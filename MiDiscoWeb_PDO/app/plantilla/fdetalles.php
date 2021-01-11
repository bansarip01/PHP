<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
// Detalles del usuario
?>
<table>
	<tr>
		<td>Nombre</td>
		<td><?= $datosUser['nombre']?></td>
	</tr>
	<tr>
		<td>Correo Electrónico</td>
		<td><?= $datosUser['correo']?></td>
	</tr>
	<tr>
		<td>Plan</td>
		<td><?= $datosUser['plan']?></td>
	</tr>
	<tr>
		<td>Número de ficheros</td>
		<td><?= $datosUser['nficheros']?></td>
	</tr>
	<tr>
		<td>Espacio Ocupado</td>
		<td><?= $datosUser['espacio']?></td>
	</tr>
</table>
<form action="index.php">
	<input type="submit" value="Volver">
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>