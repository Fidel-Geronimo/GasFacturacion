<?php
include("../db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    // formateamos la tabla de revertir en la base de datos
    $queryReset = "DELETE FROM revertirkm15";
    mysqli_query($conn, $queryReset);

    $queryRevertir = "SELECT * FROM gaskm15 WHERE id= $id";
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

        $queryRespaldo = "INSERT INTO revertirkm15(id, nombre, fecha, galones,precio,abono,Deuda,credito,comentario,idCliente) VALUES('$id','$nombre','$fecha','$galones','$precio','$abono', '$deuda', '$credito','$comentario','$idCliente')";
        mysqli_query($conn, $queryRespaldo);
    }
    $query = "DELETE FROM gaskm15 WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['messageDelete'] = 1;
    $_SESSION["revertir"] = 1;

    header("Location: facturacionkm15.php");
}
