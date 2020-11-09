<?php
function usuarioOk($usuario, $contraseña) :bool {
    $resu = false;
    //Comprobamos que no exista codigo 
    if(filtrarContenido($usuario)&& filtrarContenido($contraseña)){
        
        // Comprobamos que tenga una longitud de 8 como minimo
        // Comprobamos si la contraseña es igual al usuario invertido
        if(strlen($usuario)>= 8 && $contraseña == strrev($usuario)){
                $resu = true;          
        }
    }
    return $resu;
       
}

//Comprobamos que el no supere los 300 caracteres 
function comentarioOK ($comentario):bool{ 
    if(strlen($comentario)<=300){
        return true;
    }else{
        echo "<script>alert('En la caja de texto solo se perimeten 300 caracteres');</script>";
        return false;
    }
}


function palabraMasRepetida($comentario):string{
    // De esta forma conseguimos un array con todas las palabras
    $todasLasPalabras = str_word_count($comentario,1); 
    // Definimos una palabra como la mas repetida
    $palabraMasRepetida = $todasLasPalabras[0];
    $veces = 0;
    
    // Recoremos el array comprobando la mas repetida
    foreach ($todasLasPalabras as $palabra){
        if(substr_count($comentario, $palabra)>$veces){
            $palabraMasRepetida = $palabra;
            $veces = substr_count($comentario, $palabra);
        }
    }
    
    return $palabraMasRepetida;
}

function letraMasRepetida ($comentario):string{
    // Definimos la primera letra como la mas repetida
    $letraMasRepetida = $comentario[0];
    $veces=0;
    
    // Recoremos el string comprobando la letra mas repetida
    for ($i=0; $i<strlen($comentario); $i++){
        $letra = $comentario[$i];                 // Obtenemos una letra
        $num = substr_count($comentario, $letra); // Obtenemos las veces que se encuentra
        
        if($num>$veces){
            $letraMasRepetida = $letra;
            $veces=$num;
        }
    }
    return $letraMasRepetida;
}

function filtrarContenido ($mensaje):bool{
    //Con esto cambiamos las etiquetas de codigo a otro texto
    if($mensaje === htmlspecialchars($mensaje)){
        return true;
    }
    else{
        echo "<script>alert('No se permite inyección de código');</script>";
        return false;
    }
    
}