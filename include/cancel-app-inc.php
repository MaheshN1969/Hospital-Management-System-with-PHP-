<?php
    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['cancel'])){
        $query = "DELETE FROM Appointment WHERE app_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i',$_POST['app-id']);
        $stmt->execute() or die("Unable to execute query");
        header("Location: ../pat-dashboard.php?canceled=1");
    }else{
        header("Location: logout-inc.php");
    }