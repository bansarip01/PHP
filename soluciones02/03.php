<?php 
    
    /*Hacer una nueva versi�n  del ejercicio anterior pero creando 
    un nuevo fichero de funciones (funcionesref.php) donde cada 
    funci�n tenga tres par�metros los dos primeros por valor y el 
    �ltimo por referencia. A�adir al principio dentro del programa 
    principal (03.php) la instrucci�n include_once(�funcionesref.php�) 
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