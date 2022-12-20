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

    <nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        
        <a href="logout.php"><button class="btn btn-outline-danger" type="button" >logout</button></a>
    </form>
    </nav>

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
      
    <style>
        *{
            font-family: Helvetica;
        }
    </style>
    <div style="text-align:center;width:100%;" class="welcome">
    <?php 

    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM regis_user WHERE STUDENT_ID = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $sex = $row['STUDENT_SEX'];
    }
    ?>
    <div class="container" style="margin-top:10px;">
    <form action="reser_user_db.php" method="post" enctype="multipart/form-data">
    <H1 class="text-center fw-bolder" style="color:#0d6efd;">Choose Room</H1><hr>
        </div>
        <?php       
                    if(isset($_GET['ROOM_ID'])){
                        $room_id = $_GET['ROOM_ID'];
                        $stmt = $conn->prepare("SELECT* FROM admin_add WHERE ROOM_ID=$room_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
                        if($stmt->rowCount() < 1){
                            header('Location: admin_add.php');
                            exit();
                        }
                      }//isset
                    $select_stmt = $conn->prepare("SELECT * FROM admin_add
                    WHERE ROOM_DETAIL = '$sex' AND ROOM_ID = $room_id "); 
                    $select_stmt->execute();

                    
                ?>
                <table class="table table-striped">
    <thead class="table-primary">
      <tr>
          <th>Room No.</th>
          <th>Type</th>
          <th>Detail</th>
          <th>Price</th>
          <th>Image</th>
          <th>Status</th>
          <th>Deposit</th>
      </tr>
    </thead>
                    <tr>
                        
                        <td><?php echo $row['ROOM_ID']; $_SESSION['room_id'] = $row['ROOM_ID']?></td>                        
                        <td><?php echo $row['ROOM_DETAIL']; ?></td>
                        <td><?php echo $row['detail']; $_SESSION['detail'] = $row['detail'];?></td>
                        <td><?php echo $row['ROOM_PRICE']; $_SESSION['price'] = $row['ROOM_PRICE']; ?></td>
                        <td><img src="upload/<?php echo $row['img_file'];?>" width="100px"></td>
                        <td><?php echo $row['ROOM_STATUS']; ?></td>
                        <td><?php $price = $row['ROOM_PRICE'];  $depo = $price*30/100; echo $depo; $_SESSION['deposit'] = $depo;?></td>
                        <br><br>


                    </tr>
                
</table>    
                <div></div>
                <div class="mb-3 w-50" style="margin: 0 auto;">
                <font color="black">Please attach a proof of payment/transfer slip.</font>
                <font color="red">*Upload your .jpeg , .jpg , .png </font>
                    <input type="file" name="img_file" required   class="form-control " accept="image/jpeg, image/png, image/jpg"> <br>
                <input class="btn btn-primary" type="submit" onclick="return confirm('ยืนยันการชำระหรือไม่ !!');">
                <br>
                <font color="red">Please Scan QR Code For Payment.</font>
                <img src="https://i.ibb.co/sKRGWjt/qr.png" width= 300 px height=300 px>
            </div>
            </form>
            </div>
</body>

</html>
