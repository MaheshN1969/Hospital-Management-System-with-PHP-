<?php

    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $pincode=$_POST['zipcode'];

    if(isset($_POST['save']))
    {
        $update_date="UPDATE doctors  
                      SET 
                      email_id= ?,
                      contact_no= ?,
                      address= ?,
                      city= ?,
                      state= ?,
                      pincode= ?
                      WHERE username= ? ";

        $stmt = $conn->prepare($update_date);
        $stmt->bind_param("sssssss",$email, $contact, $address, $city, $state, $pincode, $_SESSION['username']);
        $stmt->execute() or die("Unable to execute query");
        $stmt->close();

        header("Location: ../profile_dr.php");
    }else{
        header("Location: ../dashboard_dr.php");
    }	