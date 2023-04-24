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

## Root

