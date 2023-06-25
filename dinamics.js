$(document).ready(function () {


    console.log("running");

    var validarInputs = function (data) {

        if (data.credenciales == "passError") {
            $('.login-pass').removeClass('is-invalid');
            $('.login-pass').removeClass('is-valid');
            $('.login-pass').addClass('is-invalid');

            $('.login-user').removeClass('is-invalid');
            $('.login-user').removeClass('is-valid');
            $('.login-user').addClass('is-valid');

        }


        else if (data.credenciales == "inexistente") {
            $('.login-pass').removeClass('is-invalid');
            $('.login-pass').removeClass('is-valid');

            $('.login-user').removeClass('is-invalid');
            $('.login-user').removeClass('is-valid');
            $('.login-user').addClass('is-invalid');

        }

    }


    $('#form-login').submit(function (e) {
        e.preventDefault();

        var data = $(this).serializeArray();
        console.log(data);

        $.ajax({
            type: 'POST',
            url: 'backend/login/acceder.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })

            .done(function (data) {
                console.log(data);
                if (data.credenciales == "ok") {
                    window.location.replace("interfaces/cotizar.php");
                }

                else {
                    console.log(data.credenciales);
                    validarInputs(data);
                }

            })
    });




    $('#form-registro').submit(function (e) {
        e.preventDefault();

        let data = $(this).serializeArray();
        console.log(data);

        $.ajax({
            type: 'POST',
            url: 'backend/login/registro.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })

            .done(function (data) {
                console.log(data);
                if (data.response == "ok") {
                    window.location.replace("interfaces/cotizar.php");
                }

            })
    });


})