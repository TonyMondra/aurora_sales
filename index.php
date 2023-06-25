<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    Datatables  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Inicio</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg sticky-top">

        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aurora Sales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent2">

                <ul class="navbar-nav nav-ul"> 
                    <li class="nav-item"><a href="#inicio" class="nav-link">Inicio</a></li>
                    <li class="nav-item"><a href="#software" class="nav-link">Software</a></li>
                    <li class="nav-item"><a href="#precios" class="nav-link">Precios</a></li>
                    <li class="nav-item"><a href="#contacto" class="nav-link">Contacto</a></li>
                    <li class="nav-item login"><a href="#" class="nav-link login btn" data-bs-target="#modal-login" data-bs-toggle="modal"> Acceder </a></li>
                </ul>

            </div>

        </div>


    </nav>

    <div class="body" id="inicio">

        <div class="panel panel-1">

            <div class="slogan slogan-container">
                <div class="slogan-text-primario morado slogan">Potencia</div>
                <div class="slogan-text-primario slogan">tus ventas</div>
                <div class="slogan-text-secundario slogan">Gestiona las relaciones con tus clientes, manten tu cartera de prospectos activa y
                    aumenta tu flujo de ventas.
                </div>
                <div class="btn-box">
                    <button class="btn btn-probar" data-bs-target="#modal-registro" data-bs-toggle="modal">Pruebalo gratis</button>
                </div>
            </div>
            <div class="slogan imagenPromo">
                <img src="media/logoverde.png" alt="" class="imagenPromo">
            </div>

        </div>
    </div>

    <div id="software" class="software">

        <div class="panel panel-2">

            <div class="panel2-title">
                <p class="panel2-title"> Por qué el CRM de Aurora Sales?</p>
            </div>
            <div class="info-1 panel-container2">
                <div class="info1-box-text">
                    <p class="wallet-main main-detail">Controla tu cartera</p>
                    <p class="wallet-detail description">Dale un correcto seguimiento a todos tus clientes y prospectos, revisa: estatus.
                        saldos pendientes, ultimas compras, linea de credito y actividades de seguimiento.
                    </p>
                </div>
                <div class="info1-box-img">
                    <img src="media/cartera.png" alt="" class="imagenWallet">
                </div>
            </div>


            <div class="info-1 panel-container2">
                <div class="info1-box-img">
                    <img src="media/carrito.png" alt="" class="imagenWallet">
                </div>
                <div class="info1-box-text">
                    <p class="wallet-main main-detail">Administra tu catalogo</p>
                    <p class="wallet-detail description">Maneja tu catalogo de una manera dinamica: agraga, edita y remueve productos de tu catálogo y observa los
                        cambios en la misma venta en tiempo real </p>
                </div>
            </div>

            <div class="info-1 panel-container2">
                <div class="info1-box-text">
                    <p class="wallet-main main-detail">Aumenta tus ventas</p>
                    <p class="wallet-detail description">No volveras a perder ninguna venta: realiza todas tus transacciones en solo tres clicks.
                    </p>
                </div>
                <div class="info1-box-img">
                    <img src="media/ventas.png" alt="" class="imagenWallet">
                </div>
            </div>

        </div>



    </div>


    <div id="carrusel">

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="media/interface1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="media/interface2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item active">
                    <img src="media/interface3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>



    <div id="precios">

        <div class="panel-3">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Plan <span class="morado">Personal</span></h5>
                    <p class="card-text cost-plan">499.00 <sup>mx</sup>
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Clientes Ilimitados</li>
                    <li class="list-group-item">Hasta 100 productos</li>
                    <li class="list-group-item">1 Usuario</li>
                    <li class="list-group-item">Soporte por chat y mail 8X5</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-target="#modal-registro" data-bs-toggle="modal"> comprar</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Plan <span class="morado">Pyme</span></h5>
                    <p class="card-text cost-plan">1,780.00 <sup>mx</sup></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Clientes Ilimitados</li>
                    <li class="list-group-item">Hasta 1000 productos</li>
                    <li class="list-group-item">Hasta 5 Usuarios</li>
                    <li class="list-group-item">Soporte telefonico 8X5 </li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-target="#modal-registro" data-bs-toggle="modal"> comprar</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Plan <span class="morado">Coorporativo</span> </h5>
                    <p class="card-text cost-plan">4,799.00 <sup>mx</sup></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Clientes Ilimitados</li>
                    <li class="list-group-item">Hasta 4000 productos</li>
                    <li class="list-group-item">Hasta 25 Usuarios</li>
                    <li class="list-group-item">Soporte prioritario</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-primary" data-bs-target="#modal-registro" data-bs-toggle="modal"> comprar</button>
                </div>
            </div>


        </div>


    </div>


    <div id="contacto">

        <div class="panel-4">

            <form id="form-contacto">

                <div class="title-form ">
                    Dudas, comentarios o sugerencias ? ponte en contacto con nosotros llenando este formulario
                </div>

                <div class="input-group">
                    <div class="form-floating mb-3">
                        <input type="text" required name="nombre-contacto" id="name-contacto" class="form-control form-control-lg">
                        <label for="name-contacto" class="morado"> Nombre </label>
                    </div>
                    <div class="invalid-feedback">dato invalido</div>
                </div>

                <div class="input-group">
                    <div class="form-floating mb-3">
                        <input type="text" required name="telefono-contacto" id="phone-contacto" class="form-control form-control-lg">
                        <label for="phone-contacto" class="morado"> Teléfono </label>
                    </div>
                    <div class="invalid-feedback">dato invalido</div>
                </div>

                <div class="input-group">
                    <div class="form-floating mb-3">
                        <input type="email" required name="correo-contacto" id="mail-contacto" class="form-control form-control-lg">
                        <label for="mail-contacto" class="morado"> Correo electronico </label>
                    </div>
                    <div class="invalid-feedback">dato invalido</div>
                </div>

                <div class="input-group has-validation">
                    <div class="form-floating ">
                        <select required name="motivo-contacto" id="subject-contacto" class="form-select">
                            <option value="ventas">Ventas</option>
                            <option value="soporte">Soporte</option>
                            <option value="soporte">Negocios</option>
                        </select>
                        <label for="subject-contacto" class="morado">Asunto</label>
                    </div>
                    <div class="invalid-feedback">dato invalido</div>
                </div>
                <br>

                <div class="input-group has-validation">
                    <div class="form-floating">
                        <textarea class="form-control" name="comentarios-contacto" id="coments-contacto"></textarea>
                        <label for="coments-contacto" class="morado">Describa el motivo de su contacto</label>
                    </div>
                    <div class="invalid-feedback">dato invalido</div>
                </div>


                <div class="d-grid gap-2" id="btn-enviar-contact">
                    <button class="btn btn-primary" type="submit" form="form-contacto">Enviar</button>
                </div>

            </form>

        </div>

    </div>



    <div id="footer">

        <div class="panel-5">

            <div class="box-footer footer-icon">
                <img src="media/logo3_4_153724.png" alt="" class="footer-icon">
            </div>

            <div class="box-footer social">
                <ul class="social box-list">
                    <li class="social box-list"> Redes sociales</li>
                    <li class="social box-list"> <a href="" class="box-link"> Facebook </a> </li>
                    <li class="social box-list"> <a href="" class="box-link"> Instagram </a> </li>
                    <li class="social box-list"> <a href="" class="box-link"> Youtube </a> </li>
                    <li class="social box-list"> <a href="" class="box-link"> Twiter </a> </li>
                </ul>
            </div>

            <div class="box-footer oficces">
                <ul class="oficces box-list">
                    <li class="oficces box-list"> Acercate </li>
                    <li class="oficces box-list"> <a href="" class="box-link"> Coorporativo</a> </li>
                    <li class="oficces box-list"> <a href="" class="box-link"> Oficinas</a> </li>
                    <li class="oficces box-list"> <a href="" class="box-link"> Aliados</a> </li>
                </ul>
            </div>
            <div class="box-footer bolsa-trabajo">
                <ul class="bolsa-trabajo box-list">
                    <li class="bolsa-trabajo box-list">Bolsa laboral</li>
                    <li class="bolsa-trabajo box-list"> <a href="" class="box-link"> Vacantes </a> </li>
                </ul>
            </div>


        </div>
        <div id="privacidad">
            <span id="avisoP">aviso de privacidad</span>
        </div>

    </div>


    <!-- modal login -->
    <div class="modal fade" id="modal-login" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 morado" id="exampleModalToggleLabel">Ingresar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="form-login" method="POST">

                        <div class="input-group">
                            <div class="form-floating mb-3 login-user">
                                <input type="user" required name="usuarioLog" id="userLog" class="form-control form-control-lg login-user">
                                <label for="userLog" class="morado"> Usuario </label>
                            </div>
                            <div class="invalid-feedback">Usuario inexistente</div>
                        </div>


                        <div class="input-group">
                            <div class="form-floating mb-3 login-pass">
                                <input type="password" required name="contraLog" id="passLog" class="form-control form-control-lg login-pass ">
                                <label for="passLog" class="morado"> Contraseña </label>
                            </div>
                            <div class="invalid-feedback">contraseña incorrecta</div>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="submit" form="form-login" class="btn btn-primary">iniciar sesion</button>
                    <span> aun no eres cliente? <a href="#" data-bs-target="#modal-registro" data-bs-toggle="modal" class="opcionForm">registrate</a></span>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-registro" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 morado" id="exampleModalToggleLabel2">Registro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="form-registro" method="POST">

                        <div class="input-group">
                            <div class="form-floating mb-3">
                                <input type="text" required name="name-reg" id="nombre-reg" class="form-control form-control-lg">
                                <label for="nombre-reg" class="morado"> Nombre </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3">
                                <input type="text" required name="lastname-reg" id="apellido-reg" class="form-control form-control-lg">
                                <label for="apellido-reg" class="morado"> Apellido </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3">
                                <input type="text" required name="email-reg" id="correo-reg" class="form-control form-control-lg">
                                <label for="correo-reg" class="morado"> Email </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3">
                                <input type="text" required name="phone-reg" id="telefono-reg" class="form-control form-control-lg">
                                <label for="telfono-reg" class="morado"> Teléfono </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3">
                                <input type="password" required name="pass-reg" id="contra-reg" class="form-control form-control-lg">
                                <label for="contra-reg" class="morado"> Contraseña </label>
                            </div>
                            <div class="invalid-feedback">dato invalido</div>
                        </div>

                    </form>


                </div>
                <div class="modal-footer" id="footModalReg">
                    <button type="submit" form="form-registro" class="btn btn-primary">Registrarse</button>
                    <span> soy cliente <a href="#" data-bs-target="#modal-login" data-bs-toggle="modal" class="opcionForm">Ingresar</a></span>
                </div>
            </div>
        </div>
    </div>




    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="interfaces/jquery-3.6.1.min.js"></script>
    <script src="dinamics.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>