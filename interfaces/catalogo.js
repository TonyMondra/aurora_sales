$(document).ready(function () {


    //construye la tabla

    var table = $('#tablaProductos').DataTable({

        order: [[0, 'desc']],
        "destroy": false,
        "pageLength": 10,
        "ajax": {
            "url": "../backend/productos/consultaProd.php",
            "dataSrc": ""
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
        "columns": [
            {
                "data": "imgn",
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<img class='producto' src='" + oData.imgn + "'>");
                }
            },
            { "data": "id_producto" },
            { "data": "nombreProd" },
            { "data": "tipoProd" },
            { "data": "talla" },
            { "data": "marca" },
            { "data": "color" },
            { "data": "material" },
            { "data": "genero" },
            { "data": "edad" },
            { "data": "costoU" },
            { "data": "inventario" },
            { 'defaultContent': "<button class='edit btn btn-primary' style='width:100%' data-bs-toggle='modal' data-bs-target='#exampleModal'>editar</button> <button class='btn btn-danger del' style='width:100%'> borrar </button>" },

        ],

    });



    //valida si los valores de los inputs son correctos

    var validarInputs = function (data) {

        let ids = [".groupName", ".groupType", ".groupSize", ".groupBrand", ".groupColor", ".groupMaterial", ".groupSex", ".groupAge", ".groupCost", ".groupStock"];

        let contador = 0;

        for (var value in data) {

            if (data[value] == "incorrecto") {

                $(ids[contador]).removeClass('is-valid');
                $(ids[contador]).addClass('is-invalid');
            }
            else {
                $(ids[contador]).removeClass('is-invalid');
                $(ids[contador]).addClass('is-valid');
            }

            contador++;
        }

        if (data['picture'] == "noImagen") {
            $('.pictureProd').removeClass('is-invalid');
            $('.pictureProd').removeClass('is-valid');
            $('.pictureProd').addClass('is-invalid');
            $(".feedbackImg").html('cargar imagen');

        }

        else if (data['picture'] == "sizeLimit") {
            $('.pictureProd').removeClass('is-invalid');
            $('.pictureProd').removeClass('is-valid');
            $('.pictureProd').addClass('is-invalid');
            $(".feedbackImg").html('peso max 1mb');
        }

        else if (data['picture'] == "invalidExtension") {
            $('.pictureProd').removeClass('is-invalid');
            $('.pictureProd').removeClass('is-valid');
            $('.pictureProd').addClass('is-invalid');
            $(".feedbackImg").html('formatos aceptados (jpg,png,gif)');
        }

        else {
            $('.pictureProd').removeClass('is-valid');
            $('.pictureProd').removeClass('is-invalid');
            $('.pictureProd').addClass('is-valid');
        }


    }


    var quitarValidacion = function () {

        let tags = [".groupId", ".groupName", ".groupType", ".groupSize", ".groupBrand", ".groupColor", ".groupMaterial", ".groupSex", ".groupAge", ".groupCost", ".groupStock", ".pictureProd"];
        let longitud = tags.length;

        for (let i = 0; i < longitud; i++) {
            $(tags[i]).removeClass('is-invalid');
            $(tags[i]).removeClass('is-valid');
        }
    }



    // llena el formulario de editar producto con la fila seleccionada al presionar edit

    var llenarForma = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {

            var data = table.row($(this).parents("tr")).data();
            var editImg = $("#oldImg").attr('src', data.imgn);
            var editIdProducto = $("#editarIdProd").val(data.id_producto);
            var editNombreProd = $("#editarNombreProd").val(data.nombreProd);
            var editTipoProd = $("#editarTipoProd").val(data.tipoProd);
            var editTalla = $("#editarTalla").val(data.talla);
            var editMarca = $("#editarMarca").val(data.marca);
            var editColor = $("#editarColor").val(data.color);
            var editMaterial = $("#editarMaterial").val(data.material);
            var editGenero = $("#editarGenero").val(data.genero);
            var editEdad = $("#editarEdad").val(data.edad);
            var editCosto = $("#editarCostoU").val(data.costoU);
            var editInventario = $("#editarInventario").val(data.inventario);

        });
    };


    var editedRow = '';
    var selectedRow = '';
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


    // agrega producto - insert

    $('#add-product-form').submit(function (e) {
        e.preventDefault();

        //Obtenemos datos.
        var data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: '../backend/productos/addProd.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(function (data) {
                llenarForma("#tablaProductos", table);
                validarInputs(data);

                if (!data.nombreProd) {

                    table.ajax.reload(function () {
                        // agrega una clase al ultimo producto agregado para sobresaltarlo
                        $(table.row(':first').node()).addClass('last-added-row');

                        //remueve la clase despues de 5 segundos
                        setTimeout(function () {
                            $(table.row(':first').node()).removeClass('last-added-row');
                        }, 5000);
                    });

                    $("#add-product-form").trigger('reset');
                    quitarValidacion();
                    $('#exampleModal2').modal('hide');
                   // $('#productoAgregado').modal('show');

                }
                if (data.registro == 'existente') {
                    confirm("producto existente, revisa los datos");
                }

            })
            .fail(function (data) {
                console.log(data);

            })
            .always(function () {

            });
    });



    //editar producto - update
    $('#edit-product-form').submit(function (a) {
        a.preventDefault();

        //Obtenemos datos.
        var data = $(this).serializeArray();
        // data.push({name: 'opc', value: opcion});

        $.ajax({
            type: 'post',
            url: '../backend/productos/editProd.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(function (data) {
                llenarForma("#tablaProductos", table);
                validarInputs(data);

                if (!data.nombreProd) {

                    table.ajax.reload(function () {

                        table.rows(selectedRow).nodes().to$().removeClass('selectedRow');

                        // agrega clase al producto despues de haberlo editado para destacarlo
                        table.rows(editedRow).nodes().to$().addClass('editedRow');

                        //elimina la clase
                        setTimeout(function () {
                            table.rows(editedRow).nodes().to$().removeClass('editedRow');
                        }, 5000);
                    });

                    $("#edit-product-form").trigger('reset');
                    quitarValidacion();
                    $('#exampleModal').modal('hide');
                    //$('#productoEditado').modal('show');


                }
                if (data.registro == 'existente') {
                    confirm("producto existente, revisa los datos");
                }

            })
            .fail(function (data) {

            })
            .always(function () {

            });
    });


    //eliminar
    var eliminarProd = function (tbody, table) {
        $(tbody).on("click", "button.del", function () {

            deletedRow = table.row($(this).parents("tr")); // asigna el valor de la fila seleccionada a la variable deletedRow
            table.rows(deletedRow).nodes().to$().addClass('deletedRow');
            var data = table.row($(this).parents("tr")).data();
            var idProducto = data.id_producto;

            $('#productoEditado').modal('show');

            $("#delProdbyId").click(function () {
                
                $.ajax({
                    url: "../backend/productos/borrarProd.php",
                    type: "POST",
                    datatype: "json",
                    data: { idProducto: idProducto },
                    success: function (data) {
                        table.ajax.reload();            
                    }
                });

            });
    
        });
    };


    $("button.closeAddForm").click(function () {
        $("#add-product-form").trigger('reset');
        $("#edit-product-form").trigger('reset');
        quitarValidacion();
        table.rows(selectedRow).nodes().to$().removeClass('selectedRow');
    });

    

    $("button.btnCloseAfterDel").click(function () {
        table.rows(deletedRow).nodes().to$().removeClass('deletedRow');
    });


    // recarga la tabla
    table.ajax.reload();
    //llama a la funcion al iniciar la pagina
    llenarForma("#tablaProductos", table);
    eliminarProd("#tablaProductos", table);
    highligthEditedRow("#tablaProductos", table);
    highligthSelectedRow("#tablaProductos", table);
    highligthDeletedRow("#tablaProductos", table);
})