<?php
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM gas WHERE ID = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row["nombre"];
        $galones = $row["galones"];
        $precio = $row["precio"];
        $abono = $row["abono"];
        $comentario = $row["comentario"];
    }
    if (isset($_POST["actualizar"])) {
        if ($_POST['select'] == "" || $_POST['galones'] == "" || $_POST['precio'] == "") { ?>
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
                $galones = $_POST["galones"];
                $precio = $_POST["precio"];
                $abono = $_POST["abono"];
                $deuda = $precio - $abono;
                $comentario = $_POST["comentario"];
                
                $query = "UPDATE gas set nombre = '$nombre',galones= '$galones',precio= '$precio',abono= '$abono',Deuda= '$deuda', comentario = '$comentario' WHERE id = $id";
                mysqli_query($conn, $query);

            } else {
                $query = "SELECT nombre FROM clientes where id=$idCliente";
                $resultadoCliente = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($resultadoCliente);

                $id = $_GET["id"];
                $nombre = $row["nombre"];
                $galones = $_POST["galones"];
                $precio = $_POST["precio"];
                $abono = $_POST["abono"];
                $deuda = $precio - $abono;
                $comentario = $_POST["comentario"];

                $query = "UPDATE gas set nombre = '$nombre',galones= '$galones',precio= '$precio',abono= '$abono',Deuda= '$deuda', comentario = '$comentario', idCliente='$idCliente' WHERE id = $id";
                mysqli_query($conn, $query);
            }

    

            $_SESSION['messageEdit'] = 1; ?>
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

<div class="container p-4 shadow editwidth">
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <h1>Edicion</h1>
            <form action="edit.php?id=<?php echo $_GET["id"]; ?>" method="post">
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
                    <label for="galones">Galones</label>
                    <input type="number" name="galones" id="galones" value="<?php echo $galones ?>" class="form-control" placeholder="Edita la cantidad de galones">
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" value="<?php echo $precio ?>" class="form-control" placeholder="Edita el precio">
                </div>
                <div class="form-group">
                    <label for="abono">Abono</label>
                    <input type="number" id="abono" name="abono" value="<?php echo $abono ?>" class="form-control" placeholder="Edita el abono">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                    <textarea name="comentario" placeholder="Agrega un comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $comentario ?></textarea>
                </div>
                <button class="btn btn-success" name="actualizar">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>