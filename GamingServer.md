## GamingServer
https://tryhackme.com/room/gamingserver

### 👾Enum
```
nmap -Pn -sC -sV -sT 10.10.146.216 -A -p- -vv
```
```
Discovered open port 80/tcp on 10.10.146.216
Discovered open port 22/tcp on 10.10.146.216
```
ちなスキャン終わらず（フレッツ光クロスはよ～）
```
curl http://10.10.146.216/
```
```
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<head>
        <title>House of danak</title>
        <meta  charset="utf-8">
        <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
        <div id="page">
                <div id="header">
                        <a id="logo" href="index.html"><img src="logo.png" alt=""></a>
                        <ul class="navigation">
                                <li class="first">
                                        <a class="active" href="index.html">House of danak</a>
                                </li>
                                <li>
                                        <a href="about.html">draagan lore</a>
                                </li>
                                <li>
                                        <a href="myths.html">myths of d'roga</a>
                                </li>
                                <li>
                                        <a href="#">ARCHIVES</a>
                                </li>
                        </ul>
                </div>
                                <li class="last">
                                        <a href="#" class="archives">&nbsp;</a>
                                </li>
                        </ul>
                </div>
        </div>
</body>
<!-- john, please add some actual content to the site! lorem ipsum is horrible to look at. -->
</html>
```
👾 Username??? john

```
ffuf -u http://10.10.146.216/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -r
```
```
.htaccess               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 4148ms]
.hta                    [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 5346ms]
.htpasswd               [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 6441ms]
index.html              [Status: 200, Size: 2762, Words: 241, Lines: 78, Duration: 317ms]
robots.txt              [Status: 200, Size: 33, Words: 3, Lines: 4, Duration: 319ms]
secret                  [Status: 200, Size: 941, Words: 64, Lines: 17, Duration: 312ms]
server-status           [Status: 403, Size: 278, Words: 20, Lines: 10, Duration: 312ms]
uploads                 [Status: 200, Size: 1341, Words: 83, Lines: 19, Duration: 373ms]
:: Progress: [4712/4712] :: Job [1/1] :: 120 req/sec :: Duration: [0:00:43] :: Errors: 0 ::
```
👾 Yummy,do always? Mumumu,itumonoka?

  
### 👾Flag

スベスベマンジュウガニ食べたら死ぬらしい
適当に見つけた蟹は食べてはダメ


