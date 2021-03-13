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

    $query ="SELECT First_Name ,Last_Name FROM patients WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute() or die("Unable to execute query");
    $stmt->store_result();
    $stmt->bind_result($fname, $lname);
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Patient Dashboard</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <style>
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
            .error-text{
                color:red;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <span class="h1 fab fa-pinterest" style="color:rgb(4, 152, 238); margin: auto 2rem;" id="logo">

            </span>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" style="margin: auto 0.5rem;" href="#"><i class="fas fa-bars"></i></button>
            <div class="form-inline ml-auto" style="color:whitesmoke; margin-right:0.3rem;">
                <i class="fas fa-user fa-fw" style="margin-right: 0.5rem;"></i>
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
                            
                            <a class="nav-link" href="pat-profile.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Profile
                            </a>
							<a class="nav-link" href="#" data-toggle="modal" data-target="#change-pass-modal">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen"></i></div>
                                Change the Password
                            </a>
                            <a class="nav-link" href="include/logout-inc.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
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
                                        <h4 class="card-title">Book Appointment
                                        </h4>
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-todays-app">
                                        <a class="small text-white stretched-link" href="book_app.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- all appoiments -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Cancel Appoiments                                          
                                        </h4>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-all-app">
                                        <a class="small text-white stretched-link" href="#" data-target="#cancel-app-modal" data-toggle="modal">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-xl-6 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">All Payments
                                        </h4>
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-todays-app">
                                        <a class="small text-white stretched-link" href="my_bills.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-xl-6 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">My Records
                                        </h4>
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-todays-app">
                                        <a class="small text-white stretched-link" href="my_records.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                        
                        
                        <!-- cancel-cardview-Modal -->
                        <div class="modal" id="cancel-app-modal">
                            <div class="modal-dialog" style="max-width:1080px">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Cancel Appoiments</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <?php
                                       $stmt = $conn->query("
                                            SELECT app_id,doctors.first_name,doctors.middle_name,doctors.last_name,doctors.specialization,app_date,app_time 
                                            FROM appointment JOIN doctors ON appointment.doctor_id=doctors.id AND appointment.patient_id= '$_SESSION[userid]'
                                            ORDER BY app_date;
                                        ");
                                        
                                        if($stmt->num_rows <= 0){
                                            // no docotro
                                            $stmt->close();
                                            
                                            echo("<div class='alert alert-warning' role='alert'>
                                                        No Appoinments!!!
                                                    </div>");
                                        }else{
                                            $cancel_table_upper = "
                                            <div class='card-body d-flex justify-content-center align-middle'>
                                                <div class='table-responsive'>
                                                    <table class='table table-bordered' cellspacing='0' style='max-width:980px'>
                                                        <thead>
                                                            <tr class='text-center'>
                                                                <th>Name</th>
                                                                <th>Specialization</th>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='cancel-app-table'>
                                            ";

                                            $cancel_table_lower = "
                                                        </tbody>
                                                    </table> 
                                                </div>
                                            </div>
                                            ";

                                            echo($cancel_table_upper);
                                            
                                            while($row = $stmt->fetch_assoc()){

                                                $wrong_date = explode("-", $row['app_date']);

                                                $date = $wrong_date[2].'/'.$wrong_date[1].'/'.$wrong_date[0];

                                                $app ="<tr class='text-center'>												
                                                            <td>"
                                                                ."Dr. ".$row['first_name']." ".$row['middle_name']." ".$row['last_name'].
                                                            "</td>
                                                            <td>".$row['specialization']."</td>
                                                            <td>".$date."</td>
                                                            <td>".returnTime($row['app_time'])."</td>
                                                            <td class='container1'>
                                                                <form method='POST' action='include/cancel-app-inc.php'>
                                                                    <input type='hidden' name='app-id' id='app-id' value =".$row['app_id']."></input>
                                                                    <input type='submit' name='cancel' class='btn btn-danger center' value='Cancel'>
                                                                        Cancel
                                                                    </input>
                                                                </form> 
                                                            </td>
                                                        </tr>";
                                                
                                                echo($app);
                                            }

                                            echo($cancel_table_lower);
                                        }
                                    ?>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                                </div>
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
                                
                                    <form method="POST" id="change-pass-form" action="include/change-pat-pass-inc.php">
            
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
            if(isset($_GET['booked'])){
                $booked = $_GET['booked'];
                if($booked == 1)
                    displayStatus('Appoiment Booked Successfully;)');
            }else if(isset($_GET['canceled'])){
                $canceled = $_GET['canceled'];
                if($canceled == 1)
                    displayStatus('Appoiment Cancelled Successfully;)');
            }else if(isset($_GET['success'])){
                $success = $_GET['success'];
                if($success == 1)
                    displayStatus('Password Changed Successfully:)');
                else if($success == 0)
                    displayStatus("Current Password deoesn't match!!!");
            }

        ?>
        
        
        <script src="js/pat_homepage_script.js"></script>
        <script src="js/change-pass-valid.js"></script>
    </body>
</html>
