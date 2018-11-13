<?php
    require "fetch.php";
    getPath($_POST["name"]);
?>
<html>
<head>
        <title>The Whit</title>
	<link rel=stylesheet type="text/css" href="style2.css">
        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="icon" href="favicon.png">
</head>
<style>
    body{
        text-align: center;
    }
    div.header{
        text-align: left;
    }
    
    div.desc{
        font-family: "Karel", sans-serif;
        box-shadow: 2px 2px 2px 2px gray;
        border-radius: 4px;
        background-color: white;
        height: 15vh;
        width: 60vw;
        margin: 0 auto;
    }
    p{
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        padding: 10px 0px 10px 0px
    }
</style>

<div class="header">
    <a href="index.html" id="title">The Whit</a>
    <img src="whitImage.jpg"/>
    <div class="header-right">
       <a href="index.html" id="home">Home</a>
       <a href="prof.html" id="profiles">Artist Profiles</a>
    </div>
</div>

<body>
<br><br>
<video controls id="vid" src=""></video>
<br><br>
<div class="desc">
<p id="vidDesc"></p>
</div>
</body>
<script>
var url = document.getElementById('data').getAttribute('path');
if(url){
    document.getElementById('vid').setAttribute('src', url);
}
var description = document.getElementById('data').getAttribute('desc');
if(description){
    document.getElementById('vidDesc').innerHTML = description;
}
</script>
</html>
