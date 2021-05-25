<?php 
    session_start();

    if (!isset($_SESSION['admin_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
?>

<!doctype html>
<html lang="en">
  <head>
        <!-- ระบุหน้า -->
    <?php $page="instructor"; ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\officer\style_table.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <div class="sidenav" >
        <a href="admin_home.php" >HOME</a>
        <a href="register.php"style="font-size: 16px;">เพิ่มบัญชีผู้ใช้งาน</a>
        <a href="addnisit.php" style="font-size: 16px;">เพิ่มบัญชีผู้ใช้นำเข้าไฟล์.xlxs</a>
        <a href="plusyear.php"style="font-size: 16px;" onclick="return confirm('คุณต้องการอัพเดตชั้นปีนิสิตใช่หรือไม่ ข้อควรระวัง : ควรอัพเดตในวันเปิดภาคการศึกษาเพื่อชั้นปีของนิสิตที่ตรงกับปัจจุบัน/หรือการนำเข้าไฟล์แบบ.xlxs!');" >อัพเดตชั้นปีนิสิต</a>
        <button style="font-size: 16px;" class="dropdown-btn"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
  <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
</svg> จัดการบัญชีผู้ใช้
         <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="account_nisit_normal.php" style="font-size: 16px;">นิสิต(ภาคปกติ)</a>
            <a href="account_nisit_special.php" style="font-size: 16px;">นิสิต(ภาคพิเศษ)</a>
            <a href="account_instructor.php" style="font-size: 16px;">อาจารย์ที่ปรึึกษา</a>
            <a href="account_officer.php" style="font-size: 16px;">เจ้าหน้าที่บริหารงานทั่วไป</a>
        </div>
        <a href="../logout.php" style="font-size: 16px;"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>

       </div>
    <title>Account</title>
  </head>
  
  
  <body>
  
  <div id="topicbar"><div  id="topic"> 
  รายการบัญชีผู้ใช้ในระบบอาจารย์ที่ปรึกษา </div></div>
  <div class="container"  >
	<div class="row" style="position: absolute; top:-100px;">

	</div></div>

  <?php
  $q = (isset($_GET['q']) ? $_GET['q'] : '');
  if(($q =='')){
    //query
 $query=mysqli_query($conn,"SELECT COUNT(id) FROM testdb WHERE role = 'instructor' ");
 $row = mysqli_fetch_row($query);

 $rows = $row[0];

 $page_rows = 10;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

 $last = ceil($rows/$page_rows);

 if($last < 1){
   $last = 1;
 }

 $pagenum = 1;

 if(isset($_GET['pn'])){
   $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
 }

 if ($pagenum < 1) {
   $pagenum = 1;
 }
 else if ($pagenum > $last) {
   $pagenum = $last;
 }

 $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

 $nquery=mysqli_query($conn,"SELECT * from  testdb WHERE role = 'instructor' $limit");

 $paginationCtrls = '';

 if($last != 1){

 if ($pagenum > 1) {
$previous = $pagenum - 1;
   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

   for($i = $pagenum-4; $i < $pagenum; $i++){
     if($i > 0){
   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
     }
 }
}

 $paginationCtrls .= ''.$pagenum.' &nbsp; ';

 for($i = $pagenum+1; $i <= $last; $i++){
   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
   if($i >= $pagenum+4){
     break;
   }
 }

if ($pagenum != $last) {
$next = $pagenum + 1;
$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-info">Next</a> ';
}
   }
  ?>
  <div class="container">
      <div class="row"style="position: relative; top:-50px; width:1300px; border-radius:20px;">
        <div class="col-md">
   <table class="table  table-hover table-responsive">
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="1%" style="vertical-align: middle">#</th>
      <th scope="col" width="3%" style="vertical-align: middle">รหัสประจำตัว</th>
      <th scope="col" width="2%" style="text-align: center; vertical-align: middle">อีเมล</th>
      <th scope="col" width="10%"style="vertical-align: middle">ประเภทบัญชี</th>
      <th scope="col" width="6%"style="vertical-align: middle">คำนำหน้าชื่อ</th>
      <th scope="col" width="10%"style="vertical-align: middle">ชื่อ</th>
      <th scope="col" width="9%"style="vertical-align: middle ">นามสกุล</th>
      <th scope="col" width="3%"style="vertical-align: middle; text-align: center; ">สถานะ</th>
      <th scope="col" width="2%"style="vertical-align: middle">แก้ไข</th>
  
  
  </div>

  <div style="text-align: center;">
  
  <?php 
  
             $email=$_SESSION['admin_login']; 
            $query = "SELECT * FROM testdb WHERE role = 'instructor' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $id=$row["id"];
                    $user_email=$row["email"];
                    $password=$row["password"];
                    $role=$row["role"];
                    $title=$row["title"];
                    $name=$row["name"];
                    $lastname=$row["lastname"];
                    $id_no=$row["id_no"];
                    $email_user=$row["email"];
                    $status=$row["status"];   
                            
         
                    
                    ?>
 <?php

while($row = mysqli_fetch_array($nquery)){
?>
    </tr>
  </thead>
    <tbody>
    <tr>
      <th scope="row"><?php echo $row["id"] ?></th>
      <td><?php echo $row["id_no"] ?></td>
      <td style="text-align: center"><?php echo $row["email"]?></td>
   
      <td><?php echo$row["role"]?></td>
      <td><?php echo $row["title"] ?></td>
      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["lastname"] ?></td>
      

    <td> <?php echo $row["status"] ?> </td>

    <td><div style="margin-left:2px;" >
    <?php  echo "<a href='editpage.php?id=".$row["id"]."' ><button class='btn btn-outline-warning'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-file-diff-fill' viewBox='0 0 16 16'>
  <path d='M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8.5 4.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5a.5.5 0 0 1 1 0zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z'/>
</svg></button></a> "; 
     ?>
    </div>
    </td>
   
</tr>
  </tbody> 

  <?php   
                
                
              } } }
         ?>
                
</table><div id="pagination_controls"><?php echo $paginationCtrls; ?></div></div></div></div>
            </div>
          </div>
          <?php
  }
  ?>
          <?php
    require_once('connection.php');
  
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    if($q!=''){
    include('show.php');
    }
    include ('form.php');
    ?>
      
    
   
      <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>  
    
    
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  
  </body>
  
</html>