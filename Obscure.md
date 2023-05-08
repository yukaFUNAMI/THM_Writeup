### Enum
```
nmap -Pn -sS 10.10.51.73 -p- --min-rate=3000
Starting Nmap 7.93 ( https://nmap.org ) at 2023-05-08 20:19 JST
Nmap scan report for 10.10.51.73
Host is up (0.50s latency).
Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE
21/tcp open  ftp
22/tcp open  ssh

```

```
nmap -Pn -sS -sVC 10.10.51.73 -p 21,22 -vv

PORT   STATE SERVICE REASON         VERSION
21/tcp open  ftp     syn-ack ttl 61 vsftpd 3.0.3
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_drwxr-xr-x    2 65534    65534        4096 Jul 24  2022 pub
| ftp-syst: 
|   STAT: 
| FTP server status:
|      Connected to ::ffff:10.4.0.111
|      Logged in as ftp
|      TYPE: ASCII
|      No session bandwidth limit
|      Session timeout in seconds is 300
|      Control connection is plain text
|      Data connections will be plain text
|      At session startup, client count was 4
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.2p2 Ubuntu 4ubuntu2.10 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey: 
|   2048 e2915c43c181196e0a28e81678c6d5c0 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDUm+0vYzeki5r+p0e9VSBEwMVzCpoAU4ZJChMXFmLxmUCK5VMiEe1SysKfr+1+eS/f3AGVEGB4FWkGgpy6LY/+VuYcmEosPtrGfEdXhyYjuYXhpZ6N/veupvI49VYgPDN/OOfmN+uxGNjsuHb2qo3g8eHm9WZGGLF31BTzYn+b2Ei3eD/E/OrBIIhafdXtXLVt7rg3phr6Wxg87he9QrHSCuUwav6QlI0BkFzVlndqonu04tw27tBMRiIrNb45FbWukHZoJPa2pXAuS04wduZBVqVGUhODyZozy+IoAiGqRu95qYZEqUO5EewYEonZOR3Qs2Buy9PHDSt5IZy8I1eP
|   256 dbf87eca5e2431f907578b8d74cbfec1 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBG+lk85La3T3xvMi1ZQBFyX88tzW77WMCX1AZi0HVEZQTJK2UWLdFSJCctW91FCL8ZPAMvAVz3CvTCQrq6cM+Dw=
|   256 406ec3a8fbdf15d12b9c0fc560bae0b6 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIEkXVxsxv+wk2hyb9TGEJc+GdOiYel/OqY9fojqlQrXy
Service Info: OSs: Unix, Linux; CPE: cpe:/o:linux:linux_kernel

```

```
ftp 10.10.51.73
Connected to 10.10.51.73.
220 (vsFTPd 3.0.3)
Name (10.10.51.73:kali): Anonymous
331 Please specify the password.
Password: 
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls
229 Entering Extended Passive Mode (|||32035|)
150 Here comes the directory listing.
drwxr-xr-x    2 65534    65534        4096 Jul 24  2022 pub
226 Directory send OK.
ftp> cd pub
250 Directory successfully changed.
ftp> ls 
229 Entering Extended Passive Mode (|||62581|)
150 Here comes the directory listing.
-rw-r--r--    1 0        0             134 Jul 24  2022 notice.txt
-rwxr-xr-x    1 0        0            8856 Jul 22  2022 password
226 Directory send OK.
ftp> get notice.txt notice.txt
local: notice.txt remote: notice.txt
229 Entering Extended Passive Mode (|||47747|)
150 Opening BINARY mode data connection for notice.txt (134 bytes).
100% |****************************************************************************************|   134      756.41 KiB/s    00:00 ETA
226 Transfer complete.
134 bytes received in 00:00 (0.25 KiB/s)
ftp> get password password
local: password remote: password
229 Entering Extended Passive Mode (|||6402|)
150 Opening BINARY mode data connection for password (8856 bytes).
100% |****************************************************************************************|  8856       25.67 MiB/s    00:00 ETA
226 Transfer complete.
8856 bytes received in 00:00 (16.90 KiB/s)
ftp> bye
221 Goodbye.
```

```
cat notice.txt                               
From antisoft.thm security,

A number of people have been forgetting their passwords so we've made a temporary password application.
```
                                                                                                                                     
```
file password  
password: ELF 64-bit LSB executable, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, for GNU/Linux 2.6.32, BuildID[sha1]=97fe26005f73d7475722fa1ed61671e82aa481ff, not stripped

./password 
Password Recovery
Please enter your employee id that is in your email
test@test.com
Incorrect employee id

```

```
strings password 

/lib64/ld-linux-x86-64.so.2
libc.so.6
__isoc99_scanf
puts
__stack_chk_fail
printf
strcmp
__libc_start_main
__gmon_start__
GLIBC_2.7
GLIBC_2.4
GLIBC_2.2.5
UH-X
SecurePaH
ssword12H

```
普通にきれいに見えて、なんか数字でEmployeeIDっぽいのあるのでそれを入れてみる。

```
./password                  
Password Recovery
Please enter your employee id that is in your email
*********
remember this next time '*****************'

```
![image](https://user-images.githubusercontent.com/6504854/236838850-2341d7ac-1fa0-4ce5-9ba3-54ccd8fadfbf.png)

WEBある？？？？
```
curl http://10.10.51.73 -vv
*   Trying 10.10.51.73:80...
* Connected to 10.10.51.73 (10.10.51.73) port 80 (#0)
> GET / HTTP/1.1
> Host: 10.10.51.73
> User-Agent: curl/7.88.1
> Accept: */*
> 
* HTTP 1.0, assume close after body
< HTTP/1.0 200 OK
< Content-Type: text/html; charset=utf-8
< Content-Length: 84
< Set-Cookie: session_id=be5c3fca90a3413567561297340c77c277a16494; Expires=Sun, 06-Aug-2023 13:32:49 GMT; Max-Age=7776000; Path=/
< Server: Werkzeug/0.9.6 Python/2.7.9
< Date: Mon, 08 May 2023 13:32:49 GMT
< 
* Closing connection 0
<html><head><script>window.location = '/web' + location.hash;</script></head></html>
```

![image](https://user-images.githubusercontent.com/6504854/236839863-d5ff928e-0398-47b1-a77c-060d25b2789b.png)

![image](https://user-images.githubusercontent.com/6504854/236839765-68a22a5a-19ec-4832-8662-3b9dd334da3b.png)

![image](https://user-images.githubusercontent.com/6504854/236842999-b7266678-5da6-4e69-94f6-bb09502b4af7.png)

![image](https://user-images.githubusercontent.com/6504854/236843146-12255292-9f80-4a04-8a14-a1f27e80470e.png)

😞

![image](https://user-images.githubusercontent.com/6504854/236855131-6295476f-e8af-4fdb-911d-538239774b21.png)

なんかさっきのパスワードでダンプがDLできた。

![image](https://user-images.githubusercontent.com/6504854/236855700-f8c56603-1007-41fd-85ef-560d2a623696.png)

![image](https://user-images.githubusercontent.com/6504854/236855946-d047e69c-6260-4912-a4e7-eae137aad45e.png)

![image](https://user-images.githubusercontent.com/6504854/236856425-9dcce627-eb1e-45d6-8fa0-a4ecd1c552bf.png)

ログインできた。

### Flag
