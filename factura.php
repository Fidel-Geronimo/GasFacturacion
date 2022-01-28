<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM gas WHERE ID = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row["nombre"];
        $galones = $row["galones"];
        $precio = $row["precio"];
        $fecha = $row["fecha"];
        if ($galones == 6) {
            $tanque = "Tanque de 25 lbs";
        } else if ($galones == 12) {
            $tanque = "Tanque de 50 lbs";
        } else {
            $tanque = "Cilindro de gas";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            font-size: 12px;
            font-family: "Times New Roman";
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.producto,
        th.producto {
            width: 75px;
            max-width: 75px;
        }

        td.cantidad,
        th.cantidad {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.precio,
        th.precio {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .oculto-impresion,
            .oculto-impresion * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <img src="img/cilindro.ico" alt="Logotipo">
        <p class="centrado">GuayoGas
            <br>Embazadora Ramirez
            <br><?php echo $fecha ?>
        </p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">RD$</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="cantidad">1.00</td>
                    <td class="producto"><?php echo $tanque ?></td>
                    <td class="precio"><?php echo $precio ?>$</td>
                </tr>
            </tbody>
        </table>
        <p class="centrado"><?php echo $nombre ?>
            <br>¡GRACIAS POR SU COMPRA!
            <br>Contacto: 809-967-4384

        </p>
    </div>
    <button class="oculto-impresion" onclick="imprimir()">Imprimir</button>
</body>
<script>
    function imprimir() {
        window.print();
    }
</script>

</html>