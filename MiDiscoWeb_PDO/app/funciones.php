<?php
// Comprobamos si los datos del usuario cumplen los requisitos de la web
function validarUser($user, &$msg){
    $resu = true;
    
    // Comprobamos que ninguna entrada tenga iyección de código
    foreach ($user as $dato){
        if (!filtrarContenido($dato)){
            $resu = false;
            $msg = "Error: No se permite inyección de código.";
            break;
        }
    }
    
    // Comprobamos que el ID tenga solo letras y numeros y que tenga entre 5 y 10 caracteres
    if ($resu){
        if (strlen($user['id']) < 5 || strlen($user['id']) > 10){
            $msg = "Error: El identificador debe tener entre 5 y 10 caracteres.";
            $resu = false;
        }
        else{
            if(hayNoAlfanumerico($user['id'])){
                $msg = "Error: El identificador solo permite letras y números.";
                $resu = false;
            }
        }
    }
    
    // Comprobamos que el nombre sea correcto maximo 20 caracteres
    if($resu){
        if(strlen($user['nombre'])>20){
            $msg = "Error: El nombre solo se permite 20 caracteres como máximo.";
            $resu = false;
        }
    }
    
    // Comprobamos que el formato del correo sea valido.
    if ($resu){
        if(!comprobarCorreo($user['correo'])) {
            $msg = "Error: El correo no es valido.";
            $resu = false;
        }
    }
    
    // Comprobamos que la contraseña sea segura
    if($resu){
        if($user['clave'] != $user['reclave']){
            $msg = "Error: Las contraseñas no coinciden.";
            $resu = false;
        }
        else{
            if (strlen($user['clave']) < 8 || strlen($user['clave']) > 15){
                $msg = "Error: La contraseña debe tener entre 8 y 15 caracteres.";
                $resu = false;
            }
            else{
                if (!claveSegura($user['clave'])){
                    $msg = "Error: La contraseña no es segura.";
                    $resu = false;
                }
            }
        }
    }
    
    return $resu;
}

// Funciones de comprobacion de datos

function claveSegura($cadena){
    $resu = true;
    
    if (!hayMayusculas($cadena)) $resu = false;
    if (!hayMinusculas($cadena)) $resu = false;
    if (!hayDigito($cadena)) $resu = false;
    if (!hayNoAlfanumerico($cadena)) $resu = false;
    
    return $resu;
}

function hayMayusculas ($cadena){
    for ($i=0; $i<strlen($cadena); $i++){
        if ( ctype_upper($cadena[$i]) )
            return true;
    }
    return false;
}

function hayMinusculas ($cadena){
    for ($i=0; $i<strlen($cadena); $i++){
        if ( ctype_lower($cadena[$i]))
            return true;
    }
    return false;
}

function hayDigito ($cadena){
    for ($i=0; $i<strlen($cadena); $i++){
        if ( ctype_digit($cadena[$i]) )
            return true;
    }
    return false;
}

function hayNoAlfanumerico($cadena){
    for ($i=0; $i< strlen($cadena); $i++){
        if(!ctype_alnum($cadena[$i])) return true;
    }
    return false;
}

function comprobarCorreo($correo){
    $patron = "/^[a-zA-Z0-9]+([.][a-zA-Z0-9]+)*@{1}[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.]{1}[a-zA-Z]{2,3}$/" ;
    if ( preg_match( $patron , $correo) ) {
        return true;
    }
    return false;
}

// Comprobamos que no se introduzca código.
function filtrarContenido ($mensaje):bool{
    return ($mensaje === htmlspecialchars($mensaje));
}

?>