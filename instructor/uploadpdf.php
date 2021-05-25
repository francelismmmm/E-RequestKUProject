<!DOCTYPE html>
<html>
<head>
<?php 
$pdf_name = $_REQUEST['pdf_name'];
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
       
    }
    include('..\connection.php');
?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\officer\style_table.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <div class="sidenav">
        <a href="instructor_home.php">HOME</a>
        <a href="status_table.php">Back</a>
        <a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>

       </div>
    
  
<title>อัพโหลดไฟล์ PDF</title>
</head>
<body>
<div style="text-align: center;">
<div class="container"  >

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body style="height: 180vh;">
<link rel="stylesheet" href="style.css">
<?php $query = "SELECT * FROM tb_pdf WHERE pdf_file = '$pdf_name'";
     $result = $conn->query($query);
     if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$pathlink = $row["path_link"];
		$type_form = $row["type_form"];
	  $nisit_id = $row["nisit_id"];
		$advisor_id = $row["advisor_id"];
		$pdf_id = $row["pdf_id"];}
    
	}?>

<div class="col-10" style="position:relative; left:-100px; text-align:left" >
    <label>เปิดเอกสารเพื่อทำการเซ็นด้วยลายมือของผู้ใช้  </label>
    <?php echo "<a target='_blank' href='../Eformpdf/" . $pathlink . "'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?> <br> <label>จากนั้นทำการอัพโหลดเอกสารที่ทำการเซ็นอนุมัติแล้วเข้าระบบตรงด้านล่างนี้เป็นนามสกุลไฟล์ pdf</label>
    </div><br>
<form action="save_pdf.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('Are you sure you want to submit?')">
  
   <span id="headupload"> อัพโหลดไฟล์เอกสารที่ผ่านการเซ็นอนุมัติแล้ว (.pdf) : </span> <input class="btn btn-outline-success" id="uploadfiles" type="file" name="attch_file[]" id="attch_file" multiple="multiple"/>   <br>  
   <input name="pdf_name" id="pdf_name" type="hidden" value="<?=$pdf_name;?>" >
 <br>
<input class="btn btn-outline-success" id="submit"name="btnSubmit" type="submit" value="Submit" >

            
 
</form>


  </div></div>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  
       

</body>

</html>