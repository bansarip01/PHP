<?php 
    
    /*Rellenar un array con 20 números aleatorios entre 1 y 10 
    y mostrar el contenido del array  mediante una tabla de 
    una fila en HMTL. Mostrar a continuación el valor máximo, 
    el mínimo y el  valor que mas veces se repite. 
    (Nota definir funciones para cada caso)*/

    // Generamos un array con numeros aletarios
    $numeros = generarNumeros();
    
    function generarNumeros() {       
        $array = [];
        for ($i=0; $i<20;$i++){
            $array[$i]=random_int(1,10);
        }        
        return $array;        
    }
        
    function escribirArray($numeros) {
        echo "<tr>";
        for ($i=0; $i<20;$i++){
            echo "<td>$numeros[$i]</td>";
        }    
        echo "</tr>";
    }
    
    function obtenerMinimo($numeros){
        $min = $numeros[0];
        for ($i=1;$i<sizeof($numeros);$i++){
            if ($numeros[$i]<$min) $min = $numeros[$i];
        }
        return $min;
    }
    
    function obtenerMaximo($numeros){
        $max = $numeros[0];
        for ($i=1;$i<sizeof($numeros);$i++){
            if ($numeros[$i]>$max) $max = $numeros[$i];
        }
        return $max;
    }
    
    function obtenerMasRepetido($numeros){
        
        $masRepetido=0;
        $veces=0;
        for ($i=0;$i<sizeof($numeros);$i++){
            $aux = cantidadTotal($numeros,$numeros[$i]);
            if ($aux>$veces) {
                $veces=$aux;
                $masRepetido = $numeros[$i];
            }
        }
        
        return $masRepetido;
        
    }
    
    function cantidadTotal($numeros,$valor){
        
        $cont = 0;
        
        for ($i=0;$i<sizeof($numeros);$i++){
            if ($numeros[$i]==$valor) $cont++;      
        }
        
        return $cont;
    }
?>
<html>
<head>
<style type="text/css">	
	   table {border-collapse: collapse;}
	   table, th, td {border-collapse: collapse;
	                  border: 2px solid black;}	                 	   	   
</style>
</head>
<body>
<table>
	<tr><th colspan="20">20 números generados de 1 al 10 </th></tr>
	<?php 
	   
	   escribirArray($numeros);
	   
	   echo "<tr><td colspan=\"10\"> El mínimo es </td>";
	   echo "<td colspan=\"10\">".obtenerMinimo($numeros)."</td></tr>";
	   
	   echo "<tr><td colspan=\"10\"> El máximo es </td>";
	   echo "<td colspan=\"10\">".obtenerMaximo($numeros)."</td></tr>";
	   
	   echo "<tr><td colspan=\"10\"> El más repetido es </td>";
	   echo "<td colspan=\"10\">".obtenerMasRepetido($numeros)."</td></tr>";
	   
	?>
</table>
</body>
</html>
