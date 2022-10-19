let htmlList = "";
var recordingBase64;
$(function () {


    /////////////////////////
    //functions main window//
    /////////////////////////

    //initialization of the tabs
    var tab_options = {onShow: new_tab_show_callback};
    var init_tabs = M.Tabs.init($('.tabs'), tab_options);
    var instance_tabs = M.Tabs.getInstance($('.tabs'));


    //Map initializaton
    overviewMap = L.map('overviewMap').setView([50.8796, 4.7009], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        //attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiY2VkcmljZHMyNTEyIiwiYSI6ImNrZ3d2YThyYTBkd3gyeXBmejdpdmc0M3YifQ.hNXfrpIUH38P-owvohaiIg'
    }).addTo(overviewMap);

    function new_tab_show_callback() {
        if (instance_tabs.index == 1) {
            overviewMap.invalidateSize();
        }
        else{
            $('.listview').css('display', 'flex');
        }
    }

    // Fixed action btn
    var elems = $('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
        direction: 'top',
        hoverEnabled: false
    });

    //modal
    $("#makeSnappLink").animatedModal({
        animatedIn: 'slideInUp',
        animatedOut: 'slideOutRight',
        color: '#fff',
        beforeOpen: function () {
            $('#uploadSnappModal').click();
        },
    });
    $("#chooseSnappLink").animatedModal({
        animatedIn: 'slideInUp',
        animatedOut: 'slideOutRight',
        color: '#fff',
        beforeOpen: function () {
            initExistingSnapp();
        }
    });
    $("#simpleLocationLink").animatedModal({
        animatedIn: 'slideInUp',
        animatedOut: 'slideOutRight',
        color: '#fff',
    });

    ///////////////////////////
    //functions modal windows//
    ///////////////////////////

    //---make snapp modal---//

    //functions from snapp_base
    PictureUpload();
    idButtonSuggestions();
    getInfoButton();
    mapInit();
    fetchAdventure();
    initExistingSnapp();

    //init the stepper
    var stepperMake = document.querySelector('.stepperMake');
    var stepperInstaceMake = new MStepper(stepperMake, {
        // options
        firstActive: 0, // this is the default
        autoFormCreation: false
    });
    stepperMake.addEventListener('stepopen', function () {
        create_snapp_map.invalidateSize();
    });

    //saving adventure location
    $('#addLocation').on('click', function () {
        if ($('#adv_loc_title').val() == '') {
            alert("You should fill in a title");
        } else {
            const post_data = {
                title: $('#adv_loc_title').val(),
                pic: identification.snappImage,
                description: $('#description_area').val(),
                location_lat: create_snapp_map.getCenter().lat,
                location_lon: create_snapp_map.getCenter().lng,
                plant_species: identification.suggestion[identification.chosenSuggestion].name,
                voice: recordingBase64
            };
            $.post(`${base_url}/Adventure/add_adventure_location`, post_data).done(function (response) {
                //window.location.href = `${base_url}/snapp/view/${JSON.parse(response).snapp_id}`;
                console.log(response);
                resetStepper();
                fetchAdventure();
                $('.close-makeSnappModal').click();
            });
        }

    });

    function resetStepper() {
        $('#adv_loc_title').val("");
        $('#description_area').val("");
        stepperInstaceMake.openStep(0);
    }

    //saving adventure
    $('#save_adventure').on('click', function () {
        const post_data = {
            title: $('#title_adv').val(),
            description: $('#textarea_description').val()
        };
        $.post(`${base_url}/Adventure/save_adventure`, post_data).done(function (response) {
            console.log(response);
        });
    });

    //publishing adventure

    $('#submit_adventure').on('click', function () {
        if(htmlList == "" || $('#title_adv').val() == ""){
            alert("you can't submit an empty adventure or an adventure without title");
        }
        else{
            const post_data = {
                title: $('#title_adv').val(),
                description: $('#textarea_description').val()
            };
            $.post(`${base_url}/Adventure/submit_adventure`, post_data).done(function (response) {
                console.log(response);
                window.location.href = `${base_url}/`;
            });
        }

    });

    //Voice Recording

    let audioURLBlob
    let constraintObj = {
        audio: true,
        video: false
    };

    navigator.mediaDevices.getUserMedia(constraintObj)
        .then(function (mediaStreamObj) {

            let start = document.getElementById('btnStart');
            let stop = document.getElementById('btnStop');
            let audioSave = document.getElementById('voice');
            let mediaRecorder = new MediaRecorder(mediaStreamObj);
            let chunks = []; // blob


            start.addEventListener('click', (ev) => {
                mediaRecorder.start();
                console.log(mediaRecorder.state);
            })
            stop.addEventListener('click', (ev) => {
                mediaRecorder.stop();
                console.log(mediaRecorder.state);
            });
            mediaRecorder.ondataavailable = function (ev) {
                chunks.push(ev.data);
                console.log('saved');
            }
            mediaRecorder.onstop = (ev) => {
                let blob = new Blob(chunks, {'type': 'audio/mp3;'});
                chunks = [];
                audioURLBlob = window.URL.createObjectURL(blob);
                audioSave.src = audioURLBlob;
                console.log(blob);

                // blob --> base64
                var reader = new window.FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    recordingBase64 = reader.result;
                }

            }
            $('#btnStart').on('click', function () {
                $('#btnStart').hide();
                $('#btnStop').removeClass('hide');
            });
            $('#btnStop').on('click', function () {
                $('#btnStop').hide();
                $('#voice').removeClass('hide');
            });

        })
        .catch(function (err) {
            //console.log(err.name, err.message);
        });

});

//croppie stuff
function PictureUpload() {
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.create_placeholder').addClass('ready');
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });

            }
            reader.readAsDataURL(input.files[0]);
        } else {
            alert("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#cropsnapp').croppie({
        viewport: {
            //ratio 3:4
            width: 189,
            height: 252,
        },
        showZoomer: false,
        enableExif: true
    });
    $('#uploadSnappModal').on('change', function () {
        readFile(this);
    });
    $('.next-croppie').on('click', function (ev) {
        console.log("imhere");
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            //ratio 3:4
            quality: 0.6,
            size: {300: 400}
        }).then(function (resp) {
            identifyPlant(resp);
        });
    });
}

function fetchAdventure() {
    $.post(`${base_url}/Adventure/get_adventure_locations`).done(function (response) {
        htmlList = "";
        prevMarker = null;
        JSON.parse(response).forEach(function (item) {
            htmlList += `
            <div class="col s12 m7">
                <div href="#" class="card horizontal find_snapp_card">
                    <a href="${base_url}/snapp/view/${item.id_loc}" class="find_snapp_link waves-effect"></a>
                    <div class="card-image">
                        <!-- Picture should be of ratio 3:4 -->
                        <img class="find_snapp_list_image" src="${item.pic}">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <span class="card-title">${item.title}</span>
                            <p class="snapp_descripiton">${item.description}.</p>
                        </div>
                        <div class="card-action">
                            <div class="chip">${item.distanceToPrevious}km</div>
                        </div>
                    </div>
                </div>
            </div>`;
            marker = new L.marker([item.location_lat, item.location_lon]).addTo(overviewMap);
            if(prevMarker != null){

                var firstpolyline = new L.Polyline([prevMarker.getLatLng(),marker.getLatLng()], {
                    color: 'blue',
                    weight: 5,
                    opacity: 0.5,
                    smoothFactor: 1
                });
                firstpolyline.addTo(overviewMap);
            }
            prevMarker = marker;

        });
        if(htmlList != ""){
            $('#list-container').html(htmlList);
            //card hover init
            $('.card-favorite').click(function () {
                    likeButton(this);
                }
            );
            $('.find_snapp_card').hover(
                function(){ $(this).addClass('z-depth-3') },
                function(){ $(this).removeClass('z-depth-3') }
            );
        }

    });
}

function openCollection(collection_id) {
    $.post(`${base_url}/Adventure/get_collection_snapps/${collection_id}`).done(function (response) {
        console.log(response);

        htmlList = `<h4 class="center-align"> <a class="waves-effect waves-light btn-small" onclick="initExistingSnapp()"><i class="material-icons left">keyboard_arrow_left</i>back</a>${JSON.parse(response).collname.collectionName} </h4>` ;
        htmlList += "<div class='flex_container_create_adv'> <div class='flex_box_create_adv'>";
        JSON.parse(response).collectionElements.forEach(function (item) {
            htmlList += `
            <div class="col s12">
                <div href="#" class="card horizontal find_snapp_card">
                    <a onclick="chooseSnapp(${item.id_snapp})" " class="find_snapp_link waves-effect"></a>
                    <div class="card-image">
                        <!-- Picture should be of ratio 3:4 -->
                        <img class="find_snapp_list_image" src="${item.pic}">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <span class="card-title">${item.title}</span>
                            <p class="snapp_descripiton">${item.snappNotes}.</p>
                        </div>
                    </div>
                </div>
            </div>`;
        });
        htmlList += "</div> </div>";
        $("#addExistingSnappModal").html(htmlList);
    });
}

function chooseSnapp(id) {
    $.get(`${base_url}/Snapp/view_json/${id}`).done(function (response) {
        response = JSON.parse(response);
        snappChosen_add_html(response);
        $('#adv_loc_title2').val(response.title);
        $('#description_area2').val(response.snappNotes);
        M.textareaAutoResize($('#description_area2'));

        //init map
        choose_snapp_map = L.map('choose_snapp_map').setView([response.location_lat, response.location_lon], 13);
        mapInit2(choose_snapp_map);

        var stepperSelect = document.querySelector('.stepperSelect');
        var stepperInstaceSelect = new MStepper(stepperSelect, {
            // options
            firstActive: 0, // this is the default
            autoFormCreation: false
        });
        stepperSelect.addEventListener('stepopen', function () {
            choose_snapp_map.invalidateSize();
        });

        //Voice Recording

        let audioURLBlob
        let constraintObj = {
            audio: true,
            video: false
        };

        navigator.mediaDevices.getUserMedia(constraintObj)
            .then(function (mediaStreamObj) {

                let start = document.getElementById('btnStart2');
                let stop = document.getElementById('btnStop2');
                let audioSave = document.getElementById('voice2');
                let mediaRecorder = new MediaRecorder(mediaStreamObj);
                let chunks = []; // blob


                start.addEventListener('click', (ev) => {
                    mediaRecorder.start();
                    console.log(mediaRecorder.state);
                })
                stop.addEventListener('click', (ev) => {
                    mediaRecorder.stop();
                    console.log(mediaRecorder.state);
                });
                mediaRecorder.ondataavailable = function (ev) {
                    chunks.push(ev.data);
                    console.log('saved');
                }
                mediaRecorder.onstop = (ev) => {
                    let blob = new Blob(chunks, {'type': 'audio/mp3;'});
                    chunks = [];
                    audioURLBlob = window.URL.createObjectURL(blob);
                    audioSave.src = audioURLBlob;
                    console.log(blob);

                    // blob --> base64
                    var reader = new window.FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        recordingBase64 = reader.result;
                    }

                }
                $('#btnStart2').on('click', function () {
                    $('#btnStart2').hide();
                    $('#btnStop2').removeClass('hide');
                });
                $('#btnStop2').on('click', function () {
                    $('#btnStop2').hide();
                    $('#voice2').removeClass('hide');
                });

            })
            .catch(function (err) {
                //console.log(err.name, err.message);
            });

        //saving adventure location
        $('#addLocation2').on('click', function () {
            if ($('#adv_loc_title2').val() == '') {
                alert("You should fill in a title");
            } else {
                const post_data = {
                    title: $('#adv_loc_title2').val(),
                    pic: response.pic,
                    description: $('#description_area2').val(),
                    location_lat: choose_snapp_map.getCenter().lat,
                    location_lon: choose_snapp_map.getCenter().lng,
                    plant_species: response.plant_species,
                    voice: recordingBase64
                };
                $.post(`${base_url}/Adventure/add_adventure_location`, post_data).done(function (response) {
                    //window.location.href = `${base_url}/snapp/view/${JSON.parse(response).snapp_id}`;
                    console.log(response);
                    $('#adv_loc_title2').val("");
                    $('#description_area2').val("");
                    initExistingSnapp();
                    stepperInstaceSelect.openStep(0);
                    fetchAdventure();
                    $('.close-chooseSnappModal').click();
                });
            }

        });

    });
}








