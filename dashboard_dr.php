<?php
    session_start();

    try{
        require "include/dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }
    function returnTime($time){
        switch($time){
            case '10':return '10:00am';
            case '11':return '11:00am';
            case '12':return '12:00pm';
            case '13':return '1:00pm';
            case '14':return '2:00pm';
            case '15':return '3:00pm';
            case '16':return '4:00pm';
            case '17':return '5:00pm';
            case '18':return '6:00pm';
            case '19':return '7:00pm';
            case '20':return '8:00pm';
            default  :return 'NA';
        }
    }
    $delele_dates = $conn->query("DELETE FROM appointment WHERE app_date < CURRENT_DATE();");

    $query ="SELECT first_name ,last_name FROM doctors WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute() or die("Unable to execute query");
    $stmt->store_result();
    $stmt->bind_result($fname, $lname);
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();

    /* 
        variable to hold today app count and all appointment count
    */
    $no_today_app = 0;
    $no_all_app = 0;
    
    /*
        array variable to hold the records
    */

    $arr_today = null;
    $all_today = null;

    // query for toaday appointment result
    $today_result = $conn->query("
        SELECT app_id, patients.Patient_ID,
                patients.First_Name, patients.Middle_Name, patients.Last_Name,
                patients.Gender, patients.Age, app_time 
        FROM appointment JOIN patients ON appointment.patient_id = patients.Patient_ID AND 
            appointment.app_date = CURRENT_DATE() AND appointment.doctor_id = '$_SESSION[userid]'
        ORDER BY app_time;
    ");
    if($today_result->num_rows < 0){
        $today_result->close();
    }else{
        $no_today_app = $today_result->num_rows;
    }
     // query for all appointment result
    $all_result = $conn->query("
        SELECT app_id, patients.Patient_ID,
                patients.First_Name, patients.Middle_Name, patients.Last_Name,
                patients.Gender, patients.Age, app_date, app_time 
        FROM appointment JOIN patients 
        ON appointment.doctor_id = '$_SESSION[userid]'
        AND appointment.patient_id = patients.Patient_ID
        ORDER BY app_date;
    ");
    if($all_result->num_rows < 0){
        $all_result->close();
    }else{
        $no_all_app = $all_result->num_rows;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Doctor Dashboard</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <style>
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
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <span class="h1 fas fa-hospital-symbol" style="color:rgb(4, 152, 238); margin: auto 2rem;" id="logo">
                
            </span>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" style="margin: auto 0.5rem;" href="#"><i class="fas fa-bars"></i></button>
            <div class="form-inline ml-auto" style="color:whitesmoke; margin-right:0.3rem;">
                <i class="fas fa-user fa-fw" style="margin-right: 0.5rem;"></i>
                <!-- User's first name and last name  -->
                <?= htmlentities($fname)." ". htmlentities($lname);?>
                
            </div>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link" href="profile_dr.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Profile
                            </a>

                            <a class="nav-link" href="#" data-toggle="modal" data-target="#change-pass-modal">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen"></i></div>
                                Change the Password
                            </a>

                            <a class="nav-link" href="#" data-toggle="modal" data-target="#resign-modal">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-times"></i></div>
                                Resign
                            </a>

                            <a class="nav-link" href="include/logout-inc.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                                Logout
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <!-- User's username -->
                        <?= htmlentities($_SESSION['username']);?> 
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid" style="margin-top: 0.75rem;">

                        <div class="breadcrumb mb-4 d-flex align-items-center" style="color: black;">
                            <i class="fas fa-tachometer-alt" style="margin-right: 0.75rem;"></i>
                             Dashboard   
                        </div>

                        <div class="row">
                           
                            <!-- today appoiments -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Today's Appoiments
                                            <span class="badge badge-light float-right" id="today-app-count">
                                            <!-- toaday appointment count -->
                                                <?= htmlentities($no_today_app);?>
                                                
                                            </span></h2>
                                        </h4>
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-todays-app">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- all appoiments -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">All Appoiments
                                            <span class="badge badge-light float-right" id="all-app-count">
                                            <!-- all appointment count -->
                                                <?= htmlentities($no_all_app);?>
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-all-app">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- today appoiment table -->
                        <div class="card mb-4 " id="dataTable-today-app" >
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Today's Appoiments
                                <!-- input for search -->
                                <form class="d-none d-md-inline-block form-inline d-flex align-items-center float-right ">
                                    <input class="form-control" id="today-app-search" type="text" placeholder="Search for Patient..."/>
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="today-app-data">
                                            <?php
                                                if($no_today_app === 0){
                                                    $empty ="
                                                        <tr>
                                                            <td id='no-pat-today' class='text-muted text-center' colspan='6'>Search Result Empty</td>
                                                        </tr>
                                                    ";
                                                    
                                                    echo($empty);
                                                }else{
                                                    while($rows = $today_result->fetch_assoc()){                   
                                                        $pat ="
                                                        <tr class='text-center'>
                                                            <td>"
                                                                .$rows['First_Name']." ".$rows['Middle_Name']." ".$rows['Last_Name'].
                                                            "</td>
                                                            <td>".$rows['Age']."</td>
                                                            <td>".$rows['Gender']."</td>
                                                            <td>".returnTime($rows['app_time'])."</td>
                                                            <td>
                                                                <form id='check-form' method='POST' action='checkup_form.php'>
                                                                    <input type='hidden' name='pat_id' id='pat_id' value =".$rows['Patient_ID']."></input>
                                                                    <input type='hidden' name='app_id' id='app_id' value =".$rows['app_id']."></input>
                                                                    <input type='submit' id='check-btn' class='btn btn-success' name='check' value='Check'>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        ";
                                                        
                                                        echo($pat);
                                                    }
                                                    $today_result->close();
                                                }
                                                
                                            ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- all appoiments  -->
                        <div class="card mb-4" id="dataTable-all-app" style="display: none;">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Appoiments
                                <!-- input for search -->
                                <form class="d-none d-md-inline-block form-inline d-flex align-items-center float-right ">
                                    <input class="form-control" id="all-app-search" type="text" placeholder="Search for Patient..."/>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Sr.No.</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>

                                        <tbody id="all-app-data">
                                            <?php
                                                if($no_all_app === 0){
                                                    $empty ="
                                                        <tr>
                                                            <td id='no-pat-all' class='text-muted text-center' colspan='6'>Search Result Empty</td>
                                                        </tr>
                                                    ";
                                                    echo($empty);
                                                
                                                }else{
                                                    $i = 1;
                                                   while($rows = $all_result->fetch_assoc()){
                                                    $wrong_date = explode("-", $rows['app_date']);

                                                    $date = $wrong_date[2].'/'.$wrong_date[1].'/'.$wrong_date[0];
                               
                                                        $pat ="
                                                        <tr class='text-center'>
                                                            <td>$i</td>
                                                            <td>"
                                                                .$rows['First_Name']." ".$rows['Middle_Name']." ".$rows['Last_Name'].
                                                            "</td>
                                                            <td>".$rows['Age']."</td>
                                                            <td>".$rows['Gender']."</td>
                                                            <td>".$date."</td>
                                                            <td>".returnTime($rows['app_time'])."</td>
                                                        </tr>
                                                        ";
                                                        echo($pat);
                                                        $i++;
                                                    }
                                                    $all_result->close();
                                                }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Change password modal -->
                        <div class="modal fade" id="change-pass-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="max-width: 720px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change the Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                
                                    <form method="POST" id="change-pass-form" action="include/change-pass-inc.php">
              
                                        <div class="form-group">
                                            <label class="h6" for="password">Current Password :</label>
                                            <input type="password" class="form-control" id="old-password" name="old-password" placeholder="Enter your Current Password" required>
                                            <small class="error-text" id="old-pass-error" ></small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="h6" for="new-password">New Password :</label>
                                            <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Enter New Password" required>
                                            <small class="error-text" id="new-pass-error" ></small>
                                        </div>

                                        <div class="form-group">
                                            <label class="h6" for="con-new-password">Confirm the New Password :</label>
                                            <input type="password" class="form-control" id="con-new-password" name="con-new-password" placeholder="Confirm your New Password" required>
                                            <small class="error-text" id="con-new-pass-error" ></small>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="submit" value="Change" name="change" id="change" class="btn btn-primary"/>
                                            <button type="button" id="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                        </div>
                                    </form>
                                
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- resign modal  -->
        <div class='modal' id='resign-modal'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                
                    <!-- Modal Header -->
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class='modal-body h5'>Are you sure, do you want to resign?</div>
                    
                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <form method="POST" action="include/resign-inc.php">
                            <input type="submit" class='btn btn-success' value="Yes" name="resign" id="resign" >
                            <button type='button' class='btn btn-danger' data-dismiss='modal'>No</button>
                        </form> 
                    </div>
                    
                </div>
            </div> 
        </div>

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

            if(isset($_GET['success'])){
                
                $success = $_GET['success'];
                
                if($success == 1){
                    // if success = 1 : password change successfully

                    // echo("<script type= 'text/javascript'>alert('Password Change : Success'); </script>");
                    displayStatus("Password Changed Successfully:)"); 
                }else if($success == 0){
                    // if success = 0 : password does not match with db password

                    // echo("<script type= 'text/javascript'>alert('Password Change : Unsuccess'); </script>");
                    displayStatus("Current Password deoesn't match!!!"); 
                }
            }
        ?>


        
        <script src="js/dr_homepage_script.js"></script>
        
        <script src="js/change-pass-valid.js"></script>
        
    </body>
</html>
