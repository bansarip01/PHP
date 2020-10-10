<html>
<head>
</head>
<body>
<?php

    $numuno = random_int(1,10);
    $numdos = random_int(1,10);

    echo "<table border=\"1\">";

    echo "<tr><th style=\"background-color: #a6a6a6; color: #006bb3\">Operación</th>";
    echo "<th style=\"background-color: #a6a6a6; color: #006bb3\">Resultado</th></tr>";

    for($i=1; $i<=6; $i++){
        
        if ($i%2==0){
            echo "<tr><td style=\"background-color:#d9d9d9\">";
        }else{
            echo "<tr><td>";
        }
        
        switch($i){
            case 1 : echo $numuno." + ".$numdos."</td>";
                     echo "<td>".($numuno+$numdos);
                     break;
            case 2 : echo $numuno." - ".$numdos."</td>";
                     echo "<td style=\"background-color:#d9d9d9\">".($numuno-$numdos);
                     break;
            case 3 : echo $numuno." * ".$numdos."</td>";
                     echo "<td>".($numuno*$numdos);
                     break;
            case 4 : echo $numuno." / ".$numdos."</td>";
                     echo "<td style=\"background-color:#d9d9d9\">".($numuno/$numdos);
                     break;
            case 5 : echo $numuno." % ".$numdos."</td>";
                     echo "<td>".($numuno%$numdos);
                     break;
            case 6 : echo $numuno." + ".$numdos."</td>";
                     echo "<td style=\"background-color:#d9d9d9\">".($numuno+$numdos);
                     break;
        }

        echo "</td></tr>";

    }
    echo "</table>";
?>
</body>
</html>