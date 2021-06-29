<?php

require_once('config.php');

try {

    $pdo = new PDO($dsn, $db_user, $db_pass);

    $sql = 'DELETE FROM login_user where id = :id';
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam( ':id', $_POST['id'], PDO::PARAM_INT );
    $stmt->execute();
    echo "削除しました。";

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>削除完了</title>
  </head>
  <body>          
  <p>
      <a href="list.php">一覧へ</a>
  </p> 
  </body>
</html>