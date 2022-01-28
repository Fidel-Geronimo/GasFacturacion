<?php
include("../db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $query = "DELETE FROM clientekm15 WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['messageDelete'] = 1;

    header("Location: clientesKm15.php");
}
