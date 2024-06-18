<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

include 'funcs.php';

$stores = getStores();
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

<body>
    <div id="map" class="w-full h-screen"></div>

    <?php include 'footer.php'; ?>

    <script type="module">
        import { GOOGLE_MAPS_API_KEY } from './key.js';
        import { initMap } from './mapFuncs.js';

        // Google Maps APIのスクリプトタグを動的に生成
        const googleMapsScript = document.createElement('script');
        googleMapsScript.src = `https://maps.googleapis.com/maps/api/js?key=${GOOGLE_MAPS_API_KEY}&libraries=places&callback=onGoogleScriptLoad`;
        googleMapsScript.async = true;
        googleMapsScript.defer = true;
        document.body.appendChild(googleMapsScript);

        // Google Maps APIのスクリプトが読み込まれた後に呼び出される関数
        window.onGoogleScriptLoad = function() {
            const stores = <?php echo json_encode($stores); ?>;
            initMap(stores);
        };
    </script>
</body>

</html>