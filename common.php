<?php

function check_password($pass) {
    global $PassEroorMessage;
        if ($pass === "") {
            $PassEroorMessage = "パスワードが入力されていません。".'<br>';
            return false;
        } 
        if (mb_strlen($pass) < 8) {
                $PassEroorMessage = "パスワードは8文字以上で設定してください<br />";
                return false;
        }
        // 入力されたパスワードが半角英数記号2種類 以上かどうかをチェック
        $alpa = ctype_alpha($pass);
        $digit = ctype_digit($pass);
        $punct = ctype_punct($pass);
        $str = ($pass);
        $len = mb_strlen($str, "UTF-8");
        $wdt = mb_strwidth($str, "UTF-8");

        if (($alpa) || ($digit) || ($punct) || ($len != $wdt)){
            //$error['password'] = 'undefine';
            $PassEroorMessage = "パスワードは半角英数字及び記号を2種類以上入れてください。<br />";
            return false;
        }
        return true;
}

function check_mail($mail) {
    var_dump($mail);
    global $MailEroorMessage;
    $MailEroorMessage = "";

    // 空白チェック
    if ($mail === "") {
        $MailEroorMessage = "  メールアドレスが入力されていません。".'<br>';
        return false;
    }


    // @と.チェック
    if (!str_contains($mail, '@')) {
        $MailEroorMessage = "メールアドレスには@ を入れてください".'<br>';
        return false;
    } elseif (!str_contains($mail, '.')) {
        $MailEroorMessage = "メールアドレスには. を入れてください".'<br>';
        return false;
    } 

    // メールアドレスを分割
    $arr1 = array(explode("@", $mail));

    //文字数チェック
    $cnt1 = mb_strlen($arr1[0] [0]);
    if ($cnt1 < 3) {
        $MailEroorMessage = "メールアドレスには＠の前に半角3つ以上を入れてください".'<br>';
        return false;
    } 

    $arr2 = array(explode(".", $arr1[0] [1]));


    for ($i = 0; $i < count($arr2[0]); $i++) {
            if (mb_strlen($arr2[0] [$i]) < 2) {
                $MailEroorMessage = "メールアドレスには.の前後に半角2つ以上を入れてください".'<br>';
                return false;
            }
    }

    // 半角チェック
    $len = mb_strlen($mail, "UTF-8");
    $wdt = mb_strwidth($mail, "UTF-8");

    if ($len == $wdt) {
        return true;
    } elseif (str_contains($arr1[0] [0], '.')) {
        return true;
    } else { $MailEroorMessage = "メールアドレスには半角英数のみ使用してください".'<br>'; return false; }



    return true;
}
