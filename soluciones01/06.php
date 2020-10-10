<html>
<head>
	<style type="text/css">
	   .titulo {margin = 0px;
	            background-color: blue;
	            color: white;
	            text-align: center;}	    
	   table {border-collapse: collapse;}	
	   table, th, td { border: 1px solid black;}
	</style>
</head>
<body>
<div class="titulo">
	<h1> TABLA DE </h1>
	<h1>MULTIPLICAR</h1>
</div>

<?php 
    /*Generar la  tabla de multiplicar de un número elegido al 
    azar entre 1 y 10 con la siguiente apariencia*/
    
    $num = random_int(1, 10);
    echo "<table>";
    echo "<tr><th colspan=\"2\">Tabla del ".$num."</th><tr>";
    
    for($i=1;$i<=10;$i++){
        echo "<tr><td>".$num." X ".$i." =</td>";
        echo "<td>".($num*$i)."</td></tr>";
    }
    
    echo "</table>";

?>
</body>
</html>