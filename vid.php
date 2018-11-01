<?php
    require "fetch.php";
    getPath($_POST["name"]);
?>
<html>
<head>
	<title>The Whit</title>
	<LINK rel=stylesheet type="text/css" href="style.css">
</head>
<br><br><br>
<video id="vid" src=""></video>
<script type="text/javascript" src="gen.js"></script>
<script>
var url = document.getElementById('data').getAttribute('path');
if(url){
    confirm('MESS: ' + url);
    document.getElementById('vid').setAttribute('src', url);
}
</script>
</html>
