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
                if(strpos($path, "[iframe]") === false)
                  echo "<php-data id=\"data\" path=\"" . $path . "\" desc=\"" . $description . "\"></php-data>";
                else {
                  $path = substr($path, strpos($path, "[iframe]") + 8);
                  echo "<php-data id=\"data\" path=\"" . $path . "\" desc=\"" . $description . "\"></php-data>";
                }
            }
        }
        fclose($f);        
    }
    
    function mediaType() {
       if(isset($_POST["frame"])){
         echo "<iframe frameborder=\"no\" scrolling=\"no\" id=\"frame\" src=\"\"></iframe>";
         echo "<php-data id=\"type\" type=\"frame\"></php-data>";
       }
       else {
         echo "<video id=\"vid\" controls></video>";
         echo "<php-data id=\"type\" type=\"vid\"></php-data>";
       }
    }
?>