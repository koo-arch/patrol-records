<?php 
  require_once '../judge_login.php';
  require_once '../judge_post.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="css/form.css">
    <title>入力内容確認</title>
</head>
<body>
    <div class="inner">
        <form method="POST" action="register">
            <p class="confirm">入力内容確認</p>
            <table>
                <tr>
                    <th>時限</th><td id="res_time" ><?php echo $timetable?></td>
                </tr>
                <tr>
                    <th>場所</th><td id="res_place" ><?php echo $place?></td>
                </tr>
                <tr>
                    <th>形式</th><td id="res_room" ><?php echo $PCtype?></td>
                </tr>
                <tr>
                    <th>利用可能PC台数</th><td id="res_num" ><?php echo $pcnum?></td>
                </tr>
                <tr>
                    <th>大学PC利用者数</th><td id="res_univ" ><?php echo $univ?></td>
                </tr>
                <tr>
                    <th>私物PC利用者数</th><td id="res_own" ><?php echo $own?></td>
                </tr>
            </table>
            <input type="hidden" name="chkno" value="<?php echo $chkno; ?>">
            <input type="hidden" name="res_time" value="<?php echo $timetable?>">
            <input type="hidden" name="res_place" value="<?php echo $place?>">
            <input type="hidden" name="res_room" value="<?php echo $PCtype?>">
            <input type="hidden" name="res_num" value="<?php echo $pcnum?>">
            <input type="hidden" name="res_univ" value="<?php echo $univ?>">
            <input type="hidden" name="res_own" value="<?php echo $own?>">
            <input type="hidden" name="update" value="<?php echo $update?>">
            <input type="hidden" name="ID" value="<?php echo $ID?>">
            <?php if ($update == true):?>
            <p class="message">選択した時限、場所、形式のデータはすでに登録済みです。送信すると上記ののデータに上書きされます。</p>
            <?php endif; ?>
            <div class="flex">
                <button type="button" class="back" onclick="location.href='./register'">修正</button>
                <input type="submit" class="send" value="送信">
            </div>
        </form>
    </div>
</body>
</html>