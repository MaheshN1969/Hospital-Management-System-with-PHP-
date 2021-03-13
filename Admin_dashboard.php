<?php
    session_start();

    try{
        require "include/dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }
   
    if(isset($_POST['verify']))
    {
        $srno = $_POST['doc_verify'];
        $sql = "UPDATE  doctors SET verified = 1 WHERE id=$srno";
        $stmt= $conn->query($sql);

        $update = "UPDATE doctors SET join_date = CURRENT_DATE() WHERE id=$srno";
        $stmt= $conn->query($update);
        
        // echo '<script type=" text/javascript ">alert("Doctor has been verified ")</script>';
    }
    if(isset($_POST['remove']))
    {
        $srno = $_POST['doc_remove'];
        $sql = "UPDATE  doctors SET verified = -1 where id=$srno";
        $stmt= $conn->query($sql);
        
        // echo '<script type=" text/javascript ">alert("Doctor application has been rejected")</script>';
    }    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</head>
<body class="sb-nav-fixed">
      
<!-- head nav -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <span class="h1 fab fa-app-store" style="color:rgb(4, 152, 238); margin: auto 2rem;" id="logo">   
        </span>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" style="margin: auto 0.5rem;" href="#"><i class="fas fa-bars"></i></button>
        <div class="form-inline ml-auto" style="color:whitesmoke; margin-right:0.3rem;">
            <i class="fas fa-user fa-fw" style="margin-right: 0.5rem;"></i> <h5>Admin Dashboard </h5>
            
        </div>
    </nav>  
    
 
 <!-- slide bar -->
 
 <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" >
                        <div class="nav">
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link" href="include/logout-inc.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-power-off"></i></div>
                                Logout
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:  
                            <h3>Admin </h3>
                        </div>

                    </div>
                </nav>
            </div>


<!-- main body content -->

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid" style="margin-top: 0.75rem;">

                        <div class="breadcrumb mb-4 d-flex align-items-center" style="color: black;">
                            <i class="fas fa-tachometer-alt" style="margin-right: 0.75rem;"></i>
                             Dashboard   
                        </div>

                        <div class="row">
                           
                            <!-- Patient detial -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Patient Details
                                        <span class="badge badge-light float-right" id="today-app-count">
                                        <?php
                                            $sql = "SELECT * FROM patients;";
                                            $result= $conn->query($sql);

                                            echo($result->num_rows);
                                             
                                            
                                        ?>
                                        </span>
                                        </h4>
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-todays-app">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Doctor Details -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Doctor Details
                                        <span class="badge badge-light float-right" id="today-app-count">
                                        <?php
                                            $sql = "SELECT * FROM doctors WHERE verified = 1;";
                                            $result= $conn->query($sql);

                                            echo($result->num_rows);
                                             
                                            
                                        ?>
                                        </span>
                                            </h4>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-all-app">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- verify doctor -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Verify Doctor
                                        <span class="badge badge-light float-right" id="today-app-count">
                                        <?php
                                            $sql = "SELECT * FROM doctors WHERE verified = 0;";
                                            $result= $conn->query($sql);

                                            echo($result->num_rows);
                                              
                                        ?>
                                        </span>
                                            </h4>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" id="toggle-all-verify">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>                        
                        </div>



                        <!-- Table view -->

                        <!-- Patient detail table -->
                        <div class="card mb-4 " id="dataTable-today-app" style="display: none; margin-top: 30px;">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Patient detail table 
                                <!-- input for search -->
                                <form class="d-none d-md-inline-block form-inline d-flex align-items-center float-right ">
                                    <input class="form-control" id="today-app-search" type="text" placeholder="Search for Patient..."/>
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                            </tr>
                                        </thead>
                                        <tbody id="today-app-data">
                                         
                                         <!-- using php -->
                                        <?php 
                                         $sql = "SELECT First_name, Middle_name, Last_name, Gender, Email_ID, Contact_No FROM patients";
                                         $result= $conn->query($sql);

                                                while($row = $result -> fetch_assoc())
                                                {
                                                    echo "<tr><td>".$row["First_name"]." ".$row["Middle_name"]." ". $row["Last_name"]."</td>
                                                    <td>".$row["Gender"]."</td>
                                                    <td>".$row["Email_ID"]."</td>
                                                    <td>".$row["Contact_No"]."</td></tr>";

                                                }
                                           

                                        ?>


                                           <!-- <tr>
                                                <td id="no-pat-today" class="text-muted text-center" colspan="6" style="display: none;">Search Result Empty</td>
                                            </tr> -->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Detail table  -->
                        <div class="card mb-4" id="dataTable-all-app" style=" display: none; margin-top: 30px; ">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Doctor Details 
                                <!-- input for search -->
                                <form class="d-none d-md-inline-block form-inline d-flex align-items-center float-right ">
                                    <input class="form-control" id="all-app-search" type="text" placeholder="Search for Doctor..."/>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Specialization</th>
                                                <th>Contact</th>
                                                <th>Email_ID</th>
                                                <th>Join date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-app-data">
                                            <!-- Php for doctor -->

                                        <?php 
                                         $sql = "SELECT first_name, middle_name, last_name,specialization, email_id, contact_no, join_date FROM doctors WHERE verified = 1";
                                         $result= $conn->query($sql);
                                         
                                                while($row = $result -> fetch_assoc())
                                                {
                                                    echo "<tr><td>".$row["first_name"]." ".$row["middle_name"]." ". $row["last_name"]."</td>
                                                    <td>".$row["specialization"]."</td>
                                                    <td>".$row["contact_no"]."</td>
                                                    <td>".$row["email_id"]."</td>
                                                    <td>".date("d M Y", strtotime($row["join_date"]))."</td>
                                                    </tr>";

                                                }
                                           

                                        ?>
                                            
                                            <tr>
                                                <td id="no-pat-all" class="text-muted text-center" colspan="6" style="display: none;">Search Result Empty</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Verify doctor table -->
                        
                        <div class="card mb-4" id="dataTable-all-verify" style="display: none; margin-top: 30px; ">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Doctor Verification
                                <!-- input for search -->
                                <form class="d-none d-md-inline-block form-inline d-flex align-items-center float-right ">
                                    <input class="form-control" id="all-verify-search" type="text" placeholder="Search for Doctor..."/>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Specialization</th>
                                                <th>Contact</th>
                                                <th>Email_ID</th>
                                                <th>View profile</th>
                                                <th colspan='2' class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-app-data">
                                           
                                                <!-- php code for doctor verification -->

                                         <?php 
                                         $sql = "SELECT id, first_name, middle_name, last_name,specialization, email_id, contact_no, verified FROM doctors WHERE verified = 0";
                                         $result= $conn->query($sql);
                                         
                                         
                                                while($row = $result -> fetch_assoc())
                                                {
                                                    echo "<tr>
                                                    <td>".$row["first_name"]." ".$row["middle_name"]." ". $row["last_name"]."</td>
                                                    <td>".$row["specialization"]."</td>
                                                    <td>".$row["contact_no"]."</td>
                                                    <td>".$row["email_id"]."</td>
                                                    <td>
                                                    <form id='book-form' method='POST' action='profile.php'>
                                                    <input type='hidden' name='doc-id' value=".$row['id']."></input>
                                                    <input type='submit' id='view' class='btn btn-primary center' name='view' value='view'></input>
                                                    </form>
                                                    </td>
                                                    <td style='display: inline-flex'>
                                                    <form id='verify_doc' method='POST' action='Admin_dashboard.php'>
                                                    <input type='hidden' name='doc_verify' value=".$row['id']."></input>
                                                    <input type='submit' id='verify' class='btn btn-success center' name='verify' value='verify'></input>
                                                    </form>
                                                    </td>
                                                    <td>
                                                    <form id='remove_doc' method='POST' action='Admin_dashboard.php'>
                                                    <input type='hidden' name='doc_remove' value=".$row['id']."></input>
                                                    <button type='submit' id='remove' class='btn btn-danger' name='remove'> <i class='fas fa-trash-alt'></i></button>
                                                    </form>
                                                    </td>
                                                    </tr>";
                                                }
                                                

                                        ?>
                                            <tr>
                                                <td id="no-pat-all" class="text-muted text-center" colspan="6" style="display: none;">Search Result Empty</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>    


                    </div>                                   
</div>
</div> 
<script src="js/Admin_homepage_script.js"></script>

</body>
</html>

