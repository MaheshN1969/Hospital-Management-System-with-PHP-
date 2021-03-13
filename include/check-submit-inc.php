<?php
    session_start();

    try{
        require "dbh-inc.php";
        require "pdf-generator-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }
    if(isset($_POST['submit'])){

        $totalbill = $_POST['total-charges'];
        $patid = $_POST['patient_id'];
        $appid = $_POST['app_id'];

        $symptoms = $_POST['symptoms'];
        $prescribe = $_POST['prescribe'];
        $suggest = $_POST['suggest'];

        $fetch_pat = "SELECT First_Name, Middle_Name, Last_Name, Gender, Age, Blood_Group FROM patients WHERE Patient_ID = $patid;";

        $pat = $conn->query($fetch_pat)->fetch_assoc();

        $fetch_doc = "SELECT first_name, middle_name, last_name, specialization FROM doctors WHERE id = '$_SESSION[userid]';";
        $doc = $conn->query($fetch_doc)->fetch_assoc();

        $file_path = generateRecord(
            $pat['First_Name']." ".$pat['Middle_Name']." ".$pat['Last_Name'],
            $pat['Gender'],
            $pat['Age'],
            $pat['Blood_Group'],
            $doc['first_name']." ".$doc['middle_name']." ".$doc['last_name'],
            $doc['specialization'],
            $symptoms,
            $prescribe,
            $suggest
        );

        
        //pdf uploading to database
        $data_file = file_get_contents($file_path);
        $filename = explode('\\',$file_path)[1];
        $today = date("Y-m-d",time());
        $stmt = $conn->prepare("INSERT INTO records(pat_id, record_name,data,record_date) VALUES(?,?,?,?);");
        $stmt->bind_param("isss",$patid, $filename, $data_file, $today);
        $stmt->execute() or die("Unable to execute query");
        $stmt->close();

        unlink($file_path);

        $query = "INSERT INTO bills(pat_id,doctor_id, issue_date, amount) VALUES(?,?,?,?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisi", $patid, $_SESSION['userid'], $today, $totalbill);
        $stmt->execute() or die("Unable to execute query");
        $stmt->close();

        $delete = $conn->query("DELETE FROM appointment WHERE app_id = $appid;");
        header("Location: ../dr_homepage.php");
    }else{
        header("Location: ../logout-inc.php");
    }
