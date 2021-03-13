<?php
 try{
        require "dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }
//$conn=mysqli_connect("localhost","root","","hospital");
if(isset($_POST['register']))
{
	$fname=$_POST['fname'];
	$mname=$_POST['mname'];
	$lname=$_POST['lname'];
	//$username=$_POST['username'];
	$username = strtolower($fname) . "." . strtolower($lname) . "@hospital.com";
	$password=$_POST['user-password'];
	//$conf_password=$_POST['conf_password'];
	$gender=$_POST['gender'];
	$bg=$_POST['bg'];
	
	$wrong_dob = explode("/", $_POST['dob']);
    $dob = $wrong_dob[2].'-'.$wrong_dob[1].'-'.$wrong_dob[0];
	
	$age=$_POST['age-val'];
	$contact=$_POST['contact'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$pincode=$_POST['pincode'];
	 $check = "SELECT 
                    First_Name, Middle_Name, Last_Name, Username, 
                    Password, Gender, Blood_Group, Contact_No, Postal_Address
                 FROM patients 
                 WHERE First_Name = ? AND
                 Middle_Name = ? AND
                 Last_Name = ? AND
                 Username = ? AND
                 Password = ? AND
                 Gender = ? AND
                 Blood_Group = ? AND
                 Contact_No = ? AND
                 Postal_Address = ?";
				 
	$stmt  = $conn->prepare($check);
	$stmt->bind_param("sssssssss", $fname, $mname, $lname, $username, $password, $gender, $bg, $contact, $address);
	$stmt->execute() or die("Unable to execute select query");
	$stmt->store_result();

	//count of rows
	$count = $stmt->num_rows;
	
	//delete the stored result
	$stmt->free_result();
	$stmt->close();
	
	if($count>=1)
	{
		 header("Location: ../status.php?status=1");	
	}
	else
	{
		 //checking if the username exists in database or not 
            $check = "SELECT * FROM patients WHERE Username = ?";
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

            $insert = "INSERT INTO patients(First_Name,Middle_Name,
								Last_Name,
								Username,
								Password,
								Gender,
								Blood_Group,
								Date_of_Birth,
								Age,
								Contact_No,
								Email_ID,
								Postal_Address,
								City,
								State,
								Pin_Code
                    ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $conn->prepare($insert);
            $stmt->bind_param("sssssssssssssss", $fname, $mname, $lname, $username, $password, $gender, $bg,
                                $dob, $age, $contact, $email, $address, $city, $state, $pincode);

            $stmt->execute() or die("Unable to insert data into db");
            $stmt->close();
				
			/*echo "<script>alert('Patient Registered')</script>";
			echo "<script>window.open('admins.php','_self')</script>";*/
			
			header("Location: ../status.php?status=$username");

	}

}
else{
    //else returning to same file
	header("Location: ../pat-reg.php");
}

	
/*if(isset($_POST['login-submit']))
{
	$username =$_POST['username'];
	$password=$_POST['password'];
	$check="SELECT Username, Password FROM patients WHERE Username=? AND Password=?";
	$stmt=$conn->prepare($check);
	$stmt->bind_param("ss",$username,$password);
	$stmt->execute() or die("Unable to execute select query");
	$stmt->store_result();
	$count = $stmt->num_rows;
	
	//delete the stored result
	$stmt->free_result();
	$stmt->close();
	
	if($count==1)
	{
		header("Location:sample-homepage.php");
	}
	else
	{
		//echo "<script>alert('Incorrect login credentials')</script>";
		//echo "<script>window.open('index1.php','_self')</script>";
		header("Location:error_login.php");
	}
}*/

/*if(isset($_POST['login-submit']))
{
	 $username = $_POST['username'];
        $password =  $_POST['password'];

        //query to select user from db
        $sql = "SELECT Patient_ID, Username, verified FROM patients WHERE Username = ? AND Password = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute() or die("Unable to execute select query");

        //storing the result of executed query
        $stmt->store_result();

        if($stmt->num_rows != 1)
		{

            //closing the prepared statement
            $stmt->close();

            //if user not found then return to index page
            header("Location:index.php?dberror=notfound");
        }
		else
		{
            // binding the parameters for result
            $stmt->bind_result($user_id, $user_name, $verify);
            
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
            header("Location:sample-homepage.php");
        } 
} 
else
{
    //else returning to same file
    header("Location:error-login.php");
}*/


?>


