<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
	integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" 
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" 
        crossorigin="anonymous"></script-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/validator.js"></script>
	
</head>
<style>
	.required{
		color:red;
	}
</style>
<body>

	<div class="container" style="width:600px">
			<div class="card">
				<div class="card-body" style="background-color:#3386FF;color:#ffffff">
					<h3>Registeration form</h3>
				</div>
				<div class="card-body">
					<form class="form-group" action="include/func.php" method="post" name="form">
						<div class="required">* Required</div>
						<label for="fname">First Name</label><span class="required"> *</span>
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name" required><br>
                        <small class="error-text" id="fname-error" ></small>
						<label for="mname">Midddle Name</label><span class="required"> *</span>
                        <input type="text" class="form-control" name="mname" id="mname" placeholder="Enter Middle Name" required><br>
                        <small class="error-text" id="mname-error" ></small>
						<label for="lname">Last Name: </label><span class="required"> *</span>
						<!--input type="text" name="lname" class="form-control" id="lname" required="required" placeholder="Enter last name" onblur="
						if(document.form.username.value=='' && document.form.fname.value!='' && document.form.lname.value!='') {
							 var username = document.form.fname.value.substr(0,19) +  '.'  +  document.form.lname.value.substr(0,19);
							 username = username.replace(/\s+/g, '');
							 username = username.replace(/\'+/g, '');
							 username = username.replace(/-+/g, '');
							 username = username.toLowerCase();
							 document.form.username.value = username;
						}" /><br-->
						<input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Surname" required><br>
                        <small class="error-text" id="lname-error" ></small>
						<!--label for="username">Username: </label><span class="required"> *</span>
						<input type="text" name="username" class="form-control" id="username" readonly /><br!-->
					    <label for="password">Password :</label><span class="required"> *</span>
                        <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Enter Password" required><br>
                        <small class="error-text" id="pass-error" ></small>
						<label for="con_pass">Confirm the Password :</label><span class="required"> *</span>
                        <input type="password" class="form-control" id="con-pass" name="con-pass" placeholder="Confirm your Password" required><br>
                        <small class="error-text" id="cpass-error" ></small>
						<label for="gender">Gender:</label><span class="required"> *</span>
						<div>
						  <input id="male" type="radio" value="male" name="gender" formControlName="gender required="required"">
						  <label for="male">Male</label>
					    </div>
					    <div>
						  <input id="female" type="radio" value="female" name="gender" formControlName="gender">
						  <label for="female">Female</label>
						</div>
						<div>
						  <input id="male" type="radio" value="transgender" name="gender" formControlName="gender required="required"">
						  <label for="male">Transgender</label>
					    </div>
						<label>Blood Group: </label><span class="required"> *</span>
						<select class="form-control" name="bg">
							<option value="" disabled selected>Click this to select</option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select><br>
						
						<!--label>Date of Birth: </label><span class="required"> *</span>
						<input type="text" class="form-control" name="dob" id="dob" placeholder="dd/mm/yyyy" required autocomplete="off"/>
						<span class="input-group-addon"></span>
						<label>Age: </label>
						<input type="text" name="age" class="form-control" id="age" readonly><br>
						<input type ="hidden" id="age-val" name="age-val"-->
						
						<div class="form-group" id="dateInput">
							<label for="dob">Date of Birth</label><span class="required"> *</span>
							<input type='text' class="form-control border-prop" name="dob" id="dob" placeholder="dd/mm/yyyy" required autocomplete="off"/>
							<span class="input-group-addon"></span>
							<small class="error-text" id="dob-error" ></small>
						</div>
						<div class="form-group">
							<label for="age">Age</label><span class="required"> *</span>
							<input type="text" class="form-control border-prop" name="age" id="age" placeholder="0" disabled>
							<input type="hidden" name="age-val" id="age-val">
						</div>
						<label for="contact">Contact No. :</label></label><span class="required"> *</span>
                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Enter Contact No." required><br>
                        <small class="error-text" id="contact-error" ></small>
						<label>Email id :</label><span class="required"> *</span>
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email ID" required><br>
                        <small class="error-text" id="email-error" ></small>
						<label for="address">Address :</label></label><span class="required"> *</span>
						<textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter your Address" required></textarea><br>
						<small class="error-text" id="addr-error" ></small>
						<label>City: </label><span class="required"> *</span>
						<input type="text" name="city" class="form-control" placeholder="Enter city" required="required"><br>
						<label>State :</label><span class="required"> *</span>
						<input type="text" name="state" class="form-control" placeholder="Enter state" required="required"><br>
						<label for="pincode">Pincode :</label></label><span class="required"> *</span>
                        <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode" required><br>
                        <small class="error-text" id="pin-error" ></small>
						<input type="submit" class="btn btn-primary" name="register">
						<input type="reset" class="btn btn-primary" name="reset" value="Reset">
					</form>
				</div>
			</div>
	</div>
	

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" 
integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
</body>
</html>