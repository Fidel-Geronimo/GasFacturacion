<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    // info del cliente
    $queryFactura = "SELECT * FROM gas WHERE id = $id";
    $resultadoFactura = mysqli_query($conn, $queryFactura);


    if (mysqli_num_rows($resultadoFactura) == 1) {
        $row = mysqli_fetch_array($resultadoFactura);
        $idCliente = $row["idCliente"];

        $queryCliente = "Select * from clientes where id= $idCliente";
        $resultadoCliente = mysqli_query($conn, $queryCliente);
        if (mysqli_num_rows($resultadoCliente) == 1) {
            $rowCliente = mysqli_fetch_array($resultadoCliente);
            $nombreCliente = $rowCliente["nombre"];
            $telefonoCliente = $rowCliente["telefono"];
        }

        // formateamos la tabla de revertir en la base de datos
        $queryReset = "DELETE FROM revertir";
        mysqli_query($conn, $queryReset);
        $queryRevertir = "SELECT * FROM gas WHERE id= $id";
        $resultadoRevertir = mysqli_query($conn, $queryRevertir);
        if (mysqli_num_rows($resultadoRevertir) == 1) {
            $rowRevertir = mysqli_fetch_array($resultadoRevertir);
            $id = $rowRevertir["id"];
            $nombre = $rowRevertir["nombre"];
            $fecha = $rowRevertir["fecha"];
            $galones = $rowRevertir["galones"];
            $precio = $rowRevertir["precio"];
            $abono = $rowRevertir["abono"];
            $deuda = $rowRevertir["Deuda"];
            $credito = $rowRevertir["credito"];
            $comentario = $rowRevertir["comentario"];
            $idCliente = $rowRevertir["idCliente"];

            $queryRespaldo = "INSERT INTO revertir(id, nombre, fecha, galones,precio,abono,Deuda,credito,comentario,idCliente) VALUES('$id','$nombre','$fecha','$galones','$precio','$abono', '$deuda', '$credito','$comentario','$idCliente')";
            mysqli_query($conn, $queryRespaldo);
        }

        $query = "DELETE FROM gas WHERE id = $id";
        $resultado = mysqli_query($conn, $query);
    }

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['messagePago'] = 1;
    $_SESSION['nombreCliente'] = $nombreCliente;
    $_SESSION['telefonoCliente'] = $telefonoCliente;
    $_SESSION["revertir"] = 1;

    header("Location: index.php");
}
