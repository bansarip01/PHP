<?php 
    
    /*Realizar y probar una función en PHP  llamada elMayor  que reciba tres números: A,B y C. 
    La función almacenará en C el valor que sea mayor A o B. En el caso sean iguales almacenará el valor 0 en C 
    ¿Qué parámetros se deberían pasar por valor o copia y cuales por referencia?*/

    $A = 5;
    $B = 10;
    $C;
    
    echo "<p> El valor de A es : ".$A."</p>";
    echo "<p> El valor de B es : ".$B."</p>";
    
    
    
    elMayor($A,$B,$C);
    
    echo "<p> El valor de C es : ".$C."</p>";
    
    
    
    // La variable A y B pasamos por copia y la variable C pasamos por referencia
    function elMayor($a, $b, &$c) {
        if($a>$b){
            $c=$a;
        } else{
            if($a<$b) {
                $c=$b;
            }else{
                $c=0;
            }
        }
    }

?>