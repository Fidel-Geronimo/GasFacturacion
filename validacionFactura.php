<?php
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {
    $idCliente = $_POST["select"];
    $galones = $_POST['galones'];
    $precio = $_POST['precio'];
    $abono = $_POST['abono'];
    $comentario = $_POST['comentario'];
    $queryConfirmacion = "SELECT * FROM gas where idCliente=$idCliente";
    $resultadoConfirmacion = mysqli_query($conn, $queryConfirmacion);


    if ($_POST['select'] == "Selecciona el cliente" || $_POST['galones'] == "" || $_POST['precio'] == "") { ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Dejaste Algun Campo Vacio",
                icon: 'error',
                confirmButtonColor: '#007bff',
                confirmButtonText: "Ok",
            }).then((result) => {
                if (result.value) {
                    window.location.href = "save_task.php?id=0&idCliente=<?php echo $idCliente ?>";
                }
            })
        </script>

        <?php } else {

        if (mysqli_num_rows($resultadoConfirmacion) > 0) { ?>
            <script>
                Swal.fire({
                    title: "Cuidado!",
                    text: "Este Cliente Tiene Facturas Pendientes, Desea Facuturar de Todos Modos?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#007bff",
                    confirmButtonText: "Sí, Facturar",
                    cancelButtonText: "No",
                }).then((resultado) => {
                    if (resultado.value) {
                        window.location.href = "save_task.php?id=1&idCliente=<?php echo $idCliente ?>&galones=<?php echo $galones ?>&precio=<?php echo $precio ?>&abono=<?php echo $abono ?>&comentario=<?php echo $comentario ?>";
                    } else {
                        window.location.href = "save_task.php?id=0";
                    }
                });
            </script>
        <?php
        } else { ?>
            <script>
                window.location.href = "save_task.php?id=1&idCliente=<?php echo $idCliente ?>&galones=<?php echo $galones ?>&precio=<?php echo $precio ?>&abono=<?php echo $abono ?>&comentario=<?php echo $comentario ?>";
            </script>
<?php
        }
    }
}
