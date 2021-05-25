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
$pdf_file = $_REQUEST["pdf_name"];?>



<form method="post" action="reject.php">
<label style="text-align: center;"  class="col-sm-4 control-label">แจ้งรายละเอียดของการปฏิเสธคำร้อง<a style="color: red;"></a></label>
        <div class="col-sm-5" >
            <input style="height: 100px;"  type="text" name="feedback" class="form-control" required placeholder="โปรดแจ้งรายละเอียด">
            <input type="hidden" name="pdfname" class="form-control" value="<?=$pdf_file?>">
        </div>  
        <div style="position: absolute; left:280px; top: 160px;">
        <button type="button" class="btn btn-secondary" onclick="window.close();" >Cancle</button>
        <button type="submit" class="btn btn-primary" onclick="return confirm('คุณต้องการแจ้งปฏิเสธคำร้องนี้ใช่หรือไม่?');">Send message</button>
        </div></form>
</body> </html>