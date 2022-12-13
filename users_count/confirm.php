<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>入力内容確認</title>
</head>
<body>
    <div class="inner">
        <form method="POST" action="patrol.php">
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
            <div class="flex">
            <button type="button" class="js-close button-close" onclick="history.back()">修正</button>
            <input type="submit" class="" value="送信">
            </div>
        </form>
    </div>
    
</body>
</html>