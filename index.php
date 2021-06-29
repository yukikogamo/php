<?php
require_once('config.php');
require_once("common.php");

try {
    include('index.html');

    if (isset($_POST['action'])) {
        // DBに接続
        $pdo = new PDO($dsn, $db_user, $db_pass);

        $mail = check_mail($_POST['mail']);
        if ($mail === false) {
            $error['mail'] = 'mail error';
        echo $MailEroorMessage;
        }
        else {
            $member = $pdo->prepare('SELECT COUNT(*) as cnt FROM login_user WHERE email=:mail');
            $member->execute(array(':mail' => $_POST['mail']));
            $record = $member->fetch();
            if ($record['cnt'] > 0) {
                $error['mail'] = 'duplicate';
                echo "すでに登録済みです。".'<br>';
            }
        }

        $pass = check_password($_POST['password']);
        if ($pass === false) {
        //var_dump($message);
        $error['mail'] = 'pass error';
        echo $PassEroorMessage;
        }

        if (!isset($error)) {
            //echo " あああ";
            $stmt_insert = $pdo->prepare("INSERT INTO login_user (email, password) VALUES  (:email , :password )");   
            $params = array(':email' => $_POST['mail'], ':password' => $_POST['password']); 
            $stmt_insert->execute($params);
            echo "格納しました。";
    
        }
    }
} catch (PDOException $e) {
    exit(' エラー' . $e->getMessage());
}

?>

