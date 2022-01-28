<?php include("../db.php") ?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: ../login.php");
} else {
    if ($_SESSION["rol"] == 1) {
        include("headerKM15Guayo.php");
    } else {
        include("headerkm15.php");
    }
}
?>
<!-- MENSAJES QUE LANZA AL USUARIO REALIZAR DISTINTIAS ACCIONES -->
<?php
// mensaje que lanza al editar una Factura
if (isset($_SESSION['messageEdit'])) { ?>
    <script>
        Swal.fire({
            title: "Factura Editada Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageEdit']);
}
// mensaje de pago
if (isset($_SESSION['messagePago'])) {
    $nombreClientePago = $_SESSION['nombreCliente'];
    $telefonoClientePago = $_SESSION['telefonoCliente'];
?>
    <script>
        Swal
            .fire({
                title: "Correcto",
                text: "Desea Avisar al cliente?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                confirmButtonText: "Sí, Avisar",
                cancelButtonText: "No",
            })
            .then(resultado => {
                if (resultado.value) {

                    // Hicieron click en "Sí"
                    window.location = "https://wa.me/1<?php echo $telefonoClientePago ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0AMensaje%20Dirigido%20A:%20<?php echo $nombreClientePago ?>%0A%0A*FACTURA%20PAGADA EXITOSAMENTE!*%0AGracias%20por%20realizar%20el%20pago%20de%20su%20factura%20de%20Gas%0ARecuerde%20pagar%20siempre%20a%20tiempo%20para%20mantener%20su%20credito%20*vigente*!%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";

                }
            });
    </script>
<?php unset($_SESSION['messagePago']);
    unset($_SESSION['nombreCliente']);
    unset($_SESSION['telefonoCliente']);
}
// mensaje de abono
if (isset($_SESSION['messageAbono'])) {
    $deuda = $_SESSION['deuda'];
    $abono = $_SESSION['abono'];
    $telefonoClienteAbono = $_SESSION['telefonoAbonoCliente'];
    $nombreClienteAbono = $_SESSION['nombreAbonoAbonoCliente'];
    $deudaAnterior = $_SESSION['deudaAnterior']; ?>
    <script>
        Swal
            .fire({
                title: "Correcto",
                text: "Desea Avisar al cliente?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                confirmButtonText: "Sí, Avisar",
                cancelButtonText: "No",
            })
            .then(resultado => {
                if (resultado.value) {

                    // Hicieron click en "Sí"
                    window.location = "https://wa.me/1<?php echo $telefonoClienteAbono ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A*ACTUALIZACION:*%0AMensaje%20Dirigido%20A:%20<?php echo $nombreClienteAbono ?>%0A%0AAbono%20realizado%20con%20exito!%0A*DETALLE:*%0A%0A*Deuda%20Anterior:*%20<?php echo $deudaAnterior ?>%0A*Abono%20Realizado:*%20<?php echo $abono ?>%0A*Deuda%20Actual:*%20<?php echo $deuda ?>%0A%0ALe%20recordamos%20que%20debe%20apresurarse%20a%20pagar%20el%20dinero%20restante%20lo%20antes%20posible.%0A*GRACIAS%20POR%20PREFERIRNOS*";

                }
            });
    </script>
<?php unset($_SESSION['messageAbono']);
    unset($_SESSION['deuda']);
    unset($_SESSION['abono']);
    unset($_SESSION['telefonoAbonoCliente']);
    unset($_SESSION['nombreAbonoAbonoCliente']);
    unset($_SESSION['deudaAnterior']);
}
// Mensaje que lanza al borrar un factura
if (isset($_SESSION['messageDelete'])) { ?>
    <script>
        Swal.fire({
            title: "Factura Elimnada Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
    <?php unset($_SESSION['messageDelete']);
}

if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] == 1) {
        $nombre = $_SESSION['NombreCliente'];
        $telefono = $_SESSION['TelefonoCliente'];
        $galones = $_SESSION['galonesCliente'];
        $deuda = $_SESSION['deudaCliente'];
        $abono = $_SESSION['AbonoCliente'];
        $precio = $_SESSION['precioCliente'];
    ?>


        <script>
            Swal
                .fire({
                    title: "Correcto",
                    text: "Desea Enviar Factura al cliente?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    confirmButtonText: "Sí, Enviar",
                    cancelButtonText: "No",
                })
                .then(resultado => {
                    if (resultado.value) {
                        <?php
                        echo "var nombre ='$nombre';";
                        echo "var telefono ='$telefono';";
                        ?>
                        // Hicieron click en "Sí"
                        window.location = "https://wa.me/1<?php echo $telefono ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A%0A*FACTURA:*%0A%0AMensaje%20Dirigido%20A:%20<?php echo $nombre ?>%0A%0AGracias%20por%20la%20Compra%20de%20su%20cilindro%20de%20gas%20de%20<?php echo $galones ?>%20Galones%0A%0A*DETALLE:*%0A%0A*Nombre:*%20<?php echo $nombre ?>%0A*Precio:*%20<?php echo $precio ?>%20Pesos%0A*Galones:*%20<?php echo $galones ?>%20Galones%0A*Abono:*%20<?php echo $abono ?>%20Pesos%0A*Deuda:*%20<?php echo $deuda ?>%20Pesos%0A%0A*Recuerde*%20que%20posee%20un%20credito%20de%20hasta%2010%20dias%20para%20pagar%20el%20dinero%20restante.%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";

                    }
                });
        </script>
<?php
        unset($_SESSION['NombreCliente']);
        unset($_SESSION['TelefonoCliente']);
        unset($_SESSION['galonesCliente']);
        unset($_SESSION['deudaCliente']);
        unset($_SESSION['AbonoCliente']);
        unset($_SESSION['precioCliente']);
        unset($_SESSION['message']);
    }
} ?>
<!-- ========================================================= -->
<!--  -->

<h1 class="text-center">FACTURACION KM 15</h1>
<div class="container p-4">
    <div class="row">
        <?php
        if (isset($_SESSION["revertir"])) { ?>

            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    <button type="button" class="btn" onclick="window.location.href='revertirkm15.php'"><i class="fas fa-sync-alt"></i> Revertir</button>

                </div>
            </div>
        <?php
            unset($_SESSION['revertir']);
        }
        ?>
        <!-- boton de nueva factura -->
        <button type="button" onclick="location.href='save_task_km15.php?id=0'" class="btn btn-primary btn-lg edicionButton"><i class="fas fa-plus"></i> Nueva Factura</button>
        <!--  -->
        <div class="table-responsive">
            <!-- tabla -->

            <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Galones</th>
                        <th>Precio</th>
                        <th>Abono</th>
                        <th>Fecha</th>
                        <th>Deuda</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="developers">
                    <?php
                    $query = "SELECT * from gaskm15";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td> <a href="detalleKm15.php?id=<?php echo $row['id']; ?>&idCliente=<?php echo $row['idCliente']; ?>" class="text-decoration-none text-dark"><?php echo $row['nombre']; ?></a></td>
                            <td><?php echo $row['galones']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['abono']; ?></td>
                            <td><?php echo $row['fecha'] ?></td>
                            <td><?php echo $row['Deuda']; ?></td>
                            <td>
                                <!-- boton collapse-->

                                <?php
                                $string1 = strval($contador);
                                $azul = "collapseExample$contador";
                                $contador = $contador + 1; ?>

                                <p>
                                    <a href="editkm15.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary      botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                                    <button class="btn btn-primary itemMenuLateral dropdown-toggle bg-primary text-white mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                        Opciones
                                    </button>
                                </p>
                                <div class="collapse" id="<?php echo $azul ?>">
                                    <div class="card card-body">
                                        <a href="abonokm15.php?id=<?php echo $row['id'] ?>" class="btn btn-info botonesOpciones text-white">Abonar</i></a>
                                        <a class="btn btn-warning botonesOpciones text-white" onclick="confirmacionReenvioGasKm15(<?php echo $row['idCliente'] ?>)">Factura</a>
                                        <a class="btn btn-danger botonesOpciones" onclick="confirmacionKm15(<?php echo $row['id'] ?>)">Eliminar</a>
                                        <a class="btn btn-success botonesOpciones" onclick="confirmacionPagoKm15(<?php echo $row['id'] ?>)">Pago</a>

                                    </div>
                                </div>
                                <!--  -->

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php include("footerkm15.php") ?>