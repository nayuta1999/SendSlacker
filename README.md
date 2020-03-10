SendSlacker
====

## 概要
Slackにincoming webhookのAPIにGuzzleを使って送信します．
簡易にSlackに何かを送信したいときに便利です．

## 依存関係
php:7.3
guzzlehttp/guzzle
## Install
```
composer require nayuta1999/sendslacker
```

## 使い方

宣言例
```
$client_slack = new SendSlacker("https://hooks.slack.com/services/XXXXXXXXX");
```
プログラム直書きはよくないのでphpdotenvなどを別にinstallして使うべき．

メッセージの送り方
```
$client_slack->sendText("XXXXXXX");
```
ただのテキストメッセージを送信するならこのメソッドを呼ぶ．

blocksやattachmentsを使うとき
```
$client_slack->addBlock($block);//$blockの中にはblockとして送信したい連想配列を入力する．
$client_slack->addAttachments($attachments);//$attachmentsの中にはattachmentsとして送信したい連想配列を入力する
```

debugをしたいとき
```
$client_slack->setdebug();
```

debug時はhttp_errorを無効にしない．


## Licence

Copyright (c) 2020 nayuta1999
Released under the MIT license
https://opensource.org/licenses/mit-license.php