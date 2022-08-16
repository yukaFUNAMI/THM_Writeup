## Gotta Catch'em All!
https://tryhackme.com/room/pokemon

## Enum
```
nmap -Pn -sC -sS -sV target.thm -vv -open -T 4
```

```
Not shown: 998 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.2p2 Ubuntu 4ubuntu2.8 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 58:14:75:69:1e:a9:59:5f:b2:3a:69:1c:6c:78:5c:27 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQC5csEY9HQAEkHk16FMvfJVYh4YzdcIRCQpv2IOon6FHy3la/DkwscWsUIp7hXmMeW35Oa7OfI08LvyokxDX8bKgKUpU/dP05LNyDzv17MKB6rt3SkPbDv3XVMlu101/wkIMIOdJ38TW0+vVlU89cjQ5XiSDep4kKm/+6fEl2zM5x60DKexOOYTQ3t8SRkBV4TnWmr9wDQCDH/Kc8Pl2W9GM7hgAhVB9uUhN/EBCUbwZ8xE0ToOQz+QIkCTEuwD/AhDoURmRzv7EGut0TBrUPvFCK19v2Crw/BVQc07taDkei4N0/MwpXvI4CnJ6jpGOgxTMePk/nZusz/XbnUtnIqD
|   256 23:f5:fb:e7:57:c2:a5:3e:c2:26:29:0e:74:db:37:c2 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBP9bcehMnrIADUJHvNw7/zastIegVYRSXcF40Pky1Yllzx872e/LUM6UdTNaC4gffBnEpKcmwE9wjR+J6lfR8Yk=
|   256 f1:9b:b5:8a:b9:29:aa:b6:aa:a2:52:4a:6e:65:95:c5 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAICabmX4EeiR66bXPzMHbCZpkcUu+GSkDJP1nZ2+30Vm+
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
|_http-server-header: Apache/2.4.18 (Ubuntu)
| http-methods:
|_  Supported Methods: POST OPTIONS GET HEAD
|_http-title: Can You Find Them All?
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

![image](https://user-images.githubusercontent.com/6504854/184862188-b801bc0a-fe42-48f3-a481-ae7b2fc9b415.png)

🏴 Nothing is interesting just apache default page 'IT works' as usual?

![image](https://user-images.githubusercontent.com/6504854/184862709-38913bea-9222-4e74-9ed9-eec5e539a80f.png)
![image](https://user-images.githubusercontent.com/6504854/184863465-273068b9-dd2c-4f84-98ee-e28da03784e1.png)

🏴 This is the ssh credential.I was taken in and scanned web with ffuf.

## Flag
```
ssh p*****@target.thm
$ cd Desktop/
$ uzip P0kEmOn.zip
$ cat P0kEmOn/grass-type.txt
50 6f ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** 7d
```
![image](https://user-images.githubusercontent.com/6504854/184868063-b620f4e8-7d2e-4882-9db3-6b490f22e723.png)


```
$ find / -name 'water-type.txt' 2>/dev/null
/var/www/html/water-type.txt
$ cat /var/www/html/water-type.txt
E*******_*****{E*******}
```
![image](https://user-images.githubusercontent.com/6504854/184865034-f443d67a-131c-4041-9e49-05e474bd0bba.png)

```
$ find / -name 'fire-type.txt' 2>/dev/null/water-type.txt
/etc/why_am_i_here?/fire-type.txt
$ cat /etc/why_am_i_here?/fire-type.txt
U*************************==
```
![image](https://user-images.githubusercontent.com/6504854/184865656-06b49221-7ceb-42bf-88f6-e2d2aa035ffd.png)


```
$cd ~/Videos/Gotta/Catch/Them/ALL!

$ls -la
total 12
drwxrwxr-x 2 pokemon pokemon 4096 Jun 22  2020 .
drwxrwxr-x 3 pokemon pokemon 4096 Jun 22  2020 ..
-rw-r--r-- 1 pokemon root      78 Jun 22  2020 Could_this_be_what_Im_looking_for?.cplusplus

$ file Could_this_be_what_Im_looking_for?.cplusplus
Could_this_be_what_Im_looking_for?.cplusplus: C source, ASCII text

$ cat Could_this_be_what_Im_looking_for?.cplusplus
```
![image](https://user-images.githubusercontent.com/6504854/184867047-25ef7564-6df5-47ae-8ab6-bc069e2af38f.png)

```
$ su ***
$ cat /home/roots-pokemon.txt
```


Thank you for your time! Happy hacking 😄


![image](https://user-images.githubusercontent.com/6504854/184869204-a54db965-00f3-4a03-801d-1c4da320c9fd.png)

石粉粘土で作るしわしわピカチュウ | DETECTIVE PIKACHU - CLAY SCULPTURE より

https://youtu.be/men2MyGNzsg
