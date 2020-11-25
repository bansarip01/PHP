<?php
include_once 'app/config.php';

//Carga los datos de un fichoro de texto
function cargarDatostxt(){
    // Si no existe lo creo
    $tabla=[]; 
    if (!is_readable(FILEUSER) ){
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura
    
    while ($linea = fgets($fich)) {
        $partes = explode('|', trim($linea));
        // Escribimos la correspondiente fila en tabla
        $tabla[]= [ $partes[0],$partes[1],$partes[2],$partes[3]];
        }
    fclose($fich);
    return $tabla;
}

function mostrarDatos (){
    echo "<table>\n";
     // Identificador de la tabla
    // Generamos la cabecera de la tabla
    echo "<tr><th>usuario</th><th>login</th><th>pasword</th></tr>\n";
    $auto = $_SERVER['PHP_SELF'];
    $id=0;
    $nusuarios = count($_SESSION['tuser']);
    for($id=0; $id< $nusuarios ; $id++){
        echo "<tr>";
        $datosusuario = $_SESSION['tuser'][$id];
        for ($j=0; $j < CAMPOSVISIBLES; $j++){
            echo "<td>$datosusuario[$j]</td>";
        }
        echo "<td><a href=\"#\" onclick=\"confirmarBorrar('$datosusuario[0]',$id);\" >Borrar</a></td>\n";
        echo "<td><a href=\"".$auto."?orden=Modificar&id=$id\">Modificar</a></td>\n";
        echo "<td><a href=\"".$auto."?orden=Detalles&id=$id\" >Detalles</a></td>\n";
        echo "</tr>\n";
        
    }
    echo "</table>";
}

function volcarDatostxt($tvalores){
    
    $fich = @fopen(FILEUSER,"w") or die ("Error al escribir en el fichero.");
    
    foreach ($tvalores as $usuario) {
        $linea = implode('|', $usuario)."\n";
        fwrite($fich,$linea);
    }
    
    fclose($fich); 
}

function accionDetalles($idUser){
    
    $usuario = $_SESSION['tuser'][$idUser];     
    
    include_once "primeraParte.php";
    
    echo "<table>";
    echo "<tr><th>usuario</th><th>login</th><th>pasword</th><th>Comentario</th></tr>";
    echo "<tr>";
    foreach ($usuario as $contenido){
        echo "<td>$contenido</td>";
    }   
    echo "</tr><table>";
    
    include_once "segundaParte.php";
}

function accionModificar($idUser){
    
    // El diseño del header incluimos;
    include_once "primeraParte.php";
    
    // Si recibimos el la accion por GET procesamos el formulario a rellenar
    if ($_SERVER['REQUEST_METHOD'] == "GET" ){
        echo "<h3>Dar de alta usuario</h3>";
        echo "<form method=\"post\">";
        echo "<p>Usuario:   <input type=\"text\" name=\"usuario\" value=".$_SESSION['tuser'][$idUser][0]."></p>";
        echo "<p>Login:     <input type=\"text\" name=\"login\" disabled value=".$_SESSION['tuser'][$idUser][1]."></p>";
        echo "<p>Password:  <input type=\"password\" name=\"contraseña\" value=".$_SESSION['tuser'][$idUser][2]." ></p>";
        echo "<p>Comentario:<input type=\"text\" name=\"comentario\"value=".$_SESSION['tuser'][$idUser][3]." ></p>";
        echo "<p><button name=\"modificar\">Modificar</button></p>";
        echo "</form>";
    }
    else {
        $nuevoUsuario = [];
        $nuevoUsuario[] = $_POST['usuario'];
        $nuevoUsuario[] = $_POST['login'];
        $nuevoUsuario[] = $_POST['contraseña'];
        $nuevoUsuario[] = $_POST['comentario'];
        $_SESSION['tuser'][$idUser]= $nuevoUsuario;
        
        echo "<h3>Usuario añadido correctamente</h3>";
        
    }
    
    // El diseño del boton final incluimos;
    include_once "segundaParte.php";
}

function accionBorrar($idUser){
    // El diseño del header incluimos;
    include_once "primeraParte.php";
    
    unset($_SESSION['tuser'][$idUser]); // Borrar el elemento
    
    // Reindexa el indice 0,1,2 de la array
    $_SESSION['tuser'] = array_values($_SESSION['tuser']);
    
    echo "<h3>Usuario eliminado correctamente</h3>";
    
    // El diseño del boton final incluimos;
    include_once "segundaParte.php";
}

function accionAlta(){
    // El diseño del header incluimos;
    include_once "primeraParte.php";
    
    // Si recibimos el la accion por GET procesamos el formulario a rellenar
    if ($_SERVER['REQUEST_METHOD'] == "GET" ){        
        echo "<h3>Dar de alta usuario</h3>";
        echo "<form method=\"post\">";
        echo "<p>Usuario:   <input type=\"text\" name=\"usuario\"></p>";
        echo "<p>Login:     <input type=\"text\" name=\"login\"></p>";
        echo "<p>Password:  <input type=\"password\" name=\"contraseña\"></p>";
        echo "<p>Comentario:<input type=\"text\" name=\"comentario\"></p>";
        echo "<p><button name=\"DAR ALTA\">DAR ALTA</button></p>";
        echo "</form>";
    }
    else {
        $nuevoUsuario = [];
        $nuevoUsuario[] = $_POST['usuario'];
        $nuevoUsuario[] = $_POST['login'];
        $nuevoUsuario[] = $_POST['contraseña'];
        $nuevoUsuario[] = $_POST['comentario'];                
        $_SESSION['tuser'][]= $nuevoUsuario; 
        
        echo "<h3>Usuario añadido correctamente</h3>";
        
    }
    
    // El diseño del boton final incluimos;
    include_once "segundaParte.php";
}

function accionTerminar(){
    // El diseño del header incluimos;
    include_once "primeraParte.php";
    
    if($_REQUEST['guardar']=="si"){
        
        echo "<h3>Se han guardado todos los cambios realizados</h3>";
        volcarDatostxt($_SESSION['tuser']);
        
    }
    else{
        echo "<h3>No se ha guardado todos los cambios realizados</h3>";
    }
    
    session_destroy();    
    
    // El diseño del boton final incluimos;
    include_once "segundaParte.php";
}