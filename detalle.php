<?php include("db.php");

if (isset($_GET["id"])) {
    // datos del cliente

    $id = $_GET["id"];
    $idCliente = $_GET['idCliente'];
    $queryCliente = "select * from clientes where id=$idCliente";
    $resultadoCliente = mysqli_query($conn, $queryCliente);

    if (mysqli_num_rows($resultadoCliente) == 1) {
        $rowCliente = mysqli_fetch_array($resultadoCliente);
        $nombreCliente = $rowCliente["nombre"];
        $telefonoCliente = $rowCliente["telefono"];
        $direccionCliente = $rowCliente["direccion"];
        $comentarioCliente = $rowCliente["comentario"];
    } else {
        $nombreCliente = "Vacio";
        $telefonoCliente = "Vacio";
        $direccionCliente = "Vacio";
        $comentarioCliente = "Vacio";
    }

    // ......................................................................

    // Comentario de la factura
    $query = "select comentario from gas where id =$id ";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $comentario = $row['comentario'];
    }
}
// .................................................................................
?>

<!--  -->
<?php include("includes/header.php"); ?>
<div class="container p-4 shadow editwidth">
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                <textarea name="comentario" placeholder="Vacio" disabled class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $comentario ?></textarea>
            </div>
            <p>
                <a class="btn btn-success" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Ver Informacion del cliente</a>
            </p>
            <div class="row">
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nombreCliente" class="form-label">Nombre del cliente</label>
                                    <input type="text" value="<?php echo $nombreCliente ?>" class="form-control" id="nombreCliente" aria-describedby="nombreCliente" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="telefonoCliente" class="form-label">Telefono del cliente</label>
                                    <input type="text" value="<?php echo $telefonoCliente ?>" class="form-control" id="telefonoCliente" aria-describedby="telefonoCliente" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Direccion del cliente</label>
                                    <textarea name="comentario" placeholder="Vacio" disabled class="form-control" id="direccion" rows="3"><?php echo $direccionCliente ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Comentario</label>
                                    <textarea name="comentario" placeholder="Vacio" disabled class="form-control" id="direccion" rows="3"><?php echo $comentarioCliente ?></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("includes/footer.php"); ?>