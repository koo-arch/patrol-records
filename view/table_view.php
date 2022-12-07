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
    <h1>巡回記録</h1>
    <form method="POST" action="table.php">
        <div>
            <div class="container">
                <select id="ASC" name="ASC">
                    <option>降順</option>
                    <option>昇順</option>
                </select>
            </div>
            <div class="container">
                <select id="year" name="year">
                    <?php
                    // 西暦のセレクトボックス
                    print('<option value="">選択</option>');
                    for ($i = 2022; $i < 2122; $i++) {
                    print ('<option value="' . $i. '">' . $i . '年</option>');
                    }
                    ?>
                </select>
            </div>
            <div class="container">
                <select id="month" name="month">
                    <?php
                    // 月のセレクトボックス
                    print('<option value="">選択</option>');
                    for ($i = 1; $i < 13; $i++) {
                    print ('<option value="' . $i. '">' . $i . '月</option>');
                    }
                    ?>
                </select>
            </div>
            <p class="more"><input id="send" type="submit" value="絞り込み"></p>
        </div>

    </form>
    <table class="content-table">
        <thead>
            <tr id="column-name"></tr>
        </thead>
        <tbody id="patrolRecords"></tbody>
    </table>
</body>
</html>