<?php
// エラーレポートを有効にする
ini_set("display_errors", 1);
error_reporting(E_ALL);

// 関数が既に存在するかどうかを確認
if (!function_exists('h')) {
    function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}

// ローカルホストDB接続関数：db_conn()
if (!function_exists('db_conn')) {
    function db_conn() {
        try {
            $db_name = "podiuma";    //データベース名
            $db_id   = "root";      //アカウント名
            $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード"root"に修正してください。
            $db_host = "localhost"; //DBホスト
            return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        } catch (PDOException $e) {
            exit('DB Connection Error:' . $e->getMessage());
        }
    }
}

// さくらサーバーDB接続関数：db_conn()
// function db_conn() {
//     try {
//         $db_name = "yamauchi-bd_no1map";    //データベース名
//         $db_id   = "yamauchi-bd";      //アカウント名
//         $db_pw   = "Vu5s98Lw";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード"root"に修正してください。
//         $db_host = "mysql57.yamauchi-bd.sakura.ne.jp"; //DBホスト
//         return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
//     } catch (PDOException $e) {
//         exit('DB Connection Error:' . $e->getMessage());
//     }
// }

// SQLエラー
if (!function_exists('sql_error')) {
    function sql_error($stmt){
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("SQLError:".$error[2]);
    }
}

// リダイレクト
if (!function_exists('redirect')) {
    function redirect($file_name){
        header("Location: ".$file_name);
        exit();
    }
}

// セッションチェック関数
if (!function_exists('sschk')) {
    function sschk() {
        if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
            exit("Login Error.");
        } else {
            session_regenerate_id(true);
            $_SESSION["chk_ssid"] = session_id();
        }
    }
}

// fileUpload("送信名","アップロード先フォルダ");
if (!function_exists('fileUpload')) {
    function fileUpload($fname,$path){
        if (isset($_FILES[$fname] ) && $_FILES[$fname]["error"] ==0 ) {
            //ファイル名取得
            $file_name = $_FILES[$fname]["name"];
            //一時保存場所取得
            $tmp_path  = $_FILES[$fname]["tmp_name"];
            //拡張子取得
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            //ユニークファイル名作成
            $file_name = date("YmdHis").md5(session_id()) . "." . $extension;
            // FileUpload [--Start--]
            $file_dir_path = $path.$file_name;
            if ( is_uploaded_file( $tmp_path ) ) {
                if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
                    chmod( $file_dir_path, 0644 );
                    return $file_name; //成功時：ファイル名を返す
                } else {
                    return 1; //失敗時：ファイル移動に失敗
                }
            }
         }else{
             return 2; //失敗時：ファイル取得エラー
         }
    }
}

// 店舗情報取得
if (!function_exists('getStores')) {
    function getStores() {
        $pdo = db_conn();
        $stmt = $pdo->prepare("SELECT storeName, storeAddress, storeUrl, storeGenre, storeScene, storeBudget, storeImpression, storeImage FROM post_table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
