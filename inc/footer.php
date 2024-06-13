<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/output.css?<?= time() ?>">
  <link href="../colorbox/example3/colorbox.css" rel="stylesheet">

  <!-- ▼jQueryとColorboxのスクリプトを読み込む記述 -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../colorbox/jquery.colorbox-min.js"></script>

  <script src="https://kit.fontawesome.com/17c882a708.js" crossorigin="anonymous"></script>
</head>

<body>

  <!-- nav - start -->
  <nav class="sticky bottom-0 mx-auto flex h-28 w-full justify-around items-center gap-5 border-t bg-white px-40 text-xs sm:rounded-t-xl sm:border-transparent sm:text-sm sm:shadow-md">

    <a href="" class="flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="fa-solid fa-location-dot fa-2x"></i>
      <span>マップ</span>
    </a>

    <a href="../post/" class="iframe flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="far fa-plus-square fa-2x"></i>
      <span>投稿</span>
    </a>

    <a href="./explore" class="flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="fa-brands fa-instagram fa-2x"></i>
      <span>発見</span>
    </a>

    <a href="#" class="flex flex-col items-center gap-1 text-gray-800 transition duration-100 hover:text-gray-500 active:text-gray-800">
      <i class="far fa-user-circle fa-2x"></i>
      <span>マイページ</span>
    </a>

  </nav>
  <!-- nav - end -->

<!-- ▼Colorboxの適用対象の指定とオプションの記述 -->
<script>
   $(document).ready(function(){
      $(".iframe").colorbox({iframe:true, width:"40%", height:"80%", speed:200, opacity:0.7});
   });
</script>

</body>

</html>