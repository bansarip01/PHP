<?php 
    // Iniciamos la sesión
    session_start();
    
    // Obenemos el valor de COOKIE
    if(isset($_COOKIE["partidas"])){
        $partidaGanadas = $_COOKIE["partidas"];
    }
    
    // INICIO NO HAY PALABRA ELEGIDA
    if (! isset($_SESSION['palabrasecreta'])) {
        $_SESSION['palabrasecreta'] = elegirPalabra();
        $_SESSION['palabrausuario'] = ""; // Inicialmente no tiene ninguna letra
        $_SESSION['fallos'] = 0; // Inicialmente no hay ningún fallo
    }
    
    //añadimos la nueva letra a la session del usuario
    if (!empty($_REQUEST['letra'])){
        $letraNueva = $_REQUEST['letra'];
        $_SESSION['palabrausuario'] .= $letraNueva;
        
        // Si la letra introducida no se encuentra en la palabra secreta
        // Incrementamos los fallos del usuario en la sesion
        if(!comprobarLetra($letraNueva,$_SESSION['palabrasecreta'])){
            $_SESSION['fallos']++;
        }
    }
    
    function elegirPalabra(){
        static $tpalabras = ["Madrid","Sevilla","Murcia","Málaga","Mallorca","Menorca"];
        $aleatorio = rand(0,5);
         
        return $tpalabras[$aleatorio];// Devuelve una palabra al azar
    }
    
    function comprobarLetra($letra,$cadena){
        $resu = false;        
        if (substr_count($cadena, $letra)>0){
            $resu = true;
        }
        return  $resu;// Devuelve true o false si la letra esta en la cadena
    }
    
    
    /*
     * Devuelve una cadena donde aparecen las letras de la cadenapalabra en su posición    
     * si cada letra se encuentra en la cadenaletras
     *
     * Ej  generaPalabraconHuecos("aeiou"     ,"hola pepe") -->"-o-a--e-e"
     *     generaPalabraconHuecos("abcdefghi ","hola pepe") -->"h--a -e-e"
     *
     */
    
    function generaPalabraconHuecos ( $cadenaletras, $cadenapalabra) {
        
        // Genero una cadena resultado inicialmente con todas las posiciones con -
        $resu = $cadenapalabra;
        for ($i = 0; $i<strlen($resu); $i++){
            $resu[$i] = "-";
        }
        
        $cadenaUsuario = $cadenaletras;

        // COMPLETAR rellenado la cadena resu
        for ($i = 0; $i<strlen($resu); $i++){
            $letra = $cadenapalabra[$i];

            if(comprobarLetra($letra, $cadenaUsuario)){
                $resu[$i]=$letra;

            }
        }
        
        return $resu;
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
    text-align: center;
}
</style>
</head>
<body>
<div class="contenedor">
<h1> Juego Palabra Oculta</h1>
<form action="juegopalabraoculta.php" method="get">
<p>Palabra
<?php 
$palabraJuego = generaPalabraconHuecos($_SESSION['palabrausuario'],$_SESSION['palabrasecreta']);
echo $palabraJuego;
?>
</p>
<p>Has cometido fallos <?php echo "".$_SESSION['fallos'];?> </p>
<p>Introduzca una letra: <input type="text" name="letra" value=""></p>
<p><input type="submit" value="COMPROBAR LETRA"></p>
</form>	
<?php

//Comprobamos si la palabra ya esta adivinada
if($_SESSION['palabrasecreta']==$palabraJuego){
    //Comprobomos si tenemos un cookie
    //en caso contrario la crea.
    if(isset($partidaGanadas)){
        $partidaGanadas++;
        setcookie("partidas", $partidaGanadas,time()+ 14*24*3600);
    }
    else {
        setcookie("partidas","1",time()+ 14*24*3600);
    }
    
    // Cerramos la session
    session_destroy();
    echo "FELICIDADES LA HAS ADIVINIDO <br>";
    echo "<a href='http://localhost/PalabraOculta/juegopalabraoculta.php'>OTRA PARTIDA</a><br>";
}
else{
    // Si ha superado los fallos
    // Indicamos que ha perdido y reiniciamos el juego
    if($_SESSION['fallos']==5){
        session_destroy();
        echo "HAS PERDIDO: La palabra era: ".$_SESSION['palabrasecreta']."<br>";
        echo "<a href='http://localhost/PalabraOculta/juegopalabraoculta.php'>OTRA PARTIDA</a><br>";
    }
}

// En caso que tengamos cookies 
// le informamos de sus partidas ganadas
if(isset($partidaGanadas)){
    echo "Ya son ".$_COOKIE['partidas']." ganadas.";
}

?>
</div>
</body>
</html>