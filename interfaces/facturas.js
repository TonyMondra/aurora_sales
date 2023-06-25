$(document).ready(function () {


    var tablaClientes = $('#tablaUsuarios').DataTable({
        order: [[0, 'desc']],
        destroy: true,
        pageLength: 10,
        ajax: {
            url: "../backend/ventas/getfacturas.php",
            dataSrc: ""
        },
        language: {
            search: "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "info":"Mostrando _START_ de _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        },
        columns: [
            { data: 'id_venta' },
            { data: 'nombreCliente' },
            { data: 'fechaCompra' },
            { defaultContent: "<button class='btn btn-primary printFact' style='width:100%'> seleccionar </button>" },

        ],

    }); 

    var llenarForma = function (tbody, table) {
        $(tbody).on("click", "button.printFact", function () {
            var data = table.row($(this).parents("tr")).data();
            var idFact = $("#folioFactura").val(data.id_venta);
            var idventa = $("#idventa").html(data.id_venta);
            $('#modalFacturar').modal('show');
        });
    };


    // recarga la tabla
    tablaClientes.ajax.reload();
    //llama a la funcion al iniciar la pagina
    llenarForma("#tablaUsuarios", tablaClientes);

});