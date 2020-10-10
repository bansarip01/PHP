<?php
    /*
     * Juego de Piedra, Papel, Tijera
     */

    // Definimos numeros aleatorios de los dos jugadores
    // al jugador2 los pasamos a negativo para poder calcular el ganador
    
    $jugador1 = random_int(1,3);        
    $jugador2 = (random_int(1,3)*-1); 
    
    header('Content-Type: text/html; charset=UTF-8');
    
    echo "<h1>¡Piedra, Papel, Tijera!</h1>";
    echo "<p>Actualice la página para mostrar otra partida.</p>";
    
    // Creamos una tabla para que se vea mejor.
    echo "<table><tr><th>Jugador 1</th><th>Jugador 2 </th></tr>";
    
    // Llamamos a la funcion para escribir el simbolo
    echo "<tr><th style=\"font-size: 150px\">";
    echo escribirSimbolo($jugador1)."</th>";
    
    // Llamamos a la funcion  para escribir el simbolo
    echo "<th style=\"font-size: 150px\">";
    echo escribirSimbolo($jugador2)."</th></tr>";
    
    // Llamamos a la funcion para calcular al ganador
    echo "<tr><th colspan=\"2\">";
    echo calcularGanador($jugador1, $jugador2);
    echo "</th></tr></table>";
    
    function calcularGanador ($num1, $num2) {
        
        $resultado = $num1 + $num2;
        
        switch($resultado){
            case 0 : return "¡Empate!";
            break;
            case -1 :
            case  2 : return "Ha ganado el jugador 1";
            break;
            case  1 :
            case -2 : return "Ha ganado el jugador 2";
            break;
        }
    }
    
    
    function escribirSimbolo ($num) {
        
        switch ($num){
            // Piedra Jugador 2
            case -1 : return "&#x1F91B";
                      break;
            // Piedra Jugador 1
            case  1 : return "&#x1F91C";
                      break;
            // Tijeras
            case -2 :
            case  2 : return "&#x1F596";
                      break;
            // Papel
            case -3 :
            case  3 : return "&#x1F91A";
            break;           
        }
    }
    
