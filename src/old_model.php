<?php

//require('connect.php');

    /*
     *  GET PELICAN_test
     */

    function getTEST()
    {

        $host='localhost';
        $user='admin_PELICAN';
        $pass='pass_PELICAN';
        $dbname='IESA_PELICAN';

        try {
            $db = new PDO('mysql:dbname=' .$dbname. ';charset=utf8;host=' .$host, $user, $pass);
        } catch (Exception $e) {
            echo 'Error : ' .$e->getMessage();
        }

        $TEST = $db->prepare('SELECT * FROM PELICAN_test');
        $TEST->execute();
        $TEST_row = $TEST->fetchall(PDO::FETCH_ASSOC);
        return $TEST_row;

    }