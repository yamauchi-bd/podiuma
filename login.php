<?php
session_start();

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once 'funcs.php';
$title = 'ポジウマ';
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
</head>

<body class="bg-custom-bg bg-cover bg-center">
    <div class="bg-black h-screen w-screen bg-opacity-50">
        <div class="py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl max-h-1.5 px-4 md:px-8">
                <h2 class="mt-10 text-center text-2xl font-bold text-white md:mb-8 lg:text-3xl">＼とっておきグルメをシェアしよう／</h2>

                <form method="post" action="loginExec.php" class="bg-white mx-auto max-w-lg rounded-lg border">
                    <div class="flex flex-col gap-4 p-4 md:p-8">
                        <div>
                            <label for="email" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ID（メールアドレス）</label>
                            <input name="email" type="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required />
                        </div>

                        <div>
                            <label for="password" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">パスワード</label>
                            <input name="password" type="password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" required />
                        </div>

                        <button type="submit" class="block rounded-lg bg-orange-400 mt-4 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-orange-300 transition duration-100 hover:bg-orange-500 focus-visible:ring active:bg-orange-600 md:text-base">ログイン</button>

                        <div class="relative flex items-center justify-center">
                            <span class="absolute inset-x-0 h-px bg-gray-300"></span>
                            <span class="relative bg-white px-4 text-sm text-gray-400">Log in with google</span>
                        </div>
                        <button class="flex items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-8 py-3 text-center text-sm font-semibold text-gray-800 outline-none ring-gray-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200 md:text-base">
                            <svg class="h-5 w-5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.7449 12.27C23.7449 11.48 23.6749 10.73 23.5549 10H12.2549V14.51H18.7249C18.4349 15.99 17.5849 17.24 16.3249 18.09V21.09H20.1849C22.4449 19 23.7449 15.92 23.7449 12.27Z" fill="#4285F4" />
                                <path d="M12.2549 24C15.4949 24 18.2049 22.92 20.1849 21.09L16.3249 18.09C15.2449 18.81 13.8749 19.25 12.2549 19.25C9.12492 19.25 6.47492 17.14 5.52492 14.29H1.54492V17.38C3.51492 21.3 7.56492 24 12.2549 24Z" fill="#34A853" />
                                <path d="M5.52488 14.29C5.27488 13.57 5.14488 12.8 5.14488 12C5.14488 11.2 5.28488 10.43 5.52488 9.71V6.62H1.54488C0.724882 8.24 0.254883 10.06 0.254883 12C0.254883 13.94 0.724882 15.76 1.54488 17.38L5.52488 14.29Z" fill="#FBBC05" />
                                <path d="M12.2549 4.75C14.0249 4.75 15.6049 5.36 16.8549 6.55L20.2749 3.13C18.2049 1.19 15.4949 0 12.2549 0C7.56492 0 3.51492 2.7 1.54492 6.62L5.52492 9.71C6.47492 6.86 9.12492 4.75 12.2549 4.75Z" fill="#EA4335" />
                            </svg>
                            Googleアカウントでログイン
                        </button>
                    </div>

                    <div class="flex items-center justify-center bg-gray-100 p-4 rounded-b-lg">
                        <p class="text-center text-sm text-gray-500">アカウントをお持ちではありませんか？ <a href="userRegister.php" class="text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700">新規登録</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>