<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

session_start();
include("funcs.php");
sschk();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/output.css?<?= time() ?>">
    
    <script src="https://kit.fontawesome.com/17c882a708.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module">
        import { GOOGLE_MAPS_API_KEY } from './key.js';
        import { initPostAutocomplete, fillInAddress } from './postFuncs.js';

        const googleMapsScript = document.createElement('script');
        googleMapsScript.src = `https://maps.googleapis.com/maps/api/js?key=${GOOGLE_MAPS_API_KEY}&libraries=places`;
        document.head.appendChild(googleMapsScript);

        googleMapsScript.onload = () => {
            initPostAutocomplete();
        };

        let postAutocomplete;
    </script>
</head>

<body>

        <!-- 投稿画面 -->
<div class="fixed inset-0 bg-black bg-opacity-50 z-100">
    <form action="postExec.php" method="post" enctype="multipart/form-data" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-11/12 sm:w-4/5 md:w-3/5 lg:w-2/5 max-w-md bg-white bg-opacity-70 p-5 rounded-lg shadow-lg flex flex-col justify-between" onsubmit="postComplete()">
        <input type="hidden" name="userId"">
        <input name="storeName"    id="storeName"    type="text" placeholder="店舗名" required class="border border-gray-300 rounded-md p-2 mb-2 text-lg">
        <input name="storeAddress" id="storeAddress" type="text" placeholder="住所"  required  class="border border-gray-300 rounded-md p-2 mb-2 text-lg">
        <input name="storeUrl"     id="storeUrl"     type="text" placeholder="URL"            class="border border-gray-300 rounded-md p-2 mb-2 text-lg">
        <?php
        $storeGenres = [
            "焼肉", "焼き鳥", "寿司", "居酒屋", "お好み焼き･もんじゃ", "ラーメン", "カレー",
            "フレンチ", "イタリアン", "日本料理", "中華料理", "韓国料理", "アジア料理",
            "エスニック料理", "創作料理", "ビストロ", "スイーツ", "カフェ･喫茶店",
            "ビアバー", "ワインバー", "日本酒バー"
        ];
        $storeScenes = [
            "カジュアル", "デート", "記念日", "接待･会食", "歓送迎会", "忘年会･新年会"
        ];
        $storeBudgets = [
            "〜1000円", "1000円〜5000円", "5000円〜10000円", "10000円〜30000円", "30000円〜"
        ];
        ?>
        <select name="storeGenre" required class="border border-gray-300 rounded-md p-2 mb-2 text-lg">
            <option value="">お店のジャンル</option>
            <?php foreach ($storeGenres as $storeGenre) : ?>
                <option value="<?= $storeGenre ?>"><?= $storeGenre ?></option>
            <?php endforeach; ?>
        </select>
        <select name="storeScene" required class="border border-gray-300 rounded-md p-2 mb-2 text-lg">
            <option value="" selected>利用シーン</option>
            <?php foreach ($storeScenes as $storeScene) : ?>
                <option value="<?= $storeScene ?>"><?= $storeScene ?></option>
            <?php endforeach; ?>
        </select>
        <select name="storeBudget" required class="border border-gray-300 rounded-md p-2 mb-2 text-lg">
            <option value="" selected>予算</option>
            <?php foreach ($storeBudgets as $storeBudget) : ?>
                <option value="<?= $storeBudget ?>"><?= $storeBudget ?></option>
            <?php endforeach; ?>
        </select>
        <textarea name="storeImpression" placeholder="おすすめポイント" class="border border-gray-300 rounded-md p-2 mb-2 text-lg"></textarea>
        <input type="file" name="storeImage" accept="image/jpeg, image/gif, image/png" capture="camera">
        <button type="submit" class="bg-orange-400 border-none w-1/2 rounded-full p-2 my-6 mx-auto text-white text-lg cursor-pointer shadow-md transition-colors duration-300 hover:bg-orange-300">投稿する</button>
    </form>
</div>

<script>
    function postComplete() {
        window.parent.postMessage('postComplete', '*');
    }
</script>
    

</body>

</html>