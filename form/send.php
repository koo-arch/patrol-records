<?php
  session_start();
  require_once '../function.php';
  require_once '../escape.php';
  require_once '../judge_login.php';
  require_once '../judge_post.php';

  // エラーを入れる配列
  $error = [];
  // POSTされた「時限」を取り出す
  if (isset($_POST["timetable"])){
    $timetabVal = ["1限","2限","3限","4限","5限"];
    $isTimetab = in_array($_POST["timetable"], $timetabVal);

    if ($isTimetab){
      $timetable = $_POST["timetable"];
    } else {
      $timetable = "error";
      $error[] = "時限の選択にエラーがありました";
    }
  } else {
    // POSTされた値が無いとき
    $isTimetab = false;
  }
  
  // POSTされた「場所」を取り出す
  if (isset($_POST["place"])){
    $placeVal = $_SESSION["placeVal"];
    $isPlace = in_array($_POST["place"], $placeVal);

    if ($isPlace){
      $place = $_POST["place"];
    } else {
      $place = "error";
      $error[] = "場所の選択にエラーがありました";
    }
  } else {
    // POSTされた値が無いとき
    $isPlace = false;
  }

  // POSTされた「形式」を取り出す
  if (isset($_POST["PCtype"])){
    $PCtypeVal = $_SESSION["PCtypeVal"];
    $isPCtype = in_array($_POST["PCtype"], $PCtypeVal);

    if ($isPCtype){
      $PCtype = $_POST["PCtype"];
    } else {
      $PCtype = "error";
      $error[] = "形式の選択にエラーがありました";
    }
  } else {
    // POSTされた値が無いとき
    $error[] = "形式の選択にエラーがありました";
    $isPCtype = false;
  }

  if (isset($_POST["pcnum"])){
    if (preg_match('/^[0-9]+$/', $_POST["pcnum"]) && $_POST["pcnum"] >= 0){
      $pcnum = intval($_POST["pcnum"]);
      $isPCnum = true; 
    } else {
      $pcnum = "error";
      $error[] = "利用可能PC台数欄に正しい数値が入力されていません";
    }
  } else {
    $isPCnum = false;
  }

  if (isset($_POST["univ"])){
    if (preg_match('/^[0-9]+$/', $_POST["univ"]) && $_POST["univ"] >= 0){
      $univ = intval($_POST["univ"]);
      $isUniv = true;
    } else {
      $univ = "error";
      $error[] = "私物PC利用者数に正しい数値が入力されていません";
    }
  } else {
    $isUniv = false;
  }

  if (isset($_POST["own"])){
    if (preg_match('/^[0-9]+$/', $_POST["own"]) && $_POST["own"] >= 0){
      $own = intval($_POST["own"]);
      $isOwn = true;
    } else {
      $own = "error";
      $error[] = "大学PC利用者数に正しい数値が入力されていません";
    }
  } else {
    $own = 0;
    $isOwn = false;
  }

  if (count($error) > 0){
    $_SESSION["error"] = $error;
    header("Location:register.php");
    exit();
  }
  
  $chkno = $_SESSION["chkno"];
  require_once 'confirm.php';
?>