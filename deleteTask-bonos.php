<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    // formateamos la tabla de revertir en la base de datos
    $queryReset = "DELETE FROM revertirbonos";
    mysqli_query($conn, $queryReset);
    // .............................................

    $queryRevertir = "SELECT * FROM bonos WHERE id= $id";
    $resultadoRevertir = mysqli_query($conn, $queryRevertir);
    if (mysqli_num_rows($resultadoRevertir) == 1) {

        $rowRevertir = mysqli_fetch_array($resultadoRevertir);
        $id = $rowRevertir["ID"];
        $nombre = $rowRevertir["nombre"];
        $fecha = $rowRevertir["fecha"];
        $valor = $rowRevertir["valor"];
        $abono = $rowRevertir["abono"];
        $deuda = $rowRevertir["deuda"];
        $credito = $rowRevertir["credito"];
        $comentario = $rowRevertir["comentario"];
        $idCliente = $rowRevertir["idCliente"];

        $queryRespaldo = "INSERT INTO revertirBonos(id, nombre,fecha, valor,abono,Deuda,credito,comentario,idCliente) VALUES('$id','$nombre', '$fecha','$valor','$abono', '$deuda', '$credito','$comentario','$idCliente')";
        mysqli_query($conn, $queryRespaldo);
    }

    $query = "DELETE FROM bonos WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['messageDelete'] = 1;
    $_SESSION["revertir"] = 1;

    header("Location: bonos.php");
}
