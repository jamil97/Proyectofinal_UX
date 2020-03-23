<?php 
//Verifica los datos y los desencripta al momento de agregar al carrito
session_start();


$mensaje="";
if (isset($_POST['btnAccion'])) {

    switch ($_POST['btnAccion']) {
        case 'Agregar':
            //Validacion de ID
            if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje.="ID Correcto ".$ID."<br/>";
            } else {
                $mensaje="ID Incorrecto";
            }

            //Validacion de Nombre 
            if (is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="Nombre Correcto ".$NOMBRE."<br/>";
            } else {
                $mensaje="Nombre Incorrecto"; 
            
            break;
            }

            //Validacion de Cantidad
            if (is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="Cantidad Correcta ".$CANTIDAD."<br/>";
            } else {
                $mensaje="Cantidad Incorrecta";

            break;
            }

            //Validacion de Precio
            if (is_string(openssl_decrypt($_POST['precio'],COD,KEY))){
                $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                $mensaje.="Precio Correcto ".$PRECIO."<br/>";

            } else {
                $mensaje="Precio Incorrecto";
            break;
            }
            //Verificamos si la variable de sesion esta nula.
            //Empezamos a agregar al carrito
            if (!isset($_SESSION['CARRITO'])) {
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO
                );
                $_SESSION['CARRITO'][0]=$producto;

            } else {
                $NumeroProductos=count($_SESSION['CARRITO']);
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO
                );
                $_SESSION['CARRITO'][$NumeroProductos]=$producto;
            }
            $mensaje="Producto agregado al carrito ";

        break;

        //Boton eliminar del carrito.
        case "Eliminar":
            if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);

                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                    if ($producto['ID']==$ID) {
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento Eliminado');</script>";
                    }    
                }
            } else {

            }

        break;

    }
}
?>