<?php

$host='localhost';
$user='admin_PELICAN';
$pass='pass_PELICAN';
$dbname='IESA_PELICAN';

try {

    $db = new PDO('mysql:dbname=' .$dbname. ';charset=utf8;host=' .$host, $user, $pass);

} catch (Exception $e) {

    echo 'Error : ' .$e->getMessage();

}