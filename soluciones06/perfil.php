<?php 
    // Obtenemos los valores cookies
    if(isset($_COOKIE["edad"])){
        $edad = $_COOKIE['edad'];
        $genero = $_COOKIE['genero'];
        $deportes = $_COOKIE['deportes'];
    }
    

    // comprobamos si recibimos nuevos datos    
    if(isset($_REQUEST['almacenar'])){
        
        $edad = $_REQUEST['edad'];
        $genero = $_REQUEST['genero'];       
        $deportesNuevos = $_REQUEST['depor'];
        
        setcookie("edad",$edad,time() +7*24*3600);
        setcookie("genero",$genero,time() +7*24*3600);
        
        if(isset($deportes)){
            foreach ($deportes as $dep) {
                setcookie("deportes[$dep]",$dep,time() -7*24*3600);
            }
        }
        
        foreach ($deportesNuevos as $dep) {
            setcookie("deportes[$dep]",$dep,time() +7*24*3600);
        }        
    }
    
    if(isset($_REQUEST['eliminar']) && isset($_COOKIE["edad"])){
        setcookie("edad",$edad,time() -7*24*3600);
        setcookie("genero",$genero,time() -7*24*3600);
        setcookie("deportes",$deportes,time() -7*24*3600);
        foreach ($deportes as $dep) {
            setcookie("deportes[$dep]",$dep,time() -7*24*3600);
        }
        header("refresh: 0");
    }    
    
    function escribirDeportes($deporte) {
        global $deportes;
        $msj = "";
        foreach ($deportes as $dep) {
            if ($dep == $deporte){
                $msj = "selected";
            }
        }
        return $msj;
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
<h1>SUS DATOS ALMACENADOS</h1>
<form action="perfil.php" method="get">
 <p>Edad <input type="number" name="edad" value="<?= isset($edad)? $edad: ""; ?>"></p>
 <p>Genero: 
  Mujer <input type="radio" name="genero" value="mujer" <?= isset($genero) && $genero =='mujer' ? "checked" : "" ; ?>> 
  Hombre <input type="radio" name="genero" value="hombre" <?= isset($genero) && $genero =='hombre' ? "checked" : "";?>></p>
 <p>Deportes</p>
 <select name="depor[]" multiple>
  <option value="futbol" <?= isset($deportes) ? escribirDeportes("futbol"):"" ?>>Futbol</option>
  <option value="tenis" <?= isset($deportes) ? escribirDeportes("tenis"):"" ?>>Tenis</option>
  <option value="ciclismo" <?= isset($deportes) ? escribirDeportes("ciclismo"):"" ?>>Ciclismo</option>
  <option value="otro" <?= isset($deportes) ? escribirDeportes("otro"):"" ?>>Otro</option>
 </select>
 <p>
  <button name="almacenar" value="almacenar">Almacenar Valores</button>
  <button name="eliminar" value="eliminar">Eliminar Valores</button>
 </p>
</form>
</div>
</body>
</html>