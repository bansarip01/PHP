<?php 
    function calSuma( $num1, $num2, &$resultado){
        $resultado = $num1 + $num2;
    }
    
    function calResta( $num1, $num2, &$resultado){
        $resultado = $num1 - $num2;
    }
    
    function calMultiplicacion( $num1, $num2, &$resultado){
        $resultado = $num1 * $num2;
    }
    
    function calDivision( $num1, $num2, &$resultado){
        $resultado = $num1 / $num2;
    }
    
    function calModulo( $num1, $num2, &$resultado){
        
        $resultado = $num1 % $num2;
    }
    
    function calPotencia( $num1, $num2, &$resultado){
        
        $resu = $num1;
        
        for ($i=1; $i<$num2;$i++) {
            $resu *= $num1;
        }
        
        $resultado = $resu;
                    
  
    }
    
?>