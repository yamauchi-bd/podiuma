<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/output.css?<?= time() ?>">
  <link href="colorbox/example3/colorbox.css" rel="stylesheet">

  <!-- ▼jQueryとColorboxのスクリプトを読み込む記述 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="colorbox/jquery.colorbox-min.js"></script>

  <script src="https://kit.fontawesome.com/17c882a708.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- nav - start -->
  <nav class="sticky top-0 bottom-0 mx-auto flex h-28 w-full justify-around items-center gap-5 border-t border-b bg-white px-40 text-xs sm:border-transparent sm:text-sm sm:shadow-md">

    <a href="userpage.php" class="flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="far fa-user-circle fa-2x"></i>
      <span>マイページ</span>
    </a>

    <a href="index.php" class="flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="fa-solid fa-location-dot fa-2x"></i>
      <span>マップ</span>
    </a>

    <a href="post.php" class="iframe flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="far fa-plus-square fa-2x"></i>
      <span>投稿</span>
    </a>

    <a href="explore.php" class="flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="fa-regular fa-compass fa-2x"></i>
      <span>発見</span>
    </a>

  </nav>
  <!-- nav - end -->

<!-- ▼Colorboxの適用対象の指定とオプションの記述 -->
<script>
   $(document).ready(function(){
      $(".iframe").colorbox({
         iframe: true,
         width: "33%",
         height: "80%",
         speed: 200,
         opacity: 0.7,
         onClosed: function() {
            // 投稿完了時にColorboxを閉じる
            window.parent.$.colorbox.close();
         }
      });

      // 投稿完了イベントをリスンする
      window.addEventListener('message', function(event) {
         if (event.data === 'postComplete') {
            $.colorbox.close();
         }
      });
   });
</script>

</body>

</html>