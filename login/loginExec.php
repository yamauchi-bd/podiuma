<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

//最初にSESSIONを開始！！ココ大事！！
session_start();

//1.  DB接続します
include("../funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
$sql = "SELECT * FROM user_table WHERE email=:email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error();
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
if( password_verify($_POST["password"] ,$val["password"])){
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["username"]      = $val['username'];
  redirect("../index.php");
}else{
  //Login失敗時(Logout経由)
  $_SESSION['error'] = '※メールアドレスまたはパスワードが違います。';
  redirect("index.php");
}
exit();
?>

