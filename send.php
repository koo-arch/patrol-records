<?php
  require_once 'function.php';
  // 文字エンコードの検証
  if (!cken($_POST)){
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encoding;
    // エラーメッセージを出して以下のコードをキャンセルする
    exit($err);
  }
  // HTMLエスケープ(XLL対策)
  $_POST = es($_POST);
?>

<?php
// エラーチェック
  session_start();

  // エラーを入れる配列
  $error = [];
  // POSTされた「時限」を取り出す
  if (isSet($_POST["timetable"])){
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
  if (isSet($_POST["place"])){
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
    $isTimetab = false;
  }

  // POSTされた「形式」を取り出す
  if (isSet($_POST["PCtype"])){
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
    $isPCtype = false;
  }

  if (isSet($_POST["pcnum"])){
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

  if (isSet($_POST["univ"])){
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

  if (isSet($_POST["own"])){
    if (preg_match('/^[0-9]+$/', $_POST["own"]) && $_POST["own"] >= 0){
      $own = intval($_POST["own"]);
      $isOwn = true;
    } else {
      $own = "error";
      $error[] = "大学PC利用者数に正しい数値が入力されていません";
    }
  } else {
    $isOwn = false;
  }

  $placeLen = mb_strlen($place);
  $str = mb_substr($PCtype,0,$placeLen);
  if ($place === $str){
    $room = mb_substr($PCtype,$placeLen);
    $isRoom = True;
  } else {
    $room = "error";
    $error[] = '場所の選択でエラーが発生しました';
    $isRoom = false;
  }
?>

<?php
  header("Content-type: application/json; charset=UTF-8");
  $isSubmited = $isTimetab && $isPlace && $isPCtype && $isPCnum && $isUniv && $isOwn && $isRoom;
  if ($isSubmited){
    $list = array('true',$timetable,$place,$room,$pcnum,$univ,$own);
    echo json_encode($list);
  } else {
    echo json_encode($error);
    $SESSION["error"] = $error;
  }
?>