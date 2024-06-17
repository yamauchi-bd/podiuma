$(document).ready(function() {
    $('.post img').click(function() {
        var postId = $(this).data('post-id'); // 投稿IDを取得
        console.log('postId:', postId); // postIdをログに出力

        if (!postId) {
            alert('投稿IDが見つかりません。');
            return;
        }

        $.ajax({
            url:  'postDetailsGet.php', // APIのURL
            type: 'POST',
            data: {
                postId: postId          
            },
            dataType: 'json',
            success: function(data) {
                console.log('Response data:', data); // レスポンスデータをログに出力

                // 成功時の処理
                $('#postDetails').html(
                    '<div class="p-6 bg-white rounded-lg shadow-lg">' +
                    '<h2 class="text-2xl font-bold mb-4">' + data.storeName + '</h2>' +
                    '<p><strong>住所:</strong> ' + data.storeAddress + '</p>' +
                    '<p><strong>URL:</strong> <a href="' + data.storeUrl + '" class="text-blue-500 underline">' + data.storeUrl + '</a></p>' +
                    '<p><strong>ジャンル:</strong> ' + data.storeGenre + '</p>' +
                    '<p><strong>シーン:</strong> ' + data.storeScene + '</p>' +
                    '<p><strong>予算:</strong> ' + data.storeBudget + '</p>' +
                    '<p><strong>おすすめ:</strong> ' + data.storeImpression + '</p>' +
                    '<button id="closeModal" class="mt-4 px-4 py-2 bg-orange-500 text-white rounded">閉じる</button>' +
                    '</div>'
                );
                $('#postDetails').css({
                    'display': 'flex',
                    'justify-content': 'center',
                    'align-items': 'center',
                    'position': 'fixed',
                    'top': '0',
                    'left': '0',
                    'width': '100%',
                    'height': '100%',
                    'background-color': 'rgba(0, 0, 0, 0.5)',
                    'z-index': '1000'
                });

                $('#closeModal').click(function() {
                    $('#postDetails').hide();
                });
            }
        });
    });

    // モーダル外をクリックで閉じる
    $(window).click(function(e) {
        if (!$(e.target).closest('#postDetails > div').length) {
            $('#postDetails').hide();
        }
    });
});
