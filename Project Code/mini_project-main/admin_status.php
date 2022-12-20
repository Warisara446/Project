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
    <title>Admin Ravenclaw</title>
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        *{
            font-family: Helvetica;
        }

    </style>
</head>

<body>
<nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        <a href="admin_add.php"><button class="btn btn-primary mx-1" type="button" >Back</button></a>
    </form>
    </nav>
    <?php
    if (isset($_SESSION['admin_login'])) {
        $admin_id = $_SESSION['admin_login'];
        $stmt = $conn->query("SELECT * FROM regis_user WHERE STUDENT_ID = $admin_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    
    <div class="container" style="margin-top:20px">
    <h3 class="text-center fw-bold fs-1">Status</h3>             
            <form action="admin_status.php" method="post" enctype="multipart/form-data">
            <label class="form-label d-none d-sm-block">search</label>
            <div class="bm-3">
            <input type="text" name="q" class="form-control" placeholder="type for search" value="<?php if (isset($_POST['q'])) { echo $_POST['q'];}?>">
            </div>
              <input class="form-check-radio mb-3" type="radio" name="q"  value="ชาย">Male
              <input class="form-check-radio mb-3" type="radio" name="q"  value="หญิง">Female          
                <div class="d-grid gap-2 w-50" style="margin: 0 auto;">  
                <a  href="admin_status.php" class="btn btn-warning">Reset</a>
                <button type="submit" class="btn btn-primary">Search</button>
                </div>
                </form>
               
        

<?php  if (isset($_POST['q']) && $_POST['q']!='') {
 
 //ประกาศตัวแปรรับค่าจากฟอร์ม
 $q = $_POST['q'];

 //คิวรี่ข้อมูลมาแสดงจากการค้นหา
 $stmt = $conn->prepare("SELECT* FROM admin_add WHERE ROOM_STATUS LIKE 'จองแล้ว' AND  ROOM_DETAIL LIKE '%$q%' OR ROOM_STATUS LIKE 'จองแล้ว' AND ROOM_ID LIKE '%$q%' OR ROOM_STATUS LIKE 'จองแล้ว' AND ROOM_PRICE LIKE '%$q%' ");
 
 $stmt->execute();

 $result = $stmt->fetchAll();
}else{
  //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
 $stmt = $conn->prepare("SELECT* FROM admin_add WHERE ROOM_STATUS like 'จองแล้ว'");
 $stmt->execute();
 $result = $stmt->fetchAll();
}?>
 <?php 
                
                //แสดงข้อความที่ค้นหา
               if (isset($_POST['q']) && $_POST['q']!='') {
                echo '<font color="red"> ข้อมูลการค้นหา : '.$_POST['q'];
                echo ' *พบ '. $stmt->rowCount().' รายการ</font><br><br>';
               }?>

              


              
            <h3 class="text-start fw-bold fs-1">List Status</h3> 
                <table class="table table-striped  table-hover table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            
                            <th width="5%">Type</th>
                            <th width="5%">Detail</th>
                            <th width="5%">Price</th>
                            
                            <th width="10%">Image</th>
                            <th width="10%">Status</th>
                            <th width="10%"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //คิวรี่ข้อมูลมาแสดงในตาราง
                       
                        foreach($result as $row) {
                        ?>
                        <tr>
                        <td><?php echo $row['ROOM_ID'];?></td>                        
                        <td><?php echo $row['ROOM_DETAIL']; ?></td>                     
                        <td><?php echo $row['detail']; ?></td>                     
                        <td><?php echo $row['ROOM_PRICE']; ?></td>
                        <td><img src="upload/<?php echo $row['img_file'];?>" width="100px"></td>
                        <td><?php echo $row['ROOM_STATUS']; ?></td>
                        
                        <td><a href="ad_status_edit.php?ROOM_ID=<?php echo $row['ROOM_ID']; $_SESSION['id'] = $row['ROOM_ID'];?>" class="btn btn-warning btn-sm">Cancle Reserve</a></td>
                        <br><br>
                               
                                
                        <?php } ?>
                    </tbody>
                </table>
                
                <a href="admin_add.php" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
</div>    
</body>
</html>
