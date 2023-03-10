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
    <link rel="stylesheet" href='adminshow.css'>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        
        <a href="logout.php"><button class="btn btn-outline-danger" type="button" >Logout</button></a>
    </form>
    </nav>

    <div id="SCROLL_TO_TOP" class="qhwIj ignore-focus undefined" tabindex="-1" role="region" aria-label="top of page">&nbsp;</div>
<body>
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,500&family=Roboto&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
    
    
    
    
    <div class="container" style="margin-top:20px">
    <H1 class="text-center fw-bolder" style="color:#0d6efd;">Reservation date</H1><hr><br>
    <div>

    <?php 

    if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $conn->query("SELECT * FROM regis_user WHERE STUDENT_ID = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <form action="" method="POST">
    <table class="table table-striped table-bordered table-hover">
            <thead><br><br>
                <tr>
                    <td>Reservation ID</td>
                    <td>Room No.</td>
                     <td>Reserve Date</td>
                    <td>Expire Date</td>
                    <td>Student ID</td>
                    <td>Name</td>
                    <td>Status</td>
                    <td>Room Image</td>
                    

                </tr>
            </thead>

            <tbody>
                <?php 
                    $select_stmt = $conn->prepare("SELECT reserve.ID,admin_add.ROOM_ID,reserve.reserve_date,reserve.reserve_expiredate,regis_user.STUDENT_LOG,regis_user.STUDENT_FNAME,admin_add.ROOM_STATUS,admin_add.img_file FROM reserve
                    INNER JOIN reservedetail ON reservedetail.reserve_id = reserve.reserve_id
                    INNER JOIN admin_add ON admin_add.ROOM_ID = reservedetail.room_id
                    INNER JOIN regis_user ON regis_user.STUDENT_ID = reserve.student_id
                    WHERE regis_user.STUDENT_ID = $user_id ORDER BY reserve.ID DESC"); 
                    $select_stmt->execute();
                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

                    
                ?>
                    <tr>
                        
                        <td><?php echo $row['ID'];?></td>                        
                        <td><?php echo $row['ROOM_ID']; ?></td>                     
                        <td><?php echo $row['reserve_date']; ?></td>
                        <td><?php echo $row['reserve_expiredate']; ?></td>
                        <td><?php echo $row['STUDENT_LOG']; ?></td>
                        <td><?php echo $row['STUDENT_FNAME']; ?></td>
                        <td><?php echo $row['ROOM_STATUS']; ?></td>
                        <td><img src="upload/<?php echo $row['img_file'];?>" width="200px"></td>
                        
                        
                    </tr>
                
                    </tbody>
       </div>
     </table>
    <div class="d-grid gap-2 w-50" style="margin: 0 auto;">
            <a href="change_date.php?ID=<?php echo $row['ID']?>" class="btn btn-warning btn-sm"  onclick="return confirm('ยืนยันเปลี่ยนวัน !!');" >Change Reserve Date</a>
    </div>
        </div>
           
            
        

</body>

</html>