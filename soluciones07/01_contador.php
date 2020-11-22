<?php 
    /* Realizar programa php (contador.php) que muestre cuantas veces 
       se ha accedido a la página en total y cuantas  veces desde un 
       mismo navegador  trabajando sobre un fichero llamado accesos.txt 
       y con un valor de cookie válido por tres meses.*/
    
    // Obenemos el valor de la tarjeta de COOKIE
    if(isset($_COOKIE["navegador"])){
        $navegadorCookie = $_COOKIE["navegador"];
    }else{
        $navegadorCookie = 0;
        
    }
    
    $navegadorCookie++;    
    setcookie("navegador",$navegadorCookie,time()+ 90*24*3600);
    
    // Definimos la ruta del fichero
    define('FICHERO', 'accesos.txt');
    
    // Obtenemos el fichero en un array por lineas
    $arrayLineas = file(FICHERO);
    
    // Obtenemos el navegador actual
    $navegador = get_browser_name($_SERVER['HTTP_USER_AGENT']);
       
    // Actualizamos el fichero.
    actualizarContenido($arrayLineas,$navegador,$navegadorCookie);
    
    // Obtenemos el fichero actualizado
    $arrayLineas = file(FICHERO);
    
    
    function visualizarContenido($arrayLineas){
        $msj = "";
        foreach ($arrayLineas as $linea){
            $msj .= $linea."<br>";
        }
        return $msj;
    }
    
    
    function actualizarContenido($arrayLineas, $navegador, $navegadorCookie){
        $arrayNavegadores = [];
        
        // Creamos un array asociativo.
        // clave el navegador y contenido las visitas
        foreach ($arrayLineas as $linea){
            $aux = preg_split("/:/", $linea);
            $arrayNavegadores[$aux[0]]=(int)$aux[1];
        }
        
        // Modificamos el valor del navegador
        // O se crea si es la primera vez
        $arrayNavegadores[$navegador]= $navegadorCookie;
    
        // Limpiamos el fichero
        file_put_contents(FICHERO, "");
    
        // Escribimos en el fichero con los datos actualizados
        // Y con el formato navegador:visitas
        foreach ($arrayNavegadores as $clave => $valor){
            $newline = $clave.":".$valor."\n";
            file_put_contents(FICHERO, $newline, FILE_APPEND);
        }
    }
    
    
    //Obtenemos el nombre del navegador
    function get_browser_name($user_agent):string {
        
        // Vamos retornando en las comprobaciones.
        // Con strpos buscamos la posicion de la cadena en caso contrario seria vacio.
        // Edge: por ejemplo contiene Chrome/Safari/Edg por eso es la primera comprobacion.
        // IE: versiones anteriores tenia "MSIE" y la version 11 tiene "Trident/7"
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edg')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        else return 'Other';
    }
     
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Forma de pago</title>
<style type="text/css">
.contenedor {
    margin: 50px;
    padding: 20px;
    border: 3px solid black;
}

h1 { text-align: center;
}


</style>
</head>
<body>
<div class="contenedor">
	<h1>Accediendo a la página</h1>
	<p>Navegador : veces que ha accedido a la página</p>
<p>
<?php
    echo "".visualizarContenido($arrayLineas);  
?>
</p>
</div>
</body>
</html>