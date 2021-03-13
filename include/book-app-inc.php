<?php
    session_start();

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['book'])){

        if(empty($_POST['app-date-input']) || empty($_POST['app-time-input'])){
            header("Location: ../book_app.php?emptyFields=1");
        }else{
            $wrong_date = explode("/", $_POST['app-date-input']);
            $app_time = $_POST['app-time-input'];

            $app_date = $wrong_date[2].'-'.$wrong_date[1].'-'.$wrong_date[0];
            
            $doc_id= $_POST['doc-id'] ;
            $pat_id= $_SESSION['userid'];
        
            $sql="INSERT INTO appointment(doctor_id,patient_id,app_date,app_time) 
                    VALUES(?,?,?,?)";
            
            $sql=$conn->prepare($sql);
            $sql->bind_param("iiss", $doc_id, $pat_id, $app_date, $app_time);
            
            $sql->execute() or die("Unable to execute query");
            $sql->close();

            // echo($app_date);
            // echo($app_time);
            header("Location: ../pat-dashboard.php?booked=1");
        }
    }