## Intermediate Nmap
https://tryhackme.com/room/intermediatenmap

## Flag
```
nmap -Pn -sS 10.10.45.7 -p- --min-rate=5000

Host is up (0.54s latency).
Not shown: 65188 closed tcp ports (reset), 344 filtered tcp ports (no-response)
PORT      STATE SERVICE
22/tcp    open  ssh
2222/tcp  open  EtherNetIP-1
31337/tcp open  Elite
```

```
nmap -Pn -sC -sV -sS 10.10.45.7 -p 22,2222,31337 -A -T2

Starting Nmap 7.92 ( https://nmap.org ) at 2022-09-25 21:29 JST
Nmap scan report for 10.10.45.7
Host is up (0.42s latency).

PORT      STATE SERVICE VERSION
22/tcp    open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.4 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   3072 7d:dc:eb:90:e4:af:33:d9:9f:0b:21:9a:fc:d5:77:f2 (RSA)
|   256 83:a7:4a:61:ef:93:a3:57:1a:57:38:5c:48:2a:eb:16 (ECDSA)
|_  256 30:bf:ef:94:08:86:07:00:f7:fc:df:e8:ed:fe:07:af (ED25519)
2222/tcp  open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.4 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   3072 e0:55:20:cc:74:34:4c:87:9e:07:0d:7f:b0:12:12:a4 (RSA)
|   256 12:bf:14:32:39:35:88:a3:4f:c7:41:98:4b:e5:15:fb (ECDSA)
|_  256 7b:72:e6:d4:1a:ef:de:a1:14:7d:7b:37:22:27:e9:ac (ED25519)
31337/tcp open  Elite?
| fingerprint-strings:
|   DNSStatusRequestTCP, DNSVersionBindReqTCP, FourOhFourRequest, GenericLines, GetRequest, HTTPOptions, Help, Kerberos, LANDesk-RC, LDAPBindReq, LDAPSearchReq, LPDString, NULL, RPCCheck, RTSPRequest, SIPOptions, SMBProgNeg, SSLSessionReq, TLSSessionReq, TerminalServer, TerminalServerCookie, X11Probe:
|     In case I forget - user:pass
|_    u*****:D************g
1 service unrecognized despite returning data. If you know the service/version, please submit the following fingerprint at https://nmap.org/cgi-bin/submit.cgi?new-service :
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
ssh u******@10.10.45.7
The authenticity of host '10.10.45.7 (10.10.45.7)' can't be established.
Welcome to Ubuntu 20.04.3 LTS (GNU/Linux 5.13.0-1014-aws x86_64)

$ cd /home
$ ls -la
total 20
drwxr-xr-x 1 root   root   4096 Mar  2  2022 .
drwxr-xr-x 1 root   root   4096 Mar  2  2022 ..
drwxr-xr-x 1 ubuntu ubuntu 4096 Sep 25 12:33 u******
drwxr-xr-x 2 root   root   4096 Mar  2  2022 user
$ cd user
$ ls -la
total 16
drwxr-xr-x 2 root root 4096 Mar  2  2022 .
drwxr-xr-x 1 root root 4096 Mar  2  2022 ..
-rw-rw-r-- 1 root root   38 Mar  2  2022 flag.txt
$ cat flag.txt
flag{2**********************************}
```

Thank you for Nmap Senapai, may live foever! I always belong with you! 🥰🥰🥰

Thank you for your time. 😄

