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

        $admin_username="admin";
		$admin_password="admin123";

        $input_username=$_POST['username'];   //name of username input 
        $input_password=$_POST['password'];		// name of password input
        if(($admin_username==$input_username)&&($admin_password==$input_password))	
        {				
            // returning to admin page
            header("Location: ../Admin_dashboard.php");
        }
        else
        {
            
            header("Location: ../demo.php");

        }
        
    } else{
        //else returning to same file
        header("Location: ../demo.php");
    }
