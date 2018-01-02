var map;


function initmap() {
    // set up the map
    var mymap = L.map('mapid').setView([51.505, -0.09], 13);

    // create the tile layer with correct attribution

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiY3ZlcmluZSIsImEiOiJjamI5dmNsc2cwZnF0Mnd1cG14bTd3bWx1In0.Vc2UzKeLDzIUvik3rI9fAA'
    }).addTo(mymap);
}

