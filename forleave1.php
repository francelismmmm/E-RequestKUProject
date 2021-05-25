<!DOCTYPE html>
<html lang="en">
<html>
<head>
<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');?>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<title>ใบลา</title>
</head>

<body style="height: 200vh;" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="style.css">
<form action="forleaveform.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('Are you sure you want to submit?')">

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
  <h1>คำร้องขอลาป่วย/ลากิจ</h1> 
  <div id="headinput" style="position: relative; z-index:1;">กรุณากรอกข้อมูลเพื่อสร้างแบบฟอร์ม&nbsp&nbsp&nbsp<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></div>
  <div id="formbackground" style="width: 800px;height:1490px; position:relative; right:100px;" >
  <div id="radio">
  <h4>ขออนุญาติ :
  <input type="radio" name="select" id="myCheck1" value="sick" onclick="myFunction()"> ลาป่วย 
  <input type="radio"name="select" id="myCheck2" value="business" onclick="myFunction()"> ลากิจ </h4>
  </h4>
 
  <h4>เลขที่บ้าน :<input type="text" value="<?=$bannum?>" id="box3" name="bannum" class="form-control" required placeholder=""></h4>
  <h4>หมู่ :<input type="text" value="<?=$moo?>" id="box4" name="moo" class="form-control" required placeholder=""></h4>
  <h4>ถนน :<input type="text" value="<?=$roadname?>"id="box5" name="street" class="form-control"></h4>
  <h4>ตำบล :<input type="text" value="<?=$tumbon?>" id="box6"name="tumbol" class="form-control" required placeholder=""></h4>
  <h4>อำเภอ :<input type="text" value="<?=$aumper?>"id="box7"name="aumper" class="form-control" required placeholder=""></h4>
  <h4>จังหวัด :<input type="text" value="<?=$city?>"id="box8" name="province" class="form-control" required placeholder=""></h4>
  <h4>รหัสไปรษณีย์ :<input type="text" value="<?=$postcode?>" id="box9" onKeyUp="if(this.value*1!=this.value) this.value='' ;" name="postcode" class="form-control" required placeholder=""></h4>
  <h4>เบอร์โทร :<input type="text" value="<?=$phonenum?>"onKeyUp="if(this.value*1!=this.value) this.value='' ;" class="form-control" maxlength="10" name="phone" required placeholder=""></h4>
 <div style="position: relative; left:160px; " >
  วันที่ต้องการลาตั้งแต่วันที่ : <input type="date" name="startdate">
                   ถึง : <input type="date" name="enddate">
                   <br> เป็นจำนวนวัน (ไม่นับวันหยุดข้าราชการและวันหยุดนักขัตฤกษ์) : <input type="text" name="countday" placeholder="จำนวนวันที่ลา"></div>
  <h4>เนื่องจาก :<textarea type="text" id="box11" name="story" rows="4" cols="69" maxlength="336" class="form-control" required placeholder=""></textarea></h4>
  <h4>รายวิชาที่ขอหยุดเรียน : <label style="color: red;">*จำเป็นต้องกรอกอย่างน้อย1วิชา</label>
  <div id="inputsub" style="position: relative; right:100px; ">
  <input type="text" id="idsub1" name="idsub1" class="form-control" required placeholder="รหัสวิชาที่1" style="width: 100px;display: inline;">
  <input type="text" id="namesub1" name="namesub1" class="form-control" required placeholder="   ชื่อวิชาที่1" style="width: 150px; display: inline;">
  <input type="text" id="secsub1" name="secsub1" class="form-control" required placeholder="หมู่เรียนวิชาที่1" style="width: 130px; display: inline;">
  <input type="text" id="teachersub1" name="teachersub1" class="form-control" required placeholder="ชื่ออาจารย์ผู้สอนวิชาที่1" style="width: 190px; display: inline;">

  <input type="text" id="idsub2" name="idsub2" class="form-control" placeholder="รหัสวิชาที่2" style="width: 100px;display: inline;">
  <input type="text" id="namesub2" name="namesub2" class="form-control"  placeholder="   ชื่อวิชาที่2" style="width: 150px; display: inline;">
  <input type="text" id="secsub2" name="secsub2" class="form-control" placeholder="หมู่เรียนวิชาที่2" style="width: 130px; display: inline;">
  <input type="text" id="teachersub2" name="teachersub2" class="form-control"  placeholder="ชื่ออาจารย์ผู้สอนวิชาที่2" style="width: 190px; display: inline;">

  <input type="text" id="idsub3" name="idsub3" class="form-control"  placeholder="รหัสวิชาที่3" style="width: 100px;display: inline;">
  <input type="text" id="namesub3" name="namesub3" class="form-control"  placeholder="   ชื่อวิชาที่3" style="width: 150px; display: inline;">
  <input type="text" id="secsub3" name="secsub3" class="form-control"  placeholder="หมู่เรียนวิชาที่3" style="width: 130px; display: inline;">
  <input type="text" id="teachersub3" name="teachersub3" class="form-control"  placeholder="ชื่ออาจารย์ผู้สอนวิชาที่3" style="width: 190px; display: inline;">

  <input type="text" id="idsub4" name="idsub4" class="form-control"  placeholder="รหัสวิชาที่4" style="width: 100px;display: inline;">
  <input type="text" id="namesub4" name="namesub4" class="form-control" placeholder="   ชื่อวิชาที่4" style="width: 150px; display: inline;">
  <input type="text" id="secsub4" name="secsub4" class="form-control" placeholder="หมู่เรียนวิชาที่4" style="width: 130px; display: inline;">
  <input type="text" id="teachersub4" name="teachersub4" class="form-control" placeholder="ชื่ออาจารย์ผู้สอนวิชาที่4" style="width: 190px; display: inline;">

  <input type="text" id="idsub5" name="idsub5" class="form-control" placeholder="รหัสวิชาที่5" style="width: 100px;display: inline;">
  <input type="text" id="namesub5" name="namesub5" class="form-control"  placeholder="   ชื่อวิชาที่5" style="width: 150px; display: inline;">
  <input type="text" id="secsub5" name="secsub5" class="form-control"  placeholder="หมู่เรียนวิชาที่5" style="width: 130px; display: inline;">
  <input type="text" id="teachersub5" name="teachersub5" class="form-control" placeholder="ชื่ออาจารย์ผู้สอนวิชาที่5" style="width: 190px; display: inline;">

  
  </div>
  </h4>
  <span style="margin-left: 60px;" id="headupload"> อัพโหลดไฟล์แนบ (.pdf) : </span> <input class="btn btn-outline-success" id="uploadfiles" type="file" name="attch_file[]" id="attch_file" multiple="multiple"/>   <br>  

  <input name="btnSubmit" id="submit" type="submit" value="Submit" class="btn btn-outline-success" href="C:\xampp\htdocs\Multi-User-Role-Login-master\Eformpdf\forleave2.php">
  <input name="btnSave" id="save" type="submit" value="Save" class="btn btn-outline-success" href="C:\xampp\htdocs\Multi-User-Role-Login-master\Eformpdf\forleave2.php">
  <input name="btnReset"  id="clear"type="reset" value="Clear"class= "btn btn-outline-secondary">
  </div>
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
            <a href="..\Eformpdf\inputform.php">Request Normal Form</a>
            <a href="../Eformpdf/inputformregis.php">Request for Registration</a>
            <a href="#">..</a>
        </div></h3>

</form>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>