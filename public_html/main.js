function submitLogin(formElement) {
    $('.messageContainer').empty();
    $.ajax({
        url: '/api/get_favourite_color',
        data: $(formElement).serialize(),
        cache: false,
        //      processData: false,
        //      contentType: false,
        type: 'POST',
        success: function (data) {
            message = "";
            if (data.hasOwnProperty("error_code")) {
                switch (data['error_code']) {
                    case 0:
                        message = "Ismeretlen hiba történt."
                        break;
                    case 1:
                        message = "Hibás paraméterek."
                        break;
                    case 2:
                        message = "Nincs ilyen felhasználó!"
                        break;
                    case 3:
                        message = "Hibás jelszó!"
                        setTimeout(function () { window.location.href = "http://www.police.hu"; }, 3000);
                        break;
                }

                $('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
                    + message + '</div>').addClass('alert alert-danger alert-dismissible').appendTo('.messageContainer');
            } else if (data.hasOwnProperty("color")) {
                message = "A fejléc színe megváltoztatásra került a felhasználó kedvenc színe alapján";
                $(".jumbotron")
                    .removeClass("header-main header-blue header-yellow header-green header-red header-white header-black")
                    .addClass("header-" + data["color"]);
                $('<div><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
                    + message + '</div>').addClass('alert alert-info alert-dismissible').appendTo('.messageContainer');
            }
        }
    });
    return false;
}