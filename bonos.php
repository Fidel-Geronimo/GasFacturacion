<?php include("db.php") ?>

<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
} else {
    if ($_SESSION["rol"] == 2) {
        header("Location: km15\facturacionkm15.php");
    }
}
?>
<!--  -->
<?php include("includes/header.php") ?>
<!-- mensaje cuando le usuario usa funciones -->
<?php
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
                    window.location = "https://wa.me/1<?php echo $telefonoClienteAbono ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A%0A*ACTUALIZACION:*%0AMensaje%20Dirigido%20A:%20<?php echo $nombreClienteAbono ?>%0A%0AABONO%20REALIZADO%20CON%20EXITO!%0A*DETALLE:*%0A%0A*Deuda%20Anterior:*%20<?php echo $deudaAnterior ?>%20Pesos%0A*Abono%20Realizado:*%20<?php echo $abono ?>%20Pesos%0A*Deuda%20Actual:*%20<?php echo $deuda ?>%20Pesos%0A%0ALe%20recordamos%20que%20debe%20apresurarse%20a%20pagar%20el%20dinero%20restante%20lo%20antes%20posible.%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";

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
// mensaje que lanza al editar una factura
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
// Mensaje que lanza al borrar un factura
if (isset($_SESSION['messageDelete'])) { ?>
    <script>
        Swal.fire({
            title: "Factura Elimnado Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageDelete']);
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
                    window.location = "https://wa.me/1<?php echo $telefonoClientePago ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A%0AMensaje%20Dirigido%20A:%20<?php echo $nombreClientePago ?>%0A%0A*FACTURA%20PAGADA EXITOSAMENTE!*%0AGracias%20por%20realizar%20el%20pago%20de%20su%20*bono*%20de%20Gas%0ARecuerde%20siempre%20pagar%20a%20tiempo%20para%20mantener%20su%20credito%20*VIGENTE*!%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";

                }
            });
    </script>
    <?php unset($_SESSION['messagePago']);
    unset($_SESSION['nombreCliente']);
    unset($_SESSION['telefonoCliente']);
}
// mensaje que lanza al facturar
if (isset($_SESSION['message'])) {
    if ($_SESSION['message'] == 1) {
        $nombre = $_SESSION['NombreCliente'];
        $telefono = $_SESSION['TelefonoCliente'];
        $valor = $_SESSION['valorBonoCliente'];
        $deuda = $_SESSION['deudaCliente'];
        $abono = $_SESSION['AbonoCliente'];
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
                        console.log(nombre);
                        console.log(telefono);
                        // Hicieron click en "Sí"
                        window.location = "https://wa.me/1<?php echo $telefono ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A%0A*FACTURA DE BONO:*%0A%0AMensaje%20Dirigido%20A:%20<?php echo $nombre ?>%0AHa%20recibido%20un%20bono%20de%20<?php echo $valor ?>%20pesos,%20recuerda%20ir%20a%20cangearlo%20a%20la%20Emabazadora%20Ramirez%20(El Ganadero)%0A%0A*DETALLE:*%0A%0A*Nombre:*%20<?php echo $nombre ?>%0A*Valor:*%20<?php echo $valor ?>%20Pesos%0A*Abono:*%20<?php echo $abono ?>%20Pesos%0A*Deuda:*%20<?php echo $deuda ?>%20Pesos%0A%0A*RECUERDE*%20que%20posee%20un%20credito%20de%20hasta%2010%20dias%20para%20pagar. Realiza tu pago dentro de este plazo, vencido dicho crediito le haremos una visita de cobro reservandonos el derecho a un nuevo credito.%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";

                    }
                });
        </script>
<?php
        unset($_SESSION['NombreCliente']);
        unset($_SESSION['TelefonoCliente']);
        unset($_SESSION['valorBonoCliente']);
        unset($_SESSION['deudaCliente']);
        unset($_SESSION['AbonoCliente']);
        unset($_SESSION['message']);
    }
} ?>
<!-- ------------------------------------------------- -->

<h1 class="text-center">BONOS</h1>
<div class="container p-4">
    <div class="row">
        <?php
        if (isset($_SESSION["revertir"])) { ?>

            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    <button type="button" class="btn" onclick="window.location.href='revertirBonos.php'"><i class="fas fa-sync-alt"></i> Revertir</button>

                </div>
            </div>
        <?php
            unset($_SESSION['revertir']);
        }
        ?>
        <!-- boton de nueva factura -->
        <button type="button" onclick="location.href='save_taskBonos.php?id=0'" class="btn btn-primary btn-lg edicionButton"><i class="fas fa-plus"></i> Nueva Factura</button>
        <!--  -->
        <div class="table-responsive">


            <!-- tabla -->
            <table class="table table-striped table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Valor</th>
                        <th>Abono</th>
                        <th>Deuda</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaBusqueda">
                    <?php
                    $query = "SELECT * from bonos";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td> <a href="detalleBonos.php?id=<?php echo $row['ID'] ?>&idCliente=<?php echo $row['idCliente']; ?>" class="text-decoration-none text-dark"><?php echo $row['nombre']; ?></a></td>
                            <td><?php echo $row['valor']; ?></td>
                            <td><?php echo $row['abono']; ?></td>
                            <td><?php echo $row['deuda']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td>
                                <?php
                                $string1 = strval($contador);
                                $azul = "collapseExample$contador";
                                $contador = $contador + 1; ?>

                                <p>

                                    <a href="edit-bonos.php?id=<?php echo $row['ID'] ?>" class="btn btn-secondary ">Editar <i class="fas fa-edit"></i></a>
                                    <button class="btn btn-primary itemMenuLateral dropdown-toggle bg-primary text-white mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                        Opciones
                                    </button>
                                </p>
                                <div class="collapse" id="<?php echo $azul ?>">
                                    <div class="card card-body">
                                        <a href="abono-bonos.php?id=<?php echo $row['ID'] ?>" class="btn btn-info botonesOpciones text-white ">Abonar</a>
                                        <a class="btn btn-warning botonesOpciones text-white" onclick="confirmacionReenvioBonos(<?php echo $row['ID'] ?>)"> Factura</a>
                                        <a class="btn btn-danger botonesOpciones" onclick="confirmacionBono(<?php echo $row['ID'] ?>)">Eliminar</a>
                                        <a class="btn btn-success botonesOpciones" onclick="confirmacionPagoBono(<?php echo $row['ID'] ?>)">Pago</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>