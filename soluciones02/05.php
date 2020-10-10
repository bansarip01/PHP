<html>
<head>
</head>
<body>
    <?php 
        /*Realizar y probar una  función que genere el código HTML 
        de tablas con un borde determinado, incluyendo en cada 
        casilla el mismo texto.*/
        
    generarHTMLtable(5,5,"1px solid blue","HOLA");
        
    
        function generarHTMLTable($filas, $columnas,$borde,$contenido){
            echo "<table style =\"border:".$borde."\">";
            for ($i=1; $i<=$filas;$i++){
                echo "<tr>";
               
                for($j=1;$j<=$columnas;$j++){
                    echo "<td>".$contenido."</td>";
                }
                
                echo "</tr>";
            }
            echo "</table>";
            
        }
    ?>
</body>
</html>