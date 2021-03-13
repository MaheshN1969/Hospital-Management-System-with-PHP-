<?php
session_start();

    try{
        require "include/dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" 
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" 
        crossorigin="anonymous"></script>
    
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" 
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" 
        crossorigin="anonymous"></script>
		
	<!--link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" rel="stylesheet" id="bootstrap-css"-->
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

	<!-- <script src="js/doctor_reg.js"></script> -->
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        *{
            margin: 0.3rem;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background:#797f88;
        }
        .border-prop{
            border-color: #8b8b91;
        }
        .remove-arrow::-webkit-inner-spin-button,
        .remove-arrow::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
        .error-text{
          color:red;
		 
        }
		.container1 {
		  
		  position: relative;
		  
		}

		.center {
		  margin: 0;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  -ms-transform: translate(-50%, -50%);
		  transform: translate(-50%, -50%);
		}
		
		/* width */
		::-webkit-scrollbar {
		  width: 0.3rem;
		}

		/* Track */
		::-webkit-scrollbar-track {
		  background: var(--gray-dark); 
		}
		 
		/* Handle */
		::-webkit-scrollbar-thumb {
		  background: #888; 
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
		  background: #555; 
		}
    </style>
</head>
<body>

	<div class="card container justify-content-center align-middle" style="padding-top:1rem; max-width: 1080px;">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<a href="pat-dashboard.php" class="btn btn-info breadcrumb-item"><i class="fas fa-tachometer-alt" style="margin-right: 0.75rem;"></i>Dashboard</a>
			</ol>
		</nav>

        <div class="jumbotron d-flex justify-content-center align-middle" style="padding:2rem; background-color: #328de9; margin-bottom: 0; color: azure;">
            <h1>Book Appointment</h1>      
        </div>    
        <div class="card-body">
            <form method="POST" id="reg-form" action="book_app.php">
				<div class="form-group">
					<label class="h6" for="spec">Specialization :</label>
					<select id="special" class="custom-select border-prop" name="special" required>
						<option value="" disabled selected >Click this to Select</option>
						<option value="General Physician">General Physician</option>
						<option value="Gynecologist">Gynecologist</option>
						<option value="Pediatrician">Pediatrician</option>
						<option value="Ophthalmologist">Ophthalmologist</option>
						<option value="Dermatologist">Dermatologist</option>
						<option value="ENT">ENT</option>
						<option value="Orthopedic">Orthopedic</option>
						<option value="Cardiologist">Cardiologist</option>
						<option value="Neurologist">Neurologist</option>
						<option value="Dentist">Dentist</option>
					</select>
					<small class="error-text" id="special-error"></small>
				</div>
				
				
				<input type="submit" value="Search" id="search-btn" name="search-btn" class="form-control btn-primary"></input>
            </form>
			
			<?php

				
				if(isset($_POST['search-btn'])){

					$splize = $_POST['special'];

					$stmt = $conn->query("SELECT id, first_name, middle_name, last_name, specialization FROM doctors WHERE specialization= '$splize'");
					
					$hrline = "<hr class='my-4'>";

					if($stmt->num_rows <= 0){
						// no docotro
						// $stmt->free_result();
						$stmt->close();
						echo($hrline);
						echo("<div class='alert alert-warning' role='alert'>
									No Doctor Found!!!!
								</div>");

					}else{
						//there are doctors
					
						$book_form = "
							<form>
								<div class='form-row'>
									<div class='col' id='dateInput'>
										<label class='h6' for='dob'>Appointment Date</label>
										<input type='text' class='form-control border-prop' name='app-date' id='app-date' placeholder='dd/mm/yyyy' required autocomplete='off'/>
										<span class='input-group-addon'></span>
									</div>
									
									<div class='col' id='timeInput'>
										<label class='h6' for='time'>Appointment Time</label>
										<!--input type='text' class='form-control border-prop' name='app-time' id='app-time' placeholder='Select Time' required autocomplete='off'/>
										<span class='input-group-addon'></span-->
									
										<select id='time' class='custom-select border-prop' name='time' required>
											<option value='' disabled selected>Click this to Select</option>
											<option value='10'>10:00am</option>
											<option value='11'>11:00am</option>
											<option value='12'>12:00pm</option>
											<option value='13'>1:00pm</option>
											<option value='14'>2:00pm</option>
											<option value='15'>3:00pm</option>
											<option value='16'>4:00pm</option>
											<option value='17'>5:00pm</option>
											<option value='18'>6:00pm</option>
											<option value='19'>7:00pm</option>
											<option value='20'>8:00pm</option>
										</select>	
									</div>
								</div>
							</form>
						";

						$dr_table_uppeer = "
								<div class='card mb-4 ' id='dataTable-today-app' >
									<div class='card-header'>                             
										<!-- input for search -->
										<form>
											<input class='form-control' id='book-app-search' type='text' placeholder='Search for Doctor'/>
										</form>

									</div>
									<div class='card-body d-flex justify-content-center align-middle'>
										<div class='table-responsive'>
											<table class='table table-bordered' cellspacing='0' style='max-width:888px'>
												<thead>
													<tr class='text-center'>
														<th>Sr.No.</th>
														<th>Name</th>
														<th>Specialization</th>
														<th> </th>
													</tr>
												</thead>
												<tbody id='book-app-table'>";
													
						$dr_table_lower	="</tbody>
										</table>
									</div>
								</div>
							</div>
						";

						echo($hrline);
						echo($book_form);
						$i = 1;
						echo($dr_table_uppeer);
						while($row = $stmt->fetch_assoc()){
							$doctor = "
								<tr class='text-center'>
									<td>".$i."</td>
									<td>
										"."Dr.".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."
									</td>
									<td>".$row['specialization']."</td>
									<td class='container1'>
										<form id='book-form' method='POST' action='include/book-app-inc.php'>
											<input type='hidden' name='doc-id' value=".$row['id']."></input>
											<input type='hidden' class='app_date' id='app-date-val' name='app-date-input'></input>
											<input type='hidden' class='app_time' id='app-time-val' name='app-time-input'></input>
											<input type='submit' id='book' class='btn btn-primary center' name='book' value='Book'></input>
										</form> 
									</td>
								</tr>
							";
							
							echo($doctor);
							
							$i += 1;	
						}
						echo($dr_table_lower);	
						$stmt->close();
					}	
					
				}
			?>

			<?php
				function displayStatus($msg) {
					$text = "
						<div class='modal' id='myModal'>
							<div class='modal-dialog'>
								<div class='modal-content'>
								
									<!-- Modal Header -->
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal'>&times;</button>
									</div>
									
									<!-- Modal body -->
									<div class='modal-body'>". $msg ."</div>
									
									<!-- Modal footer -->
									<div class='modal-footer'>
										<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>
									</div>
									
								</div>
							</div> 
						</div>

						<script> $('#myModal').modal('show') </script>
					";
					echo($text);
					
				}
				if(isset($_GET['emptyFields'])){
					$emptyFields = $_GET['emptyFields'];
					if($emptyFields == 1)
						displayStatus('Please Select Appoiment Date & Time!!');
				}
			?>
			
		</div>	
        	
    </div>
	<script src="js/book-app-valid.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script-->
</body>
</html>