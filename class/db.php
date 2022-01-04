<?php
session_start();
function connect() {
$dbase = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','root');
[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
return $dbase;
}


?>