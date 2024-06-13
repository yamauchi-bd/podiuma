<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
//関数読込み
include("../funcs.php");

//ファイルアップロード処理
$status = fileUpload("storeImage","storeImage/"); //戻り値：0=ファイル名,1=NG,2=NG
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
$stmt = $pdo->prepare("INSERT INTO post_table( storeName, storeAddress, storeUrl, storeGenre, storeScene, storeBudget, storeImpression, storeImage, indate )VALUES(:storeName, :storeAddress, :storeUrl, :storeGenre, :storeScene, :storeBudget, :storeImpression, :storeImage, sysdate())");
$stmt->bindValue(':storeName', $storeName);
$stmt->bindValue(':storeAddress', $storeAddress);
$stmt->bindValue(':storeUrl', $storeUrl);
$stmt->bindValue(':storeGenre', $storeGenre);
$stmt->bindValue(':storeScene', $storeScene);
$stmt->bindValue(':storeBudget', $storeBudget);
$stmt->bindValue(':storeImpression', $storeImpression);
$stmt->bindValue(':storeImage', $storeImage);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  echo "false";
}else{
    header("Location: ../");
    exit();
}

?>
