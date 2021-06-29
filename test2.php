<?php

require_once("common.php");

echo "空白チェック</br>";
$mail = check_mail("");
var_dump ($MailEroorMessage); 


echo "全角チェック1</br>";
$mail = check_mail("あああ@gmail.com");
var_dump ($MailEroorMessage); 

echo "全角チェック2</br>";
$mail = check_mail("aaa@gmail.あああ");
var_dump ($MailEroorMessage); 


// 正しい形式
echo "正しい形式1</br>";
$mail = check_mail("aaa@gmail.com");
var_dump ($MailEroorMessage); 

echo "正しい形式2</br>";
$mail = check_mail("aaa@co.jp");
var_dump ($MailEroorMessage);

echo " 正しい形式3</br>";
$mail = check_mail("1111@spk.co.jp");
var_dump ($MailEroorMessage); 

echo "正しい形式4</br>";
$mail = check_mail("====@gmail.com");
var_dump ($MailEroorMessage); 

echo "正しい形式5</br>";
$mail = check_mail("=1===a@gmail.com");
var_dump ($MailEroorMessage); 

echo "正しい形式6</br>";
$mail = check_mail("11aa.@co.com");
var_dump ($MailEroorMessage); 

echo "正しい形式7</br>";
$mail = check_mail("ssss@gmail.com.jp.o");
var_dump ($MailEroorMessage); 


//　文字数
echo "少ない文字数（@前）</br>";
$mail = check_mail("aa@gmail.com");
var_dump ($MailEroorMessage); 

echo "少ない文字数（@後）1</br>";
$mail = check_mail("aaa@co.j");
var_dump ($MailEroorMessage); 

echo "少ない文字数（@後）2</br>";
$mail = check_mail("ssss@.com");
var_dump ($MailEroorMessage); 

echo "少ない文字数（@後）3</br>";
$mail = check_mail("ssss@i.com");
var_dump ($MailEroorMessage); 

echo "少ない文字数（@後）4</br>";
$mail = check_mail("ssss@g.c.jp.o");
var_dump ($MailEroorMessage); 

echo "少ない文字数（@後）5</br>";
$mail = check_mail("ssss@g.com.jp.or");
var_dump ($MailEroorMessage); 



// 一種類
echo "英字のみ</br>";
$mail = check_mail("aaaaaaaaaaa");
var_dump ($MailEroorMessage); 

echo ".のみ</br>";
$mail = check_mail("..........");
var_dump ($MailEroorMessage); 

echo "@のみ</br>";
$mail = check_mail("@@@@@@.....@");
var_dump ($MailEroorMessage); 


// .の位置
echo ".なし</br>";
$mail = check_mail("11aa@com");
var_dump ($MailEroorMessage); 

echo "最後に. 1</br>";
$mail = check_mail("ssss@gmail.com.");
var_dump ($MailEroorMessage); 

echo "最後に. 2</br>";
$mail = check_mail("ssss@gmail.com.jp.");
var_dump ($MailEroorMessage); 

echo "最後に. 3</br>";
$mail = check_mail("ssss@gmail.com.jp.or.");
var_dump ($MailEroorMessage); 
