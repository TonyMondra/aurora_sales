$(document).ready(function () {


    //############################################################################ DATA TABLE ############################################################################

    let table = $('#tablaProductos').DataTable({

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
            {
                "data": "img_prod",
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<img class='producto' src='" + oData.img_prod + "'>");
                }
            },
            { "data": "id_producto" },
            { "data": "nombre_prod" },
            { "data": "tipo_prod" },
            { "data": "talla_prod" },
            { "data": "marca_prod" },
            { "data": "color_prod" },
            { "data": "material_prod" },
            { "data": "genero_prod" },
            { "data": "edad_prod" },
            { "data": "costo_prod" },
            { "data": "inventario_prod" },
            { 'defaultContent': "<button class='edit btn btn-primary' style='width:100%' data-bs-toggle='modal' data-bs-target='#modalEditProd'>editar</button> <button class='btn btn-danger del' style='width:100%'> borrar </button>" },

        ],

    });





    //############################################################################ INSERTAR PROD ############################################################################
    $('#add-product-form').submit(function (e) {
        e.preventDefault();

        let data = $(this).serializeArray();

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
                console.log(data);
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
                    $('#modalAddProd').modal('hide');

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



    //############################################################################ EDITAR PROD ############################################################################
    $('#edit-product-form').submit(function (a) {
        a.preventDefault();

        //Obtenemos datos.
        let data = $(this).serializeArray();

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

                console.log(data);

                //si el registro existe
                if (data.registro) {
                    confirm("producto existente, revisa los datos");
                }

                //si el registro no existe
                else {

                    //si hay errores en los inputs
                    if (data.errs) {
                        validarInputs(data);
                    }

                    //si todos los datos ingresados son correctos
                    else {
                        table.ajax.reload(function () {

                            //elimina la clase selectedRow
                            table.rows(selectedRow).nodes().to$().removeClass('selectedRow');

                            // agrega la clase editedRow al producto despues de haberlo editado para destacarlo
                            table.rows(editedRow).nodes().to$().addClass('editedRow');

                            //elimina la clase editedRow
                            setTimeout(function () {
                                table.rows(editedRow).nodes().to$().removeClass('editedRow');
                            }, 5000);
                        });

                        $("#edit-product-form").trigger('reset');
                        quitarValidacion();
                        $('#modalEditProd').modal('hide');

                    }
                }
            })
            .fail(function (data) {

            })
            .always(function () {

            });
    });


    //############################################################################ ELIMINAR PROD ############################################################################
    let eliminarProd = function (tbody, table) {
        $(tbody).on("click", "button.del", function () {

            deletedRow = table.row($(this).parents("tr")); // asigna el valor de la fila seleccionada a la variable deletedRow
            table.rows(deletedRow).nodes().to$().addClass('deletedRow');
            let data = table.row($(this).parents("tr")).data();
            let idProducto = data.id_producto;

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


    //valida si los valores de los inputs son correctos
    let validarInputs = function (data) {

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


    let quitarValidacion = function () {

        let tags = [
            ".groupId",
            ".groupName",
            ".groupType",
            ".groupSize",
            ".groupBrand",
            ".groupColor",
            ".groupMaterial",
            ".groupSex",
            ".groupAge",
            ".groupCost",
            ".groupStock",
            ".pictureProd"];

        let longitud = tags.length;

        for (let i = 0; i < longitud; i++) {
            $(tags[i]).removeClass('is-invalid');
            $(tags[i]).removeClass('is-valid');
        }
    }



    // llena el formulario de editar producto con la fila seleccionada al presionar edit
    let llenarForma = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {

            var data = table.row($(this).parents("tr")).data();
            var editImg = $("#oldImg").attr('src', data.img_prod);
            var editIdProducto = $("#editarIdProd").val(data.id_producto);
            var editNombreProd = $("#editarNombreProd").val(data.nombre_prod);
            var editTipoProd = $("#editarTipoProd").val(data.tipo_prod);
            var editTalla = $("#editarTalla").val(data.talla_prod);
            var editMarca = $("#editarMarca").val(data.marca_prod);
            var editColor = $("#editarColor").val(data.color_prod);
            var editMaterial = $("#editarMaterial").val(data.material_prod);
            var editGenero = $("#editarGenero").val(data.genero_prod);
            var editEdad = $("#editarEdad").val(data.edad_prod);
            var editCosto = $("#editarCostoU").val(data.costo_prod);
            var editInventario = $("#editarInventario").val(data.inventario_prod);

        });
    };


    var editedRow = '';
    var selectedRow = '';
    var deletedRow = '';

    //resalta fila editada
    let highligthEditedRow = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {

            editedRow = table.row($(this).parents("tr"));
        });
    };

    //resalta fila seleccionada
    let highligthSelectedRow = function (tbody, table) {
        $(tbody).on("click", "button.edit", function () {

            selectedRow = table.row($(this).parents("tr"));
            table.rows(selectedRow).nodes().to$().addClass('selectedRow');

        });
    };


    //resetea los formularios, quita la validacion y resaltado al presionar el botton cerrar de cualquier modal
    $("button.closeAddForm").click(function () {
        $("#add-product-form").trigger('reset');
        $("#edit-product-form").trigger('reset');
        quitarValidacion();
        table.rows(selectedRow).nodes().to$().removeClass('selectedRow');
    });


    //elimina las clases de los elementos que son eliminados
    $("button.btnCloseAfterDel").click(function () {
        table.rows(deletedRow).nodes().to$().removeClass('deletedRow');
    });


    // recarga la tabla
    table.ajax.reload();

    //llama a estas funciones al iniciar la pagina
    llenarForma("#tablaProductos", table);
    eliminarProd("#tablaProductos", table);
    highligthEditedRow("#tablaProductos", table);
    highligthSelectedRow("#tablaProductos", table);

})