<?php
    /*Realizar un programa (verdirinfo.php) donde podamos 
    indicar un nombre de directorio y me muestre los archivos 
    que lo componen indicando el nombre, el tipo de archivo (MIME) 
    y su tamaño en bytes. Mostrar la lista ordenada por tamaño.*/

    if(!empty($_POST['directorio'])){
        $directorio = $_POST['directorio'];
    }

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Forma de pago</title>
<style type="text/css">
.contenedor {
    margin: 50px;
    padding: 20px;
    border: 3px solid black;
}

h1 { text-align: center;
}

.contenido{
    padding: 20px;
    border: 2px solid black;
}

</style>
</head>
<body>
<div class="contenedor">
<h1>Ver Fichero</h1>
<form action="03_verdirinfo.php" method="post">
<p>Nombre del directorio: <input type="text" name="directorio"></p>
<p><input type="submit" value="COMPROBAR"></p>
</form>
<div class="contenido">
<?php 
    if(isset($directorio)){
        // Comprueba que realmente existe el directorio
        if (! is_dir($directorio)) die("No existe el directorio " . $directorio);
        
        // Abrimos el directorio
        $dir_cursor = @opendir($directorio) or die("Error al abrir el directorio");
        
        $contenidoDir=[];
        
        $entrada = readdir($dir_cursor); // lee primera entrada
        while ($entrada !== false) // mientras haya datos
        {
            if (is_file($directorio . "/" .$entrada)) {
                $tamaño = filesize($directorio . "/" . $entrada);
                $contenidoDir[$entrada]= $tamaño;
            } else{
                $contenidoDir[$entrada]= "Directorio";
            }
            
            $entrada = readdir($dir_cursor); // lee siguiente entrada
        }
        
        
        asort($contenidoDir);

        echo "<h3>Datos del directorio ".$directorio."</h3>";
        
        echo "<table border=1>";
        echo "<tr><th>Nombre</th><th>Tamaño</th></tr>";
        
        foreach ($contenidoDir as $clave => $size){
            echo "<tr><td>".$clave."</td><td>".$size."</td></tr>";
        }
        
        closedir($dir_cursor); // cerramos el directorio
    }

?>
</div>
</div>
</body>
</html>