### Enum
```
nmap -Pn -sVC 10.10.133.73 -p 22,80 
Nmap scan report for vulnnet.thm (10.10.133.73)
Host is up.

PORT   STATE    SERVICE VERSION
22/tcp filtered ssh
80/tcp filtered http

```
```
nmap -sVC 10.10.133.73 -p 22,80 
Nmap scan report for vulnnet.thm (10.10.133.73)
Host is up (0.40s latency).

PORT   STATE SERVICE VERSION
22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.7 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 bb2ee6cc79f47d682c11bc4b631908af (RSA)
|   256 8061bf8caad14d4468154533edeb82a7 (ECDSA)
|_  256 878604e9e0c0602aab878e9bc705351c (ED25519)
80/tcp open  http    Apache httpd 2.4.29 ((Ubuntu))
|_http-server-header: Apache/2.4.29 (Ubuntu)
|_http-title: Soon &mdash; Fully Responsive Software Design by VulnNet
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

Webサーバ。Fuzzしたけど空振りなので、サブドメインを探す。

```
ffuf -w /usr/share/wordlists/seclists/Discovery/DNS/subdomains-top1million-5000.txt -u http://vulnnet.thm -H "HOST:FUZZ.vulnnet.thm" -fs 65
________________________________________________

        /'___\  /'___\           /'___\       
       /\ \__/ /\ \__/  __  __  /\ \__/       
       \ \ ,__\\ \ ,__\/\ \/\ \ \ \ ,__\      
        \ \ \_/ \ \ \_/\ \ \_\ \ \ \ \_/      
         \ \_\   \ \_\  \ \____/  \ \_\       
          \/_/    \/_/   \/___/    \/_/       

       v2.0.0-dev
________________________________________________

 :: Method           : GET
 :: URL              : http://vulnnet.thm
 :: Wordlist         : FUZZ: /usr/share/wordlists/seclists/Discovery/DNS/subdomains-top1million-5000.txt
 :: Header           : Host: FUZZ.vulnnet.thm
 :: Follow redirects : false
 :: Calibration      : false
 :: Timeout          : 10
 :: Threads          : 40
 :: Matcher          : Response status: 200,204,301,302,307,401,403,405,500
 :: Filter           : Response size: 65
________________________________________________

[Status: 200, Size: 19316, Words: 1236, Lines: 391, Duration: 405ms]
    * FUZZ: blog

[Status: 200, Size: 26701, Words: 11619, Lines: 525, Duration: 415ms]
    * FUZZ: shop

[Status: 200, Size: 18, Words: 4, Lines: 1, Duration: 610ms]
    * FUZZ: api

[Status: 307, Size: 0, Words: 1, Lines: 1, Duration: 5123ms]
    * FUZZ: admin1

:: Progress: [4989/4989] :: Job [1/1] :: 69 req/sec :: Duration: [0:00:49] :: Errors: 0 ::
```




### Flag(User)

### Flag(Root)


地震はくるわ、風が強すぎて困る、すーっと隠れて生きのびていこ。
