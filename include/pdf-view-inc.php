<?php
    session_start();

    try{
        require "dbh-inc.php";
        require "../fpdf/fpdf.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['view'])){
        $result = $conn->query("SELECT record_name, data FROM records WHERE record_id = '$_POST[record_id]';")->fetch_assoc();
        // Store the file name into variable 
        $pdf = $result['data']; 
        $pdfname = $result['record_name']; 
        
        // Header content type 

        header('Content-type: application/pdf'); 
        
        header('Content-Disposition: inline; filename="' . $pdfname . '"'); 
        
        header('Content-Transfer-Encoding: binary'); 
        
        header('Accept-Ranges: bytes'); 
        
        // Read the file 
        @readfile($pdf);

        print_r($pdf);

    }else{
        header("Location: ../index.php");
    }
    