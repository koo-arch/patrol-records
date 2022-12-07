<?php 
  require_once 'function.php';
  session_start();
  // DB接続
  require 'secret.php';

  try{
    $dbh = new PDO($dsn, $user, $pass);

    // SQL文(巡回場所の取得)
    $sql = "SELECT * FROM 巡回場所";

    $stmt = $dbh->query($sql);

    $visitation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // columnの配列
    $placeArray = array_column($visitation, '場所');
    $roomtypeArray = array_column($visitation, '形式');
    $pcnumArray = array_column($visitation, '利用可能PC台数');

    // javascriptに渡すjson
    $place_json = json_encode($placeArray);
    $roomtype_json = json_encode($roomtypeArray);
    $pcnum_json = json_encode($pcnumArray);

    $pcnumArray_key = [];
    for ($i = 0; $i < count($placeArray); $i++) {
      $pcnumArray_key[] = $placeArray[$i].$roomtypeArray[$i];
    }

    $_SESSION['PCtypeVal'] = $roomtypeArray;
    $pcnumkey_json = json_encode($pcnumArray_key);
    
    $placeArray = array_unique($placeArray); //重複を削除
    $_SESSION["placeVal"] = array_values($placeArray);

  }catch(PDOException $e){
    print("データベースの接続に失敗しました".$e->getMessage());
    die();
  }

  //接続を閉じる
  $dbh = null;

  $success = "";
  // POSTされた値があるか
  if (isset($_POST["res_time"]) && isset($_POST["res_place"]) && isset($_POST["res_room"]) && isset($_POST["res_num"]) && isset($_POST["res_univ"]) && isset($_POST["res_own"])){

    // トークンが一致しているか
    if (isset($_POST["chkno"]) && isset($_SESSION["chkno"]) && ($_POST["chkno"] == $_SESSION["chkno"])){

      $timetable = $_POST["res_time"];
      $place     = $_POST["res_place"];
      $room      = $_POST["res_room"];
      $pcnum     = $_POST["res_num"];
      $univ      = $_POST["res_univ"];
      $own       = $_POST["res_own"];

      try{
        $dbh = new PDO($dsn, $user, $pass);

        // SQL文(巡回表に日付、時限、場所、形式、利用可能PC数、大学PC利用者数、私物PC利用者数を記録)
        $sql = "INSERT INTO 巡回記録 VALUES (0, CURRENT_DATE, :timetable, :place, :room, :pcnum, :univ, :own)";

        $stmt = $dbh->prepare($sql);

        $stmt -> bindValue(':timetable', $timetable, PDO::PARAM_STR);
        $stmt -> bindValue(':place', $place, PDO::PARAM_STR);
        $stmt -> bindValue(':room', $room, PDO::PARAM_STR);
        $stmt -> bindValue(':pcnum', $pcnum, PDO::PARAM_INT);
        $stmt -> bindValue(':univ', $univ, PDO::PARAM_INT);
        $stmt -> bindValue(':own', $own, PDO::PARAM_INT);
        $stmt -> execute();


      }catch(PDOException $e){
        print("データベースの接続に失敗しました".$e->getMessage());
        die();
      }

      //接続を閉じる
      $dbh = null;
      $success = "正常に送信されました";

    } else {
    }
    // 新しいトークンをセット
    $_SESSION["chkno"] = $chkno = mt_rand();
  }

require 'form.php';
?>