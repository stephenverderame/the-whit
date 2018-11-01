<?php
    $file = fopen("database/artists/list.txt", "r");
    while(!feof($file)){
        $artist = explode("<>", fgets($file));
        if(count($artist) != 3) continue;
        echo "<tr><td><img src=\"" . $artist[2] . "\"/></td></tr>";
        echo "<tr><td>" . $artist[0] . "</td></tr>";
        echo "<tr genre><td>" . $artist[1] . "</td></tr>";
    }
?>