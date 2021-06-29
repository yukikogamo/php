<?php

require_once('config.php');
require_once("common.php");

try {

    // actionが起きたら
    if (isset($_POST['action'])) {
        $ans = check($_POST['password']);
        if ($ans === false) {
        //var_dump($ans) ;
        echo $message;
        }
        if ($ans === true) {
            //echo " あああ";
            $pdo = new PDO($dsn, $db_user, $db_pass);
    
            $smt = $pdo->prepare('UPDATE login_user SET email = :mail, password = :password WHERE id = :id');
    
            $smt->execute(array(':mail' => $_POST['email'], ':password' => $_POST['password'], ':id' => $_POST['id']));

            echo "更新しました";
    
        }

    }

    // 初期表示
    // DBへ接続
    $pdo = new PDO($dsn, $db_user, $db_pass);

    // SQL作成
    $stmt = $pdo->prepare("SELECT * FROM login_user where id = :id");

    $stmt->execute(array(':id' => $_POST['id']));
        
    $row = $stmt->fetch();

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>編集</title>

    <div class="contact-form">
        <h2>編集</h2>
        <form action="update.php" method="post">
        <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo($_POST['id']);?>">
            <p>
                <input type="text" name="email" value="<?php echo($row['email']);?>">
                <input type="text" name="password" value="<?php echo($row['password']);?>">
            </p>

            <input name="submit" type="submit" value="更新する">
            <a href="list.php">一覧へ</a>

        </form>
    </div>
</body>
</html>