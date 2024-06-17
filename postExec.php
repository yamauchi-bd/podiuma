<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();
include("funcs.php");
sschk();

// セッションにidが設定されているか確認
if (!isset($_SESSION["id"])) {
    echo "エラー: セッションにユーザーIDが設定されていません。";
    exit();
}

// データベース接続
$pdo = db_conn();

// ユーザーIDを取得
$userId = $_SESSION['userId'];

// ユーザーの投稿数をカウント
$stmt = $pdo->prepare("SELECT COUNT(*) FROM post_table WHERE userId = :userId");
$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$postCount = $stmt->fetchColumn();

if ($postCount >= 3) {
     // 出力バッファリングを開始
     ob_start();
     // 投稿数が3件以上の場合、アラートメッセージを表示
     echo "<script>alert('投稿は1ユーザーにつき3件までです。'); window.history.back();</script>";
     // 出力バッファをフラッシュして出力
     ob_end_flush();
    exit();
}

//ファイルアップロード処理
$status = fileUpload("storeImage","./storeImage/"); //戻り値：0=ファイル名,1=NG,2=NG
if($status==1 || $status==2){
    $img ="アップロード失敗";
}else{
    $img = $status; //ファイル名
}

//1. POSTデータ取得
$storeName   = $_POST["storeName"];
$storeAddress  = $_POST["storeAddress"];
$storeUrl = $_POST["storeUrl"];
$storeGenre = $_POST["storeGenre"];
$storeScene = $_POST["storeScene"];
$storeBudget = $_POST["storeBudget"];
$storeImpression = $_POST["storeImpression"];
$storeImage = $img;

//2. DB接続
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO post_table( storeName, storeAddress, storeUrl, storeGenre, storeScene, storeBudget, storeImpression, storeImage, indate, userId )VALUES(:storeName, :storeAddress, :storeUrl, :storeGenre, :storeScene, :storeBudget, :storeImpression, :storeImage, sysdate(), :userId)");
$stmt->bindValue(':storeName', $storeName);
$stmt->bindValue(':storeAddress', $storeAddress);
$stmt->bindValue(':storeUrl', $storeUrl);
$stmt->bindValue(':storeGenre', $storeGenre);
$stmt->bindValue(':storeScene', $storeScene);
$stmt->bindValue(':storeBudget', $storeBudget);
$stmt->bindValue(':storeImpression', $storeImpression);
$stmt->bindValue(':storeImage', $storeImage);
$stmt->bindValue(':userId', $_SESSION["id"]);

$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  echo "SQLエラー: " . $error[2];
}else{
    header("Location: userpage.php");
    exit();
}

?>
