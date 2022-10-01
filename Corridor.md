## Corridor
https://tryhackme.com/room/corridor

## Flag
```
nmap -Pn -sS 10.10.84.216 -p- --min-rate=1000

Starting Nmap 7.92 ( https://nmap.org ) at 2022-10-01 17:45 JST
Nmap scan report for 10.10.84.216
Host is up (0.44s latency).
Not shown: 65534 closed tcp ports (reset)
PORT   STATE SERVICE
80/tcp open  http

Nmap done: 1 IP address (1 host up) scanned in 68.78 seconds
```

```
curl http://ip.thm/

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Corridor</title>

    <link rel="stylesheet" href="/static/css/main.css">
</head>

<body>
    

<img src="/static/img/corridor.png" usemap="#image-map">

    <map name="image-map">
        <area target="" alt="c4ca4238a0b923820dcc509a6f75849b" title="c4ca4238a0b923820dcc509a6f75849b" href="c4ca4238a0b923820dcc509a6f75849b" coords="257,893,258,332,325,351,325,860" shape="poly">
        <area target="" alt="c81e728d9d4c2f636f067f89cc14862c" title="c81e728d9d4c2f636f067f89cc14862c" href="c81e728d9d4c2f636f067f89cc14862c" coords="469,766,503,747,501,405,474,394" shape="poly">
        <area target="" alt="eccbc87e4b5ce2fe28308fd9f2a7baf3" title="eccbc87e4b5ce2fe28308fd9f2a7baf3" href="eccbc87e4b5ce2fe28308fd9f2a7baf3" coords="585,698,598,691,593,429,584,421" shape="poly">
        <area target="" alt="a87ff679a2f3e71d9181a67b7542122c" title="a87ff679a2f3e71d9181a67b7542122c" href="a87ff679a2f3e71d9181a67b7542122c" coords="650,658,644,437,658,652,655,437" shape="poly">
        <area target="" alt="e4da3b7fbbce2345d7772b0674a318d5" title="e4da3b7fbbce2345d7772b0674a318d5" href="e4da3b7fbbce2345d7772b0674a318d5" coords="692,637,690,455,695,628,695,467" shape="poly">
        <area target="" alt="1679091c5a880faf6fb5e6087eb1b2dc" title="1679091c5a880faf6fb5e6087eb1b2dc" href="1679091c5a880faf6fb5e6087eb1b2dc" coords="719,620,719,458,728,471,728,609" shape="poly">
        <area target="" alt="8f14e45fceea167a5a36dedd4bea2543" title="8f14e45fceea167a5a36dedd4bea2543" href="8f14e45fceea167a5a36dedd4bea2543" coords="857,612,933,610,936,456,852,455" shape="poly">
        <area target="" alt="c9f0f895fb98ab9159f51fd0297e236d" title="c9f0f895fb98ab9159f51fd0297e236d" href="c9f0f895fb98ab9159f51fd0297e236d" coords="1475,857,1473,354,1537,335,1541,901" shape="poly">
        <area target="" alt="45c48cce2e2d7fbdea1afc51c7c6ad26" title="45c48cce2e2d7fbdea1afc51c7c6ad26" href="45c48cce2e2d7fbdea1afc51c7c6ad26" coords="1324,766,1300,752,1303,401,1325,397" shape="poly">
        <area target="" alt="d3d9446802a44259755d38e6d163e820" title="d3d9446802a44259755d38e6d163e820" href="d3d9446802a44259755d38e6d163e820" coords="1202,695,1217,704,1222,423,1203,423" shape="poly">
        <area target="" alt="6512bd43d9caa6e02c990b0a82652dca" title="6512bd43d9caa6e02c990b0a82652dca" href="6512bd43d9caa6e02c990b0a82652dca" coords="1154,668,1146,661,1144,442,1157,442" shape="poly">
        <area target="" alt="c20ad4d76fe97759aa27a0c99bff6710" title="c20ad4d76fe97759aa27a0c99bff6710" href="c20ad4d76fe97759aa27a0c99bff6710" coords="1105,628,1116,633,1113,447,1102,447" shape="poly">
        <area target="" alt="c51ce410c124a10e0db5e4b97fc2af39" title="c51ce410c124a10e0db5e4b97fc2af39" href="c51ce410c124a10e0db5e4b97fc2af39" coords="1073,609,1081,620,1082,459,1073,463" shape="poly">
    </map>


</body>
</html>
```

![image](https://user-images.githubusercontent.com/6504854/193406608-2d2f673e-0952-4149-8867-1055fb163b1c.png)
![image](https://user-images.githubusercontent.com/6504854/193406651-2cee24df-8392-448c-8de7-85cbea7e8c39.png)
![image](https://user-images.githubusercontent.com/6504854/193406707-36d06050-7dcb-43e4-9a6d-b42ef7bf22f9.png)

🚩 alt="xxxxxxx" is MD5 hash from 1 to 13... 🤔

md50-100.py

```
import hashlib

# MD5のハッシュ値
for num in range(101):
    h = hashlib.md5(str(num).encode()).hexdigest()
    print(h)
```

```
python3 md50-100.py > md51-100.txt

ffuf -u http://ip.thm/FUZZ -w=md51-100.txt
________________________________________________

a87ff679a2f3e71d9181a67b7542122c [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 462ms]
8f14e45fceea167a5a36dedd4bea2543 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 462ms]
c81e728d9d4c2f636f067f89cc14862c [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 462ms]
c4ca4238a0b923820dcc509a6f75849b [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 462ms]
6512bd43d9caa6e02c990b0a82652dca [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 463ms]
45c48cce2e2d7fbdea1afc51c7c6ad26 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 463ms]
c51ce410c124a10e0db5e4b97fc2af39 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 463ms]
c9f0f895fb98ab9159f51fd0297e236d [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 463ms]
c20ad4d76fe97759aa27a0c99bff6710 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 463ms]
eccbc87e4b5ce2fe28308fd9f2a7baf3 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 464ms]
d3d9446802a44259755d38e6d163e820 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 464ms]
e4da3b7fbbce2345d7772b0674a318d5 [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 465ms]
1679091c5a880faf6fb5e6087eb1b2dc [Status: 200, Size: 632, Words: 72, Lines: 24, Duration: 465ms]
cf*****************************a [Status: 200, Size: 797, Words: 121, Lines: 34, Duration: 466ms]
:: Progress: [101/101] :: Job [1/1] :: 37 req/sec :: Duration: [0:00:05] :: Errors: 0 ::
```

```
curl http://ip.thm/cf*****************************a

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Corridor</title>

    <link rel="stylesheet" href="/static/css/main.css">
</head>

<body>
    

<style>
    body{
        background-image: url("/static/img/empty_room.png");
        background-size:  cover;
    }

    h1 {
        width: 100%;
        position: absolute;
        top: 40%;
        text-align: center;
    }
</style>
<h1>
    flag{24*******************************e}
</h1>
```

Yatta \(^o^)/🚩

Thank you for your time, Happy Hacking 😄

