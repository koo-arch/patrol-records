<?php require 'patrol.php' ?>

<!DOCTYPE html>
<html>
  <head>
    <title>巡回表</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>巡回表</h1>
    <div id="message"></div>
    <?php if( $success != "" ): ?>
    <p class="success_message"><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if(isset($_SESSION["error"])): 
      $error = $_SESSION["error"]
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
            <option value="">場所を選択</option>
          </select>
        </div>
      </div>
      <div>
        <label for="PCtype">形式</label>
        <div class="container">
          <select name="PCtype" id="PCtype">
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
  let keyArray = JSON.parse('<?php echo $place_json ?>');
  // keyが「形式」の部分の値を取り出し、配列に格納
  let valueArray = JSON.parse('<?php echo $roomtype_json ?>');
</script>
<script src='script.js'></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  $(document).ready(function()
  {
  
      $('#send').click(function()
      {
        
        //postメソッドで送るデータを定義 var data = {パラメータ名 : 値};
        var data = {
        timetable : $('#timetable').val(),
        place : $('#place').val(),
        PCtype : $('#PCtype').val(),
        pcnum : $('#pcnum').val(),
        univ : $('#univ').val(),
        own : $('#own').val()
        };

        $.ajax({
          type: "post",
          url: "send.php",
          data: data,
          dataType: 'json',
          //Ajax通信が成功した場合
          success: function(data)
          {
            
          //送信完了後フォームの内容をリセット
          if(data[0] == 'true'){
            $('#overlay, .modal-window').fadeIn();
            const slicedata = data.slice(1);
            const resArray = ["res_time","res_place","res_room","res_num","res_univ","res_own"]
            for(let i=0; i<slicedata.length; i++){
              document.getElementById(resArray[i]).textContent = slicedata[i];
              document.getElementById(resArray[i]).value = slicedata[i];
              document.getElementsByName(resArray[i])[0].value = slicedata[i];
            }
            } else {
              const success = document.getElementsByClassName("success_message")[0];
              const error = document.getElementsByClassName("error_message")[0];

              if(success != null){
                success.remove();
              }

              if(error != null){
                error.remove();
              }

              const ul = document.createElement('ul');
              const message = document.getElementById('message');
              ul.className = "error_message";
              message.appendChild(ul);
              data.forEach(element => {
                const li = document.createElement('li');
                console.log(element);
                li.textContent = element;
                ul.appendChild(li);
              });
              
              $(window).scrollTop(0);
            }
            
          },
          //Ajax通信が失敗した場合のメッセージ
          error: function(){
            alert('メールの送信が失敗しました。');
            }
          });
          return false;
      });
  });

  $(function(){
    $('.js-close').click(function () {
    $('#overlay, .modal-window').fadeOut();
  });
  });
</script>