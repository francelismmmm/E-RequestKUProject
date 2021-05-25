<!DOCTYPE html>
<html lang="en">
<html>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<title>Normal Form Input</title>
</head>

<body>
<link rel="stylesheet" href="style.css">
<?php include('..\connection.php');
$pdf_id = 'aa';
$pdf_id = $_REQUEST['pdf_id'];
$pdf_name = $_REQUEST['pdf_name'];?>
<form action="normalform.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('คุณแน่ใจโปรดยืนยันใช่หรือไม่?')">
<?php

$result= mysqli_query($conn,"SELECT * FROM tb_pdf WHERE pdf_id = '$pdf_id' ") or die(mysqli_error($conn));
if($result->num_rows > 0){ 	
 while($row = $result->fetch_assoc())	
	{ 
    $pdf_file = $row["pdf_file"];
     }
	}

   $queryyi= mysqli_query($conn,"SELECT path_link,attch_file FROM tb_attch WHERE from_pdf = '$pdf_name'") or die(mysqli_error($conn));
   while($info1=mysqli_fetch_array($queryyi))	
   if($info1['attch_file']<>9999){ 
     $attch_name=$info1['attch_file'];
     $path_link=$info1['path_link'];
     }else{
       $attch_name='nonameeiei';
   }
$id_pdf= mysqli_query($conn,"SELECT draftA,draftB,draftC,draftD,draftE,draftF,draftG,draftH,draftI,draftJ,draftK FROM tb_pdf WHERE pdf_id = $pdf_id") or die(mysqli_error($conn));
while($info=mysqli_fetch_array($id_pdf))	
if($info['pdf_id']>=0){ 
    $draftA=$info['draftA'];
    $draftB=$info['draftB'];
    $draftC=$info['draftC'];
    $draftD=$info['draftD'];
    $draftE=$info['draftE'];
    $draftF=$info['draftF'];
    $draftG=$info['draftG'];
    $draftH=$info['draftH'];
    $draftI=$info['draftI'];
    $draftJ=$info['draftJ'];
    $draftK=$info['draftK'];
}
?>
  <h1>คำร้องทั่วไป</h1> 
  <div id="headinput">กรุณากรอกข้อมูลเพื่อสร้างแบบฟอร์ม&nbsp&nbsp&nbsp<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></div>
  <div id="formbackground">
  <h4> หัวเรื่อง : <input type="text" id="box1" name="head" class="form-control" value="<?=$draftA;?>"></h4>
 
  <h4>เลขที่บ้าน :<input type="text" id="box3" name="bannum" class="form-control" value="<?=$draftC;?>"></h4>
  <h4>หมู่ :<input type="text" id="box4" name="moo" class="form-control" value="<?=$draftD;?>"></h4>
  <h4>ถนน :<input type="text"id="box5" name="street" class="form-control" value="<?=$draftE;?>"></h4>
  <h4>ตำบล :<input type="text" id="box6"name="tumbol" class="form-control" value="<?=$draftF;?>"></h4>
  <h4>อำเภอ :<input type="text" id="box7"name="aumper" class="form-control" value="<?=$draftG;?>"></h4>
  <h4>จังหวัด :<input type="text" id="box8" name="province" class="form-control" value="<?=$draftH;?>"></h4>
  <h4>รหัสไปรษณีย์ :<input type="text" id="box9" name="postcode" class="form-control" value="<?=$draftI;?>"></h4>
  <h4>เบอร์โทร :<input type="text" onKeyUp="if(this.value*1!=this.value) this.value='' ;" class="form-control" maxlength="10" name="phone" value="<?=$draftJ;?>"></h4>
  <h4>เนื่องจาก :<textarea type="text" id="box11" name="story" rows="4" cols="69" maxlength="336" class="form-control"> <?=$draftK;?></textarea></h4>
  <span id="headupload"> อัพโหลดไฟล์แนบ (.pdf) : </span> <input class="btn btn-outline-success" id="uploadfiles" type="file" name="attch_file[]" id="attch_file" multiple="multiple"/>   <br>  
  <div style="margin-left: 50px;">
    <?php   echo "<a  target ='_blank'  href='../student/attch.php?pdf_name=".$pdf_file."'>ไฟล์แนบเดิม</a>"; ?>
    </div>
  <input name="check" id="check" type="hidden" value='k' >
  <input name="pdf_name" id="pdf_name" type="hidden" value="<?=$pdf_name;?>" >
  <input name="pdf_draftid" id="pdf_draftid" type="hidden" value="<?=$pdf_id;?>" >
  <input name="attch_name" id="attch_name" type="hidden" value="<?=$attch_name;?>" >
  <input name="btnSubmit" id="submit" type="submit" value="Submit" class="btn btn-outline-success">
  <input name="btnSave" id="save" type="submit" value="Save" class="btn btn-outline-success">
  <input name="btnReset"  id="clear"type="reset" value="Cancle"class= "btn btn-outline-secondary">
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