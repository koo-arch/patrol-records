<?php
  // htmlエスケープ関数es()の定義
  function es($data,$charset='utf-8') {
    if (is_array($data)) {
      return array_map(__METHOD__, $data); //$dataが配列のときは要素ごとに再起処理
    } else {
      return htmlspecialchars($data, ENT_QUOTES, $charset); //htmlエスケープ
    }
  }

  // 文字エンコードを行う関数cken()の定義
  function cken(array $data){
    $result = true;
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        // 含まれている値が配列の時に文字列を連結する
        $value = implode("", $value);
      }
      if (!mb_check_encoding($value)) {
        // 文字エンコードが一致しない時
        $result = false;
        // foreachでの走査をbreakする
        break;
      }
    }
    return $result;
  }
?>
