<?php
    require_once '../users_count/function.php';
    // DB接続
    require '../users_count/secret.php';

    if (isSet($_POST["submit"])) {
        $year = $_POST["year"];
        $month = $_POST["month"];
        $day = $_POST["day"];
        $order = $_POST["order"];
    }
    try{
        $dbh = new PDO($dsn, $user, $pass);

        // SQL文(巡回記録の取得)
        $sql = "SELECT DATE_FORMAT(日付, '%m/%d') AS 日付, 時限, 場所, 形式, 利用可能台数 AS 上限台数, 大学PC利用者数 AS 大学PC, 私物PC利用者数 AS 私物PC FROM 巡回記録";
        
        // 年で絞り込む場合
        $isYear = false;
        if (isSet($year) && $year != "") {
            $isYear = true;
            $year_query = " WHERE YEAR(日付) = $year";
            $sql .= $year_query;
        }
        
        // 月で絞り込む場合
        $isMonth = false;
        if (isSet($month) && $month != "") {
            $isMonth = true;
            $month_query = " WHERE MONTH(日付) = $month";
            if ($isYear) {
                $month_query = str_replace('WHERE', 'AND', $month_query); // 年でも絞り込んでいる場合はWHEREをANDに変更
            }
            $sql .= $month_query;
        }

        // 日で絞り込む場合
        $isDay = false;
        if (isSet($day) && $day != "") {
            $isDay = true;
            $day_query = " WHERE DAY(日付) = $day";
            if ($isYear || $isMonth) {
                $day_query = str_replace('WHERE', 'AND', $day_query); // 年、月でも絞り込んでいる場合はWHEREをANDに変更
            }
            $sql .= $day_query;
        }
        
        // 昇順、降順選択
        $asc_desc = " ORDER BY ID DESC";
        // 昇順が選択されている時
        if (isSet($order) && $order == '昇順') {
            $asc_desc =" ORDER BY ID ASC";
        }
        $sql .= $asc_desc;

        $stmt = $dbh->query($sql);

        $table = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $table_json = json_encode($table);

    }catch(PDOException $e){
        print("データベースの接続に失敗しました".$e->getMessage());
        die();
    };

    //接続を閉じる
    $dbh = null;

    require 'table_view.php';
?>
<script>const table = JSON.parse('<?php echo $table_json?>');</script>
<script src="js/create_table.js"></script>