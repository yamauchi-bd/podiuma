$(document).ready(function() {
    $('.post img').click(function() {
        var postId = $(this).data('post-id'); // 投稿IDを取得
        console.log('postId:', postId); // postIdをログに出力

        if (!postId) {
            alert('投稿IDが見つかりません。');
            return;
        }

        $.ajax({
            url: 'postDetailsGet.php', // APIのURL
            type: 'POST',
            data: {
                postId: postId          
            },
            dataType: 'json',
            success: function(data) {
                console.log('Response data:', data); // レスポンスデータをログに出力

                if (data.error) {
                    alert(data.error);
                    return;
                }

                // 成功時の処理
                $('#postDetails').html(
                    '<p>店舗名: ' + data.storeName + '</p>' +
                    '<p>住所: ' + data.storeAddress + '</p>' +
                    '<p>URL: ' + data.storeUrl + '</p>' +
                    '<p>ジャンル: ' + data.storeGenre + '</p>' +
                    '<p>シーン: ' + data.storeScene + '</p>' +
                    '<p>予算: ' + data.storeBudget + '</p>' +
                    '<p>おすすめ: ' + data.storeImpression + '</p>'
                );
                $('#postDetails').css({
                    'display': 'block',
                    'width': '500px',
                    'height': '350px',
                    'color': '#000',
                    'background-color': '#fff',
                    'padding': '10px',
                    'border-radius': '10px',
                    'box-shadow': '0 0 10px rgba(0, 0, 0, 0.5)'
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown); // エラー詳細をログに出力
                console.error('Response text:', jqXHR.responseText); // レスポンステキストをログに出力
                alert('情報の取得に失敗しました。');
            }
        });
    });

    // モーダル外をクリックで閉じる
    $(window).click(function(e) {
        if (!$(e.target).closest('#postDetails').length) {
            $('#postDetails').hide();
        }
    });
});

