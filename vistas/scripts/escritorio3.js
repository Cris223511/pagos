var tabla;

function init() {
    $('#mEscritorio').addClass("treeview active");
    resetear();
}

function listar() {
    $("#fecha_inicio").val("");
    $("#fecha_fin").val("");

    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();


    $("#buscarTodos").prop("disabled", true);
    $("#buscarPorFecha").prop("disabled", true);
    $("#resetear").prop("disabled", true);

    $.get("../ajax/escritorio.php?op=listar", { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin }, function (num) {
        // console.log(num);
        num = JSON.parse(num);
        console.log(num);

        $("#importe").text('S/. ' + num.total_importe);
        $("#comision").text('S/. ' + num.total_comision);
        $("#ticket").text(num.total_tickets);

        // console.log(num.total_importe);
        // console.log(num.total_comision);
        // console.log(num.total_tickets);

        $("#buscarTodos").prop("disabled", false);
        $("#buscarPorFecha").prop("disabled", false);
        $("#resetear").prop("disabled", false);
    });

}

function buscarPorFecha() {
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();

    if (fecha_inicio == "" || fecha_fin == "") {
        alert("Los campos de fecha inicial y fecha final son obligatorios.");
        return;
    } else if (fecha_inicio > fecha_fin) {
        alert("La fecha inicial no puede ser mayor que la fecha final.");
        return;
    }

    console.log(fecha_inicio);
    console.log(fecha_fin);

    $("#buscarTodos").prop("disabled", true);
    $("#buscarPorFecha").prop("disabled", true);
    $("#resetear").prop("disabled", true);

    $.get("../ajax/escritorio.php?op=listar", { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin }, function (num) {
        console.log(num);
        num = JSON.parse(num);
        console.log(num);

        // console.log(num.total_importe);
        // console.log(num.total_comision);
        // console.log(num.total_tickets);

        $("#importe").text('S/. ' + num.total_importe);
        $("#comision").text('S/. ' + num.total_comision);
        $("#ticket").text(num.total_tickets);

        $("#buscarTodos").prop("disabled", false);
        $("#buscarPorFecha").prop("disabled", false);
        $("#resetear").prop("disabled", false);
    });

}

function buscarTodos() {
    listar();
    $("#fecha_inicio").val("");
    $("#fecha_fin").val("");
}

function resetear() {
    $("#importe").text('S/. 0.00');
    $("#comision").text('S/. 0.00');
    $("#ticket").text('0');

    $("#fecha_inicio").val("");
    $("#fecha_fin").val("");
}

init();