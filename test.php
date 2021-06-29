<?php

require_once("common.php");

 echo "空文字チェック</br>";
$ans = check("");
echo "ans;;["+$ans+"]"; 

echo "文字数チェック</br>";
$ans2 = check("a1");
echo $ans2;

echo "英数チェック</br>";
$ans3 = check("aaaa1111");
echo $ans3;

echo "英記号チェック</br>";
$ans4 = check("aaaa[[[[");
echo $ans4; 

echo "数記号チェック</br>";
$ans5 = check("1111=====");
echo $ans5;

echo "英数記号チェック</br>";
$ans6 = check("aaaa1111....");
echo $ans6;


echo "全角チェック</br>";
$ans7 = check("ああああああああ");
echo $ans7; 

echo " 一種類チェック</br>";
$ans8 = check("aaaaaaaaa");
echo $ans8; 