<?php
    require_once '../function.php';
    require_once '../escape.php';
    require_once '../judge_login.php';
    require_once '../judge_post.php';

      // DB接続
    require '../secret.php';

    try{
        $dbh = new PDO($dsn, $user, $pass);

        // SQL文(巡回場所の取得)
        $sql = "SELECT ID FROM 巡回記録 WHERE 日付 = CURRENT_DATE AND 時限 = :timetable AND 場所 = :place AND 形式 = :PCtype";
        $stmt = $dbh->prepare($sql);

        $stmt -> bindValue(':timetable', $timetable, PDO::PARAM_STR);
        $stmt -> bindValue(':place', $place, PDO::PARAM_STR);
        $stmt -> bindValue(':PCtype', $PCtype, PDO::PARAM_STR);

        $stmt -> execute();
        $ID_Array = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    
    }catch(PDOException $e){
        print("データベースの接続に失敗しました".$e->getMessage());
        die();
    }

    //接続を閉じる
    $dbh = null;

    $update = false;
    $ID = 0;
    if (!empty($ID_Array)) {
        $ID = $ID_Array[0]['ID'];
        $update = true;
    }
?>