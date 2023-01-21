<?php
    session_start();
    require_once '../judge_login.php';
    require_once '../function.php';
    require_once '../escape.php';
    // DB接続
    require '../secret.php';

    if (isset($_POST["submit"])) {
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
        if (isset($year) && $year != "") {
            $isYear = true;
            $year_query = " WHERE YEAR(日付) = :year";
            $sql .= $year_query;
        }
        
        // 月で絞り込む場合
        $isMonth = false;
        if (isset($month) && $month != "") {
            $isMonth = true;
            $month_query = " WHERE MONTH(日付) = :month";
            if ($isYear) {
                $month_query = str_replace('WHERE', 'AND', $month_query); // 年でも絞り込んでいる場合はWHEREをANDに変更
            }
            $sql .= $month_query;
        }

        // 日で絞り込む場合
        $isDay = false;
        if (isset($day) && $day != "") {
            $isDay = true;
            $day_query = " WHERE DAY(日付) = :day";
            if ($isYear || $isMonth) {
                $day_query = str_replace('WHERE', 'AND', $day_query); // 年、月でも絞り込んでいる場合はWHEREをANDに変更
            }
            $sql .= $day_query;
        }
        
        // 昇順、降順選択
        $asc_desc = " ORDER BY ID DESC";
        // 昇順が選択されている時
        if (isset($order) && $order == '昇順') {
            $asc_desc =" ORDER BY ID ASC";
        }
        $sql .= $asc_desc;

        $stmt = $dbh->prepare($sql);

        if ($isYear) {
            $stmt -> bindValue(':year', $year, PDO::PARAM_STR);
        }
        if ($isMonth) {
            $stmt -> bindValue(':month', $month, PDO::PARAM_STR);
        }
        if ($isDay) {
            $stmt -> bindValue(':day', $day, PDO::PARAM_STR);
        }
        
        $stmt -> execute();
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