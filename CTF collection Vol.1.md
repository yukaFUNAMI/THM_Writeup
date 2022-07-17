## CTF collection Vol.1
https://tryhackme.com/room/ctfcollectionvol1

I can't hear English Hopelessly. 😢

#### Task 2  What does the base said?
![image](https://user-images.githubusercontent.com/6504854/179406125-97b829ae-eb2c-443e-bacf-13bf80b4db24.png)

#### Task 3  Meta meta
![image](https://user-images.githubusercontent.com/6504854/179406191-f53b8893-23d6-4331-bcf3-379c9111fa66.png)

#### Task 4  Mon, are we going to be okay?
https://futureboy.us/stegano/decinput.html
![image](https://user-images.githubusercontent.com/6504854/179406734-370c0e19-ea28-412e-bc40-62067e222137.png)

#### Task 5  Erm......Magick
![image](https://user-images.githubusercontent.com/6504854/179407433-813c65b8-e7fb-4357-a09d-939e1f0a0caa.png)

#### Task 6  QRrrrr
http://qrcode.red/

![image](https://user-images.githubusercontent.com/6504854/179408054-cada9dd9-ae76-4b0d-b435-748ea6d0d360.png)

#### Task 7  Reverse it or read it?
![image](https://user-images.githubusercontent.com/6504854/179408976-4f8a5a00-ec28-4209-a49c-04cc53d495a4.png)

#### Task 8  Another decoding stuff
![image](https://user-images.githubusercontent.com/6504854/179409525-ba05df9f-fcd7-466e-b6de-1d3d1f2f5b9b.png)

#### Task 9  Left or right
![image](https://user-images.githubusercontent.com/6504854/179409972-611c0cfc-85a1-4691-b986-aa5d5e45cf36.png)

#### Task 10  Make a comment
![image](https://user-images.githubusercontent.com/6504854/179410902-fda715fb-b712-480f-a5b1-79d859a3ad75.png)

#### Task 11  Can you fix it?
https://hexed.it/

PNG file format 89 50 4E 47 0D 0A 1A 0A

![image](https://user-images.githubusercontent.com/6504854/179411057-c933bb08-56e2-4da5-8f90-a08a24fd5817.png)

Re write 8byte and save.

#### Task 12  Read it
Googled readit flag tryhackme site:reddit.com

5th site shows flag.

#### Task 13  Spin my head
Hint binaryfuck

https://github.com/Jomy10/Brainfuck-rs

#### Task 14  An exclusive!
https://www.dcode.fr/xor-cipher

![image](https://user-images.githubusercontent.com/6504854/179411324-dfd2608a-4b3b-47dd-867f-037d58a622ff.png)

#### Task 15  Binary walk
```
binwalk -e hell.jpg 

DECIMAL       HEXADECIMAL     DESCRIPTION
--------------------------------------------------------------------------------
0             0x0             JPEG image data, JFIF standard 1.02
30            0x1E            TIFF image data, big-endian, offset of first image directory: 8
265845        0x40E75         Zip archive data, at least v2.0 to extract, uncompressed size: 69, name: hello_there.txt
266099        0x40F73         End of Zip archive, footer length: 22
 cat _hell.jpg.extracted/hello_there.txt 
Thank you for extracting me, you are the best!

THM{***_****_**_***}
```

#### Task 16  Darkness
https://www.vector.co.jp/soft/win95/prog/se375830.html
![image](https://user-images.githubusercontent.com/6504854/179411548-a1a62c14-e730-4530-99f9-9021cf9d997e.png)
![image](https://user-images.githubusercontent.com/6504854/179411731-7a0c6986-2dba-4599-b3e2-a6093276232c.png)

#### Task 17  A sounding QR
Read QRcode and goto soundcloud. Listen the flag.

#### Task 18  Dig up the past
![image](https://user-images.githubusercontent.com/6504854/179413900-a462ae4e-879c-4a71-b6ab-6dbad05130ef.png)

#### Task 19  Uncrackable!
Hint vigenere cipher

https://www.boxentriq.com/code-breaking/vigenere-cipher
![image](https://user-images.githubusercontent.com/6504854/179414421-7f2cfab0-a2b2-4c68-a601-09f406929d34.png)

#### Task 20  Small bases
```
$ python
>>> n = 581695969015253365094191591547859387620042736036246486373595515576333693
>>> h = hex(n)[2:]
>>> bytearray.fromhex(h).decode()
'THM{**_****_**_********_*****}'
```

#### Task 21  Read the packet
Follow HTTP stream.

![image](https://user-images.githubusercontent.com/6504854/179415716-84ec4be1-e767-49b5-b3e5-2b8aaf87f206.png)
![image](https://user-images.githubusercontent.com/6504854/179415963-a3444827-fe9b-43ed-b8fc-cccf2c2fc61c.png)

Steganoはいまだうさみみハリケーン最強なきしてきたwww

Happy hacking. Thank you for your time 😄 
