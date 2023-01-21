<?php
    session_start();
    require_once 'function.php';
    require_once 'escape.php';
    require_once 'secret.php';
    
    //ログイン状態の場合ログイン後のページにリダイレクト
    if (isSet($_SESSION["login"])) {
        session_regenerate_id(TRUE);
        header("Location: ./users_count/patrol.php");
        exit();
    }

    // POSTされた値がない時
    if (count($_POST) === 0) {
        $message = '';
    }
    else if (empty($_POST['username']) || empty($_POST['userpass'])) {
        $message = 'ユーザー名とバスワードを入力してください';
    }
    else {
        try{
            $username = $_POST['username'];
            $userpass = $_POST['userpass'];

            $dbh = new PDO($dsn, $user, $pass);
             // SQL文(ユーザー情報の検索)
            $sql = "SELECT COUNT(*) FROM Users WHERE UserName = :username AND UserPass = :userpass";
            
            // クエリ実行
            $stmt = $dbh->prepare($sql);
            $stmt -> bindValue(':username', $username, PDO::PARAM_STR);
            $stmt -> bindValue(':userpass', $userpass, PDO::PARAM_STR);
            $stmt -> execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // ユーザー名とパスワードの情報が一致しないとき
            if ($result['COUNT(*)'] != 1) {
                $message = 'ユーザー名かパスワードが違います';
            }
            else {
                session_regenerate_id(TRUE); //セッションidを再発行
                $_SESSION['login'] = $username;
                header("Location:./users_count/patrol.php");
                exit();
            }
        } catch(PDOException $e) {
            print('データベースの接続に失敗しました'.$e->getMessage());
            die();
        }

        //接続を閉じる
        $dbh = null;
    }
?>