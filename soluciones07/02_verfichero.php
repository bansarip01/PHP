<?php 
    /*Realizar un programa (verfichero.php) donde podamos indicar 
    un fichero de texto plano ( .txt, html o php por ejemplo) y que 
    me lo muestre por pantalla, informando del número de caracteres 
    y del número de líneas que contiene.*/
    
if(!empty($_POST['fichero'])){
    $fichero = $_POST['fichero'].".".$_POST['extension'];
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
<form action="02_verfichero.php" method="post">
<p>Nombre del fichero: <input type="text" name="fichero"></p>
<p>Extension del fichero: 
 TXT <input type="radio" name="extension" value="txt" checked>
 HTML <input type="radio" name="extension" value="html">
 PHP <input type="radio" name="extension" value="php">
</p>
<p><input type="submit" value="COMPROBAR"></p>
</form>
<div class="contenido">
<?php
    $msj="";
    // Obtenemos el contenido del fichero
    if(isset($fichero)){
        if(file_exists($fichero)){
            
            $totalCaracteres = 0;
            $contenidoFich = file($fichero);
            
            foreach ($contenidoFich as $linea){
                $totalCaracteres += strlen($linea);
                $msj.= $linea."<br>";
            }
            
            $totalLineas = sizeof($contenidoFich);
            $totalCaracteres -= ($totalLineas*2-2);
            
            $msj.= "<br>Total Lineas: ".$totalLineas."<br>";
                       
            $msj.= "<br>Total Caracteres: ".$totalCaracteres."<br>";
        }
        else{
            $msj .= "EL fichero ".$fichero." no existe";
        }
    }
        
    echo $msj;
    
 
?>
</div>
</div>
</body>
</html>