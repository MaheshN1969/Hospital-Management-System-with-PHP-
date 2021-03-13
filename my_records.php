<?php
    session_start();

    try{
        require "include/dbh-inc.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['download'])){
        $record_id = $_POST['record_id'];
        $result = $conn->query("SELECT record_name, data FROM records WHERE record_id = $record_id;")->fetch_assoc();
        // Store the file name into variable 
        $pdf = $result['data']; 
        $pdfname = $result['record_name']; 
        
        // Header content type 

        header('Content-type: application/pdf'); 
        
        header('Content-Disposition: attachment; filename="' . $pdfname . '"'); 
        
        header('Content-Transfer-Encoding: binary'); 
        
        header('Accept-Ranges: bytes');
        @readfile($pdf);
        print_r($pdf);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Records</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="card container justify-content-center align-middle" style="padding-top:1rem; max-width: 1080px;">
        <div class="card-body">
            <nav aria-label="breadcrumb">
               <a href="pat-dashboard.php" class="btn btn-secondary"><i class="fas fa-tachometer-alt" style="margin-right: 0.75rem;"></i>Dashboard</a>
            </nav>
            <div class="card-body d-flex justify-content-center align-middle">
                <div class="table-responsive">
                    <table class="table table-bordered" cellspacing="0" style="max-width:888px">
                        <thead>
                            <tr class="text-center">
                                <th>Sr.No.</th>
                                <th>Record Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                $i = 1;
                                $result = $conn->query("SELECT * FROM records WHERE pat_id = '$_SESSION[userid]';");
                                if($result->num_rows < 0){
                                    echo("
                                        <tr> 
                                            <td colspan='4' class='text-center'>
                                                No Previous Records Found!!!
                                            </td>
                                        </tr>
                                    ");
                                }else{
                                    while($row = $result->fetch_assoc()){
                                        $tab = "
                                            <tr class='text-center'>
                                                <td>$i</td>
                                                <td>".$row['record_name']."</td>
                                                <td>
                                                    <form action='include/pdf-view-inc.php' method='post'>
                                                        <input type='hidden' id='record_id' name='record_id' value=".$row['record_id']."></input>
                                                        <input type='submit' class='btn btn-primary' value='View' name='view' id='view'></input>
                                                    </form> 
                                                </td>
                                                <td>
                                                    <form action='my_records.php' method='post'>
                                                        <input type='hidden' id='record_id_download' name='record_id' value=".$row['record_id']."></input>
                                                        <button type='submit' class='btn btn-success' name='download' id='download'>
                                                            <i class='fas fa-download'></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        ";
                                        echo($tab);
                                        $i++;
                                    }
                                }                                
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>