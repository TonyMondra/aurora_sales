<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>

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

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  style="background-color: white;">
                            Cartera
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown-item"><a href="clientes.php" class="nav-link active" style="background-color: white;">Clientes</a></li>
                            <li class="nav-item"><a href="catalogo.php" class="nav-link active">Catalogo</a></li>
                            <li class="nav-item"><a href="provedores.php" class="nav-link active">Provedores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="cotizar.php" class="nav-link active" >Cotizar</a></li>
                    <li class="nav-item"><a href="facturas.php" class="nav-link active">Negocios</a></li>
                    <li class="nav-item"><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
                </ul>


            </div>

        </div>
    </nav>



    <div id="btn-add-box">
        <div class="banner-add ">

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">
                Agregar Cliente
            </button>

            <button id="newCliente" class="btn btn-success sticky-bottom" data-bs-toggle="modal" data-bs-target="#modalAdd">
                +
            </button>
        </div>
    </div>



    <!-- Modal editar cliente -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditLabel">Editar cliente</h1>
                    <button type="button" class="btn-close close-form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="editClienteForm" method="POST">


                        <div class="input-group">
                            <div class="form-floating mb-3 val-id-edit">
                                <input type="text" required id="IDIdEdit" name="nmEditId" class="form-control form-control-lg val-id-edit" readonly>
                                <label for="IDIdEdit"> Id </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3 val-name-edit">
                                <input type="text" required id="IDnombreEdit" name="nmEditNombre" class="form-control form-control-lg val-name-edit">
                                <label for="IDnombreEdit"> * Nombre </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group">
                            <div class="form-floating mb-3 val-aP-edit">
                                <input type="text" required id="IDaPaternoEdit" name="nmEditApaterno" class="form-control form-control-lg val-aP-edit">
                                <label for="IDaPaternoEdit"> * Apellido Paterno </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group">
                            <div class="form-floating mb-3 val-aM-edit">
                                <input type="text" required id="IDaMaternoEdit" name="nmEditAmaterno" class="form-control form-control-lg val-aM-edit">
                                <label for="IDaMaternoEdit"> Apellido Materno </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group">
                            <div class="form-floating mb-3 val-tel-edit">
                                <input type="text" maxlength="10" required id="IDtelEdit" name="nmEditTel" class="form-control form-control-lg val-tel-edit">
                                <label for="IDtelEdit"> * Telefono </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3 val-dir-edit">
                                <input type="text" required id="IDdirEdit" name="nmEditDir" class="form-control form-control-lg val-dir-edit">
                                <label for="IDdirEdit"> Direccion </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                    </form>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close-form" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="editClienteForm" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>





    <div class="tabloide table-responsive">

        <table id="tablaUsuarios" class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>aPaterno</th>
                    <th>aMaterno</th>
                    <th>telefono</th>
                    <th>direccion</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            </tbody>
        </table>

    </div>





    <!-- Modal agregar cliente-->
    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAddLabel">Agregar Cliente</h1>
                    <button type="button" class="btn-close close-form" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="addClienteForm" method="POST">

                        <span hidden class="val-id-add"></span>
                        <div class="input-group">
                            <div class="form-floating mb-3 val-name-add">
                                <input type="text" required name="nombre" id="nombre" class="form-control form-control-lg val-name-add">
                                <label for="nombre"> Nombre </label>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3 val-aP-add">
                                <input type="text" name="aPaterno" required id="aPaterno" class="form-control form-control-lg val-aP-add">
                                <label for="aPaterno"> * Apellido Paterno </label>
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
                                <label for="telefono"> * Telefono </label>
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


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close-form" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="addClienteForm" class="btn btn-primary">Guardar cambios</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal confirmacion-->
    <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirmTitle"> </h1>
                    <button type="button" class="btn-close btnCloseAfterDel" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert" id="confirmMsj">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnConfirmar">Eliminar</button>
                    <button type="button" class="btn btn-primary btnCloseAfterDel" id="btnCancelarOpr" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>









    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery-3.6.1.min.js"></script>
    <!--    Datatables-->
    <script src="clientes.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
    <link rel="stylesheet" href="estilos/clientes.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


</body>

</html>