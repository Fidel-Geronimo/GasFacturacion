<?php include("../db.php"); ?>
<!-- verificacion de inicio de sesion -->
<?php

if ($_SESSION["rol"] == 1) {
    include("headerKM15Guayo.php");
} else {
    include("headerkm15.php");
}
?>
<h1 class="text-center">COBRO DE LOS BONOS KM15</h1>
<div class="container p-4">
    <div class="row">

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="example">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Valor</th>
                        <th>Abono</th>
                        <th>Deuda</th>
                        <th>Fecha</th>
                        <th>Credito</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaBusqueda">
                    <!-- actualiza la tabla en el valor de credito -->
                    <?php
                    $query = "SELECT * from bonoskm15";
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
                            $id = $row['ID'];
                            $credito = "Agotado";
                            $query = "UPDATE bonoskm15 set credito = '$credito' WHERE ID = $id";
                            $resultado = mysqli_query($conn, $query);
                        }

                        ?>
                    <?php } ?>

                    <!-- muestra las personas que ya deben pagar -->
                    <?php
                    $query = "SELECT * FROM bonoskm15 WHERE credito = 'Agotado'";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td> <a href="detalleBonosKm15.php?id=<?php echo $row['ID'] ?>&idCliente=<?php echo $row['idCliente']; ?>" class="text-decoration-none text-dark"><?php echo $row['nombre']; ?></a></td>
                            <td><?php echo $row['valor']; ?></td>
                            <td><?php echo $row['abono']; ?></td>
                            <td><?php echo $row['deuda']; ?></td>
                            <td><?php echo $row['fecha'] ?></td>
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
                                        <a href="WhatsappKm15/wasaBonos.php?idCliente=<?php echo $row['idCliente'] ?>" class="btn btn-success botonesOpciones"><i class="fab fa-whatsapp"></i></a>
                                        <a href="abono-bonosKm15.php?id=<?php echo $row['ID'] ?>" class="btn btn-primary botonesOpciones">Abonar</a>
                                        <a class="btn btn-danger botonesOpciones" onclick="confirmacionPagoBonoKm15(<?php echo $row['ID'] ?>)">Pago</a>
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