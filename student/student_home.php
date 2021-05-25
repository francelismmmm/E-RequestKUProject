<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
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
    <link rel="stylesheet" href="stylestudent.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">   
</head>
 <body>
     <div id="alert">
 <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <h3>
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?></div>
            <p id="hello" class="textlogin" style="text-align: center;"> <?php if(isset($_SESSION['student_login'])) { ?>
                Welcome, <?php echo $_SESSION['student_login'];
                 
                               
                             }?>  </p> 
         <h1 class="student" >Nisit Page <img id="KU" src='https://upload.wikimedia.org/wikipedia/commons/9/97/KU_Logo.png'></h1>

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

;?></div>
            
        <h3>
              
            <div id="profilebackground"><div id="profile"><br>ข้อมูลผู้ใช้ <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
  <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
</svg></div>
            <div id="profiledata">
            <?php 
              
             $email=$_SESSION['student_login'];
            $query = "SELECT title,name,lastname,role,id_no,years,major,advisor_id FROM testdb WHERE email = '$email' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    
                    echo "<br/>".$row["title"]." ".$row["name"]."&nbsp".$row["lastname"];
                    echo "<br/><br/>ประเภทผู้ใช้ : นิสิต";
                    echo "<br/><br/>รหัสนิสิต : ".$row["id_no"];
                    echo "<br/><br/>รหัสอาจารย์ที่ปรึกษา : ".$row["advisor_id"];
                    echo "<br/><br/>สาขาวิชา : ".$row["major"];
                   // echo "<br/><br/>ภาค : ";
                    echo "<br/><br/>ปี : ".$row["years"];
                }
                
            }
            ?> </div> </div>
           
           

        </h3>
        <div class="sidenav">
        <p id="date"href="#"> <?php echo(" $original_wday    $original_date    $original_month    $original_year");?></p>
        <a href="student_home.php">HOME</a>
        <a href="status_table.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z"/>
</svg> รายการคำร้อง</a>
        <button class="dropdown-btn"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-file-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z"/>
  <path fill-rule="evenodd" d="M4.5 10.5A.5.5 0 0 1 5 10h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
</svg> สร้างคำร้อง
         <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="..\Eformpdf\inputform.php">คำร้องทั่วไป</a>
            <a href="../Eformpdf/inputformregis.php">คำร้องขอลงทะเบียนเรียน</a>
            <a href="..\Eformpdf\forleave1.php">คำร้องขอลาป่วย/ลากิจ</a>
        </div>
        <a href="inputtoken.php" ><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg> แจ้งเตือนผ่าน Line notify</a>
        <div class="col" style="word-wrap: break-word; width:50px" id="data">
  
  <?php  {echo "<a onclick = showPopup(this.href='../student/question_pass.php?');return(false);><button class='btn btn-outline-danger'>คำถาม</button></a>";}?>

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