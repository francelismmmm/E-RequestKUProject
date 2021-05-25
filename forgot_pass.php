

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Request Form </title>
   <link rel="stylesheet" href="styleindex.css">
   <link rel="stylesheet" href="styletest.scss">
   <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Sarabun&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
   <div class="topnav">
  <a class="active" href="index.php">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a class="img"></a>
  <p id="date">
  <?php
include('connection.php');

?>
</p>
  
  


</div>


</head>
<body>



     <h1 class="main" style="position: relative; left:0px; padding-bottom:0px; font-family: 'Kanit', sans-serif;"   >คำถามลืมรหัสผ่าน</h1><br><br>
        
           

        <form action="forgot_pass.php" method="post" class="form-horizontal my-5">
        <div class="loginform" style="position: relative; top:100px; left:10px;">
        <label class ="loginform"for="email" >Email</label>
        <div class="col-sm-12"><br>
            <input  type="text" name="txt_email" class="form-control" required placeholder="Enter email">
            <br>
        </div>
        
 
            

       
            <div class="col-sm-12 mt-3"><br><br>
                <input style="position: relative; top:-80px; left:160px;" type="submit" id="login"name="btn_login" class="btn-success"  value="submit">
            </div>
        </div>
        
        </form>
        <?php
        include('connection.php');
$email = $_POST['txt_email'];
$query = "SELECT * FROM testdb WHERE email = '$email' ";
$result = $conn->query($query);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
         $q1 = $row["q1"];
         $q2 = $row["q2"];
         $a1 = $row["a1"];
         $a2 = $row["a2"];
         $password = $row["password"];
         $check_email =$row["email"];
    }
    
}

?>
<form method="post" action="forgot_pass.php">
<div class="form-group">
<div><label style="color: black;"><?php if($q1=="1"){echo "คำถามที่1 : คุณเกิดจังหวัดอะไร?";}
                        else if($q1=="2"){echo "คำถามที่1 : สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?";}
                        else if($q1=="3"){echo "คำถามที่1 : คุณเกิดวันอะไร?";} 
                        else if($q1=="4"){echo "คำถามที่1 : ชื่อโรงเรียนตอนประถมของคุณ?";}
                        else if($q1=="5"){echo "คำถามที่1 : ชื่อโรงเรียนตอนมัธยมต้นของคุณ?";}
                        else if($q1=="6"){echo "คำถามที่1 : บ้านเกิดของแม่คุณอยู่จังหวัดอะไร?";}
                        else if($q1=="7"){echo "คำถามที่1 : คุณมีพี่น้องกี่คน?";}
                        if($q1!=""){?>
                            <div><input style="width:500px;" type="input" name="answer1" class="form-control" required placeholder="โปรดตอบคำถาม"></div>
                       <?php }
                        ?></label></div>
<div><label style="color: black;"> <?php if($q2=="1"){echo "คำถามที่2 : คุณเกิดจังหวัดอะไร?";}
                        else if($q2=="2"){echo "คำถามที่2 : สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?";}
                        else if($q2=="3"){echo "คำถามที่2 : คุณเกิดวันอะไร?";} 
                        else if($q2=="4"){echo "คำถามที่2 : ชื่อโรงเรียนตอนประถมของคุณ?";}
                        else if($q2=="5"){echo "คำถามที่2 : ชื่อโรงเรียนตอนมัธยมต้นของคุณ?";}
                        else if($q2=="6"){echo "คำถามที่2 : บ้านเกิดของแม่คุณอยู่จังหวัดอะไร?";}
                        else if($q2=="7"){echo "คำถามที่2 : คุณมีพี่น้องกี่คน?";}
                        if($q2!=""){?>
                            <div><input style="width:500px;" type="input" name="answer2" class="form-control" required  placeholder="โปรดตอบคำถาม">
                            <input type="hidden" name="email" value="<?=$email;?>">
                            <button type="submit" class="btn btn-outline-danger">ส่งคำตอบ</button></div>
                       <?php }else if($email!=""&&$q1=="" )  {?><div class="alert alert-danger"><?php echo"อีเมลของคุณไม่ถูกต้องหรือยังไม่มีคำถามของคุณอยู่ในระบบโปรดลองอีกครั้ง";
                         }?><div></div></label> </div>
                       
                        
                        </div></form>

                        <?php
                      $email = $_POST['email'];
                       $query = "SELECT * FROM testdb WHERE email = '$email' ";
                       $result = $conn->query($query);
                       if($result->num_rows > 0){
                           while($row = $result->fetch_assoc()){
                                $q1 = $row["q1"];
                                $q2 = $row["q2"];
                                $a1 = $row["a1"];
                                $a2 = $row["a2"];
                                $password = $row["password"];
                                $user_email = $row["email"];
                           }
                        }
                      
                      $ans1 = $_POST["answer1"];
                      $ans2 = $_POST["answer2"];?>
                      <?php if($q1 != "") : ?>
                      <div class="alert alert-danger" style="position: relative; z-index:2; top:-30px; ">
                       <?php if ($ans1 ==""&&$ans2==""&&$q1!=""&&$q2!=""){echo"กรุณาตอบคำถาม";}
                        else if($ans1 == $a1 && $ans2 == $a2 && $q1!="" && $q2!="" && $a2!="" && $a1!="" ){echo "Your password : ". $password;}
                        else if($ans1 != $a1 || $ans2 != $a2   ){echo"คำตอบไม่ถูกต้องโปรดลองใหม่อีกครั้ง";}
                        ?></div>      <?php endif ?>
        
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>


