<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>利用人数登録</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="inner">
      <h1>電子巡回表</h1>
      <div class="tab-flex">
        <a id="users" tabindex="-1">利用人数登録</a>
        <a id="records"  href="../view/table.php">巡回記録</a>
      </div>
      <div id="message"></div>
      <?php if( $success != "" ): ?>
      <p class="success_message"><?php echo $success; ?></p>
      <?php endif; ?>
      <?php if(isset($_SESSION["error"])): 
        $error = $_SESSION["error"];
        unset($_SESSION["error"]);
      ?>
          <ul class="error_message">
          <?php foreach( $error as $value ): ?>
                  <li>・<?php echo $value; ?></li>
          <?php endforeach; ?>
          </ul>
      <?php endif; ?>
  
      <form method="POST" action="send.php">
        <div>
          <label for="timetable">時限</label> 
          <div  class="container">
            <select name="timetable" id="timetable">
              <?php
              // 時限のセレクトボックス
              print('<option value="">選択</option>');
              for ($i = 1; $i <6; $i++) {
                print ('<option value="' . $i. '限">' . $i . '限</option>');
              }
              ?>
            </select>
          </div>
        </div>
  
        <div>
          <label for="place">場所</label>
          <div class="container">
            <select name="place" id="place">
              <option>場所を選択</option>
            </select>
          </div>
        </div>
        <div>
          <label for="PCtype">形式</label>
          <div class="container">
            <select name="PCtype" id="PCtype" disabled>
              <option>選択</option>
            </select>
          </div>
        </div>
  
        <div>
          <label for="pcnum">利用可能PC台数</label>
          <input type='text' name="pcnum" id="pcnum" readonly>
        </div>
        <div>
          <div>
            <label>大学PC利用者数</label>
            <button id='reset1' type="button">リセット</button>
            <div class="button-flex">
              <button id='up1' type="button" >+</button>
              <input type='text' value=0 id="univ" name='univ'>
              <button id='down1' type="button">-</button>
            </div>
          </div>
          <div id="count_own">
            <label>私物PC利用者数</label>
            <button id='reset2' type="button">リセット</button>
            <div class="button-flex">
              <button id='up2' type="button">+</button>
              <input type='text' value=0 id="own" name='own'>
              <button id='down2' type="button">-</button>
            </div>
          </div>
        </div>
  
        <input id="confirm" type="submit" value="入力確認">
  
        
      </form>
    </div>
  </body>
</html>

<script>
  // DBから取り出した利用可能PC数の配列
  let pcnumArray = JSON.parse('<?php echo $pcnum_json ?>');
  // keyが「場所」の部分の値を取り出し、配列に格納
  let placeArray = JSON.parse('<?php echo $place_json ?>');
  // keyが「形式」の部分の値を取り出し、配列に格納
  let typeArray = JSON.parse('<?php echo $roomtype_json ?>');
</script>
<script src='js/script.js'></script>