<?php
    if(!isset($_POST["pass"]) || $_POST["pass"] !== "password") echo "false";
    else echo "true";
?>