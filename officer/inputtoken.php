<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\student\styletable.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>
<body >
<?php 
    session_start();

    if (!isset($_SESSION['officer_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
?>

<div id="topicbar"> <div  id="topic">รับการแจ้งเตือนผ่าน Line Notify</div></div>
<a style="position: absolute; top:0; height:50px; font-size:20px" target="blank" href="https://notify-bot.line.me/th/" class="btn btn-success">Line Notify <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg></a>
<div class="container">
<label class="col-10" style="text-align: center; font-size:30px;">กรอกรหัส Line Notify token เพื่อรับการแจ้งเตือนจาก Line Notify</label>
<div class="col-7" style="position: absolute;">
<form method="post" action="savetoken.php"><br><br>
<input type="text" name="txt_token"class="form-control" required placeholder = " โปรดใส่ LINE notify Token "  >

<br>
<input type="submit" class='btn btn-outline-primary' onclick="return confirm('ต้องการอัพเดต Line notify token ?');" ></form>
<div style="position: absolute; left:120px; top:110px;"><a href="officer_home.php" ><button  class='btn btn-outline-dark'> back</button></a></div></div>

</div>
</body> </html>