<?php
     if(!isset($_GET['status'])){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status page</title>

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
            background-color:#edeef0;
        }
    </style>

</head>
<body class="h-100">
    <div class="d-flex justify-content-center align-items-center bgcolor" style="height: 100%;">

        
        <?php

            $status = $_GET['status'];

            if($status == 1){
                // if account exists already 
                $exists = "
                <div class='jumbotron alert-light'>
                    <h1 class='h1' style='color: rgb(66, 65, 65);'>Account Exists Already:)</h1>
                    <p class='lead'>You already have an Account.</p>
        
                    <hr class='my-4'>
                    <div class='text-right'> 
                        <a class='btn btn-primary btn-lg' href='pat_login.php' role='button'>Ok</a>
                    </div>    
                </div>
                ";

                echo($exists);

            }else{
                
                $success = "
                    <div class='jumbotron alert-success'>
                        <h1 class='h2'>Registered Successfully:)</h1>
                        <p class='lead'>Your Login Username is,</p>
                        <center class='h3 alert alert-light' style='color : black;'>
                            " . $status . "
                        </center>
                        <hr class='my-4'>
                        <p>Use above Username and your password to login!!</p>
                        <div class='text-right'> 
                            <a class='btn btn-dark btn-lg' href='pat_login.php' role='button'>Ok</a>
                        </div>    
                    </div>
                    ";

                echo($success);
            }

        ?>


    </div>
</body>
</html>