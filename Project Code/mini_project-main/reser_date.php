<?php 

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}
?>

<!doctype html>
<html>
        

    <head>
        <link rel="stylesheet" href='w_user.css'>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style>
        *{
            font-family: Helvetica;
        }
    </style>
    <nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        
        <a href="logout.php"><button class="btn btn-outline-danger" type="button" >Logout</button></a>
    </form>
    </nav>
    <div class="container" style="margin-top:10px;">
    <H1 class="text-center fw-bolder" style="color:#0d6efd;">Select Reserve date</H1><hr><br>

    <div id="SCROLL_TO_TOP" class="qhwIj ignore-focus undefined" tabindex="-1" role="region" aria-label="top of page">&nbsp;</div>
    <body background="35413014_m.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,500&family=Roboto&display=swap" rel="stylesheet"> 
      <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">    
         
      
    <div style="text-align:center;width:100%;" class="welcome">
    
    <?php 

    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM regis_user WHERE STUDENT_ID = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    ?>
    <form action="reser_date_db.php" method="post" >
        <div class="mb-3 w-50" style="margin: 0 auto;">
    <div class="form-group mb-3">
    <label for="">date/month/year</label>
    <input type="date" name="reser_date" class="form-control" min="<?php echo date('Y-m-d');?>"><br><br>
    <button class="btn btn-primary w-50" type="submit" onclick="return confirm('ยืนยันหรือไม่ !!');">Reserve!</button>
    </div>
        </form>
            </div>
</div>
</body>

</html>
