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
Nmap scan report for 10.10.223.103
Host is up (0.91s latency).

PORT     STATE SERVICE VERSION
22/tcp   open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.5 (Ubuntu Linux; protocol 2.0)
80/tcp   open  rtsp
5000/tcp open  rtsp
2 services unrecognized despite returning data.
```
![スクリーンショット_2023-04-24_00-05-11](https://user-images.githubusercontent.com/6504854/233847589-c91be2e6-a9c7-4d55-b0ec-13cc327cab11.png)

![スクリーンショット_2023-04-24_00-10-30](https://user-images.githubusercontent.com/6504854/233848226-05db3cbd-c8e9-463f-9b6d-23b11c1fbfd9.png)

![スクリーンショット_2023-04-24_00-11-55](https://user-images.githubusercontent.com/6504854/233848235-c15e147e-b5e5-4f56-83ed-291b063db179.png)

![スクリーンショット_2023-04-24_00-12-30](https://user-images.githubusercontent.com/6504854/233848244-88f28159-0fb2-4d41-8822-38a21495107b.png)

![スクリーンショット_2023-04-24_00-16-39](https://user-images.githubusercontent.com/6504854/233848252-453fad2b-5894-4a06-a26c-da06dc2e58eb.png)

![スクリーンショット_2023-04-24_00-19-21](https://user-images.githubusercontent.com/6504854/233848356-036db8a2-5b3e-4d16-af61-6309363d777d.png)

object, iframe ,embed どれでも使えた。 
