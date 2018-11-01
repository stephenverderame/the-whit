<?php
    function getPath($postName) {
        $f = fopen("database/list.txt", "r");
        while(!feof($f)){
            $line = fgets($f);
            $name = substr($line, 0, strpos($line, "<>"));
            if($name == $postName){
                $path = substr($line, strpos($line, "<>") + 2);
                echo "<php-data id=\"data\" path=\"" . $path . "\"></php-data>";
            }
        }
        fclose($f);        
    }
?>