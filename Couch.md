## Couch
https://tryhackme.com/room/couch

## Enum
```
nmap -Pn -sC -sV -sS 10.10.111.237 -vv

Scanning 10.10.111.237 [1000 ports]
Discovered open port 22/tcp on 10.10.111.237
Completed SYN Stealth Scan at 01:04, 3.89s elapsed (1000 total ports)
Not shown: 999 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 63 OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 34:9d:39:09:34:30:4b:3d:a7:1e:df:eb:a3:b0:e5:aa (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDMXnGZUnLWqLZb8VQiVH0z85lV+G4KY5l5kKf1fS7YgSnfZ+k3CRjAZPuGceg5RQEUbOMCm+0u4SDyIEbwwAXGv0ORK4/VEIyJlZmtlqeyASwR8ML4yjdGqinqOUZ3jN/ZIg4veJ02nr86GZP+Nto0TZt7beaIxykMEZHTdo0CctdKLIet7PpvwG4F5Tn9MBoys9pUjfpcnwbf91Tv6i56Gipo07jKgb5vP8Nl1TXPjWB93WNW2vWEQ1J4tiyZlBeLOaNaEbxvNQFnKxjVYiiLCbcofwSdrwZ7/+sIy5BdiNW+k81rBN3OqaQNZ8urFaiXXf/ukRr/hhjY5a6m0MHn
|   256 a4:2e:ef:3a:84:5d:21:1b:b9:d4:26:13:a5:2d:df:19 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBNTR07g3p8MfnQVnv8uqj8GGDH6VoSRzwRFflMbEf3WspsYyVipg6vtNQMaq5uNGUXF8ubpsnHeJA+T3RilTLXc=
|   256 e1:6d:4d:fd:c8:00:8e:86:c2:13:2d:c7:ad:85:13:9c (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIKLUyz2Tpwc5qPuFxV+HnGBeqLC6NWrmpmGmE0hk7Hlj
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

```
nmap -Pn -sC -sV -sS 10.10.111.237 -vv -p 5001-7000

Starting Nmap 7.92 ( https://nmap.org ) at 2022-08-22 01:05 JST
Scanning 10.10.111.237 [2000 ports]
Discovered open port 5984/tcp on 10.10.111.237
Completed SYN Stealth Scan at 01:05, 3.71s elapsed (2000 total ports)
Not shown: 1999 closed tcp ports (reset)
PORT     STATE SERVICE REASON         VERSION
5984/tcp open  http    syn-ack ttl 63 CouchDB httpd 1.6.1 (Erlang OTP/18)
|_http-title: Site doesn't have a title (text/plain; charset=utf-8).
|_http-server-header: CouchDB/1.6.1 (Erlang OTP/18)
|_http-favicon: Unknown favicon MD5: 2AB2AAE806E8393B70970B2EAACE82E0
| http-methods:
|_  Supported Methods: GET HEAD
```

```
curl 10.10.111.237:5984

{"couchdb":"Welcome","uuid":"ef680bb740692240059420b2c17db8f3","version":"1.6.1","vendor":{"version":"16.04","name":"Ubuntu"}}
```

```
ffuf -u http://10.10.111.237:5984/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
```
```
________________________________________________

_config                 [Status: 200, Size: 4808, Words: 80, Lines: 2, Duration: 373ms]
_stats                  [Status: 200, Size: 4694, Words: 156, Lines: 2, Duration: 400ms]
favicon.ico             [Status: 200, Size: 9326, Words: 14, Lines: 12, Duration: 310ms]
secret                  [Status: 200, Size: 229, Words: 1, Lines: 2, Duration: 648ms]
:: Progress: [4713/4713] :: Job [1/1] :: 66 req/sec :: Duration: [0:01:25] :: Errors: 0 ::
```

![_config](https://user-images.githubusercontent.com/6504854/187060676-739e7e75-39ee-4370-a62c-57252119a615.PNG)

![_status](https://user-images.githubusercontent.com/6504854/187060678-77ecb040-5ea6-4254-9ed1-f4425d5653e4.PNG)

https://docs.couchdb.org/en/3.2.0/api/index.html

![_utils](https://user-images.githubusercontent.com/6504854/187060696-825454ba-cc01-49d8-a43a-f9735d6a5ce4.PNG)

![pass](https://user-images.githubusercontent.com/6504854/187060843-69c131f4-31f5-491a-b8b0-a0b519a7639e.PNG)

## Flag

![キャプチャ](https://user-images.githubusercontent.com/6504854/187060948-c51d6f3d-9aed-4c16-96c7-3278c0633cc7.PNG)

![キャプチャ2](https://user-images.githubusercontent.com/6504854/187060951-fed43789-1700-4edf-96b6-2cd056862322.PNG)

Thank you for your reading. Happy Hacking :smile:

It's easy work for privilage escaration this time! 

今回はヒストリー探して叩くだけの楽なお仕事でしたYo。（それでも答えみたけど） ｗｗｗ

