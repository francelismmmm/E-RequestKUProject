<!DOCTYPE html>
<html>
<head>
<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');?>

<title>Form InputTest</title>
</head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body style="height: 180vh;">
<link rel="stylesheet" href="style.css">
<form action="regissect.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('Are you sure you want to submit?')">

<?php $email=$_SESSION['student_login'];
	$query = "SELECT * FROM testdb WHERE email = '$email' ";
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
	
		$bannum=$row["bannum"];
    $moo=$row["moo"];
    $roadname=$row["roadname"];
    $tumbon=$row["tumbon"];
    $aumper=$row["aumper"];
    $city=$row["city"];
    $postcode=$row["postcode"];
    $phonenum=$row["phonenum"];
    }} ?>


<h1>คำร้องขอลงทะเบียนเรียน</h1>
<div id="headinput">กรุณากรอกข้อมูลเพื่อสร้างแบบฟอร์ม&nbsp&nbsp&nbsp<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></div>
 
   <div id="formbackground" style="height: 1120px;" >
  
  
  <h4>เบอร์โทร :<input type="text" value="<?=$phonenum?>" maxlength="10" class="form-control" onKeyUp="if(this.value*1!=this.value) this.value='' ;"  name="phone"required placeholder=""></h4>
  <h4>เนื่องจาก :<textarea type="text" name="story" rows="4" cols="69" class="form-control" maxlength="140"required placeholder></textarea></h4>
 
  
  <br> 
  <div id="formradio" >
  <h2 style="font-size: 18px;color:red;">**โปรดเลือกหัวข้อความประสงค์ของคำร้อง**</h2>
  <input type="radio" name="select" id="myCheck1" value="1" onclick="myFunction()"> ลงทะเบียนเรียนล่าช้าหรือรักษาสถานภาพนิสิตล่าช้า 

       <p id="text1" style="display:none; color:red;">(**กรุณาแนบ KU 1)</p>
   
       <br><input type="radio" name="select"id="myCheck2" value="2" onclick="myFunction()"> เพิ่มหรือถอนรายวิชาล่าช้า 

       <br><p id="text2" style="display:none; color:red;">(**กรุณาแนบ KU 3)</p>
       
       <input type="radio" name="select"id="myCheck3" value="3" onclick="myFunction()">
       ลงทะเบียนเกิน 22 หน่วยกิตสำหรับภาคต้นหรือภาคปลาย หรือลงทะเบียนเกิน 7 หน่วยกิตสำหรับภาคเรียนฤดูร้อน 
       <p id="text3" style="display:none; color:red;">(**กรุณาแนบ KU3)<br>
       <input  style="width: 40%;text-align: center;font-size:14px;" type="text" name="check3semester" placeholder="โปรดกรอกภาคการศึกษา"><br>
       <input  style="width: 40%;text-align: center;font-size:14px;"type="text" name="check3academicyear" placeholder="โปรดกรอกปีการศึกษา"><br>
       <input  style="width: 40%;text-align: center;font-size:14px;"type="text" name="check3fromcredit" placeholder="หน่วยกิตที่ต้องการเปลี่ยนจาก"><br>
       <input  style="width: 40%;text-align: center;font-size:14px;"type="text" name="check3tocredit" placeholder="หน่วยกิตที่ต้องการเปลี่ยนเป็น"><br>
     
      </p>

      <br><input type="radio" name="select"id="myCheck4" value="4" onclick="myFunction()"> ลงทะเบียนต่ำกว่า 9 หน่วยกิต
       <br><p id="text4" style="display:none"></p>
      
       <input type="radio" name="select"id="myCheck5" value="5"onclick="myFunction()"> ผ่อนผันค่าธรรมเนียมการศึกษา
       <br><p id="text5" style="display:none">
       <input type="text" style="width: 40%;text-align: center;font-size:14px;" placeholder="โปรดกรอกภาคการศึกษา" name="check5semester"><br>
       <input type="text" style="width: 40%;text-align: center;font-size:14px;" placeholder="โปรดกรอกปีการศึกษา" name="check5academicyear"><br></p>
       
       <input type="radio" name="select"id="myCheck6" value="6"onclick="myFunction()"> ย้ายคณะ หรือเปลี่ยนสาขาวิชาเอก
      <br><p id="text6" style="display:none">
      <input type="text" style="width: 50%;text-align: center;font-size:14px;" placeholder="โปรดกรอกคณะหรือสาขาวิชาเอกเดิม"name="check6formmajor"><br>
       <input type="text"style="width: 50%;text-align: center;font-size:14px;" placeholder="โปรดกรอกคณะหรือสาขาวิชาเอกที่เปลี่ยน"name="check6tomajor"><br></p></p>
       </div>
   <span id="headupload"> อัพโหลดไฟล์แนบ (.pdf) : </span> <input class="btn btn-outline-success" id="uploadfiles" type="file" name="attch_file[]" id="attch_file" multiple="multiple"/>   <br>  

<input class="btn btn-outline-success" id="submit"name="btnSubmit" type="submit" value="Submit">
<input name="btnSave" id="save" type="submit" value="Save" class="btn btn-outline-success">
<input class="btn btn-outline-secondary" id="clear"name="btnReset" type="reset" value="Clear ">
      
      </div>
       
    
   

  </div>
  
       
 
</form>


  <h3>

  
  <div class="sidenav">
        <a href="../student/student_home.php">HOME</a>
        <a href="..\student\status_table.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z"/>
</svg> รายการคำร้อง</a>
       
        <a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>
       
        <div class="dropdown-container">
            <a href="..\Eformpdf\inputform.php">Petition Normal Form</a>
            <a href="../Eformpdf/inputformregis.php">Petition for Registration</a>
            <a href="#">..</a>
        </div></h3>
        
  <script >     function myFunction() {
  // Get the checkbox
  var checkBox1 = document.getElementById("myCheck1");
  var checkBox2 = document.getElementById("myCheck2");
  var checkBox3 = document.getElementById("myCheck3");
  var checkBox4 = document.getElementById("myCheck4");
  var checkBox5 = document.getElementById("myCheck5");
  var checkBox6 = document.getElementById("myCheck6");
  // Get the output text
  var text = document.getElementById("text1");
  var text = document.getElementById("text2");
  var text = document.getElementById("text3");
  var text = document.getElementById("text4");
  var text = document.getElementById("text5");
  var text = document.getElementById("text6");
  // If the checkbox is checked, display the output text
  if (checkBox1.checked == true){
    text1.style.display = "block";
  } else {
    text1.style.display = "none";
  }
  if (checkBox2.checked == true){
    text2.style.display = "block";
  } else {
    text2.style.display = "none";
  } if (checkBox3.checked == true){
    text3.style.display = "block";
  } else {
    text3.style.display = "none";
  } if (checkBox4.checked == true){
    text4.style.display = "block";
  } else {
    text4.style.display = "none";
  } if (checkBox5.checked == true){
    text5.style.display = "block";
  } else {
    text5.style.display = "none";
  } if (checkBox6.checked == true){
    text6.style.display = "block";
  } else {
    text6.style.display = "none";
  } 
  
  
 
}</script>



</form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>