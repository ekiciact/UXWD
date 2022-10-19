$(document).ready(function(){
    $('.modal').modal();
    $('.dropdown-trigger').dropdown({

    });
    $('.card-favorite').click(
        function () {
            var postid = $(this).data('id');
            $post = $(this);
            if($(this).text() == "favorite") {
                $(this).text( "favorite_border" )

                $.ajax({
                    url: base_url + '/Home/like_button',
                    type: 'POST',
                    data: {
                        'unliked': 1,
                        'postid': postid
                    },
                    success: function(response){
                        $post.parent().find('span.likes').text(response);
                        // alert(response);
                    }
                });
            } else
            {
                $(this).text( "favorite" );

                $.ajax({
                    url: base_url + '/Home/like_button',
                    type: 'POST',
                    data: {
                        'liked': 1,
                        'postid': postid
                    },
                    success: function(response){
                        $post.parent().find('span.likes').text(response);
                        // alert(response);
                    }
                });
            }

        }
    );
//Map initializaton
    var mymap = L.map('mapid').setView([location_lat, location_lon], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiY2VkcmljZHMyNTEyIiwiYSI6ImNrZ3d2YThyYTBkd3gyeXBmejdpdmc0M3YifQ.hNXfrpIUH38P-owvohaiIg'
    }).addTo(mymap);

    var marker = L.marker([location_lat, location_lon]).addTo(mymap);
    function reqListener () {
        console.log(this.responseText);
    }



});

