
$(document).ready(function () {



    var tagsAdd = [".val-id-add", ".val-name-add", ".val-aP-add", ".val-aM-add", ".val-tel-add", ".val-dir-add"];
    var tagsEdit = [".val-id-edit", ".val-name-edit", ".val-aP-edit", ".val-aM-edit", ".val-tel-edit", ".val-dir-edit"];

    // construye la tabla

    var table = $('#tablaUsuarios').DataTable({
        order: [[0, 'desc']],
        "destroy": false,
        "pageLength": 10,
        "ajax": {
            "url": '../backend/clientes/consultaCliente.php',
            "dataSrc": ""
        },
        language: {
            search: "Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "info": "Mostrando _START_ de _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        },
        "columns": [
            { "data": "id_cliente" },
            { "data": "nombre" },
            { "data": "aPaterno" },
            { "data": "aMaterno" },
            { "data": "telefono" },
            { "data": "direccion" },
            { 'defaultContent': "<button class='edit btn btn-primary' style='width:100%'  data-bs-toggle='modal' data-bs-target='#modalEdit' >editar</button>  <button class='btn btn-danger del' style='width:100%'> borrar </button>" }

        ],

    });



    // llena el formulario editar-cliente con los datos de la fila seleccionada
    var llenarForma = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {
            var data = table.row($(this).parents("tr")).data();
            var iduser = $("#IDIdEdit").val(data.id_cliente);
            var nameuser = $("#IDnombreEdit").val(data.nombre);
            var middlename = $("#IDaPaternoEdit").val(data.aPaterno);
            var lastaname = $("#IDaMaternoEdit").val(data.aMaterno);
            var phone = $("#IDtelEdit").val(data.telefono);
            var address = $("#IDdirEdit").val(data.direccion);

        });
    };


    var selectedRow = '';
    var editedRow = '';
    var deletedRow = '';

    //funcion para resaltar fila editada
    var highligthEditedRow = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {

            editedRow = table.row($(this).parents("tr"));
        });
    };

    //funcion para resaltar fila seleccionada
    var highligthSelectedRow = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {

            selectedRow = table.row($(this).parents("tr"));
            table.rows(selectedRow).nodes().to$().addClass('selectedRow');

        });
    };




    // añade clases de valido/invalid a los input del form para darles estilos
    var validarInputs = function (data, ids) {

        let contador = 0;

        for (var value in data.datos) {

            if (data.datos[value] == "incorrecto") {
                $(ids[contador]).removeClass('is-invalid');
                $(ids[contador]).removeClass('is-valid');
                $(ids[contador]).addClass('is-invalid');
            }
            else {
                $(ids[contador]).removeClass('is-valid');
                $(ids[contador]).removeClass('is-invalid');
                $(ids[contador]).addClass('is-valid');
            }

            contador++;
        }
    }


    //remover las clases de los input validados
    var quitarValidacion = function (tags) {

        let longitud = tags.length;

        for (let i = 0; i < longitud; i++) {
            $(tags[i]).removeClass('is-invalid');
            $(tags[i]).removeClass('is-valid');
        }
    }


    // insertar cliente
    $('#addClienteForm').submit(function (a) {
        a.preventDefault();

        var data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: '../backend/clientes/regCliente.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(function (data) {
                llenarForma("#tablaUsuarios", table);


                if (data.registro == 'existente') {
                    confirm("Cliente existente, revisa los datos");
                    quitarValidacion(tagsAdd);
                }
                else {
                    // si hay errores en los datos
                    if (data.errs) {
                        validarInputs(data, tagsAdd); // validar inputs
                    }

                    // si no hay errores y el cliente no existe
                    else {
                        table.ajax.reload(function () {
                            // agrega una clase al ultimo producto agregado para sobresaltarlo
                            $(table.row(':first').node()).addClass('last-added-row');

                            //remueve la clase despues de 5 segundos
                            setTimeout(function () {
                                $(table.row(':first').node()).removeClass('last-added-row');
                            }, 5000);
                        });
                        $("#addClienteForm").trigger('reset');
                        quitarValidacion(tagsAdd);
                        $('#modalAdd').modal('hide');
                    }
                }

            })
            .fail(function () {
            })
            .always(function () {
            });
    });




    // actualiza los datos de un cliente
    $('#editClienteForm').submit(function (e) {
        e.preventDefault();

        var data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: '../backend/clientes/editCliente.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,

        })
            .done(function (data) {

                llenarForma("#tablaUsuarios", table);

                //si el cliente existe
                if (data.registro) {
                    confirm("Cliente existente, revisa los datos");
                    quitarValidacion(tagsEdit);
                }

                // si el cliente no existe
                else {

                    // si hay errores en los datos
                    if (data.errs) {
                        validarInputs(data, tagsEdit); // validar inputs
                    }

                    // si no hay errores y el cliente no existe
                    else {
                        table.ajax.reload(function () {

                            //table.rows(selectedRow).nodes().to$().removeClass('selectedRow');

                            // agrega clase al producto despues de haberlo editado para destacarlo
                            table.rows(editedRow).nodes().to$().addClass('editedRow');

                            //elimina la clase
                            setTimeout(function () {
                                table.rows(editedRow).nodes().to$().removeClass('editedRow');
                            }, 5000);
                        });

                        $("#editClienteForm").trigger('reset');
                        quitarValidacion(tagsEdit);
                        $('#modalEdit').modal('hide');
                    }
                }


            })
            .fail(function () {

            })
            .always(function () {

            });
    });



    //eliminar cliente
    var eliminarCliente = function (tbody, table) {
        $(tbody).on("click", "button.del", function () {

            deletedRow = table.row($(this).parents("tr"));
            table.rows(deletedRow).nodes().to$().addClass('deletedRow');
            var data = table.row($(this).parents("tr")).data();
            var idCliente = data.id_cliente;

            $('#modalConfirm').modal('show');
            $('#confirmTitle').html('Eliminar Cliente');
            $('#confirmMsj').html('Esta operacion es irreversible, desea continuar?');
            $('#btnConfirmar').show();

            $("#btnConfirmar").click(function () {

                $.ajax({
                    url: "../backend/clientes/eliminarCliente.php",
                    type: "POST",
                    datatype: "json",
                    data: { idCliente: idCliente },
                    success: function () {
                        table.ajax.reload();
                    }
                });

                $('#modalConfirm').modal('hide');
            }
            );
        });
    };


    // resetear formularios
    $("button.close-form").click(function () {
        $("#editClienteForm").trigger('reset');
        $("#addClienteForm").trigger('reset');
        quitarValidacion(tagsEdit);
        quitarValidacion(tagsAdd);

        table.rows(selectedRow).nodes().to$().removeClass('selectedRow');
    });


    $("button.btnCloseAfterDel").click(function () {
        table.rows(deletedRow).nodes().to$().removeClass('deletedRow');
    });

    const labelElement = document.querySelector('#tablaUsuarios_filter>label');
    labelElement.classList.add('sticky-bottom');



    // recarga la tabla
    table.ajax.reload();
    //llama a la funcion al iniciar la pagina
    llenarForma("#tablaUsuarios", table);
    // llama a la funcion para eliminar clientes
    eliminarCliente("#tablaUsuarios", table);
    highligthEditedRow("#tablaUsuarios", table);
    highligthSelectedRow("#tablaUsuarios", table);
    highligthDeletedRow("#tablaUsuarios", table);

})
