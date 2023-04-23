## Enum

```
nmap -Pn -sS 10.10.223.103 -p- --min-rate=1000
Nmap scan report for 10.10.223.103
Host is up (0.31s latency).
Not shown: 65532 closed tcp ports (reset)

PORT     STATE SERVICE
22/tcp   open  ssh
80/tcp   open  http
5000/tcp open  upnp

Nmap done: 1 IP address (1 host up) scanned in 69.87 seconds
```

```
nmap -Pn -sV 10.10.223.103 -p 22,80,5000
Starting Nmap 7.93 ( https://nmap.org ) at 2023-04-23 22:49 JST
WARNING: Service 10.10.223.103:5000 had already soft-matched rtsp, but now soft-matched sip; ignoring second value
WARNING: Service 10.10.223.103:80 had already soft-matched rtsp, but now soft-matched sip; ignoring second value
Nmap scan report for 10.10.223.103
Host is up (0.91s latency).

PORT     STATE SERVICE VERSION
22/tcp   open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.5 (Ubuntu Linux; protocol 2.0)
80/tcp   open  rtsp
5000/tcp open  rtsp
2 services unrecognized despite returning data.
```
![スクリーンショット_2023-04-24_00-05-11](https://user-images.githubusercontent.com/6504854/233847589-c91be2e6-a9c7-4d55-b0ec-13cc327cab11.png)



```

```
