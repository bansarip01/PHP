<?php 

    function calSuma( $num1, $num2){
        
        $resultado = $num1 + $num2;
        return $resultado;
    }
    
    function calResta( $num1, $num2){
        
        $resultado = $num1 - $num2;
        return $resultado;
    }
    
    function calMultiplicacion( $num1, $num2){
        
        $resultado = $num1 * $num2;
        return $resultado;
    }
    
    function calDivision( $num1, $num2){
        
        $resultado = $num1 / $num2;
        return $resultado;
    }
    
    function calModulo( $num1, $num2){
        
        $resultado = $num1 % $num2;
        return $resultado;
    }
    
    function calPotencia( $num1, $num2){
        
        $resultado = $num1;
        
        for ($i=1; $i<$num2;$i++) {
            $resultado *= $num1;
        }
        
        return $resultado;
    }
?>