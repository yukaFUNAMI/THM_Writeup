### :ramen: Capture!
https://tryhackme.com/room/capture

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/94946a2e-17b6-409d-a6e6-6fd9e2a1a2bb)

🤔　usernames.txt passwords.txt が与えられるので、これでID見つけるだけだと思った。Hydraまわしてダメ。


![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/9304cb7d-fa63-48f7-8207-733af099865b)

🤔　リキャプチャがあった。簡単な計算問題のよう。レスポンスから計算してリクエストに設定できればよさそう。

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/22ffffaf-6fcb-4096-bb1c-aaaa1e3ca364)

🤔 Error: The user 'test' does not exist とありヒントにErrorの内容を読むようにかいてある。
とりまPHPでつくる。ほとんどちゃっとさんからコピペしたのに半日かかってしまった。つらい。。。

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/1f53235e-d9a5-4947-b786-11690b05dd11)

🤓 今日人類が一番頑張ったところはここ！

全部リストまわりきって、みつからんぞ（バグか？ﾌﾟﾝｽｶ）となり、WriteUpにあったPythonをまわしたところ、見つかった。
自バグだった。えー、一行読み込みの時の改行のCRLF。昔もあったきがするし、よくあるバグです。（疑ってすいません。）

![image](https://github.com/yukaFUNAMI/THM_Writeup/assets/6504854/ba31385f-5119-4256-9510-06cd841184ee)

🤓 私の環境では471秒かかった。途中経過が気になる方はデバッグ用のechoだしてみて。余計時間かかりますが。。。
複数スレッドで同時にPOSTするとリキャプチャがずれてダメ。1スレで気長にやるしかない。

### :ramen: Okawari
意外と遅いということで高速化を図るべくRustでやってみる。

また無駄なものを切ってしまった。。。
