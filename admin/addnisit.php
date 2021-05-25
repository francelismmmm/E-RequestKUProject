<!DOCTYPE html>
<html>
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\officer\style_table.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <div class="sidenav">
        <a href="admin_home.php">HOME</a>
        <a href="account.php">Back</a>
        <a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>

       </div>
    
  
<title>เพิ่มบัญชีนิสิต</title>
</head>
<body style="background: linear-gradient(to right, #BDFFF3, #c2c5c4);">
<div id="topicbar" ><div  id="topic"> 
  เพิ่มบัญชีผู้ใช้งานแบบนำเข้าไฟล์.xlxs</div></div>
<div style="text-align: center;">
<div class="container"  >

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body style="height: 100vh;">
<link rel="stylesheet" href="style.css">
<form action="../PHPExcelReadToMySQL.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="return confirm('Are you sure you want to submit?')">
  <div style=" background-color:#E0E7E9; width:700px; height:300px; border-radius:20px; ">
<div style="position: absolute; font-size:22px; left:90px; top:20px;" class="alert alert-warning"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</svg> วิธีการนำเข้าบัญชีผู้ใช้จาก Google forms : <a target='_blank' href ="howto.pdf">เปิดคู่มือ</a> </div>
<br>
<a style="position: absolute; top:100px; left:50px; " target='_blank' href ="https://docs.google.com/forms/d/1ubSpLs3r_6E8JQv9KaAFriwG3NMuMyeCA8ZYh737Rsg/edit#responses"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
  <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
</svg> : แบบฟอร์มสำหรับแอดมินเพื่อใช้ในการดูข้อมูลและแก้ไข Google forms</a>
<br>
<br>
<a style="position: absolute; top:200px; left:50px; " target='_blank' href ="https://docs.google.com/forms/d/1ubSpLs3r_6E8JQv9KaAFriwG3NMuMyeCA8ZYh737Rsg/prefill"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor-fill" viewBox="0 0 16 16">
  <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
</svg> : แบบฟอร์มสำหรับให้นิสิตบันทึกข้อมูลลง Google forms</a></div>
<br>
   <div style="position: absolute; top:500px; " ><span style="font-size:26px;"id="headupload" > อัพโหลดไฟล์เพื่อเพิ่มบัญชีผู้ใช้ (.xlxs) : </span> <input class="btn btn-outline-success" id="uploadfiles" type="file" name="attch_file[]" id="attch_file" multiple="multiple"/>   <br>  
   <br> <input class="btn btn-outline-success"id="submit"name="btnSubmit" type="submit" value="Submit" ></div><br>


            
 
</form>


  </div></div>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  
       

</body>

</html>