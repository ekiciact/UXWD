$(function(){
    // $("#snapp").click(createSnapp);
});

$(document).ready(function(){
    $('.modal').modal();


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                document.cookie = "latitude=" + position.coords.latitude;
                document.cookie = "longitude=" + position.coords.longitude;
            });
        } else {
            alert("Sorry, we can't get your location, distances depend on Leuven City.");
        }
    }
    getLocation()

});

function registerAlert() {
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];
    modal.style.display = "block";
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

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
                    'unliked': 1,
                    'postid': postid
                },
                success: function(response){
                    $post.parent().find('span.likes').text(response);
                    // alert(response);
                }
            });
        }
        else
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


// $('.chips').chips();
// $('.card-favorite').text("favorite_border");
// //Tabs initialization
// var tab_options = {onShow: new_tab_show_callback}
// var init_tabs = M.Tabs.init($('.tabs'), tab_options);
// var instance_tabs = M.Tabs.getInstance($('.tabs'));



// $image_crop = $('#image_demo').croppie({
//     enableExif: true,
//     viewport: {
//         width: 200,
//         height: 200,
//         type: 'square'
//     },
//     boundary: {
//         width: 300,
//         height: 300
//     }
// });
//
// $('#upload_image').on('change', function(){
//     var reader = new FileReader();
//     reader.onload = function (event) {
//         $image_crop.croppie('bind', {
//             url: event.target.result
//         });
//     }
//     reader.readAsDataURL(this.files[0]);
// });
//
// $('.crop_image').click(function(event){
//     $image_crop.croppie('result', {
//         type: 'canvas',
//         size: 'viewport'
//     }).then(function(response){
//         $.ajax({
//             url:"../assets/upload/upload.php",
//             type: "POST",
//             data:{"image": response},
//             success:function(data)
//             {
//                 $('#uploaded_image').html(data);
//             }
//         });
//     })
// });

// function createSnapp() {
//     navigator.mediaDevices.getUserMedia({video:true})
//         .then(function (stream) {
//             let video = document.getElementById("showcamera")
//             video.autoplay = true
//             video.srcObject = stream
//         })
//         .catch(function (error) {
//             console.log("Something was wrong: " + error)
//         })
// }