var base64data;

$(function()
{
    const input = document.querySelector('input');

    input.style.opacity = 0;
    input.addEventListener('change', updateImageDisplay);

    $("#Update").click(function () {
        const post_data = {
            'profile_image': base64data
        };
        $.post(`${base_url}/User/profile`, post_data).done(function () {
            document.getElementById('Update').classList.add("hide");
            window.location.reload(false);
        });
    });


    function updateImageDisplay() {
        const curFiles = input.files;
        if (curFiles.length === 0) {

        } else {
            const list = document.createElement('ol');

            for (const file of curFiles) {
                var reader = new FileReader();
                const image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                reader.readAsDataURL(file);
                reader.onloadend = function () {
                    base64data= reader.result;
                    document.getElementById("thumbnail-view").src = base64data;
                    console.log(base64data);
                }
                document.getElementById('Update').classList.remove("hide");
            }
        }
    }
});



