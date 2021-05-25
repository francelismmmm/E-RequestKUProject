<?php 
    session_start();

    if (!isset($_SESSION['officer_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nisit Page</title>
    <link rel="stylesheet" href="style_officer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">   
   
   </head>
 <body>
 <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <h3>
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>
                <p id="hello" class="textlogin" style="text-align: center;"> <?php if(isset($_SESSION['officer_login'])) { ?>
                Welcome, <?php echo $_SESSION['officer_login'];
                 
                               
                               }?></p> 

            <h1 class="student" >General Administrative Officer Page <img id="KU" src='https://upload.wikimedia.org/wikipedia/commons/9/97/KU_Logo.png'></h1>

           <div id="date"> 
           
           <?php $original_date = date("d");
$original_wday = date("l");
$original_month = date("F");
$original_year = date("Y");



$TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$TH_Month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

$nDay = date("w");
$nMonth = date("n")-1;
$date = date("j");
$year = date("Y")+543;

?></div>
        <div id="profilebackground">   
        <h3>
        <div id="profiledata">
            <?php 
            $email=$_SESSION['officer_login'];
            $query = "SELECT * FROM testdb WHERE email = '$email' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<br/>".$row["title"]." ".$row["name"]."&nbsp".$row["lastname"];
                    echo "<br/><br/>Role : เจ้าหน้าที่บริหารงานทั่วไป";
                    echo "<br/><br/>ID : ".$row["id_no"];
                   
                    echo "<br/><br/>Major : ".$row["major"];
                   $officer_department = $row["department"];
                }
                
            }
            ?> </div></div> 
           
           

        </h3>


        <?php
        $noti = mysqli_query($conn,"SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.status_form = 'Approve' AND testdb.department = '$officer_department'")  or die(mysqli_error($conn));
        $rec = mysqli_num_rows($noti);
        ?>




        <div class="sidenav">
        <p id="date"href="#"> <?php echo(" $original_wday    $original_date    $original_month    $original_year");?></p>
        <a href="officer_home.php">HOME</a>
        <a href="table_approved.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z"/>
</svg> รายการคำร้อง <span class="badge badge-warning"><?php if($rec!=''){echo $rec;}else{echo "ไม่มีคำร้อง";}?></span></a>
        <a href="table_successfully.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-clock-history" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
  <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
  <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
</svg> ประวัติคำร้องย้อนหลัง</a>
<a href="inputtoken.php">แจ้งเตือนผ่าน Line notify</a>
<div class="col" style="word-wrap: break-word; width:50px" id="data">
  
  <?php  {echo "<a onclick = showPopup(this.href='../officer/question_pass.php?');return(false);><button class='btn btn-outline-danger'>คำถาม</button></a>";}?>

<script type="text/javascript">
function showPopup(url) {
newwindow=window.open(url,'name','height=400,width=520,top=200,left=300,resizable');
if (window.focus) {newwindow.focus()}
}
</script></div>
<a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>
            </div>
       
            
        
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
    
    
 </body>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>