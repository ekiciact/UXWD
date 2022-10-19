var mymap;
var markerList = [];

$(function () {
    ///////////////////
    //initializations//
    ///////////////////
    $('.chips').chips();

    let post_data = {
        lat: 50.8796,
        lng: 4.7009
    };
    loadListFromDB(post_data);
//Tabs initialization
    var tab_options = {onShow: new_tab_show_callback}
    var init_tabs = M.Tabs.init($('.tabs'), tab_options);
    var instance_tabs = M.Tabs.getInstance($('.tabs'));

//Map initializaton
    mymap = L.map('mapid').setView([50.8796, 4.7009], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiY2VkcmljZHMyNTEyIiwiYSI6ImNrZ3d2YThyYTBkd3gyeXBmejdpdmc0M3YifQ.hNXfrpIUH38P-owvohaiIg'
    }).addTo(mymap);
    $('#search_this_area').click(function () {
        loadListFromDB({
            lat: mymap.getCenter().lat,
            lng: mymap.getCenter().lng
        });
});

    function new_tab_show_callback() {

        if (instance_tabs.index == 1) {
            mymap.invalidateSize();
        }
    }

//algolia search initialization
    var placesAutocomplete = places({
        appId: 'plWRP55NSUEK',
        apiKey: 'b70bfab4ee2d93efd50f9d9f26ec7243',
        container: document.querySelector('#address')
    });
    placesAutocomplete.on('change', function (e) {
        mymap.setView([e.suggestion.latlng.lat, e.suggestion.latlng.lng], 13);
        loadListFromDB({
            lat: e.suggestion.latlng.lat,
            lng: e.suggestion.latlng.lng
        });

        console.log(e.suggestion.latlng);
    });

//gps button
    $('.algolia-location').click(
        function () {
            $(".algolia-search").val("My Location");
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    mymap.setView([position.coords.latitude, position.coords.longitude])
                    loadListFromDB({
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    });
                });
            } else {
                alert("Sorry, your browser does not support HTML5 geolocation.");
            }
        }
    );
});

function loadListFromDB(post_data) {
    $.post(`${base_url}/adventure/find_an_adventure`, post_data).done(function (response) {
        let htmlList = "";
        for (i = 0; i < markerList.length; i++) {
            mymap.removeLayer(markerList[i]);
        }
        markerList = [];
        console.log(response);
        JSON.parse(response).forEach(function (item, index) {
            htmlBlock = "";
            htmlBlock += `<div class="col s12 m7">
    <div href="#" class="card horizontal find_snapp_card">
        <a href="${base_url}/snapp/view_adv/${item.id_adv}" class="find_snapp_link waves-effect"></a>
        <div class="card-stacked">
            <div class="card-content">
                <span class="card-title">${item.title}</span>
                <p class="snapp_descripiton">${item.description}</p>
                <div class="adv_loc_thumbnail_placeholder"> 
                `
                //Inner card
                totalkm = 0;
                if (item.locArray.length <= 3){
                    item.locArray.forEach(function (item) {
                        htmlBlock += `<img class="adv_loc_thumbnail" src="${item.pic}">`
                        totalkm += parseInt(item.distanceToPrevious);
                    });
                }
                else{
                    item.locArray.forEach(function (item) {
                        totalkm += parseInt(item.distanceToPrevious);
                    });
                    htmlBlock += `<img class="adv_loc_thumbnail" src="${item.locArray[0].pic}">`
                    htmlBlock += `<img class="adv_loc_thumbnail" src="${item.locArray[1].pic}">`
                    htmlBlock += `<img class="adv_loc_thumbnail" src="https://hnc.org.au/wp-content/themes/ncphn/img/three-dots.png">`
                }
                htmlBlock += ` <div class="chips_placeholder"> <div class="chip">${item.locArray.length} stops </div> <div class="chip"> total of ${Math.round(totalkm)}km </div></div>`
                //End inner card
            htmlBlock +=`</div> </div>
            <div class="card-action">
                <span><div class="chip">${item.Distance} km from you</div></span>
                
                <div>
                    <a href='javascript:void(0)'> <i data-title="${item.title}" data-id="${item.id_adv}" class="material-icons card-share">share</i></a>
                    <a href='javascript:void(0)'> <i data-id="${item.id_adv}" class="material-icons card-favorite">${item.liked}</i> </a>
<!--                    <span class="likes">${item.like_count}</span>-->
                </div>
            </div>
        </div>
    </div>
</div>`;
            htmlList += htmlBlock;
            options = {
                closeButton: false,
                maxWidth : 330,
                minWidth : 330
            };

            var marker = new L.marker([item.location_lat, item.location_lon]).bindPopup(htmlBlock, options);
            markerList.push(marker);
            mymap.addLayer(markerList[index]);

        });
        $('#list-container').html(htmlList);

        $('.card-favorite').click(
            function () {
                var postid = $(this).data('id');
                $post = $(this);
                if(!$(this).text().includes("border")) {
                    $(this).text( "favorite_border" )

                    $.ajax({
                        url: base_url + '/Home/like_button',
                        type: 'POST',
                        data: {
                            'unliked_adv': 1,
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
                            'liked_adv': 1,
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

        $('.card-share').click(
            function () {
                if (navigator.share) {
                    var postid = $(this).data('id');
                    var posttitle = $(this).data('title');
                    navigator.share({
                        title: posttitle,
                        text: 'Join Snapp now! Check out '+ posttitle,
                        url: base_url + '/Snapp/view/' + postid,
                    })
                        .then(() => console.log('Thanks for sharing!'))
                        .catch((error) => console.log('Error sharing', error));
                }
                else {
                    alert("Sorry, this browser doesn't support sharing button.");
                }
            }
        );

        //card hover init
        $('.find_snapp_card').hover(
            function () {
                $(this).addClass('z-depth-3')
            },
            function () {
                $(this).removeClass('z-depth-3')
            }
        );
    });
}