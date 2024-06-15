let postAutocomplete;

export function initPostAutocomplete() {
    const inputElement = document.getElementById('storeName');

    postAutocomplete = new google.maps.places.Autocomplete(inputElement, { types: ['establishment'] });
    postAutocomplete.setFields(['place_id', 'name', 'formatted_address', 'website']);
    postAutocomplete.addListener('place_changed', fillInAddress);
}

export function fillInAddress() {
    if (!postAutocomplete) {
        console.error("Autocomplete is not initialized.");
        return;
    }

    const place = postAutocomplete.getPlace();
    if (!place || !place.place_id) {
        console.error("No details available for input: '" + place.name + "'");
        return;
    }

    const address = place.formatted_address ? place.formatted_address.split(' ').slice(1).join(' ') : '';
    $("#storeAddress").val(address);
    $("#storeUrl").val(place.website || '');
    $("#storeName").val(place.name);
}

//現在地表示
export function initMap(stores) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: userLocation
            });

            var userCircle = new google.maps.Circle({
                strokeColor: '#0000FF',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#0000FF',
                fillOpacity: 0.35,
                map: map,
                center: userLocation,
                radius: 50
            });

            //店舗マーカー設置
            stores.forEach(function(store) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'address': store.storeAddress}, function(results, status) {
                    if (status === 'OK') {
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            title: store.storeName
                        });

                        var infowindow = new google.maps.InfoWindow({
                            content: `
                    <div style="font-family: Arial, sans-serif; font-size: 14px;">
                        <h2 style="margin: 0; color: #333;">${store.storeName}</h2>
                        <p style="margin: 5px 0;">
                            <strong>住所:</strong> ${store.storeAddress}<br>
                            <strong>URL:</strong> <a href="${store.storeUrl}" target="_blank">${store.storeUrl}</a><br>
                            <strong>ジャンル:</strong> ${store.storeGenre}<br>
                            <strong>シーン:</strong> ${store.storeScene}<br>
                            <strong>予算:</strong> ${store.storeBudget}<br>
                            <strong>印象:</strong> ${store.storeImpression}
                        </p>
                        <img src="storeImage/${store.storeImage}" alt="店舗画像" style="width:100px; border-radius: 8px;">
                    </div>
                `
                        });

                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });
                    } else {
                        console.log('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        }, function() {
            handleLocationError(true, map.getCenter());
        });
    } else {
        // ブラウザがGeolocationをサポートしていない場合
        handleLocationError(false, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, pos) {
    console.log(browserHasGeolocation ? "Error: The Geolocation service failed." : "Error: Your browser doesn't support geolocation.");
}
