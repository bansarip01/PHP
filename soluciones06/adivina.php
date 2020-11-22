<?php
    // Iniciamos la sesion
    session_start();
        
    if(!isset($_SESSION['intentos'])){
        $_SESSION['intentos'] = 5;
        $_SESSION['numeroAdivinar'] = 10;//rand(1,20);
    }  
    
    // Cierra sesion y refresca la página
    if(isset($_REQUEST['nuevaPartida']) && $_SESSION['intentos']!=5){
        session_destroy();
        header("refresh: 0");
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
<h1> Juego de Adivinar el Número</h1>
<form action="adivina.php" method="get">
<p>Número: <input type="number" name="numero" value=""></p>
<p>
 <button name="adivinar"> ADIVINAR</button>
 <button name="nuevaPartida"> NUEVA PARTIDA</button>
</p>	
</form>	
<?php
    $msj ="";
    // Intenta adivinar el número
    if(isset($_REQUEST['adivinar'])){
        $_SESSION['intentos']--;
        if($_REQUEST['numero']>$_SESSION['numeroAdivinar']){
            $msj .= "<h2> El número es inferior a ".$_REQUEST['numero']."</h2>";
                    
        }
        elseif($_REQUEST['numero']<$_SESSION['numeroAdivinar']){
            $msj = "<h2> El número es superior a ".$_REQUEST['numero']."</h2>";
        }
        else{
            $msj = "<h2> FELICIDADES LO HAS ADIVINADO</h2>";
        }
    }        
    
    $msj .= "<h3> Te quedan ".$_SESSION['intentos']." intentos</h3>";
    
    if($_SESSION['intentos']==0 && $_REQUEST['numero']!=$_SESSION['numeroAdivinar'] ){
        $msj = "<h2> HAS PERDIDO el número era ".$_SESSION['numeroAdivinar'];
    }
    echo $msj;
    
    
?>
</div>
</body>
</html>