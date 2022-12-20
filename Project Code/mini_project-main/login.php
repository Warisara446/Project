<?php 

    session_start();
    require_once 'config/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        *{
            font-family: Helvetica;
        }
        #blog{
            background-color:navy;
            color:white;
        }

    </style>
</head>
<body>
    <nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        
        <a href="home.php"><button class="btn btn-outline-primary" type="button" >HOME</button></a>
    </form>
    </nav>
<div class="container" style="margin-top:20px">
    <h3 class="text-center fw-bold fs-1">Login</h3>
        <hr>
    <form action="login_db.php" method="post">
    <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
    <div class="mb-3 w-50" style="margin: 0 auto;" >

        <div class="form-label">Username</div>
        <input class="form-control" placeholder="Please enter your Student ID" type="text" name="STUDENT_LOG" aria-describedby="Username">
        
    <div class="form-label">Password</div>
    <input class="form-control" placeholder="Please enter your password" type="password" name="STUDENT_PW" aria-describedby="Password">
    
    <div class="d-grid gap-2 w-50 " style="margin-left:25%; margin-top:20px;">
        <button id="blog" type="submit" name="signin" class="btn ">Log in</button>
    </div>
   </div>
    
    </form>
    
    
    </div>
</body>
</html>