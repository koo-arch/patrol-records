<?php require_once 'login.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css"> 
    <link rel="stylesheet" href="css/common.css"> 
    <title>ログイン</title>
</head>
<body>
    <div class="inner">
        <h2>計算機センター電子巡回表</h2>
        <?php if ($message != ""): ?>
        <p class="message"><?php echo es($message); ?></p>
        <?php endif; ?>
        <div class="signin">
            <form action="" method="POST">
                <label for="signin-id">アカウント名</label>
                <input id="signin-id" name="username" type="text" placeholder="ユーザー名を入力">
                <label for="signin-pass">パスワード</label>
                <input id="signin-pass" name="userpass" type="password" placeholder="パスワードを入力">
                <input value="ログイン" name="signin" type="submit">
            </form>
        </div>
    </div>
</body>
</html>

