$("#frmAcceso").on('submit', function (e) {
    e.preventDefault();
    logina = $("#logina").val();
    clavea = $("#clavea").val();

    console.log("hace la validación =)");

    $.post("../ajax/usuario.php?op=verificar", { "logina": logina, "clavea": clavea },
        function (data) {
            console.log(data);

            if (data == 0) {
                bootbox.alert("Su usuario está desactivado, comuníquese con el administrador.");
            } else if (data == 1) {
                bootbox.alert("El usuario no se encuentra disponible, comuníquese con el administrador.");
            } else if (data == 2) {
                bootbox.alert("El local en donde usted está trabajando está desactivado, comuníquese con el administrador.");
            } else if (data == 3) {
                bootbox.alert("El local del usuario no existe, comuníquese con el administrador.");
            } else if (data != "null") {
                $(location).attr("href", "escritorio.php");
            } else {
                bootbox.alert("Usuario y/o contraseña incorrectos.");
            }
        });
})

function mostrarClave() {
    console.log("di click =)");
    var claveInput = $('#clavea');
    var ojitoIcon = $('#mostrarClave i');

    if (claveInput.attr('type') === 'password') {
        claveInput.attr('type', 'text');
        ojitoIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        claveInput.attr('type', 'password');
        ojitoIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
}

function mostrar() {
    $.post("../ajax/verPortada.php?op=mostrar", function (datas, status) {
        data = JSON.parse(datas);
        if (data != null) {
            console.log(data.imagen);
            $("#imagenmuestra").attr("src", "../files/portadas/" + data.imagen);
            $("body").css("background-image", "url('../files/portadas/" + data.imagen + "')");
        } else {
            $("#imagenmuestra").attr("src", "../files/portadas/default.jpg");
            $("body").css("background-image", "url('../files/portadas/default.jpg')");
        }
    });
}

mostrar();