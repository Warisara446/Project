<?php 

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">   
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <title>Admin Ravenclaw</title>
    <style>
        *{
            font-family: Helvetica;
        }
    </style>
</head>

<nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        <a href="admin_status.php"><button class="btn btn-success mx-1" type="button" >Status</button></a>
        <a href="admin_deuser.php"><button class="btn btn-warning mx-1" type="button" >Detail</button></a>
        <a href="logout.php"><button class="btn btn-danger mx-1" type="button" >Logout</button></a>
    </form>
    </nav>
<body>
    <?php
    if (isset($_SESSION['admin_login'])) {
        $admin_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM regis_user WHERE STUDENT_ID = $admin_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    
    <div class="container" style="margin-top:20px">  
       <h3 class="text-center fw-bold fs-1">Admin Setup Room</h3> 
       
                <form action="admin_add_db.php" method="post" enctype="multipart/form-data">
                    <input class="form-check-radio mb-3" type="radio" name="ROOM_DETAIL"  value="ชาย">Male
                    <input class="form-check-radio mb-3" type="radio" name="ROOM_DETAIL"  value="หญิง">Female
                    <input class="form-control mb-3" type="text" name="detail"  placeholder="detail">
                    <input class="form-control" type="text" name="ROOM_PRICE"  placeholder="price/month"><br><br>
                    
                    <font color="red">*Upload only .jpeg , .jpg , .png </font>
                    <input type="file" name="img_file" required   class="form-control" accept="image/jpeg, image/png, image/jpg"> <br>
                    <div class="d-grid gap-2 w-50" style="margin: 0 auto;">
                    <button type="submit" class="btn btn-primary">Upload</button></div><br><br><hr>
                </form>
                <h3 class="text-start fw-bold fs-1">List Room</h3> 
                <table class="table table-striped  table-hover table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            
                            <th width="5%">Type</th>
                            <th width="5%">Detail</th>
                            <th width="5%">Price</th>
                            
                            <th width="10%">Image</th>
                            <th width="10%">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //คิวรี่ข้อมูลมาแสดงในตาราง
                       
                        $stmt = $conn->prepare("SELECT* FROM admin_add WHERE ROOM_STATUS = 'ว่าง'");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $k) {
                        ?>
                        <tr>
                            <td><?= $k['ROOM_ID'];?></td>
                            <td><?= $k['ROOM_DETAIL'];?></td>
                            <td><?= $k['detail'];?></td>
                            <td><?= $k['ROOM_PRICE'];?></td>
                            <td><img src="upload/<?= $k['img_file'];?>" width="70px"></td>
                            <td><?= $k['ROOM_STATUS'];?></td>
                            <td><a href="admin_edit.php?ROOM_ID=<?= $k['ROOM_ID']; $_SESSION['id'] = $k['ROOM_ID']?>" class="btn btn-warning btn-sm d-flex justify-content-center">Edit</a></td>
                                <td><a href="admin_del.php?ROOM_ID=<?= $k['ROOM_ID']; $_SESSION['id'] = $k['ROOM_ID']; ?>" class="btn btn-danger btn-sm d-flex justify-content-center" onclick="return confirm('Comfirm Delete !!');">Delete</a></td>
                                
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>     
</body>
</html>
