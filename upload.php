<?php
    function is_iframe($link){
        if(strpos($link, "<iframe") !== false)
            return true;
        return false;
    }
    if(!isset($_POST["pass"]) || $_POST["pass"] !== "password") die("Invalid password!");
    if(!isset($_POST["name"])) die("Name not specefied");
    if(!isset($_POST["link"]) && !isset($_FILES["fileUp"])) die("No data specefied");   
    $fname = preg_replace("/<(\/)*script>/", "", $_POST["name"]);
    $nameList = fopen("database/list.txt", "r");
    if($nameList) {
        while(!feof($nameList)) {
            $str = fgets($nameList);
            if(substr($str, 0, strpos($str, "<>")) == $fname) die("Post name already used");
        }
        fclose($nameList);
    }
    if(isset($_POST["link"]) && strlen($_POST["link"]) > 2) {
        $nameList = fopen("database/list.txt", "a");
        echo $fname . " has been posted!";
        if($nameList){
            $flink = preg_replace("/<(\/)*script>/", "", $_POST["link"]);
            if(is_iframe($flink)){
                $flink = substr($flink, strpos($flink, "src=\"") + 5);
                $flink = substr($flink, 0, strpos($flink, "\">"));
            }               
            $str = $fname . "<>[iframe]" . $flink;
            fwrite($nameList, $str . "\n");
            fclose($nameList);
        }
    } else {
        $finalFileDir = "database/" . $fname . basename($_FILES["fileUp"]["name"]);
        $type = $_FILES["fileUp"]["type"];
        $type = substr($type, 0, strrpos($type, '/'));
        if($type !== "audio" && $type !== "video") die("Uploaded a non video/audio file");
        if(move_uploaded_file($_FILES["fileUp"]["tmp_name"], $finalFileDir)){
            echo $fname . " has been posted!";
            $nameList = fopen("database/list.txt", "a");
            if($nameList){
                $str = $fname . "<>" . $finalFileDir . "\n";
                fwrite($nameList, $str);
            }
        }
    }
    if(isset($_POST["extra"]) && strlen($_POST["extra"]) > 1) {
        $fdesc = preg_replace("/<(\/)*script>/", "", $_POST["extra"]);
        $descFile = fopen("database/desc/" . $fname . ".txt", "w");
        if($descFile){
            fwrite($descFile, $fdesc);
            fclose($descFile);
        }
    }
    if(isset($_FILES["pic"]) && $_FILES["pic"]["size"] > 5) {
        $finalFileDir = "database/pic/" . $fname . basename($_FILES["pic"]["name"]);
        move_uploaded_file($_FILES["pic"]["tmp_name"], $finalFileDir);
        $f = fopen("database/pic/piclist.txt", "a");
        if($f){
            fwrite($f, $fname . "<>" . $finalFileDir . "\n");
            fclose($f);
        }
    }
?>