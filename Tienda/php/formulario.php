<!DOCTYPE html>
<html>
<head>
    
    <title>Guardar</title>

</head>
<body>
    <center>
        <form action="guardar.php" method="POST">
            <input type="text" required name ="nombre" placeholder="Nombre" value="">
            <input type="text" required name ="precio" placeholder="Precio" value="">
            <input type="text" required name ="desc" placeholder="Descripcion" value="">
            <input type="text" required name ="url" placeholder="Imagen url" value="">
            <input type="submit" value="Guardar">
        </form>
    </center>
</body>
</html>