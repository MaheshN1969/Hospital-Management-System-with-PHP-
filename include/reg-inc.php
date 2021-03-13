<?php

    try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    //checking register btn is set or not
    if(isset($_POST['register'])){

        // feching the data from form fields
        $fname = $_POST['first-name'];
        $mname = $_POST['middle-name'];
        $lname = $_POST['last-name'];
        $wrong_dob = explode("/", $_POST['dob']);

        $dob = $wrong_dob[2].'-'.$wrong_dob[1].'-'.$wrong_dob[0];

        $age = $_POST['age-val'];
        $gender = $_POST['gender'];
        $special = $_POST['special'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $addr = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $password = $_POST['user-password'];

        // generating the username as "first_name.last_name@hospital.com"
        $username = strtolower($fname) . "." . strtolower($lname) . "@hospital.com";

        //checking if user exists in db already
        $check = "SELECT 
                    first_name, middle_name, last_name, dob, 
                    gender, specialization, email_id, contact_no, address
                 FROM doctors 
                 WHERE first_name = ? AND
                 middle_name = ? AND
                 last_name = ? AND
                 dob = ? AND
                 gender = ? AND
                 specialization = ? AND
                 email_id = ? AND
                 contact_no = ? AND
                 address = ?";

        $stmt  = $conn->prepare($check);
        $stmt->bind_param("sssssssss", $fname, $mname, $lname, $dob, $gender, $special, $email, $contact, $addr);
        $stmt->execute() or die("Unable to execute select query");
        $stmt->store_result();

        //count of rows
        $count = $stmt->num_rows;
        
        //delete the stored result
        $stmt->free_result();
        $stmt->close();

        if($count >= 1){
            //redirect to status page
            header("Location: ../status-dr.php?status=1");
        }
        else{
            //checking if the username exists in database or not 
            $check = "SELECT * FROM doctors WHERE username = ?";
            $stmt = $conn->prepare($check);
            $stmt->bind_param("s", $username);
            $stmt->execute() or die("Unable to execute select query");

            $stmt->store_result();

            $count = $stmt->num_rows;
            // echo "<script type= 'text/javascript'>alert($count);</script>";

            // if there exists a member with same username 
            if( $count == 1){
                //adding random no to the username
                $username = strtolower($fname) . "." . strtolower($lname) . "." . rand(100,9999) . "@hospital.com";
            }
            $stmt->free_result();
            $stmt->close();

            $insert = "INSERT INTO doctors(first_name,
                            middle_name,
                            last_name,
                            gender,
                            dob,
                            age,
                            specialization,
                            contact_no,
                            email_id,
                            address,
                            city,
                            state,
                            pincode,
                            username,
                            password
                    ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $conn->prepare($insert);
            $stmt->bind_param("sssssssssssssss", $fname, $mname, $lname, $gender, $dob, $age, $special,
                                $contact, $email, $addr, $city, $state, $zipcode, $username, $password);

            $stmt->execute() or die("Unable to insert data into db");
            $stmt->close();

            //returning to login page
            header("Location: ../status-dr.php?status=$username");
        }

    }else{
        //else returning to same file
        header("Location: ../doctor_reg.php");
    }