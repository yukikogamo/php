<?php

require_once('config.php');

// 変数の初期化
$sql = null;
$res = null;
$pdo = null;

try {
    // DBへ接続
    $pdo = new PDO($dsn, $db_user, $db_pass);

    // SQL作成
    $sql = "SELECT * FROM login_user";

    // SQL実行
    $res = $pdo->query($sql);

} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

// 接続を閉じる
$pdo = null;


?>

<html>
<head>
  <meta charset="utf-8">
  <title>一覧</title>
  <h1>一覧</h1>
  <style>
    .menu{
      display: flex;
    }
  </style>
</head>
<body>
    <p><a href="index.php"><button>作成</button></a></p>
    

    
    <?php
    // 取得したデータを出力
    foreach( $res as $value ): ?>
        メールアドレス：<?php echo "$value[email]"; ?>
        パスワード：<?php echo "$value[password]";?>
            <ul class="menu">
                <form action="update.php" method="post">
                    <button type="submit" name="update">更新</button>
                    <input type="hidden" name="id" value="<?=$value['id']?>">
                </form>
                <form action="delete.php" method="post">
                    <button type="submit" name="remove">削除</button>
                    <input type="hidden" name="id" value="<?=$value['id']?>">
                </form>
            </ul>
    <?php endforeach; ?>


        


</body>
</html>

