<?php include("../db.php"); ?>
<?php
if ($_SESSION["rol"] == 1) {
    include("headerKM15Guayo.php");
} else {
    include("headerkm15.php");
}
?>

<!-- MENSAJES QUE APARECEN AL HACER ACCIONES -->
<?php
// mensaje de abono
if (isset($_SESSION['messageAbono'])) { ?>
    <script>
        Swal.fire({
            title: "Factura Abonada Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageAbono']);
}
// mensaje de pago
if (isset($_SESSION['messagePago'])) { ?>
    <script>
        Swal.fire({
            title: "Factura Marcada como pago",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messagePago']);
}
?>
<h1 class="text-center">COBROS KM15</h1>
<div class="container p-4">
    <div class="row">

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Galones</th>
                        <th>Precio</th>
                        <th>Abono</th>
                        <th>Fecha</th>
                        <th>Deuda</th>
                        <th>Credito</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaBusqueda">
                    <!-- actualiza la tabla en el valor de credito -->
                    <?php
                    $query = "SELECT * from gaskm15";
                    $result_facturacion = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <?php

                        date_default_timezone_set('America/Caracas'); //se le aplica formato a la fecha
                        $DateAndTime = date('y-m-d h:i:s a', time()); // se guarda la fecha y la hora actual
                        $date1 = new DateTime($row['fecha']); // se captura la fecha de la factura
                        $date2 = new DateTime($DateAndTime); // se captura la fecha actual y DateTime le cambia el formato
                        $diff = $date1->diff($date2); //Calcula la diferencia de tiempo
                        $repuesta = $diff->days; //calcula la diferencia de dias

                        if ($repuesta >= 9) {
                            $id = $row['id'];
                            $credito = "Agotado";
                            $query = "UPDATE gaskm15 set credito = '$credito' WHERE id = $id";
                            $resultado = mysqli_query($conn, $query);
                        }
                        ?>
                    <?php } ?>


                    <!-- muestra las personas que ya deben pagar -->
                    <?php
                    $query = "SELECT * FROM gaskm15 WHERE credito = 'Agotado'";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td><a href="detalleKm15.php?id=<?php echo $row['id'] ?>&idCliente=<?php echo $row['idCliente']; ?>" class="text-decoration-none text-dark"><?php echo $row['nombre']; ?></a></td>
                            <td><?php echo $row['galones']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['abono']; ?></td>
                            <td><?php echo $row['fecha'] ?></td>
                            <td><?php echo $row['Deuda']; ?></td>
                            <td><?php echo $row['credito']; ?></td>
                            <td>

                                <!-- boton collapse-->

                                <?php
                                $string1 = strval($contador);
                                $azul = "collapseExample$contador";
                                $contador = $contador + 1; ?>

                                <a class="nav-link">
                                    <li class="list-group-item itemMenuLateral dropdown-toggle bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                        Opciones
                                    </li>
                                </a>
                                <div class="collapse" id="<?php echo $azul ?>">
                                    <div class="card card-body">
                                        <a href="WhatsappKm15/wasa.php?idCliente=<?php echo $row['idCliente'] ?>" class="btn btn-success botonesOpciones"><i class="fab fa-whatsapp"></i></a>
                                        <a href="abonokm15.php?id=<?php echo $row['id'] ?>" class="btn btn-primary botonesOpciones">Abonar</i></a>
                                        <a class="btn btn-danger botonesOpciones" onclick="confirmacionPagoKm15(<?php echo $row['id'] ?>)">Pago</a>
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


<?php include("footerkm15.php"); ?>