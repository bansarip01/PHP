<?php 
    
    /*Definir dos variables asign�ndoles un valor entero aleatorio entre 1 y 10, 
    mostrar su suma, su resta, su divisi�n, su multiplicaci�n, su m�dulo y su 
    potencia (ciclo for), Crea un archivo llamado funcionesvar.php donde est�n 
    definidas las cinco operaciones: suma, resta, divisi�n, producto, m�dulo y 
    potencia. Incluir ese fichero dentro de fichero principal (require_once) y 
    llamar  a las funciones para obtener el resultado.*/

    
    require_once 'funcionesvar.php';

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
    
?>    
