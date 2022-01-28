<?php
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM gas WHERE ID = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $abonoAnterior = $row["abono"];
        $precio = $row["precio"];
        $comentario = $row["comentario"];
        $idCliente = $row["idCliente"];
        $deudaAnterior = $row["Deuda"];

        // informacion del cliente
        $queryCliente = "SELECT * FROM clientes WHERE ID = $idCliente";
        $resultadoCliente = mysqli_query($conn, $queryCliente);
        if (mysqli_num_rows($resultadoCliente) == 1) {
            $row = mysqli_fetch_array($resultadoCliente);
            $nombreCliente = $row["nombre"];
            $telefonoCliente = $row["telefono"];
        }
        // /////////////////
    }
    if (isset($_POST["Abonar"])) {
        $id = $_GET["id"];
        $abono = $_POST["abono"];
        if ($abono == "") { ?>
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Dejaste Algun campo vacio",
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: '#007bff',
                    icon: 'error'
                });
            </script>
        <?php
        } else {
            $nuevoAbono = $abono + $abonoAnterior;
            $deuda = $precio - $nuevoAbono;
            date_default_timezone_set('America/Caracas'); //Aplicandole zona horario a la hora
            $DateAndTime = date('d-m-y', time()); //capturacion de la hora actual
            if ($_POST["comentario"] == "") {
                $comentario = $comentario . " / " . "El " . $DateAndTime . " Abonó " . $abono . " pesos";
            } else {
                $comentario = $comentario . " / " . "El " . $DateAndTime . " Abonó " . $abono . " pesos --> " . " " . $_POST["comentario"];
            }
            $query = "UPDATE gas set deuda= '$deuda', abono='$nuevoAbono', comentario='$comentario' WHERE ID = $id";
            mysqli_query($conn, $query);
            $_SESSION['messageAbono'] = 1;
            $_SESSION['abono'] = $abono;
            $_SESSION['deuda'] = $deuda;
            $_SESSION['telefonoAbonoCliente'] = $telefonoCliente;
            $_SESSION['nombreAbonoAbonoCliente'] = $nombreCliente;
            $_SESSION['deudaAnterior'] = $deudaAnterior;
        ?>
            <script>
                window.location = "index.php";
            </script>
<?php

        }
    }
}
?>

<style>
    .editwidth {
        max-width: 540px !important;
    }
</style>
<!-- verificacion de inicio de sesion -->
<?php
if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
} else {
    if ($_SESSION["rol"] == 2) {
        header("Location: km15/facturacionkm15.php");
    }
}
?>
<!--  -->



<div class="responsive">
    <div class="container p-4 shadow editwidth">
        <div class="col-md-8 mx-auto">
            <div class="card_body">
                <div class="card_body">
                    <form action="abono-facturas.php?id=<?php echo $_GET["id"]; ?>" method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                            <textarea name="comentario" placeholder="Agrega un comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input name="abono" type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="botonCentro">
                            <button class="btn btn-success tamano" name="Abonar">
                                Abonar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("includes/footer.php"); ?>