<?php
    $file = fopen("database/artists/list.txt", "r");
    $empty = true;
    while(!feof($file)){
        $empty = false;
        $artist = explode("<>", fgets($file));
        if(count($artist) != 3) continue;
        echo "<div class=\"artist\">";
        echo "<img src=\"" . $artist[2] . "\"/>";
        echo "<h2>" . $artist[0] . "</h2>";
        echo "<h4>" . $artist[1] . "</h4>";
        echo "</div><br><br>";
    }
    if($empty) echo "<tr arial big words><td>No Artists</td></tr>";
?>