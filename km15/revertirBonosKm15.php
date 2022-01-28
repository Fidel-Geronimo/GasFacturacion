<?php

include("../db.php");

$queryRevertir = "SELECT * FROM revertirbonoskm15";
$resultadoRevertir = mysqli_query($conn, $queryRevertir);
if (mysqli_num_rows($resultadoRevertir) == 1) {
    $rowRevertir = mysqli_fetch_array($resultadoRevertir);
    $id = $rowRevertir["id"];
    $nombre = $rowRevertir["nombre"];
    $fecha = $rowRevertir["fecha"];
    $valor = $rowRevertir["valor"];
    $abono = $rowRevertir["abono"];
    $deuda = $rowRevertir["Deuda"];
    $credito = $rowRevertir["credito"];
    $comentario = $rowRevertir["comentario"];
    $idCliente = $rowRevertir["idCliente"];

    $queryRespaldo = "INSERT INTO bonoskm15(nombre,fecha, valor, abono, deuda,credito,comentario,idCliente) VALUES('$nombre','$fecha','$valor','$abono', '$deuda', '$credito','$comentario,','$idCliente')";
    mysqli_query($conn, $queryRespaldo);
}


header("Location: bonosKm15.php");
