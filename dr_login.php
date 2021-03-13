<?php 
    require('include/dbh-inc.php');
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Staff Login</title>

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
            background :-webkit-linear-gradient(#53b9cf,#5489cf);
        }
        .error-text{
          color:red;
        }
    </style>

</head>
<body class="h-100">
   <div class="d-flex justify-content-center align-items-center bgcolor" style="height: 100%;">

      <div class="card" style="width:25rem; padding: 2rem;">
        <div class="card-body">
          <span class="card-img-top d-flex justify-content-center align-items-center" id="logo">
            <i class="fas fa-hospital-symbol" style="color:rgb(4, 152, 238) ;font-size:4rem"></i>
          </span>
          <hr class="my-4">

          <form method="POST" action="include/login-inc.php">

            <div class="form-group">
              
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required 
                  onfocus=onFoucsEvent(this.id)>
                </div>
                <small class="error-text" id="user-error"></small>
              </div>
              
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required
                  onfocus=onFoucsEvent(this.id)>
                </div>
                <small class="error-text" id="pass-error"></small>
              </div>
              
              <div class="form-group">
                <div class="input-group" >
                  <input class="btn btn-primary" name="login" id='login' type="submit" value="Login" style="width: 100%;">
                </div>

                <?php
                    if(isset($_GET['dberror'])){
                      echo '<small class="error-text d-flex justify-content-center align-items-center" id="msg-txt" style="margin:1rem;">*Invalid username or password</small>';
                    }
                ?>
                
              </div>

            </div> 
          </form>
          <hr class="my-4">
          <p class="lead d-flex justify-content-center">
            Not, registered yet?
          </p>
          <a href="doctor_reg.php" class="lead d-flex justify-content-center">Click Here</a>
        </div>
   </div>

   <script src="js/form-validator-login.js"></script>
</body>
</html>