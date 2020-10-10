<html>
<head>
</head>
<body>
<?php 
    /*Obtener un número al azar entre 1 y 9 y generar una 
    pirámide con ese número de peldaños.
    Utilizar la marca <code></code> para que la visualización 
    no se deforme por el tamaño de los espacio o una estilo 
    con tipo de letra monospace.*/
    
    $num = random_int(1,9);

    echo "Número generado ".$num."<br>";
    
    for($i=1;$i<=$num;$i++){
        echo "<p style=\"font-family: monospace\">";
        for($j=$num-$i;$j>=1;$j--){
           echo "&nbsp";
        }
        for($j=$i*2-1;$j>=1;$j--){
           echo "*";
        }
        echo "</p>";
    }




?>
</body>
</html>