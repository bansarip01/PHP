<html>
<head>
</head>
<body>
    <?php
    /*Definir dos variables asignándoles un valor entero aleatorio 
    entre 1 y 10 y mostrar su suma, su resta, su división, 
    su multiplicación, módulo y potencia (ciclo for)*/
    
    
    $valor1 = random_int(1,10);
    $valor2 = random_int(1,10);
    
    echo "<p>1 Numero: ".$valor1."</p>";
    echo "<p>2 Numero: ".$valor2."</p>";
    
    echo "<p>".$valor1."+".$valor2."=".calSuma($valor1,$valor2)."</p>";
    echo "<p>".$valor1."-".$valor2."=".calResta($valor1,$valor2)."</p>";
    echo "<p>".$valor1."*".$valor2."=".calMultiplicacion($valor1,$valor2)."</p>";
    echo "<p>".$valor1."/".$valor2."=".calDivision($valor1,$valor2)."</p>";
    echo "<p>".$valor1."%".$valor2."=".calModulo($valor1,$valor2)."</p>";
    echo "<p>".$valor1."**".$valor2."=".calPotencia($valor1,$valor2)."</p>";
    
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
</body>
</html>