<?php

include("db.php");

$queryRevertir = "SELECT * FROM revertir";
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

    $queryRespaldo = "INSERT INTO gas(nombre, fecha, galones,precio,abono,Deuda,credito,comentario,idCliente) VALUES('$nombre','$fecha','$galones','$precio','$abono', '$deuda', '$credito','$comentario','$idCliente')";
    mysqli_query($conn, $queryRespaldo);
}


header("Location: index.php");
