<?php
            
    //starting the session
    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['resign'])){

        $stmt = $conn->query("DELETE FROM doctors WHERE id = '$_SESSION[userid]';");

        header("Location: ../status-dr.php?status=4");

    }else{
        header("Location: logout-inc.php");
    }