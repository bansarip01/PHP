<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();

if ($_GET['orden']=="Modificar") $modo=$_SESSION['modo'];
// FORMULARIO DE ALTA Y MODIFICACION DE USUARIOS
?>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='ALTA' method="POST" action="index.php?orden=<?= ($_GET['orden']=="Alta")?"Alta":"Modificar&id=".$_GET['id']?>">
	<h1><?= ($_GET['orden']=="Alta")?"Alta Usuario":"Modificar Usuario" ?></h1>
	<table>
		<tr>
			<td>Identificador</td>
			<td><input type="text" name="id"
				value="<?= $datosUser['id'] ?>" <?=(isset($modo))?"disabled":""?>></td>
		</tr>
		<tr>
			<td>Nombre</td>
			<td><input type="text" name="nombre"
				value="<?= $datosUser['nombre'] ?>" <?=(isset($modo) && $modo==GESTIONFICHEROS)?"disabled":""?>></td>
		</tr>
		<tr>
			<td>Correo Electrónico</td>
			<td><input type="text" name="correo"
				value="<?= $datosUser['correo'] ?>"></td>
		</tr>
		<tr>
			<td>Contraseña</td>
			<td><input type="password" name="clave"
				value="<?= $datosUser['clave'] ?>"></td>
		</tr>
		<tr>
			<td>Repita Contraseña</td>
			<td><input type="password" name="reclave"
				value="<?= $datosUser['reclave'] ?>"></td>
		</tr>
		<?php if(isset($modo) && $modo==GESTIONUSUARIOS):?>
		<tr>
			<td>Estado</td>
			<td>
				<select name="estado">
    				<option value="A" <?= ($datosUser['estado']==ESTADOS['A'])? "selected":""?>>Activo</option> 
                    <option value="B" <?= ($datosUser['estado']==ESTADOS['B'])? "selected":""?>>Bloqueado</option>
                    <option value="I"<?= ($datosUser['estado']==ESTADOS['I'])? "selected":""?>>Inactivo</option>
				</select>
			</td>
		</tr>
		<?php endif?>
		<tr>
			<td>Plan</td>
			<td>
				<select name="plan">
    				<option value="0" selected>Básico</option> 
                    <option value="1" <?= ($datosUser['plan']==PLANES['1'])? "selected":""?>>Profesional</option>
                    <option value="2" <?= ($datosUser['plan']==PLANES['2'])? "selected":""?>>Premium</option>
                    <option value="3" <?= ($datosUser['plan']==PLANES['3'])? "selected":""?>>Master</option>
				</select>
			</td>
		</tr>
	</table>
	<input type="submit" value="<?= ($_GET['orden']=="Alta")?"Alta":"Modificar Usuario" ?>">
</form>
<form action="index.php">
	<input type="submit" value="Cancelar">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>