<?php

    $numuno = random_int(1,10);
    $numdos = random_int(1,10);

    echo "<table border=\"1\">";

    echo "<tr><th>Operación</th>";
    echo "<th>Resultado</th></tr>";

    for($i=1; $i<=6; $i++){
        
        if ($i%2==0){
            echo "<tr><th style=\"background-color:gray\">";
        }else{
            echo "<tr><th>";
        }
        
        switch($i){
            case 1 : echo $numuno." + ".$numdos."</th>";
                     echo "<th>".($numuno+$numdos);
                     break;
            case 2 : echo $numuno." - ".$numdos."</th>";
                     echo "<th style=\"background-color:gray\">".($numuno-$numdos);
                     break;
            case 3 : echo $numuno." * ".$numdos."</th>";
                     echo "<th>".($numuno*$numdos);
                     break;
            case 4 : echo $numuno." / ".$numdos."</th>";
                     echo "<th style=\"background-color:gray\">".($numuno/$numdos);
                     break;
            case 5 : echo $numuno." % ".$numdos."</th>";
                     echo "<th>".($numuno%$numdos);
                     break;
            case 6 : echo $numuno." + ".$numdos."</th>";
                     echo "<th style=\"background-color:gray\">".($numuno+$numdos);
                     break;
        }

        echo "</th></tr>";

    }
    echo "</table>";