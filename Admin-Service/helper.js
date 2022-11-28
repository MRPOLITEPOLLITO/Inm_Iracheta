let coords = {lat: 23.634501, lng: -102.552784};
const mapDiv = document.getElementById("map");
const input = document.getElementById("place");
let map;
let marker;
let autocomplete;
let maxZoomService;
function initMap(){
    map = new google.maps.Map(mapDiv, {
        center: coords,
        zoom: 6
    });
    console.log(maxZoomService);
    marker = new google.maps.Marker({
        position: coords,
        map: map
    });
    initAutoComplete();
}

function initAutoComplete(){
    autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function(){
        const place = autocomplete.getPlace();
        coords = place.geometry.location;
        map.setCenter(coords);
        map.setZoom(17);
        marker.setPosition(coords);
    });
}

function setContent(){
    var myContent = tinymce.activeEditor.getContent("texteditor");
    var s1 = document.getElementById('editor');
    var s2 = document.getElementById('geometry');
    s1.value = myContent;
    s2.value = coords;
    document.forms["editor"].submit();
    document.forms["geometry"].submit();
}