<html>
<head>
	<style type="text/css">
	   table { border-collapse: collapse;}
       table, th, td { border: 1px solid black;}
       th {background-color: black;
           color: white;}
	</style>
</head>
<body>
    <?php 
    
        /*Realizar un programa en php que genere 50 n�meros aleatorios en 
        1 y 100 y que muestre en una tabla  html el valor m�ximo, el m�nimo 
        y la media con el siguiente formato:
        Nota definir los valores 50 y 100 como constantes en PHP (define)*/
        
        define('CINCUENTA',50);
        define('CIEN',100);
        
        $num = random_int(1,CIEN);
        $min = $num;
        $max = $num;
        $total = $num;
    
        
        for ($i=1; $i<CINCUENTA;$i++){
            $num = random_int(1,CIEN);
             
            if ($num < $min) $min = $num;
            
            if ($num > $max) $max = $num;
            
            $total += $num;
            
        }
        
        $media = $total / CINCUENTA;
        
        echo "<table>";
        echo "<tr><th colspan=\"2\">Generacion de ".CINCUENTA." valores aleatorios</th></tr>";
        echo "<tr><td>Mínimo</td><td>".$min."</td></tr>";
        echo "<tr><td>Máximo</td><td>".$max."</td></tr>";
        echo "<tr><td>Media</td><td>".$media."</td></tr>";
        echo "</table>";
    
        
    ?>
</body>
</html>

