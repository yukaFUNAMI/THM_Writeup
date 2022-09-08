## Mindgames
https://tryhackme.com/room/mindgames

## Enum
```
nmap -Pn -sC -sV -sT 10.10.21.76 -vv

Scanning 10.10.21.76 [1000 ports]
Discovered open port 80/tcp on 10.10.21.76
Discovered open port 22/tcp on 10.10.21.76
Completed Connect Scan at 20:02, 40.83s elapsed (1000 total ports)
Not shown: 998 closed tcp ports (conn-refused)
PORT   STATE SERVICE REASON  VERSION
22/tcp open  ssh     syn-ack OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 24:4f:06:26:0e:d3:7c:b8:18:42:40:12:7a:9e:3b:71 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDffdMrJJJtZTQTz8P+ODWiDoe6uUYjfttKprNAGR1YLO6Y25sJ5JCAFeSfDlFzHGJXy5mMfV5fWIsdSxvlDOjtA4p+P/6Z2KoYuPoZkfhOBrSUZklOig4gF7LIakTFyni4YHlDddq0aFCgHSzmkvR7EYVl9qfxnxR0S79Q9fYh6NJUbZOwK1rEuHIAODlgZmuzcQH8sAAi1jbws4u2NtmLkp6mkacWedmkEBuh4YgcyQuh6jO+Qqu9bEpOWJnn+GTS3SRvGsTji+pPLGnmfcbIJioOG6Ia2NvO5H4cuSFLf4f10UhAC+hHy2AXNAxQxFCyHF0WVSKp42ekShpmDRpP
|   256 5c:2b:3c:56:fd:60:2f:f7:28:34:47:55:d6:f8:8d:c1 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBNlJ1UQ0sZIFC3mf3DFBX0chZnabcufpCZ9sDb7q2zgiHsug61/aTEdedgB/tpQpLSdZi9asnzQB4k/vY37HsDo=
|   256 da:16:8b:14:aa:58:0e:e1:74:85:6f:af:bf:6b:8d:58 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIKrqeEIugx9liy4cT7tDMBE59C9PRlEs2KOizMlpDM8h
80/tcp open  http    syn-ack Golang net/http server (Go-IPFS json-rpc or InfluxDB API)
|_http-title: Mindgames.
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
nmap -Pn 10.10.21.76 -p- --open --min-rate=5000

PORT   STATE SERVICE
22/tcp open  ssh
80/tcp open  http
```


🏴 I have seen that code other CTF. It's Brainf*ck!

![1](https://user-images.githubusercontent.com/6504854/189129191-26c1f6d2-aca8-4f3a-b29f-b379202a2ddc.PNG)
🏴 Muuuu,I couldn't use bash shell.

![3](https://user-images.githubusercontent.com/6504854/189129213-44158cd1-14f2-4d03-8800-e31b913cdba5.PNG)


## Flag
