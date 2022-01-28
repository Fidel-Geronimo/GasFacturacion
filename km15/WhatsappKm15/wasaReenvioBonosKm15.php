<?php
include("../../db.php");

if (isset($_GET["idCliente"])) {
    $idCliente = $_GET["idCliente"];
    $queryFactura = "SELECT * FROM bonoskm15 WHERE idCliente = $idCliente";
    $resultadoFactura = mysqli_query($conn, $queryFactura);

    $query = "SELECT * FROM clientekm15 WHERE id= $idCliente";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {
        if (mysqli_num_rows($resultadoFactura) > 0) {
            $rowFactura = mysqli_fetch_array($resultadoFactura);
            $rowCliente = mysqli_fetch_array($resultado);

            $deuda = $rowFactura["deuda"];
            $valor = $rowFactura["valor"];
            $abono = $rowFactura["abono"];
            $nombre = $rowCliente["nombre"];
            $telefono = $rowCliente["telefono"]; ?>
            <script>
                window.location = "https://wa.me/1<?php echo $telefono ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A%0A*FACTURA:*%0A%0AMensaje%20Dirigido%20A:%20<?php echo $nombre ?>%0A%0AHa%20recibido%20un%20bono%20de%20<?php echo $valor ?>%20pesos,%20recuerda%20ir%20a%20cangearlo%20a%20la%20Embazadora%20Ramirez%20(El Ganadero)%0A%0A*DETALLE:*%0A%0A*Nombre:*%20<?php echo $nombre ?>%0A*Valor:*%20<?php echo $valor ?>%20Pesos%0A*Abono:*%20<?php echo $abono ?>%20Pesos%0A*Deuda:*%20<?php echo $deuda ?>%20Pesos%0A%0A*Recuerde*%20que%20posee%20un%20credito%20de%20hasta%2010%20dias%20para%20pagar%20el%20dinero%20restante.%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";
            </script>
        <?php
        } else { ?>
            <script>
                alert("Informacion del cliente no encontrada");
            </script>
        <?php

        }
    } else { ?>
        <script>
            alert("Informacion del cliente no encontrada");
        </script>
<?php }
}
?>