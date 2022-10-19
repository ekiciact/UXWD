    /////////////////
    //main function//
    /////////////////
$(function(){
//modal
    $("#send").animatedModal({
        animatedIn:'slideInUp',
        animatedOut:'slideOutRight',
        color:'#fff',
        beforeOpen: function() {
            $('.modal-content').removeClass('hide');
        },
        beforeClose: function() {
            $('.create_placeholder').removeClass('ready');
        },
        afterClose: function () {
            $('.imageselector_loader').removeClass('hide');
            $('.imageselector').addClass('hide');
        }
    });
    var stepper = document.querySelector('.stepper');
    var stepperInstace = new MStepper(stepper, {
        // options
        firstActive: 0, // this is the default
        autoFormCreation: false
    });
    stepper.addEventListener('stepopen', function () {
       create_snapp_map.invalidateSize();
    });

//croppie
    PictureUpload();
//identification selector
    idButtonSuggestions();
//get info button
    getInfoButton();



//save and send to DB
    $('#save_snapp').on('click', function () {
        if($('#snapp_title').val() == ''){
            alert("You should fill in a title");
        }
        else{
            const post_data = {
                snapp_title: $('#snapp_title').val(),
                snapp_image: identification.snappImage,
                snapp_description: $('#description_area').val(),
                snapp_location_lat: create_snapp_map.getCenter().lat,
                snapp_location_lng: create_snapp_map.getCenter().lng,
                plant_species: identification.suggestion[identification.chosenSuggestion].name,
                info_link: identification.suggestion[identification.chosenSuggestion].wikiLink,
                example_picture_species: identification.suggestion[identification.chosenSuggestion].image
            };

            $.post(`${base_url}/snapp/new_snapp`, post_data).done(function (response) {
                window.location.href = `${base_url}/snapp/view/${JSON.parse(response).snapp_id}`;
                resetStepper();
            });
        }
    });

    mapInit();
    function resetStepper(){
        $('#snapp_title').val("");
        $('#description_area').val("");
        stepperInstace.openStep(0);
    }
});



        /////////////
        //functions//
        /////////////

//croppie stuff
function PictureUpload()
{
    var $uploadCrop;
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.create_placeholder').addClass('ready');
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });

            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
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
    $('#upload').on('change', function () {
        $('.photo_button').removeClass('pulse');
        readFile(this);
    });
    $('.confirm_button').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            //ratio 3:4
            quality: 0.6,
            size: {300 : 400}
        }).then(function (resp) {
            //console.log(resp);
            identifyPlant(resp);
        });
    });
}
