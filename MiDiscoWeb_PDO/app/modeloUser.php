<?php 
include_once 'config.php';
include_once 'AccesoDatos.php';
include_once 'Usuario.php';
/* DATOS DE USUARIO
• Identificador ( 5 a 10 caracteres, no debe existir previamente, solo letras y números)
• Contraseña ( 8 a 15 caracteres, debe ser segura)
• Nombre ( Nombre y apellidos del usuario
• Correo electrónico ( Valor válido de dirección correo, no debe existir previamente)
• Tipo de Plan (0-Básico |1-Profesional |2- Premium| 3- Máster)
• Estado: (A-Activo | B-Bloqueado |I-Inactivo )
*/
// Inicializo el modelo 
// Cargo los datos del fichero a la session
function modeloUserInit(){
    
   
    if (! isset ($_SESSION['tusuarios'] )){
        
        $db = AccesoDatos::getModelo();
        $tusu = $db->getUsuarios();
        
        $tusuarios=[];
        /*
         * Obtenemos el siguiente formato de array.
         $tusuarios = [
         "admin"  => ["12345"      ,"Administrado"   ,"admin@system.com"   ,3,"A"],
         "user01" => ["user01clave","Fernando Pérez" ,"user01@gmailio.com" ,0,"A"],
         "user02" => ["user02clave","Carmen García"  ,"user02@gmailio.com" ,1,"B"],
         "yes33" =>  ["micasa23"   ,"Jesica Rico"    ,"yes33@gmailio.com"  ,2,"I"]
         ];
         */
        foreach ($tusu as $usu){
            $tusuarios[$usu->login]=[$usu->passwd, $usu->nombre, $usu->correo, $usu->plan, $usu->estado];
        }
        
        $_SESSION['tusuarios'] = $tusuarios;
   }

      
}

// Comprueba usuario y contraseña (boolean)
function modeloOkUser($user,$clave){
    $resu = false;
    
    if (array_key_exists($user, $_SESSION['tusuarios'])){
        $claveRegistrada = $_SESSION['tusuarios'][$user][0];      
        $resu = ($claveRegistrada == $clave);      
    }
    
    return $resu;
}

// Devuelve el plan de usuario (String)
function modeloObtenerTipo($user){
    return PLANES[$_SESSION['tusuarios'][$user][3]];
}

// Borrar un usuario (boolean)
function modeloUserDel($user){
    unset($_SESSION['tusuarios'][$user]);
    $db = AccesoDatos::getModelo();
    $db->borrarUsuario($user);
}

// Devuelve el estado de un usuario (String)
function modeloObtenerEstado($user){
    return ESTADOS[$_SESSION['tusuarios'][$user][4]];
}


// Añadir un nuevo usuario (boolean)
function modeloUserAdd($user, &$msg){
    $resu = true;
   
    $datosUsuario = [$user['clave'],$user['nombre'],$user['correo'],$user['plan'],"I"];
    if (array_key_exists($user['id'], $_SESSION['tusuarios'])) {
        $msg = "Error: El identificador ya existe.";
        $resu = false;
    }
    
    if ($resu){
        foreach ($_SESSION['tusuarios'] as $usuario){
            if ($usuario[2]==$user['correo']){
                $msg = "Error: El correo ya existe.";
                $resu = false;
                break;
            }
        }
    }
    
    if ($resu){
        $_SESSION['tusuarios'][$user['id']] = $datosUsuario;
        
        $usu = New Usuario();
        $usu->login=$user['id'];
        $usu->passwd=$user['clave'];
        $usu->nombre=$user['nombre'];
        $usu->correo=$user['correo'];
        $usu->plan=$user['plan'];
        $usu->estado="I";
        
        $db = AccesoDatos::getModelo();
        $db ->addUsuario($usu);       
    }
    
   return $resu;
}

// Actualizar un nuevo usuario (boolean)
function modeloUserUpdate ($user,&$msg){
    $resu = true;
    $datosUsuario = [$user['clave'],$user['nombre'],$user['correo'],$user['plan'],$user['estado']];
    
    foreach ($_SESSION['tusuarios'] as $key => $usuario){
        if ($usuario[2]==$user['correo'] && $key != $user['idOrigen']){
            $msg = "Error: El correo ya existe.";
            $resu = false;
            break;
        }
    }

    
    if ($resu){
        unset($_SESSION['tusuarios'][$user['idOrigen']]);
        $_SESSION['tusuarios'][$user['id']] = $datosUsuario;
        
        $usu = New Usuario();
        $usu->login=$user['id'];
        $usu->passwd=$user['clave'];
        $usu->nombre=$user['nombre'];
        $usu->correo=$user['correo'];
        $usu->plan=$user['plan'];
        $usu->estado=$user['estado'];
        
        $db = AccesoDatos::getModelo();
        $db ->modUsuario($usu); 
        
    }
    
    return $resu;
}

// Tabla de todos los usuarios para visualizar
function modeloUserGetAll (){
    // Genero lo datos para la vista que no muestra la contraseña ni los códigos de estado o plan
    // sino su traducción a texto
    $tuservista=[];
    foreach ($_SESSION['tusuarios'] as $clave => $datosusuario){
        $tuservista[$clave] = [$datosusuario[1],
                               $datosusuario[2],
                               PLANES[$datosusuario[3]],
                               ESTADOS[$datosusuario[4]]
                               ];
    }
    return $tuservista;
}

// Datos de un usuario para visualizar
function modeloUserGet ($user){
    $datosUser = [  "id"      => $user,
                    "nombre"  => $_SESSION['tusuarios'][$user][1],
                    "correo"  => $_SESSION['tusuarios'][$user][2],
                    "clave"   => $_SESSION['tusuarios'][$user][0],
                    "reclave"   => $_SESSION['tusuarios'][$user][0],
                    "plan"    => PLANES[$_SESSION['tusuarios'][$user][3]],
                    "estado"  => ESTADOS[$_SESSION['tusuarios'][$user][4]],
                    "nficheros" => "XXX",   // Falta realizar calculo
                    "espacio" => "???"      // Falta realizar calculo
    ];
    
    return $datosUser;
}
