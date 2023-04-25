## Enum
```
nmap -Pn -sS 10.10.173.216 -p- --min-rate=10000
Nmap scan report for 10.10.173.216
Host is up (0.71s latency).
Not shown: 51387 closed tcp ports (reset), 14147 filtered tcp ports (no-response)
PORT   STATE SERVICE
80/tcp open  http

Nmap done: 1 IP address (1 host up) scanned in 62.19 seconds
                                                                                                 
sudo nmap -Pn -sVC 10.10.173.216 -p 80             
Nmap scan report for 10.10.173.216
Host is up (0.43s latency).

PORT   STATE SERVICE VERSION
80/tcp open  http    Apache httpd 2.4.41 ((Ubuntu))
|_http-server-header: Apache/2.4.41 (Ubuntu)
| http-cookie-flags: 
|   /: 
|     PHPSESSID: 
|_      httponly flag not set
| http-title: Login
|_Requested resource was login.php

Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
Nmap done: 1 IP address (1 host up) scanned in 15.71 seconds
```
```
curl http://10.10.53.82 -L
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="./css/style.css" rel="stylesheet">
</head>
<body>

<br>
<form align="center" action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr>
      <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
    </tr>
    <tr>
      <td align="right" valign="top">Username</td>
      <td><input name="Username" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td><input name="Password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
    </tr>
  </table>
</form>
</body>
</html>
```
![スクリーンショット_2023-04-24_23-28-29](https://user-images.githubusercontent.com/6504854/234027407-2355aa68-1bf3-4701-a5ad-d340488127a2.png)

😢 I checked SQLi and I couldn't bypass. Also not admin/admin credential. 

![スクリーンショット_2023-04-24_23-44-03](https://user-images.githubusercontent.com/6504854/234031738-633f1cc7-bd10-4520-8ac9-fab505165a6f.png)

I did another fuzz and found /cloud dir.

![スクリーンショット_2023-04-24_23-32-19](https://user-images.githubusercontent.com/6504854/234028415-053e6e23-6a49-4f18-979e-8995fa38aa43.png)

![スクリーンショット_2023-04-24_23-40-28](https://user-images.githubusercontent.com/6504854/234031221-fd22a843-cb5c-4cb6-98a8-61a97c7fd90c.png)

![スクリーンショット_2023-04-24_23-40-49](https://user-images.githubusercontent.com/6504854/234031238-a3b3fb07-d0a1-430e-9639-0d7b900c600b.png)

![スクリーンショット_2023-04-24_23-42-39](https://user-images.githubusercontent.com/6504854/234031292-c38fbc1a-e679-412d-9fff-fefbfdbf68f2.png)

😢 I bypassed with extentions but I couldn't get shell bloked by 500 error.I stucked and checked writeups.

## User
![image](https://user-images.githubusercontent.com/6504854/234297337-a4611e63-d8aa-420a-af95-46176acc0c19.png)

😄 The same parameters have OS commands, so I got www-data shell.

同じパラメータにOSコマンドあるのでシェルはる。

![image](https://user-images.githubusercontent.com/6504854/234298095-4c4c3796-aeac-417b-9e3b-f5d8ba5a2208.png)

![image](https://user-images.githubusercontent.com/6504854/234300637-757a022b-b2af-4cac-a2ef-eb3bbe5c6225.png)

😄 Key.

![image](https://user-images.githubusercontent.com/6504854/234303841-a75fa9e5-ac45-4f5f-906d-15902be88490.png)

ダウンロードしてキーパスに読ませたがマスターキーがいるっぽし。

I downloaded it and keepass2 it, but it seems to need a master key.

```
keepass2john dataset.kdbx > dataset.hash
john -w=/usr/share/wordlists/rockyou.txt dataset.hash
```

![image](https://user-images.githubusercontent.com/6504854/234308308-085fda5d-c25e-4606-ae7c-eb61bb2793f2.png)

アスタリスクをコピペでよめる

![image](https://user-images.githubusercontent.com/6504854/234310283-200a5959-0579-40ec-8a9b-5b0691debb18.png)

## Root
いつもの豆

Usual beans

![image](https://user-images.githubusercontent.com/6504854/234336812-53d1959f-0573-482a-a19e-d978669edc26.png)

![image](https://user-images.githubusercontent.com/6504854/234337085-990d0a45-acc7-4cac-a0be-9b4a8b1f48c5.png)

![image](https://user-images.githubusercontent.com/6504854/234317787-1d55a83d-7617-4747-915c-0e2c7d4465cd.png)

オーナーが自分グループルート。めぼしいエクスプロイトがないのでファイルを確認してみる。

Owner is sysadmin group root. There are no exploits effective, so I checked the file.

![image](https://user-images.githubusercontent.com/6504854/234346063-e30bb6cd-e73f-415f-af6c-3fb6666f2a6a.png)

![image](https://user-images.githubusercontent.com/6504854/234346161-8de0cf83-3472-40f9-927c-7b4b2402c131.png)

どうやら、アップロードされたファイルはバックアップ保存されて、消されるらしい。

確かにアップロードした画像ファイルがすぐに404になるのはこのためか。

Apparently, uploaded files are backed up, saved, and then erased.Surely this is why uploaded image files are immediately and 404'?

![image](https://user-images.githubusercontent.com/6504854/234346588-ff8b769f-5ea7-4506-b1de-cb871fe86f10.png)

１分程度できえている。backup.inc.phpでシェル返せばルートシェル帰ってくるはず。

It will lose in about 1 minute.Just return the shell in backup.inc.php

![image](https://user-images.githubusercontent.com/6504854/234356290-03f63a92-67b4-42fa-a38c-0cbcef4ec1dc.png)

![image](https://user-images.githubusercontent.com/6504854/234356370-4d90b37e-9c0f-4d0c-834d-af3ccde4ef2b.png)


Pwncatが使いこなせない。もさっとするのはどして？
Nemui... 😴

