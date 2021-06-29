<?php

include('rensyu.html');

if (isset($_GET['action'])) {
    function check_name($name) {
        //global $nameEroorMessage;
        if ($name === "") {
            return "名前が入力されていません。".'<br>';
        } elseif (mb_strlen($name) > 8) {
            return '名前は8文字以下で設定してください<br />';
        }
        return null;
    }

    function check_mail($mail) {
        $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        if ($mail === "") {
            return "メールアドレスが入力されていません。".'<br>';
        } elseif (!preg_match($pattern, $mail)) {
            return '正しいメールアドレスの形式で設定してください<br />';
        }
        return null;
    }

    function check_password($password) {
        if ($password === "") {
            return "パスワードが入力されていません。".'<br>';
        } elseif (mb_strlen($password) != 8) {
            return 'パスワードは8文字で設定してください<br />';
        }
        return null;
    }

    function check_adress($adress) {
        global $adressEroorMessage;
        if ($adress === "") {
            return "住所が入力されていません。".'<br>';
        } elseif (mb_strlen($adress) > 256) {
            return '住所は256文字以下で設定してください<br />';
        }
        return null;
    }

    function check_age($age) {
        global $ageEroorMessage;
        if ($age === "") {
            return "年齢が入力されていません。".'<br>';
        } elseif ($age < 0) {
            return '年齢は正の数字で設定してください<br />';
        }
        return null;
    }

    function check_date($date) {
        global $dateEroorMessage;
        if ($date === "") {
            return "日付が入力されていません。".'<br>';
        }
        elseif (isset($date)) {
            list($year, $month, $day) = explode('/', $date);
            if ($year >= 2021 && $month >= 04 && $day > 28) {
                return '今までの日付で入力してください<br />';
            } elseif ($year <= 1921 && $month <= 04 && $day < 28) {
                return '100年前までの日付で入力してください<br />';
            }
        }
        return null;
    }

    $name = check_name($_GET['name']);
    echo $name;

    $mail = check_mail($_GET['mail']);
    echo $mail;

    $password = check_password($_GET['password']);
    echo $password;

    $adress = check_adress($_GET['adress']);
    echo $adress;

    $age = check_age($_GET['age']);
    echo $age;

    $date = check_date($_GET['date']);
    echo $date;
}


if (isset($_POST['action'])) {
    function check_name_post($name_post) {
        global $nameEroorMessage;
        if ($name_post === "") {
            $nameEroorMessage = "名前が入力されていません。".'<br>';
        } elseif (mb_strlen($name_post) > 8) {
            $nameEroorMessage = '名前は8文字以下で設定してください<br />';
        }
    }

    function check_mail_post($mail_post) {
        global $mailEroorMessage;
        $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        if ($mail_post === "") {
            $mailEroorMessage = "メールアドレスが入力されていません。".'<br>';
        } elseif (!preg_match($pattern, $mail_post)) {
            $mailEroorMessage = '正しいメールアドレスの形式で設定してください<br />';
        }
    }

    function check_password_post($password_post) {
        global $passEroorMessage;
        if ($password_post === "") {
            $passEroorMessage = "パスワードが入力されていません。".'<br>';
        } elseif (mb_strlen($password_post) != 8) {
            $passEroorMessage = 'パスワードは8文字で設定してください<br />';
        }
    }

    function check_adress_post($adress_post) {
        global $adressEroorMessage;
        if ($adress_post === "") {
            $adressEroorMessage = "住所が入力されていません。".'<br>';
        } elseif (mb_strlen($adress_post) > 256) {
            $adressEroorMessage = '住所は256文字以下で設定してください<br />';
        }
    }

    function check_age_post($age_post) {
        global $ageEroorMessage;
        if ($age_post === "") {
            $ageEroorMessage = "年齢が入力されていません。".'<br>';
        } elseif ($age_post < 0) {
            $ageEroorMessage = '年齢は正の数字で設定してください<br />';
        }
    }

    function check_date_post($date_post) {
        global $dateEroorMessage;
        if ($date_post === "") {
            $dateEroorMessage = "日付が入力されていません。".'<br>';
        } elseif (isset($date_post)) {
            list($year, $month, $day) = explode('/', $date_post);
            if ($year >= 2021 && $month >= 04 && $day > 28) {
                $dateEroorMessage = '今までの日付で入力してください<br />';
            } elseif ($year <= 1921 && $month <= 04 && $day < 28) {
                $dateEroorMessage = '100年前までの日付で入力してください<br />';
            }
        }
    }


    $name_post = check_name_post($_POST['name']);
    echo $nameEroorMessage;

    $mail_post = check_mail_post($_POST['mail']);
    echo $mailEroorMessage;

    $password_post = check_password_post($_POST['password']);
    echo $passEroorMessage;

    $adress_post = check_adress_post($_POST['adress']);
    echo $adressEroorMessage;

    $age_post = check_age_post($_POST['age']);
    echo $ageEroorMessage;

    $date_post = check_date_post($_POST['date']);
    echo $dateEroorMessage;
}


