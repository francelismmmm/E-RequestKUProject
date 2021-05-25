<?php 

    session_start();

    if (isset($_SESSION['admin_login'])) {
        header("location: admin/admin_home.php");
    }

    if (isset($_SESSION['employee_login'])) {
        header("location: employee/employee_home.php");
    }

    if (isset($_SESSION['user_login'])) {
        header("location: user/user_home.php");
    }

    if (isset($_SESSION['student_login'])) {
        header("location: student/student_home.php");
    }

    if (isset($_SESSION['instructor_login'])) {
        header("location: student/instructor_home.php");
    }

?>

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
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

   <div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a class="img"></a>
  <p id="date">
  <?php

$original_date = date("d");
$original_wday = date("l");
$original_month = date("F");
$original_year = date("Y");

echo("$original_wday    $original_date    $original_month    $original_year");
?>
</p>
  
  


</div>


</head>
<body>


<br><br>
        
           
        <?php if(isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <h3  style="position: relative; z-index:2;">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <?php if(isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger" style="position: relative; z-index:2; top:-30px; ">
                <h3 >
                    <?php  
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <form action="login_db.php" method="post" class="form-horizontal my-5">
        <div class="container">
            <div class="background" >
            <img class="KU" src="..\Multi-User-Role-Login-master\img\pic.jpg" style="z-index:2; left:-73px; bottom:74px; width:602px ; height: 458px; transform:rotate(90deg); border-radius: 0px 0px 30px 30px;">
                <div class="col-5" style="background-color: #354649;  position:absolute; z-index:1;  top:-0px; width:700px; height:600px; border-radius: 100px 0px 0px 30px;">
                
                </div>
                <img class="KU" src="..\Multi-User-Role-Login-master\img\KUlogo.png" style="position: absolute; left:575px; top:10px; width:100px; height:100px;">
                <h1 class="main" style="font-size: 40px ; "  > E-Form </h1>
        <label class ="loginform"for="email" style="position:relative;  left:600px; margin-top:120px;">Email</label>
        <div  class="col-sm-12"><br>
            <input  style="position:absolute; width:300px; left:600px;"type="text" name="txt_email" class="form-control" required placeholder="Enter email">
            <br>
        </div>
        
        <label class ="loginform" for="password"  style="position:relative;  left:600px; margin-top:40px;">Password</label>
        <div class="col-sm-12"><br>
            <input type="password" name="txt_password"  style="position:absolute; width:300px; left:600px;" class="form-control" required placeholder="Enter password">
            <a style="position:absolute; left:740px; bottom:-50px;" href="forgot_pass.php">Forgot password?</a><br>
        </div>    

       
            <label class="loginform" style="position:relative;  left:600px; margin-top:10px;"><br>Select Type</label><br>
            <div class="col-sm-12 "  >
               <br> <select name="txt_role" style="position:relative; width:200px; left:600px;" >
                    <option >- Select Role - </option>
                    <option value="admin">Admin</option>
                    <option value="officer">Officer</option>
                    <option value="instructor">Instructor</option>
                    <option value="student">Student</option>
                    
                    
                </select>
            </div>
            

       
            <div class="col-sm-12 mt-3"><br><br>
                <input type="submit" id="login"name="btn_login" class="btn-success"  value="Log in">
            </div>
        </div>
        </div>
         

        


        </form>
        
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>

