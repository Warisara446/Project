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
    <title>Register</title>
    <style>
        *{
            font-family: Helvetica;
        }

    </style>
</head>
<body>
<nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        
        <a href="login.php"><button class="btn btn-outline-primary me-2" type="button" >Login</button></a>
        <a href="home.php"><button class="btn btn-outline-primary" type="button" >HOME</button></a>
    </form>
    </nav>
<div class="container" style="margin-top:20px">
    <h3 class="text-center fw-bold fs-1" >Register</h3>
        <hr>
        <form action="register_db.php" method="post">
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

            <div class="w-50 mb-3" style="margin: 0 auto;">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" placeholder="Please enter your name" class="form-control" name="STUDENT_FNAME" aria-describedby="firstname">
            </div>
            <div class="mb-3 w-50"style="margin: 0 auto;">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" placeholder="Please enter your last name" class="form-control" name="STUDENT_LNAME" aria-describedby="lastname">
            </div>
            <div class="mb-3 w-50"style="margin: 0 auto;">
                <label for="username" class="form-label">Username</label>
                <input type="text" placeholder="Please enter your Student ID" class="form-control" name="STUDENT_LOG" aria-describedby="username">
            </div>
            <div class="mb-3 w-50"style="margin: 0 auto;">
                <label for="password" class="form-label">Password</label>
                <input type="password" placeholder="Please enter your password" class="form-control" name="STUDENT_PW">
            </div>
            <div class="mb-3 w-50"style="margin: 0 auto;">
                <label for="confirm password" class="form-label">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" class="form-control" name="c_password">
            </div>
            <div class="mb-3 w-50"style="margin: 0 auto;">
                <label for="Dept" class="form-label">Department</label>
                <input type="text" placeholder="Please enter your Department" class="form-control" name="STUDENT_DEPT">
            </div>
            <div class="mb-3 text-center fs-5">
                <input type="radio" class="form-check-radio" name="STUDENT_SEX" value="ชาย">Male
                <input type="radio" class="form-check-radio" name="STUDENT_SEX" value="หญิง">Female
            </div>
            <div class="d-grid gap-2 w-50" style="margin: 0 auto;">
                <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
        <div class="text-center">
        <a href='login.php' class="g_login " style="color:red;">If already registered?</a>
        </div>
        
        
    </div>
    </div>
</body>
</html>