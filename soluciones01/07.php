<html>
<head>
</head>
<body>
<?php 
    /*Elegir tres valores entre 100 y 500 y pintar tres barras 
    de color rojo, verde y azul del tamaño indicado.
    Pista: Utilizar  3 tablas con una fila del tamaño generado.*/
   
    echo "<table>";
    echo "<tr><th style=\"background-color: red;";
    generarTamaño("Rojo");
    echo "</table>";
    
    echo "<table>";
    echo "<tr><th style=\"background-color: green;";
    generarTamaño("Verde");
    echo "</table>";
    
    echo "<table>";
    echo "<tr><th style=\"background-color: blue;";
    generarTamaño("Azul");
    echo "</table>";
    
    
    /*Investigar como podemos hacer que la página se cargase de 
    forma automática cada 5 segundos para mostrar distintos valores.*/
    header( "refresh:5");
    
    function generarTamaño($msj){
        $num = random_int(100, 500);       
        echo " width: ".$num."px\">";
        echo $msj."(".$num.")";
    }

?>
</body>
</html>