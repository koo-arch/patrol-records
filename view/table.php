<?php
    require_once '../users_count/function.php';
    // DB接続
    require '../users_count/secret.php';


    try{
        $dbh = new PDO($dsn, $user, $pass);

        // SQL文(巡回記録の取得)
        $sql = "SELECT * FROM 巡回記録";
        
        // 年で絞り込む場合
        $isYear = false;
        if (isSet($_POST["year"]) && $_POST["year"] != "") {
            $isYear = true;
            $year = $_POST["year"];
            $year_query = " WHERE YEAR(日付) = $year";
            $sql .= $year_query;
        }
        
        // 月で絞り込む場合
        $isMonth = false;
        if (isSet($_POST["month"]) && $_POST["month"] != "") {
            $isMonth = true;
            $month = $_POST["month"];
            $month_query = " WHERE MONTH(日付) = $month";
            if ($isYear) {
                $month_query = str_replace('WHERE', 'AND', $month_query); // 年でも絞り込んでいる場合はWHEREをANDに変更
            }
            $sql .= $month_query;
        }
        
        // 昇順、降順選択
        $asc_desc = " ORDER BY ID DESC";
        // 昇順が選択されている時
        if (isSet($_POST["ASC"]) && $_POST["ASC"] == '昇順') {
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
<script>const table = JSON.parse('<?php echo $table_json?>')</script>
<script src="js/create_table.js"></script>