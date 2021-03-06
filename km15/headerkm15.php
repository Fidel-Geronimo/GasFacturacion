<?php

include("../dbSelect.php");
$sql = "SELECT id,nombre from clientekm15";
$result = mysqli_query($conexion, $sql);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gas Facturacion</title>
    <!-- bootstrap 4-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- iconos de booststrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <!-- font awesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- cloudtables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="../img/logo.ico">
    <!-- estilos adicionales -->
    <link href="styles/estilosKm15Gabi.css" rel="stylesheet">

    <!-- select2 y jquery  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- sweet aler2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <nav class="navbar navbar-dark bg-dark shadow width-nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="facturacionkm15.php">GuayoGas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- Modal lateral -->
    <div class="modal fade edicionModal-1" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content edicionModal-1">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <a href="facturacionkm15.php" class="nav-link">
                            <li class="bg-primary text-white list-group-item"><i class="iconos bi bi-file-text-fill"></i> FACTURACION</li>
                        </a>
                        <a href="cobroskm15.php" class="nav-link">
                            <li class="bg-primary text-white list-group-item"><i class="iconos bi bi-piggy-bank-fill"></i> COBROS</li>
                        </a>
                        <a href="bonosKm15.php" class="nav-link">
                            <li class="bg-primary text-white list-group-item"><i class="iconos bi bi-ticket-perferated-fill"></i> BONOS</li>
                        </a>
                        <a href="bonos-cobrosKm15.php" class="nav-link">
                            <li class="bg-primary text-white list-group-item"><i class="iconos bi bi-calendar-x-fill"></i> BONOS VENCIDOS</li>
                        </a>
                        <a href="clientesKm15.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-primary text-white"><i class="iconos bi bi-calendar-x-fill"></i> CLIENTES</li>
                        </a>
                        <a href="../login.php?cerrar_sesion=cerrar" class="nav-link">
                            <li class="list-group-item">CERRAR SESION</li>
                        </a>

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de creacion cliente-->
    <div class="modal fade" id="registroCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Facturacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_Cliente.php" method="post">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control mt-2" placeholder="Nombre Completo" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="telefono" class="form-control mt-2" placeholder="Numero de Telefono">
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control mt-2" placeholder="Direccion">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                            <textarea name="comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Crear">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>