<?php
    function fileExtension($path){
        return substr($path, strrpos($path, '.'));
    }
    $f = fopen("database/artists/list.txt", "r");
    while(!feof($f)){
        $line = fgets($f);
        $name = substr($line, 0, strpos($line, "<>"));
        if($name == $_POST["name"]) die("Artist already added!");
    }
    fclose($f);
    $finalPicDir = "database/artists/" . $_POST["name"] . fileExtension($_FILES["pic"]["name"]);
    if(!move_uploaded_file($_FILES["pic"]["tmp_name"], $finalPicDir)) die("Upload failed!");
    $f = fopen("database/artists/list.txt", "a");
    fwrite($f, $_POST["name"] . "<>" . $_POST["genre"] . "<>" . $finalPicDir . "\n");
    fclose($f);
    echo $_POST["name"] . " was added as an artist!";
?>