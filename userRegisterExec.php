<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

//最初にSESSIONを開始！！ココ大事！！
session_start();
include("funcs.php");

//1. POSTデータ取得
$email            = $_POST["email"];
$password         = $_POST["password"];
$password         = password_hash($password, PASSWORD_DEFAULT); //パスワードハッシュ化
$username         = $_POST["username"];

//ファイルアップロード処理
$status = fileUpload("profileImage","profileImage/"); //戻り値：0=ファイル名,1=NG,2=NG
if($status==1 || $status==2){
    $img = "default.png"; // アップロード失敗時はデフォルト画像を設定
}else{
    $img = $status; //ファイル名
}

//2. DB接続します
$pdo = db_conn();

// //3. メールアドレスの重複チェック
$sql = "SELECT COUNT(*) FROM user_table WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count > 0) {
    // メールアドレスが既に存在する場合
    $_SESSION['error'] = '※このメールアドレスは既に登録されています';
    header('Location: userRegister.php');
    exit();
}

//4．データ登録SQL作成
$sql = "INSERT INTO user_table(email,password,username,profileImage)VALUES(:email,:password,:username,:profileImage)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':password', $password, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':username', $username, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':profileImage', $img, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// 5．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("login.php");
}

?>
