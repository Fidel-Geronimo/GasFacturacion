<?php
include("../db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $queryFactura = "SELECT * FROM gas WHERE id = $id";
    $resultadoFactura = mysqli_query($conn, $queryFactura);
    $rowFactura = mysqli_fetch_array($resultadoFactura);
    $idCliente = $rowFactura["idCliente"];

    $query = "SELECT * FROM clientes WHERE id= $idCliente";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) >= 1) {
        if (mysqli_num_rows($resultadoFactura) >= 1) {

            $rowCliente = mysqli_fetch_array($resultado);

            $deuda = $rowFactura["Deuda"];
            $nombreCliente = $rowCliente["nombre"];
            $telefonoCliente = $rowCliente["telefono"];

            header("Location: https://wa.me/1$telefonoCliente?text=*MENSAJE AUTOMATICO GUAYO*%0ASaludos%20*$nombreCliente*%20su%20Factura%20de%20Gas%20esta%20*VENCIDA*%0A%0AFavor%20comunicarse%20lo%20mas%20pronto%20posible%20para%20no%20perder%20su%20credito%0A%0A*Deuda%20Pendiente%20=%20$deuda%20Pesos*%0ALe%20Exhortamos%20que%20pague%20su%20factura%20lo%20antes%20posible.%0Aatt.%20GUAYO.");
        }
    } else { ?>
        <script>
            alert("Informacion del cliente no encontrada");
        </script>
<?php }
}
?>