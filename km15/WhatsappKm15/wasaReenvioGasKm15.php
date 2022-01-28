<?php
include("../../db.php");

if (isset($_GET["idCliente"])) {
    $idCliente = $_GET["idCliente"];
    $queryFactura = "SELECT * FROM gaskm15 WHERE idCliente = $idCliente";
    $resultadoFactura = mysqli_query($conn, $queryFactura);

    $query = "SELECT * FROM clientekm15 WHERE id= $idCliente";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {
        if (mysqli_num_rows($resultadoFactura) > 0) {
            $rowFactura = mysqli_fetch_array($resultadoFactura);
            $rowCliente = mysqli_fetch_array($resultado);

            $deuda = $rowFactura["Deuda"];
            $galones = $rowFactura["galones"];
            $precio = $rowFactura["precio"];
            $abono = $rowFactura["abono"];
            $nombreCliente = $rowCliente["nombre"];
            $telefonoCliente = $rowCliente["telefono"]; ?>
            <script>
                window.location = "https://wa.me/1<?php echo $telefonoCliente ?>?text=*MENSAJE%20AUTOMATICO%20GUAYO*%0A%0A*FACTURA:*%0A%0AMensaje%20Dirigido%20A:%20<?php echo $nombreCliente ?>%0A%0AGracias%20por%20la%20Compra%20de%20su%20cilindro%20de%20gas%20de%20<?php echo $galones ?>%20Galones%0A%0A*DETALLE:*%0A%0A*Nombre:*%20<?php echo $nombreCliente ?>%0A*Precio:*%20<?php echo $precio ?>%20Pesos%0A*Galones:*%20<?php echo $galones ?>%20Galones%0A*Abono:*%20<?php echo $abono ?>%20Pesos%0A*Deuda:*%20<?php echo $deuda ?>%20Pesos%0A%0A*Recuerde*%20que%20posee%20un%20credito%20de%20hasta%2010%20dias%20para%20pagar%20el%20dinero%20restante.%0A%0A*GRACIAS%20POR%20PREFERIRNOS*";
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