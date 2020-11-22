<?php 
    // Obenemos el valor de la tarjeta de COOKIE
    if(isset($_COOKIE["tarjetaDefinida"])){
        $tarjeta = $_COOKIE["tarjetaDefinida"];
    }
    
    // Comprobamos si recibimos una nueva 
    // tarjeta como forma de pago
    if(!empty($_REQUEST['nuevatarjeta'])){
        $tarjeta = $_REQUEST['nuevatarjeta'];
        // Creamos la cookie con 3 días de duración
        setcookie("tarjetaDefinida",$tarjeta,time()+ 3*24*3600);
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
<?php if(!isset($tarjeta)){ ?>
	<H2> NO TIENE FORMA DE PAGO ASIGNADA</H2> <br>
<?php 
}
else {
    ?>
    <H2> SU FORMA DE PAGO ACTUAL ES</H2> <br>
 	<a> <img src='imagenes/<?= $tarjeta?>.gif' /></a>   
<?php 
}
?>      
 <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>
 <a href='pagocookie.php?nuevatarjeta=cashu'><img  src='imagenes/cashu.gif' /></a>&ensp;
 <a href='pagocookie.php?nuevatarjeta=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp;
 <a href='pagocookie.php?nuevatarjeta=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp;
 <a href='pagocookie.php?nuevatarjeta=mastercard1'><img  src='imagenes/mastercard1.gif'/></a>&ensp;
 <a href='pagocookie.php?nuevatarjeta=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp;
 <a href='pagocookie.php?nuevatarjeta=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp;
 <a href='pagocookie.php?nuevatarjeta=visa_electron'><img  src='imagenes/visa_electron.gif'/></a>  
</div>
</body>
</html>
