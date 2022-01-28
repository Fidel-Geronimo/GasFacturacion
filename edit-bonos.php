<?php
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM bonos WHERE ID = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row["nombre"];
        $valor = $row["valor"];
        $abono = $row["abono"];
        $comentario = $row["comentario"];
    }
    if (isset($_POST["actualizarBonos"])) {
        if ($_POST['select'] == "Selecciona el cliente" || $_POST['valor'] == "") { ?>
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
            $idCliente = $_POST["select"];
            if ($nombre == $idCliente) {
                $nombre = $nombre;
                $id = $_GET["id"];
                $valor = $_POST["valor"];
                $abono = $_POST["abono"];
                $deuda = $valor - $abono;
                $comentario = $_POST["comentario"];
                $query = "UPDATE bonos set nombre = '$nombre',valor= '$valor',abono= '$abono',Deuda= '$deuda', comentario = '$comentario' WHERE id = $id";
                mysqli_query($conn, $query);
            } else {
                $query = "SELECT nombre FROM clientes where id=$idCliente";
                $resultadoCliente = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($resultadoCliente);

                $id = $_GET["id"];
                $nombre = $row["nombre"];
                $valor = $_POST["valor"];
                $abono = $_POST["abono"];
                $deuda = $valor - $abono;
                $comentario = $_POST["comentario"];
                $query = "UPDATE bonos set nombre = '$nombre',valor= '$valor',abono= '$abono',Deuda= '$deuda', comentario = '$comentario', idCliente='$idCliente' WHERE id = $id";
                mysqli_query($conn, $query);
            }

          

            $_SESSION['messageEdit'] = 1; ?>
            <script>
                window.location = "bonos.php";
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

<div class="container p-4 shadow editwidth">
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <h1>Edicion</h1>
            <form action="edit-bonos.php?id=<?php echo $_GET["id"]; ?>" method="post">
                <div class="form-group">
                    <select name="select" id="controlBuscador" class="form-select" aria-label=".form-select-lg example">
                        <option selected><?php echo $nombre ?></option>
                        <?php while ($ver = mysqli_fetch_row($result)) { ?>
                            <option value="<?php echo $ver[0] ?>">
                                <?php echo $ver[1] ?>
                            </option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor del bono</label>
                    <input type="number" id="valor" name="valor" value="<?php echo $valor ?>" class="form-control" placeholder="Edita el valor">
                </div>
                <div class="form-group">
                    <label for="abono">Abono</label>
                    <input type="number" id="abono" name="abono" value="<?php echo $abono ?>" class="form-control" placeholder="Edita el abono">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                    <textarea name="comentario" placeholder="Agrega un comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $comentario ?></textarea>
                </div>
                <button class="btn btn-success" name="actualizarBonos">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>