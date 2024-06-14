<?php
session_start();

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once '../funcs.php';
$stores = getStores();
$title = 'ポジウマ';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css?<?= time() ?>">
    <script src="https://kit.fontawesome.com/17c882a708.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?php echo $title; ?></title>
</head>

<body class="bg-custom-bg bg-cover bg-center">
    <div class="bg-black h-screen w-screen bg-opacity-50">
        <div class="py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl max-h-1.5 px-4 md:px-8">
                <h2 class="mt-10 text-center text-2xl font-bold text-white md:mb-8 lg:text-3xl">＼ユーザー登録／</h2>

                <form method="post" action="registerExec.php" enctype="multipart/form-data" class="bg-white mx-auto max-w-lg rounded-lg border">
                    <div class="flex flex-col gap-4 p-4 md:p-8">
                        <div>
                            <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">メールアドレス</label>
                            <input name="email" type="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required />
                            <?php if (isset($_SESSION['error'])) { ?>
                                <p style="color: red;" class="text-sm"><?php echo $_SESSION['error']; ?></p>
                            <?php } ?>
                        </div>

                        <div>
                            <label for="password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">パスワード</label>
                            <input name="password" type="password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required />
                        </div>

                        <div>
                            <label for="username" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ユーザーネーム</label>
                            <input name="username" type="text" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required />
                        </div>

                        <div>
                            <label for="profileImage" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">プロフィール画像</label>
                            <input name="profileImage" type="file" class="w-full rounded  text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" />
                        </div>

                        <button type="submit" class="block rounded-lg bg-orange-400 mt-4 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-orange-300 transition duration-100 hover:bg-orange-500 focus-visible:ring active:bg-orange-600 md:text-base">登録する</button>

                        
                    </div>

                    <div class="flex items-center justify-center bg-gray-100 p-4 rounded-b-lg">
                        <p class="text-center text-sm text-gray-500">アカウントをすでに持っている方は<a href="../login/" class="text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">ログイン</a>してください。</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>