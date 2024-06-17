<?php
// header('Content-Type: application/json');
ini_set("display_errors", 1);
error_reporting(E_ALL);

include_once("funcs.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];

    // DB接続
    try {
        $pdo = db_conn();
    } catch (PDOException $e) {
        echo json_encode(['error' => 'DBConnection Error: ' . $e->getMessage()]);
        exit();
    }

    // 投稿詳細を取得
    $stmt = $pdo->prepare("
        SELECT post_table.storeName, post_table.storeAddress, post_table.storeUrl, post_table.storeGenre, post_table.storeScene, post_table.storeBudget, post_table.storeImpression, user_table.username
        FROM post_table 
        JOIN user_table ON post_table.userID = user_table.id 
        WHERE post_table.id = :postId
    ");
    $stmt->bindValue(':postId', $postId, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status == false) {
        $error = $stmt->errorInfo();
        echo json_encode(['error' => 'ErrorQuery: ' . $error[2]]);
    } else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }
}
?>
