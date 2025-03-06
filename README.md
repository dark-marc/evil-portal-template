# Evil Portal Template: 
## Free WiFi - Google & Facebook Login

**Disclaimer: This template is strictly for authorized penetration testing and security research. Unauthorized use may violate legal and ethical guidelines. We are not liable for any misuse, damages, or legal consequences resulting from its use.**

Evil Portal creates fake login pages that mimic real captive portals on public WiFi networks. When users try to connect, they’re asked to enter credentials—often for social media or email accounts—to gain access. Once they do, their login details are captured, and their traffic can be intercepted, setting them up for further exploitation. 

**See Full Setup Instructions:** [WiFi Pineapple Hacking Tool: Guide to Setup and First Attack](https://darkmarc.substack.com/p/wifi-pineapple-hacking-tool-guide)

![Script](https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExcXFuNzRzcTIxdm94Yml3ZTY1ZWo3cmFmM3pjZG9rejYzMDMxa3B3cyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/kCYDhFs4TSY0qmrtaC/giphy.gif)

For this attack, we’ll simulate a public WiFi login page that requires users to sign in with Facebook or Google. When they enter their credentials, the password is logged, and their internet connection routes through the attacker's device. This not only gives access to their login details but also allows monitoring and manipulation of their traffic for further attacks.

### Instructions: Install Evil Portal Template

In this step, we will download and install the Evil Portal template from GitHub directly onto the WiFi Pineapple. 

#### Option 1: Manual Download

1. Visit https://github.com/dark-marc/evil-portal-template/tree/main
2. Click the green button that says: ‘<> Code’
3. Click ‘Download Zip’
4. Extract the Zip file on your computer
5. Open a terminal window, navigate to the folder where you downloaded and extracted the GitHub files to. Enter ls to find out what folder you’re in, and cd folder-name to navigate to the folder.
6. Use Secure Copy Protocol (SCP) to recursively copy the FreeWiFi folder from inside evil-portal-template to the Pineapple: ```scp -r evil-portal-template/FreeWiFi root@172.16.42.1:/root/portals/```

7. Follow the prompts to allow access to your Pineapple.

#### Option 2: Use Terminal

1. Open a terminal window.
2. Navigate to the folder you want to download the file to.
3. Enter git clone ```https://github.com/dark-marc/evil-portal-template.git```
4. Use Secure Copy Protocol (SCP) to recursively copy the FreeWiFi folder from inside evil-portal-template to the Pineapple: ```scp -r evil-portal-template/FreeWiFi root@172.16.42.1:/root/portals/```
5. Follow the prompts to allow access to your Pineapple.

To complete the installation, refresh the Evil Portal page at: ```http://172.16.42.1:1471/#/Modules/evilportal```

You should now see the template installed! 
