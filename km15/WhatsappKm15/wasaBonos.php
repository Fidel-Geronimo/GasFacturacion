<?php
include("../../db.php");

if (isset($_GET["idCliente"])) {
    $idCliente = $_GET["idCliente"];

    $queryFactura = "SELECT * FROM bonoskm15 WHERE idCliente = $idCliente";
    $resultadoFactura = mysqli_query($conn, $queryFactura);


    $query = "SELECT * FROM clientekm15 WHERE id= $idCliente";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {
        if (mysqli_num_rows($resultadoFactura) == 1) {
            $rowFactura = mysqli_fetch_array($resultadoFactura);
            $rowCliente = mysqli_fetch_array($resultado);

            $deuda = $rowFactura["Deuda"];
            $nombreCliente = $rowCliente["nombre"];
            $telefonoCliente = $rowCliente["telefono"];

            header("Location: https://wa.me/1$telefonoCliente?text=*MENSAJE AUTOMATICO*%0ASaludos%20$nombreCliente%20su%20Factura%20de%20Gas%20esta%20*Vencida*%0A%0AFavor%20comunicarse%20lo%20mas%20pronto%20posible%20para%20no%20perder%20su%20credito%0A%0A*Deuda%20Pendiente%20=%20$deuda%20Pesos*%0ALe%20Exhortamos%20que%20pague%20su%20factura%20lo%20antes%20posible.%0A%0AAtt:%20Guayo%20Gas");
        }
    } else { ?>
        <script>
            alert("Informacion del cliente no encontrada");
        </script>
<?php }
}
?>