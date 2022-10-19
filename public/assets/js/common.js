$(function () {

    $(".sidenav").sidenav();
    $('.menu-trigger').dropdown();

    if (window.location.href.indexOf("Adventure") > -1) {
        $('.modal-trigger').removeClass('hide');
    }

});

$(document).ready(function () {

    $(function () {
        var path = window.location.href;
        $('.nav-wrapper ul li').each(function () {
            if ($("a", this).attr('href') === path) {
                $(this).addClass('active').siblings().removeClass('active');
            }
        });
    });

});

document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});

// Or with jQuery

$(document).ready(function () {
    $('.modal').modal();
});