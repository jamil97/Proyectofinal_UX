<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php if ($mensaje!="") {?>
<div class="alert alert-success">
<!-- Imprime si el ID esta correcto al momento de agregar.-->
<?php echo $mensaje;?> 
<a href="mostrarCarrito.php" class= "badge badge-success" > Carrito de Compras</a>
</div>
<?php }?>

    <div class="row">
        <?php
            $sentencia=$pdo->prepare("SELECT * FROM tblproductos");
            $sentencia->execute(); //Permite ejecutar la sentencia anterior
            $listaProductos=$sentencia ->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach($listaProductos as $productos){ ?>
            <div class="col-3">
            <div class="card">
                <img title=<?php echo $productos['Nombre']?> 
                alt="Titulo" 
                class="card-img-top" 
                src="<?php echo $productos['Imagen']?>" 
                data-toggle="popover"
                data-trigger = "hover"
                data-content= "<?php echo $productos['Descripcion']?>" 
                height="317px"
                >
                <div class="card-body">
                    <span><?php echo $productos['Nombre']?></span>
                    <h5 class="card-title">$<?php echo $productos['Precio']?></h5>
                    <p class="card-text">Descripcion</p>
                    <form action="" method="post">
                    <!--Encriptaciones-->
                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($productos['ID'],COD,KEY);?>">
                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['Nombre'],COD,KEY);?>">
                        <input type="hidden" name="precio" id="" value="<?php echo openssl_encrypt($productos['Precio'],COD,KEY);?>">
                        <input type="hidden" name="cantidad" id="" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                    <!--Encriptaciones-->
                        <button class="btn btn-primary" 
                             name="btnAccion" value="Agregar" type="submit">Agregar al Carrito
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
        <?php }  ?>

       
    </div>

</div>

    <script>
        $(function () {
        $('[data-toggle="popover"]').popover()
         });
    </script>
<?php
include 'templates/pie.php';
?>
