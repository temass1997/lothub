const map = {
    initGeneralMap(zip) {
        let googleMap = new google.maps.Map(document.getElementById("map"), {
            zoom: 13,
            center: { lat: 41.876, lng: -87.624 },
        });
        console.log(process.env.MIX_GOOGLE_MAPS_SOURCE_URL);
        const ctaLayer = new google.maps.KmlLayer({
            url: process.env.MIX_GOOGLE_MAPS_SOURCE_URL + "zip" + zip + ".kml",
            map: googleMap,
        });
    },
    
    initPopupMap(lat, lng) {
        const position = { lat: lat, lng: lng };
        let map = new google.maps.Map(document.getElementById("popup__map"), {
            zoom: 13,
            center: position,
        });
        new google.maps.Marker({
            position: position,
            map,
        });
    }
}

export default map;