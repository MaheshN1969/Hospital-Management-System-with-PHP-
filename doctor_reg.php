<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

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
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

    <!-- <script src="js/doctor_reg.js"></script> -->
    <script src="js/form-validator-reg.js"></script>

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
    </style>
</head>
<body>

    <div class="card container justify-content-center align-middle" style="padding-top:1rem; max-width: 1080px;">
        <div class="jumbotron d-flex justify-content-center align-middle" style="padding:2rem; background-color: #328de9; margin-bottom: 0; color: azure;">
            <h1>Registration Form</h1>      
        </div>    
        <div class="card-body">
            <form method="POST" id="reg-form" action="include/reg-inc.php">
                <!-- full name -->
                <div class="form-row">
                     <div class="col-md-4">
                        <label class="h6" for="fname">First Name</label>
                        <input type="text" class="form-control border-prop" name="first-name" id="fname" placeholder="Enter First Name" required>
                        <small class="error-text" id="fname-error" ></small>
                      </div>
                      <div class="col-md-4">
                          <label class="h6" for="mname">Midddle Name</label>
                          <input type="text" class="form-control border-prop" name="middle-name" id="mname" placeholder="Enter Middle Name" required>
                          <small class="error-text" id="mname-error" ></small>
                      </div>
                      <div class="col">
                          <label class="h6" for="lname">Surname Name</label>
                          <input type="text" class="form-control border-prop" name="last-name" id="lname" placeholder="Enter Surname" required>
                          <small class="error-text" id="lname-error" ></small>
                      </div>
                </div>

                <hr class="my-4">

                <!-- age and dob -->
                <div class="form-row">
                    <div class="col" id="dateInput">
                        <label class="h6" for="dob">Date of Birth</label>
                        <input type='text' class="form-control border-prop" name="dob" id="dob" placeholder="dd/mm/yyyy" required autocomplete="off"/>
                        <span class="input-group-addon"></span>
                        <small class="error-text" id="dob-error" ></small>
                    </div>
                    <div class="col">
                        <label class="h6" for="age">Age</label>
                        <input type="text" class="form-control border-prop" name="age" id="age" placeholder="0" disabled>
                        <input type="hidden" name="age-val" id="age-val">
                    </div>
                </div>
                
                <hr class="my-4">

                <!-- gender -->
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="h6" for="genderlabel" id="gender-id">Gender :</label>
                        <div class="custom-control">
                            <div class="custom-control custom-radio custom-control-inline" name="genderlabel">
                                <input type="radio" id="M" value = "M" name="gender" class="custom-control-input" required="required">
                                <label class="custom-control-label" for="M">Male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="F" value = "F" name="gender" class="custom-control-input" required="required">
                                <label class="custom-control-label" for="F">Female</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="T" value = "T" name="gender" class="custom-control-input" required="required">
                                <label class="custom-control-label" for="T">Transgender</label>
                            </div>
                        </div> 
                        <small class="error-text" id="gender-error" ></small>
                    </div>

                    <!-- specialization -->
                    <div class="col-md-5">
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
                    </div> 
                </div>

                <hr class="my-4">

                <!-- email -->
                <div class="form-row">
                    <div class="col-md-5 offset-md-1">
                        <label class="h6" for="email">Email ID :</label>
                        <input type="email" class="form-control border-prop" name="email" id="email" placeholder="Enter Email ID" required>
                        <small class="error-text" id="email-error" ></small>
                    </div>
                    <!-- contact -->
                    <div class="form-group col-md-5">
                        <label class="h6" for="contact">Contact No. :</label>
                        <input type="text" class="form-control border-prop remove-arrow" name="contact" id="contact" placeholder="Enter Contact No." required>
                        <small class="error-text" id="contact-error" ></small>
                    </div> 
                </div>

                <hr class="my-4">

                <div class="form-group">
                    <label class="h6" for="address">Address :</label>
                    <textarea name="address" id="address" class="form-control border-prop" rows="2" placeholder="Enter your Address" required></textarea>
                    <small class="error-text" id="addr-error" ></small>
                </div>
                <!-- city state zipcode -->
                <div class="form-row">
                    <div class="col-md-4">
                        <label class="h6" for="city">City :</label>
                        <input type="text" class="form-control border-prop" name="city" id="city" placeholder="Enter City" required>
                        <small class="error-text" id="city-error" ></small>
                    </div>
                    <div class="col-md-4">
                        <label class="h6" for="state">State :</label>
                        <select id="state" class="custom-select border-prop" name="state" required>
                            <option value="" disabled selected>Click this to Select</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Keral">Keral</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                        </select>
                        <small class="error-text" id="state-error" ></small>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="h6" for="zipcode">Pincode :</label>
                        <input type="text" class="form-control border-prop remove-arrow" name="zipcode" id="zipcode" placeholder="Enter Zipcode" required>
                        <small class="error-text" id="zip-error" ></small>
                    </div>
                </div>

                <hr class="my-4">

                <div class="form-row">
                    <div class="col-md-5 offset-md-1" >    
                        <label class="h6" for="password">Password :</label>
                        <input type="password" class="form-control border-prop" id="user-password" name="user-password" placeholder="Enter Password" required>
                         <small class="error-text" id="pass-error" ></small>
                    </div>
                    <div class="col-md-5">    
                        <label class="h6" for="con_pass">Confirm the Password :</label>
                        <input type="password" class="form-control border-prop" id="con-pass" name="con-pass" placeholder="Confirm your Password" required>
                        <small class="error-text" id="cpass-error" ></small>
                    </div>
                </div>
                
               <hr class="my-4">

                <div class="d-flex justify-content-center">
                    <input type="submit" name="register" id="regbtn" class="btn btn-success btn-lg" value="Register" style="margin: 1rem;">
                    <input type="reset" name="reset" id="resetbtn" class="btn btn-danger btn-lg" value="Reset" style="margin: 1rem;">
                </div>
                <p class="h5 d-flex justify-content-center">
                    Already, have account?
                </p>
                <a href="index.php" class="h5 d-flex justify-content-center">Log In</a>
              </form>
              
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" 
    integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
</body>
</html>