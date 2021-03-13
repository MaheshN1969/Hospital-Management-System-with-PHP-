<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--<link rel="stylesheet" type="text/css" href="custum.css"> --> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <title>Home page</title>
<style>
.inner{
overflow: hidden;
}
.inner img{
    transition: all 1.5s ease;
}

.inner:hover img{
    transform: scale(1.5);
}
.card:hover{
    transform: scale(1.1);
}

</style>
    
</head>
<body class="h-100 img-fluid" style="background-image: url(img/medicare.jpg); background-size: cover; background-repeat: no-repeat;">

    <div class="head">
        <h1 style="font-size: 60px; text-align: center; ">Hospital management system</h1>
    </div>


<div class="container" style="margin-bottom: 30px; margin-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-md-3 col-sm-6">
            <div class="card text-center shadow" style="background-color:greenyellow; border-radius: 20px; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        cursor: pointer;">
                <div class="card-body">
                    <div class="inner"><img src="img/doc logo1.jpg" alt="Card image cap " class="img-fluid"></div>
                    <div class="card-title">
                        <h4>DOCTOR</h4>
                    </div>
                    <div class="card-text">To enter into Doctor system: </div>
                    <div class="card-text">Click below</div>
                    <a style="margin-top: 10px;" href="dr_login.php" class="btn btn-primary btn-success">Login</a>
                    <a style="margin-top: 10px;" href="doctor_reg.php" class="btn btn-primary">register</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card text-center shadow" style="background-color:gold;  border-radius: 20px; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
        cursor: pointer;">
                <div class="card-body">
                    <div class="inner"><img src="img/download.png" alt="" class="img-fluid"></div>
                    <div class="card-title">
                        <h4>PATIENT</h4>
                    </div>
                    <div class="card-text">To enter into Patient system: </div>
                    <div class="card-text">Click below</div>
                    <a style="margin-top: 10px;" href="pat_login.php" class="btn btn-primary btn-success">Login</a>
                    <a style="margin-top: 10px;" href="pat-reg.php" class="btn btn-primary">register</a>                   
                </div>
            </div>
        </div>

    </div>

</div>
<div class="container" style="margin-bottom: 30px;">
    <div class="row  justify-content-center">
        <div class="col-md-3 col-sm-6">
            <div class="card text-center shadow" style="background-color:rgb(47, 206, 255);  border-radius: 20px; box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
            transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
            cursor: pointer;">
                <div class="card-body">
                    <div class="inner"><img src="img/images.png" alt="" class="img-fluid"></div>
                    <div class="card-title">
                        <h4>ADMIN</h4>
                    </div>
                    <div class="card-text">To enter into Admin system: </div>
                    <div class="card-text">Click below</div>
                    <div class="text-center">
                        <a style="margin-top: 10px;" href="" class="btn btn-success btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Login</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>

</div>
    


                <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="max-width: 720px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Login</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            
                                <form method="POST" id="modalLoginForm" action="Include/admin-login-inc.php">
            
                                    <div class="form-group">
                                        <label class="h6" for="password">Username :</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter admin username" required>
                                        <small class="error-text" id="old-pass-error" ></small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="h6" for="new-password"> Password :</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                        <small class="error-text" id="new-pass-error" ></small>
                                    </div>

            

                                    <div class="modal-footer">
                                        <input type="submit" value="login" name="login" id="login" class="btn btn-success"/>
                                        <button type="button" id="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                    </div>
                                </form>
                            
                        </div>
                    </div>
                </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" 
    integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    
</body>
</html>