function initMap() {
    const bloomington = {lat: 39.1653, lng: 86.5264};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: bloomington,
        });
        const marker =  new google.maps.Marker({
            position: bloomington,
            map: map,
        });
    }
    window.initMap = initMap;