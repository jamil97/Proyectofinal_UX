<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php if ($_POST) {


    $total=0;
    $SID=session_id();
    $Correo=$_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice=>$producto) {
        $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }
    $sentencia=$pdo->prepare("INSERT INTO `tblVentas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) 
    VALUES (NULL, :ClaveTransaccion, '', NOW(),:Correo, :Total, 'Pendiente');");
    $sentencia->bindParam(":ClaveTransaccion",$SID);
    $sentencia->bindParam(":Correo",$Correo);
    $sentencia->bindParam(":Total",$total);
    $sentencia->execute();
    $idVenta=$pdo->lastInsertId();

    foreach ($_SESSION['CARRITO'] as $indice=>$producto) {


        $sentencia=$pdo->prepare("INSERT INTO 
        `tblDetalleVenta` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
        VALUES (NULL,:IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");

        $sentencia->bindParam(":IDVENTA",$idVenta);
        $sentencia->bindParam(":IDPRODUCTO",$producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
        $sentencia->execute();

    }
} 
?>

<div class="jumbotron text-center">
    <h1 class="display-4">Paso Final!</h1>
    <hr class="my-4">
    <p class="lead"> Estas a punto de pagar con Paypal la cantidad de: 
        <h4>$<?php echo number_format($total,2);?></h4>
          <!-- Set up a container element for the button PAYPAL -->
        <div id="paypal-button-container"></div>
    </p>
    <p>Los productos se procesaran una vez que se procese el pago. </p>
</div>

<!-- PAGO CON PAYPAL (AUTOGENERADO DE LA PAGINA OFICIAL) -->
<!DOCTYPE html>

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>

<body>
  

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            }

        }).render('#paypal-button-container');
    </script>
</body>
<!-- PAGO CON PAYPAL (AUTOGENERADO DE LA PAGINA OFICIAL) -->

<?php include 'templates/pie.php';?>