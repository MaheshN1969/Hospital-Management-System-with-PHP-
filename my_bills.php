<?php
    session_start();

    try{
        require "include/dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['pay'])){
        $bill_id = $_POST['bill_id'];
        $result = $conn->query("UPDATE bill_view SET pay_date = CURRENT_DATE() WHERE bill_id = $bill_id;");
    }

    $due_bills = $conn->query("SELECT * FROM bill_view WHERE pay_date = '0000-00-00';");
    $pay_bills = $conn->query("SELECT * FROM bill_view WHERE pay_date <> '0000-00-00' ORDER BY issue_date DESC;");
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bills</title>
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
        .error-text{
            color:red;
        }
		.card-margin{
			margin: 0.5rem 0;
		}
        .center {
            margin: 0;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .red-shadow{
            box-shadow: 0 0 5px rgb(255, 0, 0);
        }
        .green-shadow{
            box-shadow: 0 0 5px rgb(51, 255, 0);
        }
	</style>
	
</head>
<body class="h-100" style="background-color: #f5f6fa;">
    <div class="card container justify-content-center align-middle" style="padding-top:1rem; max-width: 1080px;">
        <div class="card-body">
            <nav aria-label="breadcrumb">
               <a href="pat-dashboard.php" class="btn btn-secondary"><i class="fas fa-tachometer-alt" style="margin-right: 0.75rem;"></i>Dashboard</a>
               <button class="btn btn-danger" id="due-section-btn">Due</button>
               <button class="btn btn-success" id="paid-section-btn">Paid</button>
            </nav>
            <hr class="my-4">

            <!-- Due bills section  -->
            <div class="container" id="due-section">  

                <?php

                    if($due_bills->num_rows <= 0){
                        echo("
                            <div class='alert alert-success text-center' role='alert'>
                                No Due Are Remaining:) 
                            </div>
                        ");
                    }else{
                        while($row=$due_bills->fetch_assoc()){
                            $due_text = "
                                <div class='card card-margin container red-shadow' style='border-radius: 1rem;max-width: 980px;'>
                                    <div class='card-body'>

                                        <div class='form-row'>
                                                <div class='col-md-2 h6'>Name</div>
                                                <div class='col-md-6 h6'>: ".htmlentities($row['pat_full_name'])."</div>
                                                <div class='col-md-2 h6'>Gender</div>
                                                <div class='col-md-2 h6'>: ".htmlentities($row['Gender'])."</div>
                                        </div>
                                        <div class='form-row'>
                                                <div class='col-md-2 h6'>Name</div>
                                                <div class='col-md-6 h6'>: Dr. ".htmlentities($row['doc_full_name'])."</div>
                                                <div class='col-md-2 h6'>Specialization</div>
                                                <div class='col-md-2 h6'>: ".htmlentities($row['specialization'])."</div>
                                        </div>
                                        
                                        <div class='form-row'>
                                            <div class='col-md-2 h6'>Bill ID</div>
                                            <div class='col-md-6 h6'>: ".htmlentities($row['bill_id'])."</div>
                                            <div class='col-md-2 h6'>Amount</div>
                                            <div class='col-md-2 h6'>: <i class='fas fa-rupee-sign'></i><b> ".htmlentities($row['amount']).".00</b></div>
                                        </div>

                                        <div class='form-row'>
                                            <div class='col-md-2 h6'>Issue Date</div>
                                            <div class='col-md-6 h6'>: ".date("d M Y", strtotime($row['issue_date']))."</div>
                                        </div>
                                        
                                        <hr class='my-4'>

                                        <div class='form-row'>
                                            <div class='col-md-2 offset-md-10'>
                                                <form action='my_bills.php' method='post'>
                                                    <input type='hidden' id='bill_id' name='bill_id' value='".htmlentities($row['bill_id'])."'>
                                                    <input type='submit' class='form-control btn btn-success float-right' name='pay' id='pay' value='Pay'>
                                                </form>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <hr class='my-4'>           
                            ";
                            echo($due_text);
                        }
                    }
                ?>   

            </div>

            <!-- Paid Bills Section -->
            <div class="container" id="paid-section" style="display: none;">  

                <?php

                    if($pay_bills->num_rows <= 0){
                        echo("
                            <div class='alert alert-info text-center' role='alert'>
                                No Previous Payments were Found 
                            </div>
                        ");
                    }else{
                        while($row=$pay_bills->fetch_assoc()){
                            $pay_text = "
                                <div class='card card-margin container green-shadow' style='border-radius: 1rem;max-width: 980px;'>
                                    <div class='card-body'>
                                
                                        <div class='form-row'>
                                            <div class='col-md-2 h6'>Name</div>
                                            <div class='col-md-6 h6'>: ".htmlentities($row['pat_full_name'])."</div>
                                            <div class='col-md-2 h6'>Gender</div>
                                            <div class='col-md-2 h6'>: ".htmlentities($row['Gender'])."</div>
                                        </div>
                                        <div class='form-row'>
                                            <div class='col-md-2 h6'>Name</div>
                                            <div class='col-md-6 h6'>: Dr. ".htmlentities($row['doc_full_name'])."</div>
                                            <div class='col-md-2 h6'>Specialization</div>
                                            <div class='col-md-2 h6'>: ".htmlentities($row['specialization'])."</div>
                                        </div>
                                    
                                        <div class='form-row'>
                                            <div class='col-md-2 h6'>Bill ID</div>
                                            <div class='col-md-6 h6'>: ".htmlentities($row['bill_id'])."</div>
                                            <div class='col-md-2 h6'>Amount</div>
                                            <div class='col-md-2 h6'>: <i class='fas fa-rupee-sign'></i><b> ".htmlentities($row['amount']).".00</b></div>
                                        </div>
                                
                                        <div class='form-row'>
                                            <div class='col-md-2 h6'>Issue Date</div>
                                            <div class='col-md-6 h6'>: ".date("d M Y", strtotime($row['issue_date']))."</div>
                                            <div class='col-md-2 h6'>Paid Date</div>
                                            <div class='col-md-2 h6'>: ".date("d M Y", strtotime($row['pay_date']))."</div>
                                        </div>
                                    </div>
                                </div>
                                <hr class='my-4'>        
                            ";
                            echo($pay_text);
                        }
                    }
                ?>

            </div>

        </div>
    </div>

    <script src="js/my-records.js"></script>
</body>
</html>