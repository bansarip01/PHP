<html>
<head>
</head>
<body>
    <?php 
        /*Generar un número entre 1 y 10  y mostrar una muralla 
        de  asteriscos con tantas almenas como indique el usuario. 
        Nota: una almena está formada dos filas de  cuatro asterisco,  
        y entre almena y almena hay un  espacio.*/
        
        dibujarMuralla();
        
        
        function dibujarMuralla(){
            $num = random_int(1,10);
            echo "Número aleatorio: ".$num."<br><br>";
            for($i=1; $i<=$num;$i++){
                
                for($j=1;$j<=$num;$j++){
                    echo "****";
                    if ($i!=$num) echo "&nbsp";
                    if ($i==$num && $j!=$num) echo "*";
                }
                
                echo "<br>";
                
            }
            
        }
        
    ?>
</body>
</html>