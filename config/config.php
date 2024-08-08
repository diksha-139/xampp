<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $server ="localhost";
    $username ="root";
    $pass ="";
    $db ="fruit_market";

    $conn = mysql_connect("$server","$username","$pass") or die(mysql_error());

    mysql_select_db($db,$conn);
  


?>