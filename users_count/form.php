<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>巡回表</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <h1>巡回表</h1>
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

    <form method="POST">

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
        <label for="univ">大学PC利用者数</label>
        <button id='up1' type="button" >+</button>
        <input type='text' value=0 id="univ" name='univ'>
        <button id='down1' type="button">-</button>
        <button id='reset1' type="button">リセット</button>
      </div>
      <div id="count_own">
        <label for="own">私物PC利用者数</label>
        <button id='up2' type="button">+</button>
        <input type='text' value=0 id="own" name='own'>
        <button id='down2' type="button">-</button>
        <button id='reset2' type="button">リセット</button>
      </div>

      <p class="more"><input id="send" type="submit" value="送る"></p>

      
    </form>
    <div>
      <!-- オーバーレイ -->
      <div id="overlay" class="overlay"></div>

      <!-- モーダルウィンドウ -->
      <div class="modal-window">
        <form method="POST" action="<?php echo es($_SERVER['PHP_SELF']); ?>">
          <p class="confirm">入力内容確認</p>
          <table>
            <tr>
              <th>時限</th><td id="res_time" ></td>
            </tr>
            <tr>
              <th>場所</th><td id="res_place" ></td>
            </tr>
            <tr>
              <th>形式</th><td id="res_room" ></td>
            </tr>
            <tr>
              <th>利用可能PC台数</th><td id="res_num" ></td>
            </tr>
            <tr>
              <th>大学PC利用者数</th><td id="res_univ" ></td>
            </tr>
            <tr>
              <th>私物PC利用者数</th><td id="res_own" ></td>
            </tr>
          </table>
          <input type="hidden" name="chkno" value="<?php echo $chkno; ?>">
          <input type="hidden" name="res_time">
          <input type="hidden" name="res_place">
          <input type="hidden" name="res_room">
          <input type="hidden" name="res_num">
          <input type="hidden" name="res_univ">
          <input type="hidden" name="res_own">
          <div class="flex">
            <button type="button" class="js-close button-close">修正</button>
            <input type="submit" class="" value="送信">
          </div>
        </form>
      </div>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src='js/ajax.js'></script>
