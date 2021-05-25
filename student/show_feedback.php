<!doctype html>
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
include("../connection.php");
$feedback = $_REQUEST["feedback"];?>



<label style="text-align: center;"  class="col-sm-4 control-label">
<br>
แจ้งรายละเอียดของการปฏิเสธคำร้อง :
<br>
<br>
<br>
<?php
echo "$feedback";
?>
</label>
      
</body> </html>