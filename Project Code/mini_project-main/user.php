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
        
    <style>
      *{
        font-family: Helvetica;
      }
    </style>
    <head>
        <link rel="stylesheet" href='w_user.css'>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <nav nav class="navbar navbar-light" style="background-color: #e3f2fd;">
    <form class="container-fluid justify-content-end">
        <a href="his.php"><button class="btn btn-outline-secondary mx-2" type="button" >History</button></a>
        <a href="logout.php"><button class="btn btn-outline-danger" type="button" >Logout</button></a>
    </form>
    </nav>

    <div id="SCROLL_TO_TOP" class="qhwIj ignore-focus undefined" tabindex="-1" role="region" aria-label="top of page">&nbsp;</div>
<body background="35413014_m.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,500&family=Roboto&display=swap" rel="stylesheet">    
      
    <div style="margin-top:10px;" class="container">
    
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
    <form action="user.php" method="post">
    <H1 class="text-center fw-bolder" style="color:#0d6efd;">Choose Room</H1><hr><br>
            
            </h1>
        </div>
              <div class="mb-3 d-flex justify-content-center">
               <input type="text" name="q" required class="form-control w-50" placeholder="ระบุชื่อสินค้าที่ต้องการค้นหา" value="<?php if (isset($_POST['q'])) { echo $_POST['q'];}?>">
        </div>
              <div class="d-grid gap-2 w-50" style="margin:auto;"> 
                <a  href="user.php" class="btn btn-warning mx-3 btn-block " >Reset</a>
                <button type="submit" class="btn btn-primary mx-3">Search</button>
                </div><br><br>
                </form>
        </div>       
        

<?php  if (isset($_POST['q']) && $_POST['q']!='') {
 
 //ประกาศตัวแปรรับค่าจากฟอร์ม
 $q = $_POST['q'];

 //คิวรี่ข้อมูลมาแสดงจากการค้นหา
 $stmt = $conn->prepare("SELECT* FROM admin_add WHERE  ROOM_DETAIL LIKE '$sex' AND ROOM_STATUS = 'ว่าง' AND ROOM_DETAIL LIKE '%$q%' OR ROOM_DETAIL LIKE '$sex' AND ROOM_STATUS = 'ว่าง' AND ROOM_ID LIKE '%$q%' OR ROOM_DETAIL LIKE '$sex' AND ROOM_STATUS = 'ว่าง' AND ROOM_PRICE LIKE '%$q%' ");
 
 $stmt->execute();

 $result = $stmt->fetchAll();
}else{
  //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
 $stmt = $conn->prepare("SELECT* FROM admin_add WHERE ROOM_DETAIL LIKE '$sex' AND ROOM_STATUS = 'ว่าง'");
 $stmt->execute();
 $result = $stmt->fetchAll();
}?>



 <?php 
                
                //แสดงข้อความที่ค้นหา
               if (isset($_POST['q']) && $_POST['q']!='') {
                echo '<font color="red"> ข้อมูลการค้นหา : '.$_POST['q'];
                echo ' *พบ '. $stmt->rowCount().' รายการ</font><br><br>';
               }?>
    <table class="table table-striped">
    <thead class="table-primary">
      <tr>
          <th>Room No.</th>
          <th>Type</th>
          <th>Price</th>
          <th>Image</th>
          <th>Status</th>
          <th></th>
      </tr>
    </thead>
    <tbody>
 <?php foreach($result as $row) {     ?>
  
        <tr>
                        
                        <td><?php echo $row['ROOM_ID'];?></td>                        
                        <td><?php echo $row['ROOM_DETAIL']; ?></td>                     
                        <td><?php echo $row['ROOM_PRICE']; ?></td>
                        <td><img src="upload/<?php echo $row['img_file'];?>" width="100px"></td>
                        <td style="color:green;font-style:bolder;"><?php echo $row['ROOM_STATUS']; ?></td>
                        <?php 
                              
                              $sql = $conn->prepare("SELECT reserve.student_id,reserve.reserve_status FROM reserve 
                              INNER JOIN regis_user ON regis_user.STUDENT_ID = reserve.student_id
                              WHERE reserve.reserve_status = 'จองแล้ว' AND reserve.student_id = $user_id;");
                              $sql->execute();
                              $mys = $sql->fetch(PDO::FETCH_ASSOC); 
                              
                              if(!isset($mys['student_id'])){?>

                                <td><a href="reser_user.php?ROOM_ID=<?php echo $row['ROOM_ID'];?>" class="btn btn-primary">Choose</a> </td>
                              <?php } 
                              else {?>

                                <td><a href="user.php"  class="btn btn-success" onclick="return confirm('คุณได้จองเรียบร้อยแล้ว !!');">Choose</a> </td>
                              <?php }?>

                       
                            

                    </tr>
          <?php }?>
              </div>

              </tbody>

</table>                             
                              
</div>    
</body>

</html>