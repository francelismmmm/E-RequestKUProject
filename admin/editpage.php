<?php
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่า member_id จากไฟล์แสดงข้อมูล
$id = $_REQUEST["id"]; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<?php 
  
            $email=$_SESSION['admin_login']; 
            $query = "SELECT * FROM testdb WHERE id = '$id' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $user_email=$row["email"];
                    $password=$row["password"];
                    $role=$row["role"];
                    $status=$row["status"];
                    $title=$row["title"];
                    $name=$row["name"];
                    $lastname=$row["lastname"];
                    $id_no=$row["id_no"];
                    $years=$row["years"];
                    $major=$row["major"];
                    $advisor_id=$row["advisor_id"];
                    $department = $row["department"];
                    $phoneNo = $row["phonenum"];
                    $bannum = $row["bannum"];
                    $moo = $row["moo"];
                    $roadname = $row["roadname"];
                    $tumbon = $row["tumbon"];
                    $aumper = $row["aumper"];
                    $city = $row["city"];
                    $postcode = $row["postcode"];
                
                }}
                   
              
                    

                     
                            
                            
         
                    
                    ?>

    <div class="container">
        <h1 class="mt-3">แก้ไขบัญชีที่ #<?php echo $id?></h1>
        <hr>
    
        <form action="edit.php" method="post" class="form-horizontal my-5">
        <input type="hidden" name="id" class="form-control" value="<?=$id;?>">
        
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">อีเมล</label>
            <div class="col-sm-5">
                <input type="text" name="txt_email" class="form-control" value="<?=$user_email;?>" required placeholder="โปรดกรอกอีเมล">
            </div>
      
        
      
        <div class="col-sm-12">
            <input type="hidden" name="txt_password" class="form-control" value="<?=$password;?>" >
        </div>

        <label for="title" class="col-sm-3 control-label">คำนำหน้าชื่อ</label>
        <div class="col-sm-3">
          
          <select name="txt_title" class="form-control">
              <option value="<?=$title;?>" selected="selected">-<?php echo $title;?> -</option>
              <option value="นาย">นาย</option>
              <option value="นางสาว">นางสาว</option>
              <option value="นาง">นาง</option>
            
          </select>
  
  </div>    

        <label for="name" class="col-sm-3 control-label">ชื่อ</label>
        <div class="col-sm-5">
            <input type="text" name="txt_name" class="form-control" value="<?=$name;?>" required placeholder="โปรดกรอกชื่อ">
        </div>  

        <label for="lastname" class="col-sm-3 control-label">นามสกุล</label>
        <div class="col-sm-5">
            <input type="text" name="txt_lastname" class="form-control" value="<?=$lastname;?>"  required placeholder="โปรดกรอกนามสกุล">
        </div>  
        
        <label for="id_no" class="col-sm-3 control-label">รหัสประจำตัว</label>
        <div class="col-sm-5">
            <input type="text" name="txt_id_no" class="form-control" value="<?=$id_no;?>" placeholder="โปรดกรอกรหัสประจำตัว">
        </div>  

        <label for="years" class="col-sm-3 control-label">ปีการศึกษา <a style="color: red;">*เฉพาะบัญชีนิสิต</a></label>
        <div class="col-sm-5">
            <input type="text" name="txt_years" class="form-control" value="<?=$years;?>"   placeholder="โปรดกรอกปีการศึกษา">
        </div>  
        
        <label for="major" class="col-sm-3 control-label">สาขาวิชา</label>
        <div class="col-sm-5">
            <input type="text" name="txt_major" class="form-control" value="<?=$major;?>" invisibled required placeholder="โปรดกรอกสาขาวิชา">
        </div>  
        
        <label for="advisorID" class="col-sm-4 control-label">รหัสอาจารย์ที่ปรึกษา <a style="color: red;">*เฉพาะบัญชีนิสิต</a></label>
        <div class="col-sm-5">
            <input type="text" name="txt_advisor_id" class="form-control" value="<?=$advisor_id;?>"  placeholder="โปรดกรอกรหัสอาจารย์ที่ปรึกษา">
        </div>  

        
        
        
        
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">สถานะผู้ใช้</label>
            <?php if($role=="student") { ?>
            <div class="col-sm-3">
                <select name="txt_status"  class="form-control">
                    <option value="<?=$status;?>" selected="selected">- <?php echo $status; ?>-</option>
                    
                    <option value="กำลังศึกษา">กำลังศึกษา</option>
                    <option value="พ้นสภาพ">พ้นสภาพ</option>
                    <option value="เสียชีวิต">เสียชีวิต</option>
                    <option value="จบการศึกษา">จบการศึกษา</option>
                    <option value="ย้ายสาขาวิชา">ย้ายสาขาวิชา</option>
                </select>
            </div><?php } ?>

            <?php if($role=="instructor") { ?>
            <div class="col-sm-3">
                <select name="txt_status"  class="form-control">
                    <option value="<?=$status;?>" selected="selected">- <?php echo  $status; ?>-</option>
                    
                    <option value="คงอยู่">คงอยู่</option>
                    <option value="ลาออก">ลาออก</option>
                    <option value="เสียชีวิต">เสียชีวิต</option>
                    <option value="ลาศึกษาต่อ">ลาศึกษาต่อ</option>
                    <option value="ลาคลอด">ลาคลอด</option>
                </select>

            </div><?php } ?>

            <?php if($role=="officer"||$role=="admin") { ?>
            <div class="col-sm-3">
                <select name="txt_status"  class="form-control">
                    <option value="<?=$status;?>" selected="selected">- <?php echo  $status; ?>-</option>
                    
                    <option value="อยู่ในหน้าที่">อยู่ในหน้าที่</option>
                    <option value="พ้นหน้าที่">พ้นหน้าที่</option>
                    <option value="เสียชีวิต">เสียชีวิต</option>
                    <option value="ลาศึกษาต่อ">ลาศึกษาต่อ</option>
                    <option value="ลาคลอด">ลาคลอด</option>
                </select>

            </div><?php } ?>

            



        </div>




        <div class="form-group">
            <label for="type" class="col-sm-3 control-label">ประเภทของบัญชีผู้ใช้</label>
            <div class="col-sm-3">
                <select name="txt_role"  class="form-control">
                    <option value="<?=$role;?>" selected="selected">- <?php if($role=="admin"){echo "ผู้ดูแลระบบ";}else
                                                                            if($role=="instructor"){echo "อาจารย์";}else
                                                                            if($role=="student"){echo "นิสิต";}else
                                                                            if($role=="officer"){echo "เจ้าหน้าที่บริหารงานทั่วไป";}?>-</option>
                    <option value="officer">ผู้ดูแลระบบ</option>
                    <option value="officer">เจ้าหน้าที่บริหารงานทั่วไป</option>
                    <option value="student">นิสิต</option>
                    <option value="instructor">อาจารย์</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="type" class="col-sm-5 control-label">ภาคสาขา <a style="color: red;">*เฉพาะบัญชีนิสิต และ เจ้าหน้าที่บริหารงานทั่วไป</a></label>
            <div class="col-sm-3">
                <select name="txt_department" class="form-control">
                    <option value="<?=$department?>" selected="selected">- <?=$department?> -</option>
                    <option value="ภาคปกติ">ภาคปกติ</option>
                    <option value="ภาคพิเศษ">ภาคพิเศษ</option>
                </select>
            </div>
        </div>
        <label  class="col-sm-4 control-label">เบอร์โทร</label>
        <div class="col-sm-5">
            <input type="text" name="txt_phoneNo" value="<?=$phoneNo?>" class="form-control"  >
        </div>  
       
       
       <div>
        <label  class="col-sm-4 control-label">เลขที่บ้าน</label>
        <div class="col-sm-5">
            <input type="text" name="txt_bannum"  value="<?=$bannum ?>"  class="form-control"  >
        </div>  

        <label  class="col-sm-4 control-label">หมู่</label>
        <div class="col-sm-5">
            <input type="text" name="txt_moo" value="<?=$moo?>"class="form-control" >
        </div>

        <label  class="col-sm-4 control-label">ถนน</label>
        <div class="col-sm-5">
            <input type="text" name="txt_roadname" value="<?=$roadname?>" class="form-control"  >
        </div>

        <label  class="col-sm-4 control-label">ตำบล</label>
        <div class="col-sm-5">
            <input type="text" name="txt_tumbon" value="<?=$tumbon?>"  class="form-control"  >
        </div>

        <label  class="col-sm-4 control-label">อำเภอ</label>
        <div class="col-sm-5">
            <input type="text" name="txt_aumper" value="<?=$aumper?>" class="form-control"  >
        </div>

        <label  class="col-sm-4 control-label">จังหวัด</label>
        <div class="col-sm-5">
            <input type="text" name="txt_city" value="<?=$city?>" class="form-control" >
        </div>

        <label  class="col-sm-4 control-label">รหัสไปรษณีย์</label>
        <div class="col-sm-5">
            <input type="text" name="txt_postcode" value="<?=$postcode?>"  class="form-control"  >
        </div>
</div>
        <div class="form-group">
            <div class="col-sm-12 mt-3">
                <input type="submit" name="btn_register" class="btn btn-primary" style="width: 30%;" value="อัพเดตข้อมูลบัญชี">
               
               
               
            </div>
        </div>

        

       

        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
</body>
</html>