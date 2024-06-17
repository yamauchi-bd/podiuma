<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();
include("funcs.php");

sschk();
$pdo = db_conn();
$title = 'ポジウマ';

// セッションからユーザーIDを取得
$userId = $_SESSION["id"];

$sql = "SELECT * FROM user_table";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$val = $stmt->fetch();

// ユーザーの投稿を取得
$sql = "SELECT * FROM post_table";
$stmt = $pdo->prepare($sql);
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
        .hidden {
            display: none;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body class="bg-custom-bg bg-cover bg-center">
    <div class="bg-white w-full full-height py-6 sm:py-8 lg:py-12 bg-opacity-90">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">

            <div class="mb-2 md:mb-4">
                <!-- 検索バー -->
            </div>

            <div id="postContainer" class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8">
                <?php foreach ($posts as $post) : ?>
                    <div class="post">
                        <!-- image - start -->
                        <a href="#" data-id="<?php echo htmlspecialchars($post['id']); ?>" class="group relative flex h-48 items-end justify-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-96 <?php echo $index >= 9 ? 'hidden' : ''; ?>">
                            <img src="storeImage/<?php echo htmlspecialchars($post['storeImage']); ?>" data-post-id="<?= $post['id']; ?>" loading="lazy" alt="ファイル名" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"></div>
                            <span class="absolute top-3 left-3 m-3 inline-block rounded-lg border border-gray-500 px-2 py-1 text-xs text-gray-200 backdrop-blur md:px-3 md:text-sm"><?php echo htmlspecialchars($post['storeName']); ?></span>
                        </a>
                        <!-- image - end -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        let currentIndex = 9;

        function loadMorePosts() {
            const hiddenItems = document.querySelectorAll('.hidden');
            hiddenItems.forEach((item, index) => {
                if (index < 9) {
                    item.classList.remove('hidden');
                }
            });
            currentIndex += 9;
        }

        window.addEventListener('scroll', function() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                loadMorePosts();
            }
        });
    </script>

<div id="postDetails" style="display: none;">
    <!-- Ajaxで取得した投稿の詳細が表示 -->
  </div>

    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>

    <script src="postDetailsGet.js"></script>
</body>

</html>