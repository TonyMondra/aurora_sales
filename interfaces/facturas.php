<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>

    <!--    Datatables  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/facturas.css">
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  >
                            Cartera
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown-item"><a href="clientes.php" class="nav-link active">Clientes</a></li>
                            <li class="nav-item"><a href="catalogo.php" class="nav-link active">Catalogo</a></li>
                            <li class="nav-item"><a href="provedores.php" class="nav-link active">Provedores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="cotizar.php" class="nav-link active" >Cotizar</a></li>
                    <li class="nav-item"><a href="facturas.php" class="nav-link active" style="background-color: white;">Negocios</a></li>
                    <li class="nav-item"><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
                </ul>


            </div>
        </div>
    </nav>




    <div class="tabloide table-responsive">

        <table id="tablaUsuarios" class="table table-hover">
            <thead>
                <tr>
                    <th>folio</th>
                    <th>cliente</th>
                    <th>fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            </tbody>
        </table>

    </div>





    <!-- Modal imprimir factura -->
    <div class="modal fade" id="modalFacturar" tabindex="-1" aria-labelledby="modalFacturarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFacturarLabel">Imprimir Cotización</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form action="../backend/ventas/printFactura.php" method="post" id="formFactura" hidden>
                        <input type="text" name="folio" id="folioFactura">
                    </form>

                    <div>
                        Desear imprimir la cotización: <span id="idventa"></span> ?
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formFactura" class="btn btn-primary"> imprimir</button>
                </div>
            </div>
        </div>
    </div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery-3.6.1.min.js"></script>
    <!--    Datatables-->
    <script src="facturas.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


</body>

</html>