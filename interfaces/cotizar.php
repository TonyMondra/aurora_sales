<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizaciones</title>
    <!--    Datatables  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>


    <nav class="navbar navbar-expand-lg bg-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aurora Sales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent1">

                <ul class="navbar-nav nav-ul ">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cartera
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown-item"><a href="clientes.php" class="nav-link active">Clientes</a></li>
                            <li class="nav-item"><a href="catalogo.php" class="nav-link active">Catalogo</a></li>
                            <li class="nav-item"><a href="provedores.php" class="nav-link active">Provedores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="cotizar.php" class="nav-link active" style="background-color: white;">Cotizar</a></li>
                    <li class="nav-item"><a href="facturas.php" class="nav-link active">Negocios</a></li>
                    <li class="nav-item"><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
                </ul>

            </div>
        </div>
    </nav>



    <div id="btn-add-box">
        <div class="banner-add ">

            <button class="btn btn-success sticky-bottom" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas" aria-controls="cartCanvas">
                Carrito
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="prodCounter">
                    0
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>

            <button id="carrito" class="btn btn-success sticky-bottom" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas" aria-controls="cartCanvas">+</button>
        </div>
    </div>



    <div class="menu">
        <div class="tablaProductos-box table-responsive">
            <table id="tablaProductos" class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>id</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Talla</th>
                        <th>Marca</th>
                        <th>Color</th>
                        <th>Material</th>
                        <th>Genero</th>
                        <th>Edad</th>
                        <th>Costo</th>
                        <th>Inventario</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                </tbody>
            </table>
        </div>
    </div>



    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartCanvas" aria-labelledby="cartCanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="cartCanvasLabel">Cotización</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body box-compras">

            <div id="emptyKart">
                <span>Carrito Vacio()</span>
            </div>

            <div id="carritoBox">

                <table id="tableShoppingKart">
                    <thead>
                        <th></th>
                        <th>Producto</th>
                        <th>talla</th>
                        <th>Monto</th>
                        <th>Cantidad</th>
                        <th></th>
                    </thead>

                    <tbody>
                    </tbody>
                </table>

                <div id="totalCompra">
                    <span>SubTotal:</span>
                    <span id="montoTotal"></span>
                </div>

                <button id="btnCheckOut" class="btn btn-success">Proceder</button>

            </div>
        </div>
    </div>


    <!-- Modal finalizar compra-->
    <div class="modal fade" id="finalizarCompraModal" tabindex="-1" aria-labelledby="finalizarCompraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen	">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="finalizarCompraModalLabel">Sistema de propuestas</h1>
                </div>
                <div class="modal-body">

                    <div class="datosCompra datos">

                        <table id="listaClientes" class="table">
                            <thead>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                        </table>

                        <div id="clienteNuevoBox">
                            <button class="btn btn-success" id="addCliente">Nuevo cliente+</button>
                        </div>

                    </div>

                    <div class="datosCliente datos">

                        <div class="formRegBox">
                            <form method="post" id="addNewCostumerForm">

                                <div class="input-group">
                                    <div class="form-floating mb-3 val-name-add">
                                        <input type="text" required name="nombre" id="nombre" class="form-control form-control-lg val-name-add">
                                        <label for="nombre"> Nombre </label>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="form-floating mb-3 val-aP-add">
                                        <input type="text" name="aPaterno" required id="aPaterno" class="form-control form-control-lg val-aP-add">
                                        <label for="aPaterno"> Apellido Paterno </label>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="form-floating mb-3 val-aM-add">
                                        <input type="text" name="aMaterno" id="aMaterno" class="form-control form-control-lg val-aM-add">
                                        <label for="aMaterno"> Apellido Materno </label>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="form-floating mb-3 val-tel-add">
                                        <input type="text" maxlength="10" required name="telefono" id="telefono" class="form-control form-control-lg val-tel-add">
                                        <label for="telefono"> Telefono </label>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="form-floating mb-3 val-dir-add">
                                        <input type="text" required name="direccion" id="direccion" class="form-control form-control-lg val-dir-add">
                                        <label for="direccion"> Direccion </label>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="registroBox">
                            <button class="btn btn-primary" id="btnGoBack"> Regresar </button>
                            <button type="submit" form="addNewCostumerForm" class="btn btn-primary" id="btnGotoCheck"> Continuar </button>
                        </div>

                    </div>

                    <div class="datosPago datos">

                        <form method="POST" id="formCheckOut">

                            <div class="input-group has-validation">
                                <div class="form-floating val-metodo-pago">
                                    <select required name="nameMetodoPago" id="metodoPago" class="form-select val-metodo-pago">
                                        <option value="efectivo">Efectivo</option>
                                        <option value="credito">Tarjeta Credito</option>
                                        <option value="debito">Tarjeta debito</option>
                                    </select>
                                    <label for="metodoPago">Metodo de Pago</label>
                                </div>
                                <div class="invalid-feedback">dato invalido</div>
                            </div>

                            <div class="input-group has-validation">
                                <div class="form-floating val-forma-pago">
                                    <select required name="nameFormaPago" id="formaPago" class="form-select val-forma-pago">
                                        <option value="pagoUnico">Una solo exihibicion</option>
                                        <option value="parcial">Parcialidades</option>
                                    </select>
                                    <label for="formaPago">Forma de pago</label>
                                </div>
                                <div class="invalid-feedback">dato invalido</div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="confirmCompra" disabled>Generar Cotización</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal confirmacion de compra -->
    <div class="modal fade" id="modalConfirmVenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalConfirmVentaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalConfirmVentaLabel"> Confirmación</h1>
                </div>
                <div class="modal-body">
                    Cotización realizada con exito
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Aurora</strong>
                <small>hace un momento</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-success p-2 text-dark bg-opacity-25">
                <span id="toastContent"></span> agregado al carrito
            </div>
        </div>
    </div>




    <script>
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("tableShoppingKart").deleteRow(i);
            mostrarCarro();
            calcularTotal();
            contadorProductos();
        }



        function actualizarMontos() {
            $("table#tableShoppingKart tr").each(function() {
                let cantidad = $(this).find('input.cantidadProd').val();
                let costoUnitario = $(this).find('span.costoUnitario').text();
                let subtotal = cantidad * costoUnitario;
                let montoExacto = parseFloat(subtotal);
                $(this).find('span.subtotalProd').text(montoExacto);
            });
            calcularTotal();
            contadorProductos();
        }

        var calcularTotal = function() {
            var total = 0;
            $("table#tableShoppingKart tr").each(function() {
                var actualData = $(this).find('span.subtotalProd');
                actualData.each(function() {
                    var costo = $(this).text();
                    var precost = parseFloat(costo);
                    total = total + precost;
                });
            });
            $('#montoTotal').text(total);
        }

        var mostrarCarro = function() {
            $("table#tableShoppingKart").each(function() {
                var numArticulos = $(this).find('tr');
                if (numArticulos.length <= 1) {
                    $('#carritoBox').hide();
                    $('#emptyKart').show();
                } else if (numArticulos.length > 1) {
                    $('#carritoBox').show();
                    $('#emptyKart').hide();
                }
            });
        }

        var contadorProductos = function() {
            let total = 0;
            $("table#tableShoppingKart tr").each(function() {
                let fila = $(this).find('input.cantidadProd');
                fila.each(function() {
                    let contador = $(this).val();
                    total = total + parseInt(contador);
                });
            });
            $('#prodCounter').text(total);
        }
    </script>

    <script src="jquery-3.6.1.min.js"></script>
    <script src="cotizar.js"></script>
    <!--    Datatables-->
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link rel="stylesheet" href="estilos/ventas.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


</body>

</html>