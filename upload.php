<?php
    if(!isset($_POST["name"])) die("Name not specefied");
    if(!isset($_POST["link"]) && !isset($_FILES["fileUp"])) die("No data specefied");
    $nameList = fopen("database/list.txt", "r");
    if($nameList) {
        while(!feof($nameList)) {
            $str = fgets($nameList);
            if(substr($str, 0, strpos($str, "<>")) == $_POST["name"]) die("Post name already used");
        }
        fclose($nameList);
    }
    if(isset($_POST["link"]) && strlen($_POST["link"]) > 2) {
        $nameList = fopen("database/list.txt", "a");
        echo $_POST["name"] . " has been posted!";
        if($nameList){
            $str = $_POST["name"] . "<>" . $_POST["link"];
            fwrite($nameList, $str . "\n");
            fclose($nameList);
        }
    } else {
        $finalFileDir = "database/" . $_POST["name"] . basename($_FILES["fileUp"]["name"]);
        $type = $_FILES["fileUp"]["type"];
        $type = substr($type, 0, strrpos($type, '/'));
        if($type !== "audio" && $type !== "video") die("Uploaded a non video/audio file");
        if(move_uploaded_file($_FILES["fileUp"]["tmp_name"], $finalFileDir)){
            echo $_POST["name"] . " has been posted!";
            $nameList = fopen("database/list.txt", "a");
            if($nameList){
                $str = $_POST["name"] . "<>" . $finalFileDir . "\n";
                fwrite($nameList, $str);
            }
        }
    }
    if(isset($_POST["extra"]) && strlen($_POST["extra"]) > 1) {
        $descFile = fopen("database/desc/" . $_POST["name"] . ".txt", "w");
        if($descFile){
            fwrite($descFile, $_POST["extra"]);
            fclose($descFile);
        }
    }
    if(isset($_FILES["pic"]) && $_FILES["pic"]["size"] > 5) {
        $finalFileDir = "database/pic/" . $_POST["name"] . basename($_FILES["pic"]["name"]);
        move_uploaded_file($_FILES["pic"]["tmp_name"], $finalFileDir);
        $f = fopen("database/pic/piclist.txt", "a");
        if($f){
            fwrite($f, $_POST["name"] . "<>" . $finalFileDir . "\n");
            fclose($f);
        }
    }
?>