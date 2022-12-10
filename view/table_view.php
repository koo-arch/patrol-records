<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>巡回記録</title>
</head>
<body>
    <div class="inner">
        <h1>巡回記録</h1>
        <form method="POST" action="table.php">
            <div>
                <label>順序</label>
                <div class="container">
                    <select id="order" name="order">
                        <option <?php if (isSet($order) && $order === "降順"){echo "selected";}?>>降順</option>
                        <option <?php if (isSet($order) && $order === "昇順"){echo "selected";}?>>昇順</option>
                    </select>
                </div>
                <div class="flex">
                    <div class="container-date">
                        <label class="date">年</label>
                        <select id="year" name="year">
                            <!-- 西暦のセレクトボックス -->
                            <option value="">選択</option>
                            <?php for ($i = 2022; $i < 2122; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if (isSet($year) && $year == $i){echo "selected";} ?>><?php echo $i; ?>年</option>
                            <?php endfor ?>
                        </select>
                    </div>

                    <div class="container-date">
                        <label class="date">月</label>
                        <select id="month" name="month">
                            <!-- 月のセレクトボックス -->
                            <option value="">選択</option>
                            <?php for ($i = 1; $i < 13; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if (isSet($month) && $month == $i){echo "selected";} ?>><?php echo $i;?>月</option>
                            <?php endfor ?>
                        </select>
                    </div>
                    <div class="container-date">
                        <label class="date">日</label>
                        <select id="day" name="day">
                            <!-- 日のセレクトボックス -->
                            <option value="">選択</option>
                            <?php for ($i = 1; $i < 32; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if (isSet($day) && $day == $i){echo "selected";} ?>><?php echo $i;?>日</option>
                            <?php endfor ?>
                        </select>
                    </div>
                </div>
                <p class="more"><input id="send" type="submit" name="submit" value="絞り込み"></p>
            </div>
    
        </form>
        <table class="content-table">
            <thead>
                <tr id="column-name"></tr>
            </thead>
            <tbody id="patrolRecords"></tbody>
        </table>
    </div>
</body>
</html>