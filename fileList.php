<?php
    function not_link($path){
        if(strpos($path, ".com") === false && strpos($path, "http") === false) return true;
        return false;
    }
    function getPicPath($name, $array) {
        foreach($array as $pic){
            if($name == substr($pic, 0, strpos($pic, "<>"))){
                return substr($pic, strpos($pic, "<>") + 2);
            }
        }
        return false;
    }
    function numToClass($num) {
        switch($num){
            case 1:
                return "one";
            case 2:
                return "two";
            case 3:
                return "three";
            case 4:
                return "four";
            case 5:
                return "five";
            default:
                return "article";
        }
    }

    $list = fopen("database/list.txt", "r");
    $picsList = fopen("database/pic/piclist.txt", "r");
    $posts = array();
    $pics = array();
    $i = 0;
    while(!feof($list)){
        $post = fgets($list);
        if(strlen($post) < 1) continue;
        $posts[$i++] = $post;
    }
    $i = 0;
    while(!feof($picsList)){
        $picData = fgets($picsList);
        if(strlen($picData) < 1) continue;
        $pics[$i++] = $picData;
    }
    fclose($picsList);
    fclose($list);
    for($j = count($posts) - 1; $j >= 0; $j--) {
        $name = substr($posts[$j], 0, strpos($posts[$j], "<>"));
        $path = substr($posts[$j], strpos($posts[$j], "<>") + 2);
        if(not_link($path))
            echo "<div class=\"" . numToClass(count($posts) - $j) . "\" l=\"vid~" . $path . "\">";
        else
            echo "<div class=\"" . numToClass(count($posts) - $j) . "\">";
        echo "<h2 arial bt><strong><u>" . $name . "</u></strong></h2><br>";
        if(file_exists("database/desc/" . $name . ".txt")){
            $f = fopen("database/desc/" . $name . ".txt", "r");
            $line1 = substr(fgets($f), 0, 100);
            echo "<p arial bt>" . $line1 . "</p><br>";
            fclose($f);
        }
        $picPath = getPicPath($name, $pics);
        if(!($picPath === false)){
            echo "<img src=\"" . $picPath . "\"/>";
        }
        if(!not_link($path)){
            echo "<a href=\"" . $path . "\">Visit Soundcloud</a>";
        }
        echo "</div>";


    }
?>