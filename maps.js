function initMap() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: pos,
                    zoom: 15,
                    styles: [{
                        featureType: "poi", // Points of Interestを非表示に
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    }]
                });

                new google.maps.Marker({
                    position: pos,
                    map: map,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 10,
                        fillColor: '#1E90FF',
                        fillOpacity: 0.7,
                        strokeColor: '#1E90FF',
                        strokeWeight: 3
                    }
                });

                
            },
            function(error) {
                console.error('Geolocation Error: ', error);
            }
        );
    } else {
        console.error('Geolocation is not supported by this browser.');
    }
}
