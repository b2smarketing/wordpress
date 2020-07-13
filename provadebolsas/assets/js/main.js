// APC RESPONDE  ----------------------------------------
$("#enviar").click(function () {
    $(".js-loading").fadeIn().css("display", "flex");
    //alert('envia'); return false;
    var user_nome = $('input[name=nome]').val();
    var user_sobrenome = $('input[name=sobrenome]').val();
    var user_email = $('input[name=email]').val();
    var user_cpf = $('input[name=cpf]').val();
    var user_celular = $('input[name=celular]').val();
    var user_data = $('#data').val();
    var user_curso = $('#curso').val();

    var proceed = true;

    if (user_nome == "") {
        $('input[name=nome]').css('border', '2px solid red');
        proceed = false
    }

    if (user_sobrenome == "") {
        $('input[name=sobrenome]').css('border', '2px solid red');
        proceed = false
    }

    if (user_email == "") {
        $('input[name=email]').css('border', '2px solid red');
        proceed = false
    }

    if (user_cpf == "") {
        $('input[name=cpf]').css('border', '2px solid red');
        proceed = false
    }

    if (user_celular == "") {
        $('input[name=celular]').css('border', '2px solid red');
        proceed = false
    }

    if (user_data == "") {
        $('#data').css('border', '2px solid red');
        proceed = false
    }

    if (user_curso == "") {
        $('#curso').css('border', '2px solid red');
        proceed = false
    }


    if (!proceed) {
        alert('Preencha os campos em destaque.');
        proceed = false;
        return false;
    }
    if (proceed) {
        $("#enviar").attr("disabled", true);

        post_data = {
            'userNome': user_nome,
            'userSobrenome': user_sobrenome,
            'userEmail': user_email,
            'userCpf': user_cpf,
            'userCelular': user_celular,
            'userData': user_data,
            'userCurso': user_curso
        };
        $.post('enviar-formulario.php',
            post_data,
            function (data) {
                $(".js-loading").fadeOut();
                $("#result").html(data).fadeIn(1500);
                $('.input-cont-textarea').val('')
                $('#enviar').attr("disabled", false);
                $("html, body").animate({ scrollTop: $(document).height() }, 1000);
            });
    }
});

$(".input-cont-textarea").keyup(function () {
    $(".input-cont-textarea").css('border', 'none');
    $("#result").fadeOut(1500)
    $("#error").fadeOut(1500)
});

$(document).ready(function () {
    $("#cpf").mask("999.999.999-99");
    $("#celular").mask("(99) 99999-9999");
});

$(document ).ready(function() {
    if ($(".js-loading").length > 0) {
        setTimeout(function() {
            $(".js-loading").fadeOut();
        }, 1000);
    }
});