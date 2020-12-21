<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------
include_once 'config.php';
include_once 'modeloUser.php';
include_once 'funciones.php';

/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function  ctlUserInicio(){
    $msg = "";
    $user ="";
    $clave ="";
    if ( $_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['user']) && isset($_POST['clave'])){
            $user =$_POST['user'];
            $clave=$_POST['clave'];
            if ( modeloOkUser($user,$clave)){
                $_SESSION['user'] = $user;
                $_SESSION['tipouser'] = modeloObtenerTipo($user);
                if ( $_SESSION['tipouser'] == PLANES[3]){
                    $_SESSION['modo'] = GESTIONUSUARIOS;
                    header('Location:index.php?orden=VerUsuarios');
                }
                else {
                  // Usuario normal;
                  // PRIMERA VERSIÓN SOLO USUARIOS ADMISTRADORES
                  $msg="Error: Acceso solo permitido a usuarios Administradores.";
                  // $_SESSION['modo'] = GESTIONFICHEROS;
                  // Cambio de modo y redireccion a verficheros
                  $_SESSION['modo'] = GESTIONFICHEROS;
                }
            }
            else {
                $msg="Error: usuario y contraseña no válidos.";
           }  
        }
    }
    
    include_once 'plantilla/facceso.php';
}

// Cierra la sesión y vuelva los datos
function ctlUserCerrar(){
    session_destroy();
    modeloUserSave();
    header('Location:index.php');
}

// Muestro la tabla con los usuario 
function ctlUserVerUsuarios (){
    // Obtengo los datos del modelo
    $usuarios = modeloUserGetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verusuariosp.php';
   
}

// Darse de alta
function ctlUserAlta(){
    $datosUser = [ "id"       => "",
                    "nombre"  => "",
                    "correo"  => "",
                    "clave"   => "",
                    "reclave" => "",
                    "plan"    => "",
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){      
        if (empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave']) || empty($_POST['reclave'])){
            $msg="Error: Falta algún campo por rellenar.";
        }
        else {
            $datosUser['id'] = $_POST['id'];
            $datosUser['nombre'] = $_POST['nombre'];
            $datosUser['correo'] = $_POST['correo'];
            $datosUser['clave'] = $_POST['clave'];
            $datosUser['reclave'] = $_POST['reclave'];
            $datosUser['plan'] = $_POST['plan'];
            
            if (validarUser($datosUser, $msg)){
                if (modeloUserAdd($datosUser, $msg)){
                    echo "<script>alert('Alta Usuario')</script>";
                    header("refresh: 0; url =".$_SERVER['PHP_SELF']);
                }
            }                    
        }
    }

    include_once 'plantilla/fnuevo.php';
}

// Mostrar Detalles Usuario
function ctlUserDetalles(){
    $datosUser = modeloUserGet($_GET['id']);
    include 'plantilla/fdetalles.php';
}

// Modificar Usuario
function ctlUserModificar(){
    $datosUser = modeloUserGet($_GET['id']);
    $datUser=[];
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        
        $datUser['id'] = (isset($_POST['id']))?$_POST['id']:$datosUser;
        $datUser['idOrigen'] = $datosUser['id'];
        $datUser['nombre'] = $_POST['nombre'];
        $datUser['correo'] = $_POST['correo'];
        $datUser['clave'] = $_POST['clave'];
        $datUser['reclave'] = $_POST['reclave'];
        $datUser['plan'] = $_POST['plan'];
        $datUser['estado'] = (isset($_POST['estado']))? $_POST['estado'] : $datosUser['estado'];
        
        if ($_SESSION['modo']==GESTIONFICHEROS && $datosUser['id'] != $datUser['id']){
            $msg = "Error: No se te permite cambiar el identificardor.";
        }
        else{
            if(validarUser($datUser, $msg)){
                if (modeloUserUpdate($datUser, $msg)){
                    echo "<script>alert('Usuario Modificado')</script>";
                    header("refresh: 0; url =".$_SERVER['PHP_SELF']);
                }
                //echo "<script>alert('Modificando')</script>"; // Falta parte Usuario
            }               
        }
     
    }
    
    include 'plantilla/fnuevo.php';
}

// Borrar usuario
function ctlUserBorrar(){
    modeloUSerDel($_GET['id']);
    header('Location:index.php?');
}

