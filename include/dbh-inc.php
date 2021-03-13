<?php

    $servername = "localhost:3306";
    $dbname = "hospital";
    $dbuser = "root";
    $dbpass = "";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try{
        $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
        echo("<script type= 'text/javascript'>alert('DB Mysqli Connection Status : Success'); </script>");
    }catch(Exception $e){
        die("Connection failed : ". $e->getMessage());
    }