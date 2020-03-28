<?php 
include("conexion.php");
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$desc = $_POST['desc'];
$urlIma = $_POST['url'];

$query= "INSERT INTO tblproductos (Nombre, Precio, Descripcion, Imagen) VALUES( '$nombre', '$precio', '$desc', '$urlIma')";
$resultado = $con -> query($query);
 if($resultado){
    echo"se agrego exitosamente";

 }else{
    echo"se pudo agregar :(";
 }
?>