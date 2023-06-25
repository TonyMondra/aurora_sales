$(document).ready(function () {


    //funcion que construye la tabla

    var table = $('#tablaProductos').DataTable({

        "destroy": true,
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
            { 'defaultContent': "<button class='add btn btn-primary' style='width:100%'> Agregar </button>" },

        ],

    });


    // inserta el producto en el carrito al hacer clic en el boton agregar
    var insertarProd = function (tbody, table) {

        $(tbody).on("click", "button.add", function () {
          

            let data = table.row($(this).parents("tr")).data();

            //inserta una nueva fila(producto) al carrito de compra
            var carritoCompras = document.getElementById("tableShoppingKart");
            var row = carritoCompras.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var cell8 = row.insertCell(7);
            var cell9 = row.insertCell(8);
            var cell10 = row.insertCell(9);
            var cell11 = row.insertCell(10);
            var cell12 = row.insertCell(11);
            cell1.innerHTML = "<img class='carritoCompras' src='" + data.imgn + "'>";
            cell2.innerHTML = "<span class='nombreProd' >" + data.nombreProd + "</span>";
            cell3.innerHTML = "<span class='tallaProd'>" + data.talla + "</span>";
            cell4.innerHTML = "<span class='subtotalProd'>" + data.costoU + "</span>";
            cell5.innerHTML = "<input class='cantidadProd' type='number' name='cantidad' min='1' max='10' value= '1' oninput='actualizarMontos()'  >";
            cell6.innerHTML = "<span class='tipoProd' hidden>" + data.tipoProd + "</span>";
            cell7.innerHTML = "<span class='colorProd' hidden>" + data.color + "</span>";
            cell8.innerHTML = "<span class='materialProd' hidden>" + data.material + "</span>";
            cell9.innerHTML = "<span class='marcaProd' hidden>" + data.marca + "</span>";
            cell10.innerHTML = "<span class='generoProd' hidden>" + data.genero + "</span>";
            cell11.innerHTML = "<button class='btnDelProd btn' onclick='deleteRow(this)'> <img class='icoDel' src='../media/delete.ico' > </button> "; // btn del prod
            cell12.innerHTML = "<span class='costoUnitario' hidden>" + data.costoU + "</span>";

            $('#liveToast').toast('show')
            $('#toastContent').html(data.nombreProd);
            calcularTotal();
            mostrarCarro();
            contadorProductos();
        });
    };



    // calcula el total de la compra
    var calcularTotal = function () {
        var total = 0;
        $("table#tableShoppingKart tr").each(function () {

            var actualData = $(this).find('span.subtotalProd');
            if (actualData.length > 0) {
                actualData.each(function () {
                    var costo = $(this).text();
                    var precost = parseFloat(costo);
                    total = total + precost;
                });
            }
        });

        $('#montoTotal').text(total);
    }




    // calcula la cantidad de articulos comprados
    var numItems = 0;
    var contadorProductos = function () {
        let cantProd = 0;
        $("table#tableShoppingKart tr").each(function () {

            let fila = $(this).find('input.cantidadProd');
            fila.each(function () {
                let contador = $(this).val();
                cantProd = cantProd + parseInt(contador);
            });
        });
        $('#prodCounter').text(cantProd);
        numItems = cantProd;
    }






    var items = [];
    var total = 0;

    // envia el detalle de los articulos comprados y el total
    $("#btnCheckOut").click(function () {

        var contador = 0;
        var totalCompra = $('#montoTotal').text();

        $("table#tableShoppingKart tr").each(function () {

            var actualData = $(this).find('td');

            if (actualData.length > 0) {

                var nombre = $(this).find('span.nombreProd').text();
                var talla = $(this).find('span.tallaProd').text();
                var subtotal = $(this).find('span.subtotalProd').text();
                var cantidad = $(this).find('input.cantidadProd').val();
                var tipo = $(this).find('span.tipoProd').text();
                var color = $(this).find('span.colorProd').text();
                var material = $(this).find('span.materialProd').text();
                var marca = $(this).find('span.marcaProd').text();
                var genero = $(this).find('span.generoProd').text();

                const art = { cantidad: cantidad, tipo: tipo, nombre: nombre, talla: talla, color: color, marca: marca, genero: genero, subtotal: subtotal };

                items[contador] = art;
            }

            contador++;
        });

        items.shift();
        total = totalCompra;
        $('#finalizarCompraModal').modal('show');
    });



    //muestra la tabla del carrito solo si hay productos agregados
    var mostrarCarro = function () {

        $("table#tableShoppingKart").each(function () {
            var numArticulos = $(this).find('tr');

            if (numArticulos.length <= 1) {
                $('#carritoBox').hide();
                $('#emptyKart').show();
            }

            else if (numArticulos.length > 1) {
                $('#carritoBox').show();
                $('#emptyKart').hide();
            }
        });

    }



    //buscar cliente
    var tablaClientes = $('#listaClientes').DataTable({

        destroy: true,
        pageLength: 4,
        info:     false,
        dom: 'rft',
        ajax: {
            url: '../backend/clientes/consultaCliente.php',
            dataSrc: ""
        },
        language: {
            search: "Buscar cliente:"
        },
        columnDefs: [
            { targets: [0, 4, 5], visible: false }
        ],
        columns: [
            { data: 'id_cliente' },
            { data: 'nombre' },
            { data: 'aPaterno' },
            { data: 'aMaterno' },
            { data: 'telefono' },
            { data: 'direccion' },
            { defaultContent: "<button class='btn btn-primary select-cliente' style='width:100%'> seleccionar </button>" },

        ],

    });


    var cliente = {};
    var nombreCliente = '';
    // seleccionar cliente
    var autoCompleteClientes = function (tbody, tablaClientes) {
        $(tbody).on("click", "button.select-cliente", function () {
            var data = tablaClientes.row($(this).parents("tr")).data();
            cliente = { id: data.id_cliente, nombre: data.nombre, aPaterno: data.aPaterno, aMaterno: data.aMaterno, telefono: data.telefono, direccion: data.direccion };
            nombreCliente = data.nombre + ' ' + data.aPaterno + ' ' + data.aMaterno;
            $('#confirmCompra').prop('disabled', false);
            $('div.datosCompra').animate({ width: 'toggle' });
            $('div.datosPago').animate({ width: 'toggle' });

        });
        
    };


    // registrar cliente
    $('#addNewCostumerForm').submit(function (i) {
        i.preventDefault();

        let data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: '../backend/ventas/nuevoCliente.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
        })
            .done(function (data) {
               
                // si el registro existe 
                if (data.registro == 'existente') {
                    confirm("Cliente existente, revisa los datos");
                }

                // si no existe
                else {
                    // si hay errores > validar y mostrar errores
                    if (data.errs) {
                        let ids = [".val-id-add", ".val-name-add", ".val-aP-add", ".val-aM-add", ".val-tel-add", ".val-dir-add"];
                        validarInputs(data, ids);
                    }

                    //si no hay errores > proceder a facturar
                    else {
                        cliente = { id: data[0].id_cliente, nombre: data[0].nombre, aPaterno: data[0].aPaterno, aMaterno: data[0].aMaterno, telefono: data[0].telefono, direccion: data[0].direccion };
                        nombreCliente = cliente.nombre + ' ' + cliente.aPaterno + ' ' + cliente.aMaterno;
                        $('div.datosCliente').animate({ width: 'toggle' });
                        $('div.datosPago').animate({ width: 'toggle' });
                        $('#confirmCompra').prop('disabled', false);

                    }

                }
            })
            .fail(function () {
            })
            .always(function () {
            });
    });


    // valida los inputs del form
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

    var quitarValidacion = function (tags) {
        let longitud = tags.length;

        for (let i = 0; i < longitud; i++) {
            $(tags[i]).removeClass('is-invalid');
            $(tags[i]).removeClass('is-valid');
        }
    }



    //confirmar compra
    $('#confirmCompra').on('click', function (a) {
        a.preventDefault();

        var metodoPago = $('#metodoPago').val();
        var formaPago = $('#formaPago').val();
        let compra = { listaCompras: items, total: total, cliente: cliente, cantidad: numItems, formaPago: formaPago, metodoPago: metodoPago };

        //delete (productos[0]);

        $.ajax({
            type: 'post',
            url: '../backend/ventas/nuevaVenta.php',
            data: compra,
            dataType: 'json',
        })
            .done(function (data) {

                console.log(data);
                $('#modalConfirmVenta').modal('show');
                setTimeout(function() {
                    window.location.replace("../interfaces/facturas.php");
                }, 4000);
            })
            .fail(function () {
            })
            .always(function (data) {
            });
    });



    $('#addCliente').on('click', function () {
        $('div.datosCompra').animate({ width: 'toggle' });
        $('div.datosCliente').animate({ width: 'toggle', duration: 5000 });
    })
    $('#btnGoBack').on('click', function () {
        $('div.datosCompra').animate({ width: 'toggle' });
        $('div.datosCliente').animate({ width: 'toggle', duration: 5000 });
    })



    $('div.datosCliente').hide();
    $('div.datosPago').hide();

    autoCompleteClientes("#listaClientes", tablaClientes);

    //llama a la funcion para mostrar el contador de productos
    mostrarCarro();

    // llena y recarga la tabla
    table.ajax.reload();

    //llama la funcion de inserta producto
    insertarProd("#tablaProductos", table);
})