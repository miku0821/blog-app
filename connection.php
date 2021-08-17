<?php
    function db_connect(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db_name = "blog";

        $conn = new mysqli($servername, $username, $password, $db_name);

        if($conn->connect_error){
            die("Connaction Failed".$conn->connect_error);
        }
        return $conn;
    }
?>