<?php
    require_once 'send.php';
    require_once 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <title>入力内容確認</title>
</head>
<body>
    <form method="POST" action="form.php">
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
        <button type="button" class="js-close button-close" onclick="history.back()">修正</button>
        <input type="submit" class="" value="送信">
        </div>
    </form>
    
</body>
</html>