$(document).ready(function(){
    $('.modal').modal();
    $('.dropdown-trigger').dropdown({

    });
    $('.card-favorite').click(
        function () {
            $(this).text() == "favorite" ? $(this).text( "favorite_border" ) : $(this).text( "favorite" );
        }
    );
//Map initializaton
    var mymap = L.map('mapid').setView([locationcomp[0].location_lat, locationcomp[0].location_lon], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiY2VkcmljZHMyNTEyIiwiYSI6ImNrZ3d2YThyYTBkd3gyeXBmejdpdmc0M3YifQ.hNXfrpIUH38P-owvohaiIg'
    }).addTo(mymap);

    /*var marker = L.marker([location_lat, location_lon]).addTo(mymap);
    function reqListener () {
        console.log(this.responseText);
    }*/
    console.log(locationcomp);
    for (var i = 0; i < locationcomp.length; i++) {
        marker = new L.marker([locationcomp[i].location_lat, locationcomp[i].location_lon])
            .addTo(mymap);
    }
    for(var i = 0; i <locationcomp.length;i++){
    var pointA = new L.LatLng(locationcomp[i].location_lat, locationcomp[i].location_lon);
    var pointB = new L.LatLng(locationcomp[i+1].location_lat, locationcomp[i+1].location_lon);
    var pointList = [pointA, pointB];

    var firstpolyline = new L.Polyline(pointList, {
        color: 'blue',
        weight: 5,
        opacity: 0.5,
        smoothFactor: 1
    });
    firstpolyline.addTo(mymap);
    }
});

