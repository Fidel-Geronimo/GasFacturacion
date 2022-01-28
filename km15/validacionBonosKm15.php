<?php
include("../db.php");
include("headerkm15.php");
if (isset($_GET["id"])) {
    $idCliente = $_POST["select"];
    $valor = $_POST['valor'];
    $abono = $_POST['abono'];
    $comentario = ucfirst(strtolower($_POST['comentario']));

    $queryConfirmacion = "SELECT * FROM bonoskm15 where idCliente=$idCliente";
    $resultadoConfirmacion = mysqli_query($conn, $queryConfirmacion);


    if ($_POST['select'] == "Selecciona el cliente" || $_POST['valor'] == "") { ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Dejaste Algun Campo Vacio",
                icon: 'error',
                confirmButtonColor: '#007bff',
                confirmButtonText: "Ok",
            }).then((result) => {
                if (result.value) {
                    window.location.href = "save_taskBonosKm15.php?id=0&idCliente=<?php echo $idCliente ?>";
                }
            })
        </script>

        <?php } else {

        if (mysqli_num_rows($resultadoConfirmacion) > 0) { ?>
            <script>
                Swal.fire({
                    title: "Cuidado!",
                    text: "Este Cliente tiene facturas pendientes, Facuturar de todos modos?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#007bff",
                    confirmButtonText: "Sí, Facturar",
                    cancelButtonText: "No",
                }).then((resultado) => {
                    if (resultado.value) {
                        window.location.href = "save_taskBonosKm15.php?id=1&idCliente=<?php echo $idCliente ?>&valor=<?php echo $valor ?>&abono=<?php echo $abono ?>&comentario=<?php echo $comentario ?>";
                    } else {
                        window.location.href = "save_taskBonosKm15.php?id=0";
                    }
                });
            </script>
        <?php
        } else { ?>
            <script>
                window.location.href = "save_taskBonosKm15.php?id=1&idCliente=<?php echo $idCliente ?>&valor=<?php echo $valor ?>&abono=<?php echo $abono ?>&comentario=<?php echo $comentario ?>";
            </script>
<?php
        }
    }
}
