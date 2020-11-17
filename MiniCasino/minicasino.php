<?php
    //iniciamos la session
    session_start();
    
    // Obtenemos los valores de la cookie
    if(isset($_COOKIE['visitas'])){
        $visitas = $_COOKIE['visitas'];
        echo $visitas;
    }
    else{
        $visitas = 1;
    }
    
    // Comprobamos que recibimos la cantidad 
    if(!empty($_POST['dinero']) ){               
        //Comprobamos si tenemos los datos de su session
        if(!isset($_SESSION['dineroTotal']) ){
            //En caso contrario creamos la nueva session con dinero
            $_SESSION['dineroTotal'] = $_POST['dinero'];
            $visitas++;
            //Como ha podido iniciar sesion sin problemas actualizamos la cookie
            setcookie("visitas",$visitas,time() + 30*24*3600);
        }
    }
    
   
    
    function calcularGanador($tipo, $dineroApostado):string{
        $numero = rand(1,100);
        $mensaje = "RESULTADO DE LA APUESTA : ";
        
        if($numero%2==0){
            $mensaje .= "PAR</br>";
        }
        else{
            $mensaje .= "IMPAR</br>";
        }
        
        if($tipo == "par" && $numero%2==0 || $tipo == "impar" && $numero%2!=0 ){
            $_SESSION['dineroTotal'] += $dineroApostado;
            $mensaje .= "GANASTE";
        }
        else{
            $_SESSION['dineroTotal'] -= $dineroApostado;
            $mensaje .= "PERDISTE";            
        }
        return $mensaje;
    }
?>
<html>
<head>
<meta charset="UTF-8">
<title>Mini Casino</title>
<style type="text/css">
.contenedor {
    margin: 50px;
    padding: 20px;
    border: 3px solid black;
}
h1{text-align: center;}
</style>
</head>
<body>
<div class="contenedor">
<h1>Mini Casino</h1>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
<?php
// Comprobamos si quiere terminar
// En ese caso mostramos mensaje de adios,
// destruimos la ssesion y refrescamos la pagina
if(isset($_POST['terminar'])){
    echo "Muchas gracias por jugar con nosotros.</br>";
    echo "Su resultado final es de ".$_SESSION['dineroTotal']." euros";
    session_destroy();
    header("Refresh:2");
}

    // COmprobamos si tenemos la session para mostrar el segundo formulario
    if(isset($_SESSION['dineroTotal'])){
    // Nos aseguramos que todos los campos esten rellenos
    // si no seguimos mostrando el mismo formulario
        if(isset($_POST['apostar']) && !empty($_POST['tipoapuesta']) && !empty($_POST['cantidad'])){
            // NOs aseguramos que la cantidad no sea supererior a su dinero disponible
            if($_POST['cantidad']>$_SESSION['dineroTotal']){
                echo "ERROR: no disponde de ".$_POST['cantidad']." euros para jugar</br>";
            }
            else{
                echo "".calcularGanador($_POST['tipoapuesta'],$_POST['cantidad']);   
            }
                
        }
    // Formulario por defecto aunque no haga alguna apuesta
    echo "<p>Dispone de ".$_SESSION['dineroTotal']." euros para jugar</p>";
    ?>
    <p>Cantidad a apostar: <input type="number" name="cantidad"></p>
    <p>Tipo de apuesta: <input type="radio" name="tipoapuesta" value="par"> PAR <input type="radio" name="tipoapuesta" value="impar"> Impar</p>
    <p><button name="apostar">Apostar Cantidad</button><button name="terminar">Abandonar el Casino</button></p>
    <?php     
    }
    // En caso de no tener el saldo en SESSION, mostramos primer formulario
    else{
        echo "<p>Esta es su ".$visitas."º visita.</p>"; 
    ?>
    <p>Introduzca el dinero con el que va a jugar: <input type="number" name="dinero"></p>
    <p><input type="submit" value="JUGAR"></p>
        
    <?php  
    }
?>
</form>	
</div>
</body>
</html>

