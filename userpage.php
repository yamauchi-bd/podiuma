<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();
include("funcs.php");
include("postDetailsGet.php");

sschk();
$pdo = db_conn();
$title = 'ポジウマ';

// セッションからユーザーIDを取得
$userId = $_SESSION["id"];

$sql = "SELECT * FROM user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $userId, PDO::PARAM_STR);
$stmt->execute();
$val = $stmt->fetch();

// ユーザーの投稿を取得
$sql = "SELECT * FROM post_table WHERE userId=:userId LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($posts, JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/output.css?<?= time() ?>">
  <script src="https://kit.fontawesome.com/17c882a708.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <title><?php echo $title; ?></title>
  <style>
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body class="bg-custom-bg bg-cover bg-center">
  <div class="bg-white w-full h-screen py-6 sm:py-8 lg:py-12 bg-opacity-90">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
      <!-- text - start -->
      <div class="mb-10 md:mb-16">
        <h2 class="mb-2 text-center text-xl font-bold text-gray-800 md:mb-1 lg:text-2xl"><?php echo $_SESSION["username"]; ?> さんの</h2>
        <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">おすすめグルメ BEST3</h2>
      </div>
      <!-- text - end -->

      <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8">
        <?php foreach ($posts as $post) : ?>
          <div class="post">
            <!-- image - start -->
            <a href="#" data-id="<?php echo htmlspecialchars($post['id']); ?>" class="group relative flex h-48 items-end justify-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-96">
              <img src="storeImage/<?php echo htmlspecialchars($post['storeImage']); ?>"  data-post-id="<?=$post['id']; ?>" loading="lazy" alt="" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"></div>

              <span class="absolute top-3 left-3 m-3 inline-block rounded-lg border border-gray-500 px-2 py-1 text-xs text-gray-200 backdrop-blur md:px-3 md:text-sm"><?php echo htmlspecialchars($post['storeName']); ?></span>
              <!-- <span onclick="location.href='postEdit.php?id=<?php echo $post['id']; ?>'" class="cursor-pointer relative mr-3 mb-3 inline-block rounded-lg border border-gray-500 px-2 py-1 text-xs text-gray-200 backdrop-blur md:px-3 md:text-sm"><?php echo htmlspecialchars("更新"); ?></span> -->
              <span onclick="if(confirm('本当に削除しますか？')) location.href='postDelete.php?id=<?php echo $post['id']; ?>'" class="cursor-pointer relative mr-3 mb-3 inline-block rounded-lg border border-gray-500 px-2 py-1 text-xs text-gray-200 backdrop-blur md:px-3 md:text-sm"><?php echo htmlspecialchars("削除"); ?></span>
            </a>
            <!-- image - end -->
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div id="postDetails" style="display: none;"></div>

  <div class="footer">
    <?php include 'footer.php'; ?>
  </div>

  <script src="postDetailsGet.js"></script>
</body>

</html>