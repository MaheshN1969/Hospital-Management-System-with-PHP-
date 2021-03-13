<?php
            
    //starting the session
    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    //checking register btn is set or not
    if(isset($_POST['login-submit'])){

        $username = $_POST['username'];
        $password =  $_POST['password'];

        //query to select user from db
        $sql = "SELECT Patient_ID, Username FROM patients WHERE Username = ? AND Password = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute() or die("Unable to execute select query");

        //storing the result of executed query
        $stmt->store_result();

        if($stmt->num_rows != 1){

            //closing the prepared statement
            $stmt->close();

            //if user not found then return to index page
            header("Location: ../pat_login.php?dberror=notfound");
        }else{
            // binding the parameters for result
            $stmt->bind_result($user_id, $user_name);
            
            // fectching those results
            $stmt->fetch();

            //checking if the doctor is not verified 
            // if($verify != 1){
            //     header("Location: ../status.php?status=2");
            // }
        
            //making session variables
            $_SESSION['userid'] = $user_id;
            $_SESSION['username'] = $user_name;

            //free the stored result
            $stmt->free_result();

            //closing the prepared statement
            $stmt->close();

            //redirect to homepage
            header("Location: ../pat-dashboard.php");
        } 
    }
