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


    session_start();

    if (!isset($_SESSION['officer_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');

    $email=$_SESSION['officer_login'];
    $query = "SELECT * FROM testdb WHERE email = '$email' ";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $a1=$row["a1"];
            $a2=$row["a2"];
            $q1=$row["q1"];
            $q2=$row["q2"];
        }}?>

<?php if($q1=='') {?>

<label style="text-align: center;"  class="col-12 control-label">
<br>
คำถามลืมรหัสผ่าน(ใส่ได้ครั้งเดียวเพื่อยืนยันการลืมรหัสผ่าน) :
<br>
<br>
<br>
<form action="add_question.php" method="get" class="form-horizontal">
    <div class="form-group" >
            <div class="col-12" style="margin-left: 0px;;"  >
                <select name="question1" class="form-control" >
                    
                    <option value="" selected="selected">เลือกคำถามข้อที่ 1</option>
                    <option value="1" >คุณเกิดจังหวัดอะไร?</option>
                    <option value="2">สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?</option>
                    <option value="3">คุณเกิดวันอะไร?</option>
                    <option value="4">ชื่อโรงเรียนตอนประถมของคุณ?</option>
                    <option value="5" >ชื่อโรงเรียนตอนมัธยมต้นของคุณ?</option>
                    <option value="6">บ้านเกิดของแม่คุณอยู่จังหวัดอะไร?</option>
                    <option value="7">คุณมีพี่น้องกี่คน?</option>
                </select>
              <input type="text" name="answer1" class="form-control" required placeholder="คำตอบข้อที่1">
              <br>
                <select name="question2" class="form-control" >
                    
                    <option value="" selected="selected">เลือกคำถามข้อที่ 2</option>
                    <option value="1" >คุณเกิดจังหวัดอะไร?</option>
                    <option value="2">สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?</option>
                    <option value="3">คุณเกิดวันอะไร?</option>
                    <option value="4">ชื่อโรงเรียนตอนประถมของคุณ?</option>
                    <option value="5" >ชื่อโรงเรียนตอนมัธยมต้นของคุณ?</option>
                    <option value="6">บ้านเกิดของแม่คุณอยู่จังหวัดอะไร?</option>
                    <option value="7">คุณมีพี่น้องกี่คน?</option>
                </select>
				<input type="text" name="answer2" class="form-control" required placeholder="คำตอบข้อที่2">
            </div>
            <br>
			<button type="submit" class="btn btn-outline-danger">submit</button>
        </div>
		</form>
        
</label> <?php } else{?> <label class="container">
<div class="col-12" style="text-align: center; position:absolute; top:150px; font-size:42px;  ">
   คำถามลืมรหัสบันทึกเรียบร้อยแล้ว
   </div>
</label>  <?php echo $aaaa;}?>
</body> </html>