<?php 
    
    /*Hacer una nueva versión  del ejercicio anterior pero creando 
    un nuevo fichero de funciones (funcionesref.php) donde cada 
    función tenga tres parámetros los dos primeros por valor y el 
    último por referencia. Añadir al principio dentro del programa 
    principal (03.php) la instrucción include_once(“funcionesref.php”) 
    para hacer referencia al las funciones definidas*/

    include_once 'funcionesref.php';
    
    $valor1 = random_int(1,10);
    $valor2 = random_int(1,10);
    $resu;
    
    echo "<p>1 Numero: ".$valor1."</p>";
    echo "<p>2 Numero: ".$valor2."</p>";
    
    calSuma($valor1, $valor2, $resu);
    echo "<p>".$valor1."+".$valor2."=".$resu."</p>";
    
    calResta($valor1,$valor2, $resu);
    echo "<p>".$valor1."-".$valor2."=".$resu."</p>";
    
    calMultiplicacion($valor1,$valor2, $resu);
    echo "<p>".$valor1."*".$valor2."=".$resu."</p>";
    
    calDivision($valor1,$valor2, $resu);
    echo "<p>".$valor1."/".$valor2."=".$resu."</p>";
       
    calModulo($valor1,$valor2, $resu);
    echo "<p>".$valor1."%".$valor2."=".$resu."</p>";
    
    calPotencia($valor1,$valor2, $resu);
    echo "<p>".$valor1."**".$valor2."=".$resu."</p>";

?>