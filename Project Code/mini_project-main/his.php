<?php 

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
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
    <title>User RavenClaw</title>
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>
<nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        <a href="user.php"><button class="btn btn-primary mx-1" type="button" >Back</button></a>
    </form>
    </nav>
    <?php
    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM regis_user WHERE STUDENT_ID = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    
    <div class="container" style="margin-top:20px">
    <h3 class="text-center fw-bold fs-1">History</h3>             
            
        

<?php  
  //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
 $stmt = $conn->prepare("SELECT reserve.room_id,regis_user.STUDENT_LOG,regis_user.STUDENT_FNAME,regis_user.STUDENT_LNAME,regis_user.STUDENT_SEX,regis_user.STUDENT_DEPT,reserve.reserve_date,reserve.reserve_expiredate,admin_add.ROOM_STATUS FROM regis_user
 INNER JOIN reserve ON reserve.student_id = regis_user.STUDENT_ID
 INNER JOIN admin_add ON admin_add.ROOM_ID = reserve.room_id
 WHERE admin_add.ROOM_STATUS = 'จองแล้ว' AND reserve.student_id = $user_id;");
 $stmt->execute();
 $result = $stmt->fetchAll();
?>

              
            
            <h3 class="text-start fw-bold fs-1">List</h3> 
                <table class="table table-striped  table-hover table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">Room No.</th>
                            <th width="5%">Student ID</th>
                            <th width="5%">Firstname</th>
                            
                            <th width="5%">Lastname</th>
                            <th width="5%">Sex</th>
                            <th width="5%">Department</th>
                            
                            <th width="10%">Reserve Date</th>
                            <th width="10%">Expire Date</th>
                            <th width="10%">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //คิวรี่ข้อมูลมาแสดงในตาราง
                       
                        foreach($result as $row) {
                        ?>
                        <tr>
                        <td><?php echo $row['room_id'];?></td>                        
                        <td><?php echo $row['STUDENT_LOG']; ?></td>                     
                        <td><?php echo $row['STUDENT_FNAME']; ?></td>                     
                        <td><?php echo $row['STUDENT_LNAME']; ?></td>                     
                        <td><?php echo $row['STUDENT_SEX']; ?></td>                     
                        <td><?php echo $row['STUDENT_DEPT']; ?></td>                     
                        <td><?php echo $row['reserve_date']; ?></td>                     
                        <td><?php echo $row['reserve_expiredate']; ?></td>
                        
                        <td><?php echo $row['ROOM_STATUS']; ?></td>
                        
                                <br><br>
                               
                                
                        <?php } ?>
                    </tbody>
                </table>
                
                <a href="admin_add.php" class="btn btn-danger btn-sm">Back</a>
            </div>
        </div>
    </div>
    
</body>
</html>