<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <!--    Datatables  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>



    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light ">

        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aurora Sales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent1">

                <ul class="navbar-nav nav-ul ">

                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white;">
                            Cartera
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item dropdown-item"><a href="clientes.php" class="nav-link active">Clientes</a></li>
                            <li class="nav-item"><a href="catalogo.php" class="nav-link active" style="background-color: white;">Catalogo</a></li>
                            <li class="nav-item"><a href="provedores.php" class="nav-link active">Provedores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="cotizar.php" class="nav-link active">Cotizar</a></li>
                    <li class="nav-item"><a href="facturas.php" class="nav-link active">Negocios</a></li>
                    <li class="nav-item"><a href="dashboard.php" class="nav-link active">Dashboard</a></li>
                </ul>


            </div>

        </div>
    </nav>



    <div id="btn-add-box">
        <div class="banner-add ">

            <button class="btn btn-success botones sticky-bottom" data-bs-toggle="modal" data-bs-target="#modalAddProd">
                Agregar Producto
            </button>

            <button id="newProduct" class="btn btn-success botones sticky-bottom" data-bs-toggle="modal" data-bs-target="#modalAddProd">
                +
            </button>
        </div>
    </div>




    <!-- Modal editar producto -->
    <div class="modal fade" id="modalEditProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable " id="editProdModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar producto</h1>
                    <button type="button" class="btn-close closeAddForm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="edit-product-form" method="POST" enctype="multipart/form-data">


                        <div class="input-group">
                            <div class="form-floating mb-3 groupId">
                                <input type="text" required name="editIdProd" id="editarIdProd" readonly class="form-control form-control-lg groupId">
                                <label for="editarIdProd"> Id </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupName">
                                <input type="text" required name="editNombreProd" id="editarNombreProd" class="form-control form-control-lg groupName">
                                <label for="editarNombreProd"> Nombre Producto </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupType">
                                <input type="text" required name="editTipoProd" id="editarTipoProd" class="form-control form-control-lg groupType">
                                <label for="editarTipoProd"> Tipo </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating groupSize">
                                <select required name="editTalla" id="editarTalla" class="form-select groupSize">
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                    <option value="6">6</option>
                                    <option value="6.5">6.5</option>
                                    <option value="7">7</option>
                                    <option value="7.5">7.5</option>
                                    <option value="8">8</option>
                                    <option value="8.5">8.5</option>
                                    <option value="9">9</option>
                                    <option value="9.5">9.5</option>
                                    <option value="10">10</option>
                                </select>
                                <label for="editarTalla"> Talla </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupBrand">
                                <input type="text" required name="editMarca" id="editarMarca" class="form-control form-control-lg groupBrand">
                                <label for="editarMarca"> Marca </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupColor">
                                <input type="text" required name="editColor" id="editarColor" class="form-control form-control-lg groupColor">
                                <label for="editarColor"> Color </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupMaterial">
                                <input type="text" required name="editMaterial" id="editarMaterial" class="form-control form-control-lg groupMaterial">
                                <label for="editarMaterial"> Material </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating groupSex">
                                <select required name="editGenero" id="editarGenero" class="form-select groupSex">
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="unisex">Unisex</option>
                                </select>
                                <label for="editarGenero">Genero</label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating groupAge">
                                <select required name="editEdad" id="editarEdad" class="form-select groupAge">
                                    <option value="adultos">Adultos</option>
                                    <option value="adolecentes">Adolecentes</option>
                                    <option value="ninos">Niños</option>
                                </select>
                                <label for="editarEdad">Edad</label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupCost">
                                <input type="text" required name="editCostoU" id="editarCostoU" class="form-control form-control-lg groupCost">
                                <label for="editarCostoU"> Costo Unitario </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupStock">
                                <input type="text" required name="editInventario" id="editarInventario" class="form-control form-control-lg groupStock">
                                <label for="editarInventario"> Inventario </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group mb-3 has-validation">
                            <input type="file" name="editImagen" class="form-control pictureProd">
                            <div class="invalid-feedback feedbackImg"> </div>
                        </div>


                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" form="edit-product-form" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-secondary closeAddForm" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>



    <!-- Tabla de productos -->
    <div class="tabloide table-responsive">

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



    <!-- Modal Agregar Producto -->
    <div class="modal fade" id="modalAddProd" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable" id="addProdModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Agregar Producto</h1>
                    <button type="button" class="btn-close closeAddForm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="add-product-form" method="POST" enctype="multipart/form-data">


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupName">
                                <input type="text" name="addNombreProd" id="nameProd" class="form-control form-control-lg groupName">
                                <label for="nameProd"> Nombre Producto </label>
                            </div>
                            <div class="invalid-feedback">nombre invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupType">
                                <input type="text" required name="addTipoProd" id="typeProd" class="form-control form-control-lg groupType">
                                <label for="typeProd"> Tipo </label>
                            </div>
                            <div class="invalid-feedback">(a-z) y (0-9)</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating groupSize">
                                <select required name="addTalla" id="sizeProd" class="form-select groupSize">
                                    <option value="2">2</option>
                                    <option value="2.5">2.5</option>
                                    <option value="3">3</option>
                                    <option value="3.5">3.5</option>
                                    <option value="4">4</option>
                                    <option value="4.5">4.5</option>
                                    <option value="5">5</option>
                                    <option value="5.5">5.5</option>
                                    <option value="6">6</option>
                                    <option value="6.5">6.5</option>
                                    <option value="7">7</option>
                                    <option value="7.5">7.5</option>
                                    <option value="8">8</option>
                                    <option value="8.5">8.5</option>
                                    <option value="9">9</option>
                                    <option value="9.5">9.5</option>
                                    <option value="10">10</option>
                                </select>
                                <label for="sizeProd"> Talla </label>
                            </div>
                            <div class="invalid-feedback">talla invalida</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupBrand">
                                <input type="text" required name="addMarca" id="brandProd" class="form-control form-control-lg groupBrand">
                                <label for="brandProd"> Marca </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupColor">
                                <input type="text" required name="addColor" id="colorProd" class="form-control form-control-lg groupColor">
                                <label for="colorProd"> Color </label>
                            </div>
                            <div class="invalid-feedback">color invalido</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupMaterial">
                                <input type="text" required name="addMaterial" id="materialProd" class="form-control form-control-lg groupMaterial">
                                <label for="materialProd"> Material </label>
                            </div>
                            <div class="invalid-feedback">dato invalido (solo letras y numeros)</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating groupSex">
                                <select required name="addGenero" id="sexProd" class="form-select groupSex">
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="unisex">Unisex</option>
                                </select>
                                <label for="sexProd">Genero</label>
                            </div>
                            <div class="invalid-feedback">genero no existente</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating groupAge">
                                <select required name="addEdad" id="ageProd" class="form-select groupAge">
                                    <option value="adultos">Adultos</option>
                                    <option value="adolecentes">Adolecentes</option>
                                    <option value="nino">Niños</option>
                                </select>
                                <label for="ageProd">Edad</label>
                            </div>
                            <div class="invalid-feedback">dato no existente (selecciones una de las opciones)</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupCost">
                                <input type="text" required name="addCostoU" id="costProd" class="form-control form-control-lg groupCost">
                                <label for="costProd"> Costo Unitario </label>
                            </div>
                            <div class="invalid-feedback">formato incorrecto (solo numeros decimales)</div>
                        </div>


                        <div class="input-group has-validation">
                            <div class="form-floating mb-3 groupStock">
                                <input type="text" required name="addInventario" id="stockProd" class="form-control form-control-lg groupStock">
                                <label for="stockProd"> Inventario </label>
                            </div>
                            <div class="invalid-feedback">dato incorrecto (ingrese un numero entero)</div>
                        </div>


                        <div class="input-group mb-3 has-validation">
                            <input type="file" name="addImagen" id="picture" class="form-control pictureProd">
                            <div class="invalid-feedback feedbackImg"> </div>
                        </div>


                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" form="add-product-form" class="btn btn-success"> Agregar</button>
                    <button type="button" class="btn btn-secondary closeAddForm" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal producto agregado-->
    <div class="modal fade" id="productoAgregado" tabindex="-1" aria-labelledby="productoAgregadoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productoAgregadoLabel">Producto Agregado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert">
                        Un nuevo producto ha sido agregado a tu catálogo
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal producto eliminado-->
    <div class="modal fade" id="productoEditado" tabindex="-1" aria-labelledby="productoEditadoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productoEditadoLabel">Eliminar producto</h1>
                    <button type="button" class="btn-close btnCloseAfterDel" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert">
                        Desea eliminar el producto?
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="delProdbyId">Eliminar</button>
                    <button type="button" class="btn btn-primary btnCloseAfterDel" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery-3.6.1.min.js"></script>
    <!--    Datatables-->
    <script src="catalogo.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
    <link rel="stylesheet" href="estilos/catalogo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


</body>

</html>