<?php
            
    //starting the session
    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    //checking register btn is set or not
    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password =  $_POST['password'];

        //query to select user from db
        $sql = "SELECT id, username, verified FROM doctors WHERE username = ? AND password = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute() or die("Unable to execute select query");

        //storing the result of executed query
        $stmt->store_result();

        if($stmt->num_rows != 1){

            //closing the prepared statement
            $stmt->close();

            //if user not found then return to index page
            header("Location: ../dr_login.php?dberror=notfound");
        }else{
            // binding the parameters for result
            $stmt->bind_result($user_id, $user_name, $verify);
            
            // fectching those results
            $stmt->fetch();

            // checking if the doctor is not verified 
            if($verify == 0){
                header("Location: ../status-dr.php?status=2");
            }else if($verify == -1){
                header("Location: ../status-dr.php?status=3&id=$user_id");
            }else{
                //making session variables
                $_SESSION['userid'] = $user_id;
                $_SESSION['username'] = $user_name;

                //free the stored result
                $stmt->free_result();

                //closing the prepared statement
                $stmt->close();

                //redirect to homepage
                header("Location: ../dr_homepage.php");
            }      
        } 
    } else{
        //else returning to same file
        header("Location: ../doctor_reg.php");
    }
