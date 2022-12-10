<?php 
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