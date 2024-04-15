## 🍜 Enum
```
nmap -Pn -sS 10.10.153.72 -p- --min-rate 5000 -v

Scanning creative.thm (10.10.153.72) [65535 ports]
Discovered open port 22/tcp on 10.10.153.72
Discovered open port 80/tcp on 10.10.153.72

Completed SYN Stealth Scan at 16:46, 36.09s elapsed (65535 total ports)
Nmap scan report for creative.thm (10.10.153.72)
Not shown: 65533 filtered tcp ports (no-response)
PORT   STATE SERVICE REASON
22/tcp open  ssh     syn-ack ttl 63
80/tcp open  http    syn-ack ttl 63
```


```
nmap -Pn -sVC 10.10.153.72 -p 22,80 -A -T4

PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.5 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   3072 a0:5c:1c:4e:b4:86:cf:58:9f:22:f9:7c:54:3d:7e:7b (RSA)
|   256 47:d5:bb:58:b6:c5:cc:e3:6c:0b:00:bd:95:d2:a0:fb (ECDSA)
|_  256 cb:7c:ad:31:41:bb:98:af:cf:eb:e4:88:7f:12:5e:89 (ED25519)
80/tcp open  http    nginx 1.18.0 (Ubuntu)
|_http-title: Creative Studio | Free Bootstrap 4.3.x template
|_http-server-header: nginx/1.18.0 (Ubuntu)
```
```
vi /etc/hosts
                                                                             
127.0.0.1       kali
127.0.0.1       localhost
10.10.153.72    creative.thm
```

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/7c5a00c4-a654-4e68-8295-4ee909b4c0d8)

```
ffuf -w /usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt -u http://creative.thm/FUZZ 

assets                  [Status: 301, Size: 178, Words: 6, Lines: 8, Duration: 421ms]
index.html              [Status: 200, Size: 37589, Words: 14867, Lines: 686, Duration: 506ms]
:: Progress: [4713/4713] :: Job [1/1] :: 101 req/sec :: Duration: [0:00:44] :: Errors: 0 ::
```
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/2fb568f0-272b-48fc-afa4-03cf4e9a9679)


```
ffuf -w /usr/share/wordlists/SecLists/Discovery/Web-Content/common.txt -u http://creative.thm/assets/FUZZ

css                     [Status: 301, Size: 178, Words: 6, Lines: 8, Duration: 390ms]
imgs                    [Status: 301, Size: 178, Words: 6, Lines: 8, Duration: 332ms]
js                      [Status: 301, Size: 178, Words: 6, Lines: 8, Duration: 335ms]
vendors                 [Status: 301, Size: 178, Words: 6, Lines: 8, Duration: 362ms]
:: Progress: [4713/4713] :: Job [1/1] :: 109 req/sec :: Duration: [0:00:44] :: Errors: 0 ::
```
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/8a97f72d-3544-4117-b3ae-b9d7ebf8e539)


```
ffuf -w /usr/share/wordlists/SecLists/Discovery/DNS/subdomains-top1million-5000.txt -u http://creative.thm -H "Host: FUZZ.creative.thm" -fs 178 

beta                    [Status: 200, Size: 591, Words: 91, Lines: 20, Duration: 407ms]
```
```
vi /etc/hosts

127.0.0.1       kali
127.0.0.1       localhost
10.10.153.72   creative.thm
10.10.153.72  beta.creative.thm
```
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/7140cf8e-9be3-441e-86d2-d8667151727f)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/3b6b4d7f-9e3e-4f45-98c2-c1b68fca0737)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/4a5f487a-27d5-4135-bf28-7f2e6be47103)

This page has SSRF. I found open port.

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/6c4a0fef-e182-4a42-b86b-6e1ce83b3e87)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/5b140182-2f3e-4d72-a67a-898b7e9195c8)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/7be041b2-97a1-451b-97a2-943f7c3dadf5)

🍜 username saad:x:1000:1000:saad:/home/saad:/bin/bash

## 🍜 User
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/0cd5a3d0-947f-4dda-9099-edd174964df1)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/da8782da-6ae7-46b1-a579-71b661e10dc0)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/ec105341-6858-4acf-b54d-ba6e1691cb14)

🍜 I got ssh key.

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/73666536-2a2b-49e4-9215-3ad9488f752a)

## 🍜 Root
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/e8b3d1e3-9c7a-4949-b856-e16a1f0bf812)


<a href="https://www.hackingarticles.in/linux-privilege-escalation-using-ld_preload/">
https://www.hackingarticles.in/linux-privilege-escalation-using-ld_preload/
</a>


![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/017b4c3e-2ff6-460d-a535-49264a609753)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/ae32d1ee-fd41-4952-bcfb-69677a194422)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/ae9e3bd9-65b1-4681-9cc6-4b1551f3a7e9)

## 🍜🍜 omake
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/46a8aed7-7328-4160-97f4-ffa4c2d0b6fb)

de.sh

```
#! /bin/bash

set -eu

# find path to liblzma used by sshd
path="$(ldd $(which sshd) | grep liblzma | grep -o '/[^ ]*')"

# does it even exist?
if [ "$path" == "" ]
then
	echo probably not vulnerable
	exit
fi

# check for function signature
if hexdump -ve '1/1 "%.2x"' "$path" | grep -q f30f1efa554889f54c89ce5389fb81e7000000804883ec28488954241848894c2410
then
	echo probably vulnerable
else
	echo probably not vulnerable
fi
```
<a href="https://www.kali.org/blog/xz-backdoor-getting-started/"> 
https://www.kali.org/blog/xz-backdoor-getting-started/
</a>

🍜 Not Vuln.

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/38f5c9db-055c-4940-9a2e-9f9c7571e9b5)

二刀流とはいかなかった。。ちゅるちゅるちゅるちゅる。。。

