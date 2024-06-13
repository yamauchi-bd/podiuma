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