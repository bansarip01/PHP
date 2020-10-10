<html>
<head>
</head>
<body>
<?php 
    /*Generar números al azar entre 1 y 10 hasta que se 
    generen 3 veces el valor 6 de forma consecutiva en 
    ese caso se mostrará cuantos número se han generado.*/

    $tiempoInicio = microtime(true);
    $cont = 0;
    $aux = 0;
    while($cont<3){
        $num = random_int(1, 10);
        if ($num==6) $cont++;
        $aux++;
    }
    
    $tiempoFinal = (microtime(true)-$tiempoInicio)*1000;
    
    echo "Han salido tres 6 seguidos tras genera ";
    echo $aux." números en ".$tiempoFinal." milisegundos";
    
    


?>
</body>
</html>