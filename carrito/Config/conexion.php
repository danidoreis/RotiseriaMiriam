<?php
$manejador="mysql";
$servidor="localhost";
$usuario="root";
$pass="";
$base="id14497134_base_de_datos";
$cadena="$manejador:host=$servidor;dbname=$base";
$cnx = new PDO($cadena,$usuario,$pass);
?>
