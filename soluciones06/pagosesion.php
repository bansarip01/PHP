<?php 
    // Iniciamos la sesión
    session_start();
    
    // La primera vez que iniciemos creara 
    // la formaPago
    if(!isset($_SESSION['formaPago'])){
        $_SESSION['formaPago'] = "";
    }
    else{
        $tarjeta = $_SESSION['formaPago'];
    }
    
    // Comprobamos si recibimos una nueva 
    // tarjeta como forma de pago.
    if(isset($_REQUEST['nuevatarjeta'])){
        $tarjeta = $_REQUEST['nuevatarjeta'];
        $_SESSION['formaPago'] = $tarjeta;
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
<a href='pagosesion.php?nuevatarjeta=cashu'><img  src='imagenes/cashu.gif' /></a>&ensp;
<a href='pagosesion.php?nuevatarjeta=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp;
<a href='pagosesion.php?nuevatarjeta=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp;
<a href='pagosesion.php?nuevatarjeta=mastercard1'><img  src='imagenes/mastercard1.gif'/></a>&ensp;
<a href='pagosesion.php?nuevatarjeta=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp;
<a href='pagosesion.php?nuevatarjeta=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp;
<a href='pagosesion.php?nuevatarjeta=visa_electron'><img  src='imagenes/visa_electron.gif'/></a>
</div>
</body>
</html>
