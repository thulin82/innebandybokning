var main = function () {

    $('.input-span1').keyup(function () {
        var content = $(this).val();

        if (content > 9) {
            $(this).addClass('disabled');
        } else if (isNaN(content)) {
            $(this).addClass('disabled');
        } else {
            $(this).removeClass('disabled');
        }
    });
}

$(document).ready(main);