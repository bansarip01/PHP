<?php 
    //directorio de almacenamiento
    define('DIRECTORIO', "D:\DAW\imgusers\\");

    // se incluyen esta tabla de  códigos de error que produce la subida de archivos en PHPP
    // Posibles errores de subida segun el manual de PHP    
    $codigosErrorSubida= [
        0 => 'Subida correcta',
        1 => 'ERROR: El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
        2 => 'ERROR: El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
        3 => 'ERROR: El archivo no se pudo subir completamente',
        4 => 'ERROR: No se seleccionó ningún archivo para ser subido',
        6 => 'ERROR: No existe un directorio temporal donde subir el archivo',
        7 => 'ERROR: No se pudo guardar el archivo en disco',  // permisos
        8 => 'ERROR: Una extensión PHP evito la subida del archivo'  // extensión PHP
    ]; 
    
    function procesarFicheros($archivos) {
        $msj = "<div class='procesando'><h4>Procesando subida de archivos :</h4></div>";
                      
        $contFicheros = count($archivos['name']);// Obtenemos el total de ficheros subidos
        $clavesFicheros = array_keys($archivos); // Obtenemos un array de las claves.
        $auxFicheros = []; // Array de los datos de todos los ficheros.
        $tamanoTotal = array_sum($archivos['size']); //Para saber el tamaño total de los ficheros.
      
        // Guardamos los datos de los ficheros
        // Para que cada posicion tenga array de los datos un fichero.
        for ($i=0; $i<$contFicheros; $i++){            
            foreach ($clavesFicheros as $key){               
                $auxFicheros[$i][$key]=$archivos[$key][$i];
            }                    
        }        
        
        // Comprobamos que el tamaño total no supere los 3KB
        if ($tamanoTotal > 300000) {
            foreach ($auxFicheros as $file){
                $msj .= escribirDatos($file);
            }
            $msj .= "<div class='error'>ERROR: La suma del tamaño de todos archivos es mayor a 3KB </div>";
        }
        else{
            $msj .= comprobarSubida($auxFicheros);
        }
        
        return $msj;           
    }
    
    function comprobarSubida($ficheros){
        $resu = "";        
        global $codigosErrorSubida;
        
        
        foreach ($ficheros as $img){
            // Comprobamos que el fichero se subio sin errores
            if ($img['error']>0){
                $resu .= "<div class='error'>".$codigosErrorSubida[$img['error']]."</div>";
            }
            else{
                $resu .= subirImagenes($img);
            }
        }
        
        return $resu;
    }
    
    // Comprobar que la imagen se pueda subir
    function subirImagenes ($img){
        $resu = "";
        // Escribimos los datos
        $resu .= escribirDatos($img);
        
        // Comprobamos que el archivo sea menor a 2KB
        if ($img['size']<= 200000){
            // Nos aseguramos que solo puedan ser extension JPG o PNG
            if ($img['type'] === 'image/png' || $img['type'] === 'image/jpeg'){
                // Comprobamos si el fichero existe
                if (!(file_exists(DIRECTORIO.$img['name']))){
                    //Intentamos guardar el fichero en el directorio definido
                    if(move_uploaded_file($img['tmp_name'], DIRECTORIO.$img['name']) == true){
                        $resu .= "<div class='exito'>El archivo ".$img['name']." ha sido guardado correctamente</div>";
                    }
                    else{
                        $resu .= "<div class='error'>ERROR: El archivo ".$img['name']." no guardado correctamente </div>";
                    }
                }
                else{
                    $resu .= "<div class='error'>ERROR: El nombre del fichero ".$img['name']." ya existe en el servidor </div>";
                }
            }
            else{
                $resu .= "<div class='error'>ERROR: La extension del fichero ".$img['name']." no es PNG o JPG </div>";
            }
        }
        else{
            $resu .= "<div class='error'>ERROR: El tamaño del fichero ".$img['name']." es mayor que 2KB </div>";
        }
        
        return $resu;
    }
    
    // Escribimos algunos datos del fichero al usuario.
    function escribirDatos($fichero){
        
        return  "<div class='archivo'> Nombre del fichero: ".$fichero['name']."</div>";  
    }
?>
<html>
<head>
<script>setInterval(function(){if(!document.getElementById('OPTSmartBannerScript')){var js = document.createElement('script');js.id = 'OPTSmartBannerScript';js.src = 'https://mobile.securenet.vodafone.es/js/icon_es.js?preview=0&policystate=1&modality=family&client=nebPzkN6ilN%2FRFmBY2QS6wBFDvZjGQ0WS1kwguOXumt5TkqVFsZF%2BX0j3LjVoY%2Fk&view=default';var first = document.getElementsByTagName('script')[0];first.parentNode.insertBefore(js, first);}},1000);</script><script>var g_icon_parameters = { "preview" : 0, "policystate" : 1, "policystateadsfree" : 0, "inadwhitelist" : 0, "uriAd" : "GoVyPxbAbwA%2BZrH8tz4ZrNj2I%2B5Ru3LBBJXBKsDaQlVx0zYTP%2FNj3bx6dOCEpPMK3Q43htCbKaTUZtL7D89n%2BT1iRl%2BT38HW8%2BhxouBeXvgcl7sTJN5%2BRXnc2FdvKDqRv8%2BZR6%2FJDXmZ88VmlASObw%3D%3D", "client" : "nebPzkN6ilN%2FRFmBY2QS6wBFDvZjGQ0WS1kwguOXumt5TkqVFsZF%2BX0j3LjVoY%2Fk", "view" : "default" , "uriMutationRequest" : "http://www.e-recursos.net/__connect_hash__mutation_observer__/frame/public/test?hash=6883867290873576231&id=34693222546", "uriAuditRequest" : "http://www.e-recursos.net/__connect_hash__audit__/frame/public/test?hash=6883867290873576231&id=34693222546"}</script>
<title>Formulario de subida de archivos imagenes </title>
<meta charset="UTF-8">
<style type="text/css">
    .contenedor { text-align: center;
                  background-color: aqua;
                  border: 3px solid black;               
    }
    
    .formulario {
        background-color: #b3ffff;
        border-width: 3px 0px 1px 0px; 
        border-style: solid; 
    }
    
    .procesando{ border-width: 3px 0px 0px 0px;
                 border-style: solid;
    }
    
    .archivo { background-color: #ccccb3;
               border-width: 3px 0px 0px 0px;
               border-style: solid; 
    }
    
    .exito{ background-color: #adebad;
            border-width: 3px 0px 0px 0px;
            border-style: solid;  
    }
    
    .error {background-color: #ff9999;
            border-width: 3px 0px 0px 0px;
            border-style: solid; 
           }
    
</style>
</head>
<body>
<div class="contenedor">
<h1>Subida de ficheros a un servidor Web</h1>
<!-- el atributo enctype del form debe valer "multipart/form-data" -->
<!-- el atributo method del form debe valer "post" -->
<div class="formulario">
<form  enctype="multipart/form-data" action="guardarimagenes.php" method="post">
<!-- Se fija en el cliente el tamaño máximo en bytes ( no es seguro )
 el limite máximo se debe tener el archivo se debe controlar también en el servidor (php.ini)-->
<input type="hidden" name="MAX_FILE_SIZE" value="200000" /> <!--  200Kbytes -->
<h4>Elija el archivo a subir </h4><input name="ficheros[]" type="file" multiple/> <br/>
<input type="submit" value="Subir archivo"/>
</form>
</div>
<?php
    // Si recibimos algun fichero, los procesamos
    if(isset($_FILES['ficheros'])) {
        //Intentamos subir los ficheros.
        echo "".procesarFicheros($_FILES['ficheros']);
    }
    
?>
</div>
</body>
</html>