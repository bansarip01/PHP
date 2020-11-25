/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar el usuario:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}

function confirmarGuardar(){
  if (confirm("¿Quieres guardar los cambios realizados?"))
  {
   	document.getElementById("guardar").value="si";
  }
else {
	document.getElementById("guardar").value="no";
}
}