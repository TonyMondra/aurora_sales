<?php
$conbd = new mysqli('localhost','root','vg8sqHvgmM9Z!#8r7M!^d$SYV','aurora_sales');

if ($conbd->connect_errno) {
    die ("Conexion no exitosa".$conbd->connect_errno);
}

?>