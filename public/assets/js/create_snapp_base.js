
    /////////////
    //Variables//
    /////////////

var create_snapp_map;
var identification = {
    snappImage: "https://picsum.photos/300/400",
    chosenSuggestion: 0,
    suggestion: [
        {
            name: "no option found",
            image: `${base_url}/assets/images/error.jpg`,
            accuracy: 0.01,
            wikiLink: "#",
            description: "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate"
        },
        {
            name: "No second option found",
            image: `${base_url}/assets/images/error.jpg`,
            accuracy: 0.01,
            wikiLink: "#",
            description: "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate"
        },
        {
            name: "No third option found",
            image: `${base_url}/assets/images/error.jpg`,
            accuracy: 0.01,
            wikiLink: "#",
            description: "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate"
        }
    ],
};

const primary_color = "#60A53B";
const primary_color_light = "#e2f3d9ce";

function idButtonSuggestions() {
    //identification selectors
    $('#suggestion1').on('click', function () {
        $('.suggestion1').css("background", `conic-gradient(${primary_color} ${identification.suggestion[0].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[0].accuracy*360}deg 359deg)`);
        $('.suggestion1 img').css("opacity", 1);
        $('.suggestion2').css("background", `conic-gradient(darkgrey ${identification.suggestion[1].accuracy*360}deg, lightgrey ${identification.suggestion[1].accuracy*360}deg 359deg)`);
        $('.suggestion2 img').css("opacity", 0.4);
        $('.suggestion3').css("background", `conic-gradient(darkgrey ${identification.suggestion[2].accuracy*360}deg, lightgrey ${identification.suggestion[2].accuracy*360}deg 359deg)`);
        $('.suggestion3 img').css("opacity", 0.4);
        $('#plant_name').text(identification.suggestion[0].name);
        $('#plant_percentage .number').text(`${Math.round(identification.suggestion[0].accuracy*100)}%`);
        $('#plant_percentage').css("background", `conic-gradient(${primary_color} ${identification.suggestion[0].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[0].accuracy*360}deg 359deg)`);
        identification.chosenSuggestion = 0;
    });
    $('#suggestion2').on('click', function () {
        $('.suggestion1').css("background", `conic-gradient(darkgrey ${identification.suggestion[0].accuracy*360}deg, lightgrey ${identification.suggestion[0].accuracy*360}deg 359deg)`);
        $('.suggestion1 img').css("opacity", 0.4);
        $('.suggestion2').css("background", `conic-gradient(${primary_color} ${identification.suggestion[1].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[1].accuracy*360}deg 359deg)`);
        $('.suggestion2 img').css("opacity", 1);
        $('.suggestion3').css("background", `conic-gradient(darkgrey ${identification.suggestion[2].accuracy*360}deg, lightgrey ${identification.suggestion[2].accuracy*360}deg 359deg)`);
        $('.suggestion3 img').css("opacity", 0.4);
        $('#plant_name').text(identification.suggestion[1].name);
        $('#plant_percentage .number').text(`${Math.round(identification.suggestion[1].accuracy*100)}%`);
        $('#plant_percentage').css("background", `conic-gradient(${primary_color} ${identification.suggestion[1].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[1].accuracy*360}deg 359deg)`);
        identification.chosenSuggestion = 1;
    });
    $('#suggestion3').on('click', function () {
        $('.suggestion1').css("background", `conic-gradient(darkgrey ${identification.suggestion[0].accuracy*360}deg, lightgrey ${identification.suggestion[0].accuracy*360}deg 359deg)`);
        $('.suggestion1 img').css("opacity", 0.4);
        $('.suggestion2').css("background", `conic-gradient(darkgrey ${identification.suggestion[1].accuracy*360}deg, lightgrey ${identification.suggestion[1].accuracy*360}deg 359deg)`);
        $('.suggestion2 img').css("opacity", 0.4);
        $('.suggestion3').css("background", `conic-gradient(${primary_color} ${identification.suggestion[2].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[2].accuracy*360}deg 359deg)`);
        $('.suggestion3 img').css("opacity", 1);
        $('#plant_name').text(identification.suggestion[2].name);
        $('#plant_percentage .number').text(`${Math.round(identification.suggestion[2].accuracy*100)}%`);
        $('#plant_percentage').css("background", `conic-gradient(${primary_color} ${identification.suggestion[2].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[2].accuracy*360}deg 359deg)`);


        identification.chosenSuggestion = 2;
    });
}

function getInfoButton() {
    $('#add_info').on('click', function () {
        $('#description_area').val(identification.suggestion[identification.chosenSuggestion].description);
        M.textareaAutoResize($('#description_area'));
    });
}

function loadView() {
    console.log(identification);
    $('.imageselector .snapp').attr("src", identification.snappImage);
    $('#plant_percentage').css("background", `conic-gradient(${primary_color} ${identification.suggestion[0].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[0].accuracy*360}deg 359deg)`);
    $('#plant_percentage .number').text(`${Math.round(identification.suggestion[0].accuracy*100)}%`);
    $('.suggestion1').css("background", `conic-gradient(${primary_color} ${identification.suggestion[0].accuracy*360}deg, ${primary_color_light} ${identification.suggestion[0].accuracy*360}deg 359deg)`);
    $('.suggestion2').css("background", `conic-gradient(darkgrey ${identification.suggestion[1].accuracy*360}deg, lightgrey ${identification.suggestion[1].accuracy*360}deg 359deg)`);
    $('.suggestion3').css("background", `conic-gradient(darkgrey ${identification.suggestion[2].accuracy*360}deg, lightgrey ${identification.suggestion[2].accuracy*360}deg 359deg)`);
    $('.suggestion1 img').attr("src", identification.suggestion[0].image);
    $('.suggestion1 img').css("opacity", 1);
    $('.suggestion2 img').attr("src", identification.suggestion[1].image);
    $('.suggestion2 img').css("opacity", 0.4);
    $('.suggestion3 img').attr("src", identification.suggestion[2].image);
    $('.suggestion3 img').css("opacity", 0.4);
    $('#plant_name').text(identification.suggestion[0].name);


    create_snapp_map.invalidateSize();

    $('.imageselector_loader').addClass('hide');
    $('.imageselector').removeClass('hide');

}

//function used for development only
function identifyPlantdev(base64) {
    data = {
        "id": 7667939,
        "custom_id": null,
        "meta_data": {
            "latitude": null,
            "longitude": null,
            "date": "2020-11-20",
            "datetime": "2020-11-20"
        },
        "uploaded_datetime": 1605904365.720117,
        "finished_datetime": 1605904366.715172,
        "images": [
            {
                "file_name": "0bf5775b5d8043da9814645124c10acc.jpg",
                "url": "https://plant.id/media/images/0bf5775b5d8043da9814645124c10acc.jpg"
            }
        ],
        "suggestions": [
            {
                "id": 56498948,
                "plant_name": "Taraxacum officinale",
                "plant_details": {
                    "scientific_name": "Taraxacum officinale",
                    "structured_name": {
                        "genus": "taraxacum",
                        "species": "officinale"
                    },
                    "common_names": [
                        "Common dandelion",
                        "Dandelion"
                    ],
                    "url": "http://en.wikipedia.org/wiki/Taraxacum_officinale",
                    "name_authority": "Taraxacum officinale F.H.Wigg.",
                    "wiki_description": {
                        "value": "Taraxacum officinale, the common dandelion (often simply called \"dandelion\"), is a flowering herbaceous perennial plant of the family Asteraceae (Compositae).\nIt can be found growing in temperate regions of the world, in lawns, on roadsides, on disturbed banks and shores of water ways, and other areas with moist soils. T. officinale is considered a weed, especially in lawns and along roadsides, but it is sometimes used as a medical herb and in food preparation. Common dandelion is well known for its yellow flower heads that turn into round balls of silver tufted fruits that disperse in the wind.  These balls are called \"blowballs\" or \"clocks\" in both British and American English.",
                        "citation": "http://en.wikipedia.org/wiki/Taraxacum_officinale",
                        "license_name": "CC BY-SA 3.0",
                        "license_url": "https://creativecommons.org/licenses/by-sa/3.0/"
                    },
                    "taxonomy": {
                        "kingdom": "Plantae",
                        "phylum": "Tracheophyta",
                        "class": "Magnoliopsida",
                        "order": "Asterales",
                        "family": "Asteraceae",
                        "genus": "Taraxacum"
                    },
                    "synonyms": [
                        "Taraxacum kok-saghyz",
                        "Taraxacum vulgare",
                        "Taraxacum palustre var. vulgare",
                        "Leontodon taraxacum",
                        "Leontodon vulgare",
                        "Taraxacum almaatense",
                        "Taraxacum dens-leonis",
                        "Taraxacum vulgare"
                    ]
                },
                "probability": 0.8426923085753543,
                "confirmed": false,
                "similar_images": [
                    {
                        "id": "b365f79832601cb264dadc3e044b9722",
                        "similarity": 0.9781787303765886,
                        "url": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum officinale/b365f79832601cb264dadc3e044b9722.jpg",
                        "url_small": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum officinale/b365f79832601cb264dadc3e044b9722.small.jpg"
                    },
                    {
                        "id": "268722208de0f3df45c471184c8e5987",
                        "similarity": 0.9692519894203178,
                        "url": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum officinale/268722208de0f3df45c471184c8e5987.jpg",
                        "url_small": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum officinale/268722208de0f3df45c471184c8e5987.small.jpg"
                    }
                ]
            },
            {
                "id": 56498949,
                "plant_name": "Taraxacum",
                "plant_details": {
                    "scientific_name": "Taraxacum",
                    "structured_name": {
                        "genus": "taraxacum"
                    },
                    "common_names": [
                        "Dandelion",
                        "Dandelions"
                    ],
                    "url": "http://en.wikipedia.org/wiki/Taraxacum",
                    "name_authority": null,
                    "wiki_description": {
                        "value": "Taraxacum () is a large genus of flowering plants in the family Asteraceae, which consists of species commonly known as dandelions. The genus is native to Eurasia and North America, but the two commonplace species worldwide, T. officinale and T. erythrospermum, were introduced from Europe and now propagate as wildflowers. Both species are edible in their entirety. The common name dandelion ( DAN-di-ly-ən, from French dent-de-lion, meaning \"lion's tooth\") is given to members of the genus. Like other members of the family Asteraceae, they have very small flowers collected together into a composite flower head. Each single flower in a head is called a floret. In part due to their abundance along with being a generalist species, dandelions are one of the most vital early spring nectar sources for a wide host of pollinators. Many Taraxacum species produce seeds asexually by apomixis, where the seeds are produced without pollination, resulting in offspring that are genetically identical to the parent plant.",
                        "citation": "http://en.wikipedia.org/wiki/Taraxacum",
                        "license_name": "CC BY-SA 3.0",
                        "license_url": "https://creativecommons.org/licenses/by-sa/3.0/"
                    },
                    "taxonomy": {
                        "kingdom": "Plantae",
                        "phylum": "Tracheophyta",
                        "class": "Magnoliopsida",
                        "order": "Asterales",
                        "family": "Asteraceae",
                        "genus": "Taraxacum"
                    },
                    "synonyms": []
                },
                "probability": 0.05385953700850546,
                "confirmed": false,
                "similar_images": [
                    {
                        "id": "93637502a2198b299930d5e422c2a03d",
                        "similarity": 0.8710916426322333,
                        "url": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum/93637502a2198b299930d5e422c2a03d.jpg",
                        "url_small": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum/93637502a2198b299930d5e422c2a03d.small.jpg"
                    },
                    {
                        "id": "d683fe18c27ebf0d9dc5459babc4c3ad",
                        "similarity": 0.849448262901156,
                        "url": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum/d683fe18c27ebf0d9dc5459babc4c3ad.jpg",
                        "url_small": "https://storage.googleapis.com/plant_id_images/similar_images/2019_05/images/Taraxacum/d683fe18c27ebf0d9dc5459babc4c3ad.small.jpg"
                    }
                ]
            },
            {
                "id": 56498950,
                "plant_name": "Taraxacum erythrospermum",
                "plant_details": {
                    "scientific_name": "Taraxacum erythrospermum",
                    "structured_name": {
                        "genus": "taraxacum",
                        "species": "erythrospermum"
                    },
                    "common_names": [
                        "Red-seeded dandelion"
                    ],
                    "url": "http://en.wikipedia.org/wiki/Taraxacum_erythrospermum",
                    "name_authority": "Taraxacum erythrospermum Andrz. ex Besser",
                    "wiki_description": {
                        "value": "Taraxacum erythrospermum, known by the common name red-seeded dandelion, is a species of dandelion found in much of North America, but most commonly in the north.It is often considered as a variety of Taraxacum laevigatum (i.e., Taraxacum laevigatum var. erythrospermum).",
                        "citation": "http://en.wikipedia.org/wiki/Taraxacum_erythrospermum",
                        "license_name": "CC BY-SA 3.0",
                        "license_url": "https://creativecommons.org/licenses/by-sa/3.0/"
                    },
                    "taxonomy": {
                        "kingdom": "Plantae",
                        "phylum": "Tracheophyta",
                        "class": "Magnoliopsida",
                        "order": "Asterales",
                        "family": "Asteraceae",
                        "genus": "Taraxacum"
                    },
                    "synonyms": [
                        "Taraxacum laevigatum",
                        "Taraxacum scanicum",
                        "Leontodon erythrospermum",
                        "Taraxacum disseminatum",
                        "Taraxacum lacistophyllum",
                        "Taraxacum laevigatum var. erythrospermum",
                        "Taraxacum officinale var. erythrospermum",
                        "Taraxacum scanicum",
                        "Taraxacum tauricum"
                    ]
                },
                "probability": 0.018601357562966443,
                "confirmed": false,
                "similar_images": []
            }
        ],
        "modifiers": [
            "crops_fast",
            "similar_images"
        ],
        "secret": "YPfY5lW2auKPDqv",
        "fail_cause": null,
        "countable": true,
        "feedback": null
    };
    identification.snappImage = base64;
    for (i = 0; i <= 2 && i < data.suggestions.length; i++) {
        identification.suggestion[i].accuracy = data.suggestions[i].probability;
        identification.suggestion[i].name = data.suggestions[i].plant_details.common_names[0];
        identification.suggestion[i].wikiLink = data.suggestions[i].plant_details.url;
        identification.suggestion[i].description = data.suggestions[i].plant_details.wiki_description.value;
        if(data.suggestions[i].similar_images.length > 0){
            identification.suggestion[i].image = data.suggestions[i].similar_images[0].url;
        }
    }
    loadView();

}

function identifyPlant(base64)
{
    const data = {
        api_key: "dViv6KR1IoGpP0VlTJKrejfDb9uoxrXPdb8K0k7WuiWfpNw85i",
        images: [base64],
        modifiers: ["crops_fast", "similar_images"],
        plant_language: "en",
        plant_details: ["common_names",
            "url",
            "name_authority",
            "wiki_description",
            "taxonomy",
            "synonyms"]
    };
    console.log(data.images);
    fetch('https://api.plant.id/v2/identify', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            identification.snappImage = base64;
            for (i = 0; i <= 2 && i < data.suggestions.length; i++) {
                identification.suggestion[i].accuracy = data.suggestions[i].probability;
                identification.suggestion[i].name = (data.suggestions[i].plant_details.common_names == null ? data.suggestions[i].plant_details.scientific_name : data.suggestions[i].plant_details.common_names[0]);
                identification.suggestion[i].wikiLink = data.suggestions[i].plant_details.url;
                identification.suggestion[i].description = data.suggestions[i].plant_details.wiki_description.value;
                if(data.suggestions[i].similar_images.length > 0){
                    identification.suggestion[i].image = data.suggestions[i].similar_images[0].url;
                }

            }
            loadView();
        })
        .catch((error) => {
            console.log('Error:', error);
        });
}

function mapInit() {
    //Map initializaton
    create_snapp_map = L.map('create_snapp_map').setView([50.8796, 4.7009], 13);
    mapInit2(create_snapp_map);
}

function mapInit2(create_snapp_map) {
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: '',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiY2VkcmljZHMyNTEyIiwiYSI6ImNrZ3d2YThyYTBkd3gyeXBmejdpdmc0M3YifQ.hNXfrpIUH38P-owvohaiIg'
    }).addTo(create_snapp_map);
    L.easyButton( '<span class="material-icons easy-button-locate">my_location</span>', function(){
        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                create_snapp_map.setView([position.coords.latitude, position.coords.longitude])
            });
        } else {
            alert("Sorry, your browser does not support HTML5 geolocation.");
        }
    }).addTo(create_snapp_map);

    var crosshair = new L.marker(create_snapp_map.getCenter());
    crosshair.addTo(create_snapp_map);
    create_snapp_map.on('move', function(e) {
        crosshair.setLatLng(create_snapp_map.getCenter());
    });
    create_snapp_map.on('zoom', function(e) {
        crosshair.setLatLng(create_snapp_map.getCenter());
    });
}
