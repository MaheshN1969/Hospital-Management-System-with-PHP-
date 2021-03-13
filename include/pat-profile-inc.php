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
    $pincode=$_POST['pincode'];

    if(isset($_POST['save']))
    {
        $update_date="UPDATE patients  
                      SET 
                      Email_ID= ?,
                      Contact_No= ?,
                      Postal_Address= ?,
                      City= ?,
                      State= ?,
                      Pin_code= ?
                      WHERE Username= ? ";

        $stmt = $conn->prepare($update_date);
        $stmt->bind_param("sssssss",$email, $contact, $address, $city, $state, $pincode, $_SESSION['username']);
        $stmt->execute() or die("Unable to execute query");
        $stmt->close();

        header("Location: ../pat-profile.php");
    }else{
        header("Location: ../pat-dashboard.php");
    }	