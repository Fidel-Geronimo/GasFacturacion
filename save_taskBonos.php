<?php
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  if ($id == 1) {

    // informacion del cliente a travez del id capturado
    $idCliente = $_GET["idCliente"];
    $query = "SELECT * FROM clientes where id=$idCliente";
    $resultadoCliente = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($resultadoCliente);
    $telefono = $row["telefono"];

    $nombre = $row["nombre"];
    $valor = $_GET['valor'];
    $abono = $_GET['abono'];
    $comentario = ucfirst(strtolower($_GET['comentario']));
    $credito = "Valido";
    if (!$abono) {
      $abono = 0;
      $deuda = $valor - $abono;
    } else {
      $deuda = $valor - $abono;
    }
    date_default_timezone_set('America/Caracas'); //Aplicandole zona horario a la hora
    $DateAndTime = date('d-m-y', time()); //capturacion de la hora actual
    if ($_GET["abono"] != "") {
      $comentario = $comentario . " / " . "El " . $DateAndTime . " Abonó " . $abono . " pesos";
    }
    $query = "INSERT INTO bonos(nombre, valor, abono, deuda,credito,comentario,idCliente) VALUES('$nombre','$valor','$abono', '$deuda', '$credito','$comentario,','$idCliente')";

    mysqli_query($conn, $query);

    $_SESSION['message'] = 1;
    $_SESSION['NombreCliente'] = $nombre;
    $_SESSION['TelefonoCliente'] = $telefono;
    $_SESSION['valorBonoCliente'] = $valor;
    $_SESSION['deudaCliente'] = $deuda;
    $_SESSION['AbonoCliente'] = $abono; ?>
    <script>
      window.location = "bonos.php"
    </script>
<?php
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
      <form action="validacionBonos.php?id=1" method="post">
        <div class="form-group">
          <!--  -->
          <div class="form-group mb-2">
            <label>Cliente:</label>
            <select name="select" id="controlBuscador" class="form-select" aria-label=".form-select-lg example">
              <option selected>Selecciona el cliente</option>
              <?php while ($ver = mysqli_fetch_row($result)) { ?>
                <option value="<?php echo $ver[0] ?>">
                  <?php echo $ver[1] ?>
                </option>

              <?php  } ?>
            </select>
            <!--  -->
          </div>
          <div class="form-group mb-2">
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" class="form-control" placeholder="Valor del bono">
          </div>
          <div class="form-group mb-2">
            <label for="abono">Abono</label>
            <input type="number" id="abono" name="abono" class="form-control" placeholder="Abono del cliente">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
            <textarea name="comentario" placeholder="Agrega un comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
          <button class="btn btn-success" name="facturar-bonos">
            Facturar
          </button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#controlBuscador').select2();
  });
</script>
<?php include("includes/footer.php"); ?>