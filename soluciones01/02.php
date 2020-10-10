<html>
<head>
</head>
<body>
<?php 
    /*Obtener un número al azar entre 1 y 9 y generar una la escalera 
    numérica del tamaño indicado alternando colores entre rojo y azul.*/


    $num = random_int(1,9);
    
    echo "Número generado ".$num;
    
    for ($i=1;$i<=$num;$i++){
        echo "<p style=\"color:";
        
        if($i%2==0) echo " red\">";
        else echo " blue\">";
        
        for ($j=1; $j<=$i;$j++){
            echo $i;
        }
        
        echo "</p>";
     
    }
?>
</body>
</html>