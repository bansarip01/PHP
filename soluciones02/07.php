<html>
<head>
	<style type="text/css">
       table, th, td { border: 1px solid black;}
	   td {height : 30px;
	       width : 30px;}
	</style>
</head>
<body>
    <?php 
        /*Realizar un programa que genere una tabla html de 10x10 
        con casillas de 30x30 px donde cada casilla tenga un color 
        aleatorio obtenido mediante una funci�n que genera un color 
        diferente en cada casilla.*/
    
    echo "<h3>1º Versión: Colores rojo,verde, azul, blanco y negro. </h3>";
    generarTabla5Colores();  
    echo "<br>";
    
    echo "<h3>2º Versión: Colores aleatorios </h3>";
    generarTablaColoresAleatorios();
    echo "<br>";
   
    echo "<h3>3º Versión: Color aleatorio degradado. </h3>";
    generarTablaColorDegradado();

    // 1º Versión  elegir entre 5 posibles valores: rojo,verde, azul, blanco y negro.
    function generarTabla5Colores(){
        echo "<table>";
        for ($i=1;$i<=10;$i++){
            echo "<tr>";
            for($j=1;$j<=10;$j++){
                $num = random_int(1,5);
                echo "<td style=\"background-color: ";
                switch ($num){
                    case 1: echo "red";
                            break;
                    case 2: echo "green";
                            break;
                    case 3: echo "blue";
                            break;
                    case 4: echo "white";
                            break;
                    case 5: echo "black";
                            break;
                }
                echo "\"> </td>";
            }
            echo "<tr>";
        }
        echo "</table>";
    }
    
    //2º Versión cualquier color aleatorios
    function generarTablaColoresAleatorios(){
        echo "<table>";
        for ($i=1;$i<=10;$i++){
            echo "<tr>";
            for($j=1;$j<=10;$j++){
                $rojo = random_int(1,250);
                $verde = random_int(1,250);
                $azul = random_int(1,250);
                echo "<td style=\"background: ";
                echo "rgb(".$rojo.",".$verde.",".$azul.")";
                echo "\"> </td>";
            }
            echo "<tr>";
        }
        echo "</table>";
    }
    
    //3º  Se elegir un color aleatorio y mostrar un degradado.
    function generarTablaColorDegradado(){
        $rojo = random_int(1,250);
        $verde = random_int(1,250);
        $azul = random_int(1,250);
        $transparencia = 1;
        echo "<table>";
        for ($i=1;$i<=10;$i++){
            echo "<tr>";
            for($j=1;$j<=10;$j++){
                echo "<td style=\"background: ";
                echo "rgba(".$rojo.",".$verde.",".$azul.",".$transparencia.")";
                echo "\"> </td>";
                $transparencia -= 0.01; 
            }
            echo "<tr>";
        }
        echo "</table>";
    }
    
    ?>
</body>
</html>