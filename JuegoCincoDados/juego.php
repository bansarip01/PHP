<html>
<head>
	<style type="text/css">	
	   td {font-size: 100px;}
	   h1 {text-align: center;}
	   table {border-collapse: collapse;}
	   .jugador1 td{border: 5px solid red;}
	   .jugador2 td{border: 5px solid blue;}
	   	   
	</style>
</head>
<body>
	<h1> CINCO DADOS</h1>
	<p>Actualice la página para mostrar una nueva tirada.</p>
<?php 

    /*Para cada jugador se mostrarán cinco dados, generados al azar (del 1 al 6).
    Se indicará la puntuación correspondiente a cada jugador, 
    teniendo en cuenta que la puntuación es la suma de todos 
    los dados menos el valor más bajo y el valor más alto.
    Se indicará qué jugador ha ganado.
    Al actualizar la página, se mostrará una nueva jugada.*/
       
    echo "<table class=\"jugador1\"><tr>";
    echo "<th>Jugador 1</th>";
    $jugador1 = generarDados();
    echo "<th>".$jugador1." puntos</th>";
    echo "</tr></table>";
    
    echo "<table class=\"jugador2\"><tr>";
    echo "<th>Jugador 2</th>";
    $jugador2 = generarDados();
    echo "<th>".$jugador2." puntos</th>";
    echo "</tr></table>";
    
    calcularGanador($jugador1, $jugador2);
        
    
    /* Calculamos el ganador dependiendo del
       del resultado de los dos jugadores*/
    function calcularGanador($player1, $player2){
        if ($player1==$player2){
            echo "<p><b>Resultado:</b> Ha empatado </p>";
        }
        else {
            if ($player1>$player2){
                echo "<p><b>Resultado:</b> Ha ganado el Jugador 1 </p>";
            }
            else {
                echo "<p><b>Resultado:</b> Ha ganado el Jugador 2 </p>";
            }
        }
    }
    
    /*  Generamos 5 dados aleatorios y retonarmos 
        el resultado del jugador*/
    function generarDados(){
        
        $num = random_int(1, 6);
        $resu = $num;
        $max = $num;
        $min = $num;
        
        dibujarDado($num);
        
        for($i=1;$i<=4;$i++){
            $num = random_int(1, 6);
            dibujarDado($num);
            if ($num<$min) $min = $num;
            if ($num>$max) $max = $num;
            $resu += $num;
        }
        
        $resu = $resu - $min - $max;        
        return $resu;            
    }
    
    /* Dibujamos el dado segun el numero que nos pasen*/
    function dibujarDado($num){
        $dadoUno = "&#x2680";
        $dadoDos = "&#x2681";
        $dadoTres = "&#x2682";
        $dadoCuatro = "&#x2683";
        $dadoCinco = "&#x2684";
        $dadoSeis = "&#x2685";
        
        switch ($num){
            case 1: echo "<td>".$dadoUno."</td>";
            break;
            case 2: echo "<td>".$dadoDos."</td>";
            break;
            case 3: echo "<td>".$dadoTres."</td>";
            break;
            case 4: echo "<td>".$dadoCuatro."</td>";
            break;
            case 5: echo "<td>".$dadoCinco."</td>";
            break;
            case 6: echo "<td>".$dadoSeis."</td>";
            break;
        }
    }

?>
</body>
</html>
