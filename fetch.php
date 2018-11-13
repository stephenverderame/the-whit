<?php
    function getPath($postName) {
        $f = fopen("database/list.txt", "r");
        while(!feof($f)){
            $line = fgets($f);
            $name = substr($line, 0, strpos($line, "<>"));
            if($name == $postName){
                $path = substr($line, strpos($line, "<>") + 2);
                $description = "";
                if(file_exists("database/desc/" . $postName . ".txt")){
                    $fd = fopen("database/desc/" . $postName . ".txt", "r");
                    while(!feof($fd)){
                        $str = fgets($fd);
                        $description .= $str;
                    }
                    fclose($fd);
                }
                echo "<php-data id=\"data\" path=\"" . $path . "\" desc=\"" . $description . "\"></php-data>";
            }
        }
        fclose($f);        
    }
?>