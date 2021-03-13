<?php
    session_start();

    try{
		require "include/dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
	}
	//global variables for patients
	$fname=$mname=$lname=$gender=$bg=$age=null;
	if(isset($_POST['check'])){
		//query for patient
		$query = "SELECT First_Name, Middle_Name, Last_Name, Gender, Blood_Group, Age FROM patients WHERE Patient_ID = ?; "; 
		$pat = $conn->prepare($query);
		$pat->bind_param("i",$_POST['pat_id']);
		$pat->execute();
		$pat->store_result();
		$pat->bind_result($fname,$mname,$lname,$gender,$bg,$age);
		$pat->fetch();
		$pat->free_result();
		$pat->close();
	}else{
		header("Location: ..include/logout-inc.php");
	}

	//query for doctor
	$query = "SELECT first_name, middle_name, last_name, specialization, CURRENT_DATE() FROM doctors WHERE id = ?; "; 
	$pat = $conn->prepare($query);
	$pat->bind_param("i",$_SESSION['userid']);
	$pat->execute();
	$pat->store_result();
	$pat->bind_result($dfname,$dmname,$dlname,$special,$today);
	$pat->fetch();
	$pat->free_result();
	$pat->close();
	$today = strtotime($today);
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
	</script>

    <style>
       *{
            margin: 0rem;
            padding: 0;
            box-sizing: border-box;
        }
        .bgcolor{
            background :-webkit-linear-gradient(#53cfcf,#54cf92);
        }
        .error-text{
            color:red;
        }
		.card-margin{
			margin: 0.5rem 0;
		}
	</style>
	
</head>
<body>
	<div class="d-flex justify-content-center align-items-center bgcolor">
		<div class="card container" style="border-radius: 1rem;padding: 0.25rem;background-color: #d2dae2d3;">
			<div class="card card-margin" style="border-radius: 1rem;">
				<div class="card-body">
					<a href="dashboard_dr.php" class="btn btn-info breadcrumb-item" style="max-width: 10rem;"><i class="fas fa-tachometer-alt" style="margin-right: 0.75rem;"></i>Dashboard</a>			
				</div>
			</div>
			<div class="card card-margin" style="border-radius: 1rem;">
				<div class="card-body">

					<div class="form-row">
							<div class="col-md-2 h5">Name</div>
							<div class="col-md-6 h5">: <?= htmlentities($fname)." ".htmlentities($mname)." ".htmlentities($lname);?></div>
					</div>
					<div class="form-row">
							<div class="col-md-2 h5">Gender</div>
							<div class="col-md-2 h5">: <?= htmlentities($gender);?></div>
							<div class="col-md-2 h5">Blood Group</div>
							<div class="col-md-2 h5">: <?= htmlentities($bg);?></div>
							<div class="col-md-2 h5">Age</div>
							<div class="col-md-2 h5">: <?= htmlentities($age);?></div>
					</div>
					<hr class="my-4">
					<div class="form-row">
							<div class="col-md-2 h5">Name</div>
							<div class="col-md-6 h5">: <?= "Dr. ".htmlentities($dfname)." ".htmlentities($dmname)." ".htmlentities($dlname);?></div>
					</div>
					<div class="form-row">
						<div class="col-md-2 h5">Date</div>
						<div class="col-md-6 h5">: <?= htmlentities(date('d M Y',$today));?></div>
					</div>

				</div>
			</div>

			<!-- <hr class="my-4"> -->
			
			<!-- <div class="card card-margin" style="border-radius: 1rem;">
				<div class="card-body">
				  History
				</div>
			</div> -->

			<!-- <hr class="my-4"> -->
			
			<div class="card card-margin" style="border-radius: 1rem;">
				<div class="card-body">
					<form action="include/check-submit-inc.php" method="post">
						<table class="table table-striped">
							<thead>
							  <tr>
								<th colspan="2" class="lead text-center">Details</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td class="h6">Symptoms</td>
								<td>
									<input type="text" name="symptoms" id="symptoms" class="form-control" placeholder="Enter the symptoms..." required>
								</td>
							  </tr>
							  <tr>
								<td class="h6">Prescription</td>
								<td>
									<textarea name="prescribe" id="prescribe" class="form-control" placeholder="Prescribe the medicines..."></textarea>
								</td>
							  </tr>
							  <tr>
								<td class="h6">Suggestions</td>
								<td>
									<textarea type="text" name="suggest" id="suggest" class="form-control" placeholder="Any Suggestions..." required></textarea>
								</td>
							  </tr>
							  <tr>
								  <td colspan="2" class="text-center">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" id="consult" value="option1" name="bill" checked>
										<label class="form-check-label h6" for="inlineCheckbox1">Consultation</label>
									  </div>
									  <div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" id="general" value="option2" name="bill">
										<label class="form-check-label h6" for="inlineCheckbox2">General Checkup</label>
									  </div>
									  <div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" id="inject" value="option2" name="bill">
										<label class="form-check-label h6" for="inlineCheckbox2">Injections</label>
									  </div>
									  <input type="hidden" name="total-charges" id="total-charges">
									  <input type="hidden" name="patient_id" id="patient_id" value="<?= $_POST['pat_id']?>">
									  <input type="hidden" name="app_id" id="app_id" value="<?= $_POST['app_id']?>">
									  
								  </td>
							  </tr>
							 
							</tbody>
						</table>
						<div class="d-flex justify-content-center">
							<input type="submit" value="Submit" class="btn btn-primary" style="margin-right: 1rem;" id="submit" name="submit">
							<input type="reset" value="Reset" class="btn btn-danger" id="reset" name="reset">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<script src="js/checkup-fees.js"></script>
</body>
</html>