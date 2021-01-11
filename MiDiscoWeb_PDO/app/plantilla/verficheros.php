
<?php
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];

//Podremos un ejemplo de un fichero y las ordenes falta por implementar
?>
<h3>Ficheros del Usuario <?= $_SESSION['user'] ?></h3>
<table>
<tr><th>Nombre</th><th>Tipo</th><th>Fecha</th><th>Tamaño</th><th colspan="3">Operaciones</th></tr>

<tr>
<td>Ejemplo.txt</td>
<td>Texto</td>
<td>11/01/2021</td>
<td>300 bytes</td>
<td><a>Borrar</a></td>
<td><a>Renombrar</a></td>
<td><a>Compartir</a></td>
</tr>
</table>  

<form action='index.php'> 
<input type='hidden' name='orden' value='Cerrar'> 
<input type='submit' value='Cerrar Sesión'> 
</form>

<form action='index.php'> 
<input type='hidden' name='id' value=<?= $_SESSION['user']?>> 
<input type='hidden' name='orden' value='Modificar'> 
<input type='submit' value='Modificar Datos'> 
</form>      

<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal
$contenido = ob_get_clean();
include_once "principal.php";

?>