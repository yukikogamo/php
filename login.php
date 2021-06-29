<?php
require_once('config.php');

if (isset($_POST['action'])) {
    include('index.html');
    
    if ($_POST['mail'] === "") {
        echo "メールアドレスが入力されていません。".'<br>';
    }

    if ($_POST['password'] === "") {
        echo "パスワードが入力されていません。".'<br>';
    }

    //DB内でPOSTされたメールアドレスを検索
    try {
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $stmt = $pdo->prepare('select * from login_user where email = ?');
        $stmt->execute([$_POST['mail']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
    //emailがDB内に存在しているか確認
    if (!isset($row['mail'])) {
        echo 'メールアドレス又はパスワードが間違っています。';
        return false;
    }
    //パスワード確認後sessionにメールアドレスを渡す
    if (password_verify($_POST['password'], $row['password'])) {
        session_regenerate_id(true); //session_idを新しく生成し、置き換える
        $_SESSION['mail'] = $row['mail'];
        echo 'ログインしました';
    } else {
        echo 'メールアドレス又はパスワードが間違っています。';
        return false;
    }
}
  


?>

<html>
<head>
  <meta charset="utf-8">
  <title>ログイン</title>
  <h1>ログイン</h1>
</head>
<body>
  <form action="login.php" method="post">
    <input type="hidden" name="action" value="login">
    <p>メールアドレス：<input type="mail" name="mail" value = "<?php if( !empty($_POST['mail']) ){ echo $_POST['mail']; } ?>"></p>
    <p>パスワード：<input type="password" name="password"></p>
    <p><input type="submit" name="submitBtn" value="送信"></p>
    <a href="index.php"> 新規登録</a>
  </form>
</body>
</html>