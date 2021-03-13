<?php

    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['change'])){

        $fetch_pass = "SELECT Password FROM patients WHERE Username = ?";

        $stmt = $conn->prepare($fetch_pass);
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute() or die("Unable to execute query");
        $stmt->store_result();
        $stmt->bind_result($fetch_old_pass);
        $stmt->fetch();
        $stmt->close();

        $old_pass = $_POST['old-password'];
        $new_pass = $_POST['new-password'];

        if($fetch_old_pass == $old_pass){
                
            $update_pass="UPDATE patients SET Password = ? WHERE Username= ?;";
            $stmt = $conn->prepare($update_pass);
            $stmt->bind_param("ss", $new_pass, $_SESSION['username']);
            $stmt->execute() or die("Unable to execute query");
            $stmt->close();

            header("Location: ../pat-dashboard.php?success=1");
        }else
            header("Location: ../pat-dashboard.php?success=0");
    }else{
        header("Location: ../pat-dashboard.php");
    }	