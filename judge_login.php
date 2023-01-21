<?php
    //ログインされていない場合は強制的にログインページにリダイレクト
    if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit();
    }
?>