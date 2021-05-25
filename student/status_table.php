<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
?>
 <?php $original_date = date("d");
$original_wday = date("l");
$original_month = date("F");
$original_year = date("Y");?>
<?php 
             $email=$_SESSION['student_login'];
            $query = "SELECT * FROM testdb WHERE email = '$email' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $name=$row["name"];
                    $lastname=$row["lastname"];
                    $nisitcode=$row["id_no"];
                    $title=$row["title"];
                    $advisor_id = $row["advisor_id"];
                }
                $query1 = "SELECT * FROM testdb WHERE id_no = '$advisor_id' ";
                $result1 = $conn->query($query1);
                if($result1->num_rows > 0){
                    while($row = $result1->fetch_assoc()){
                        $t_name=$row["name"];
                        $t_lastname=$row["lastname"];
                        $t_title=$row["title"];
                    }
                    
                }
            }
            //เรียกข้อมูลอาจารย์ที่ปรึกษา
            ?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styletable.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <div class="sidenav">
    <p id="date" style="color: white; font-size:10px; text-align:center; font-style:italic; font-weight:lighter;"> <?php echo(" $original_wday    $original_date    $original_month    $original_year");?></p>
        <a href="../student/student_home.php">HOME</a>
       
       
        <a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>
     
        <div class="dropdown-container">
            <a href="..\Eformpdf\inputform.php">คำร้องทั่วไป</a>
            <a href="../Eformpdf/inputformregis.php">คำร้องขอลงทะเบียนเรียน</a>
            <a href="#">..</a>
        </div></div>
    <title>Status of Request</title>
  </head>
  <body>

  <?php //แบ่งpage data
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    $date = $_GET['date'];
    if(($q =='')){
  $query=mysqli_query($conn,"SELECT COUNT(pdf_id) FROM tb_pdf WHERE nisit_id  = '$nisitcode' ");
 $row = mysqli_fetch_row($query);

 $rows = $row[0];

 $page_rows = 5;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

 $last = ceil($rows/$page_rows);

 if($last < 1){
   $last = 1;
 }

 $pagenum = 1;

 if(isset($_GET['pn'])){
   $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
 }

 if ($pagenum < 1) {
   $pagenum = 1;
 }
 else if ($pagenum > $last) {
   $pagenum = $last;
 }

 $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

 $nquery=mysqli_query($conn,"SELECT * from  tb_pdf WHERE nisit_id  = '$nisitcode' $limit");

 $paginationCtrls = '';

 if($last != 1){

 if ($pagenum > 1) {
$previous = $pagenum - 1;
   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

   for($i = $pagenum-4; $i < $pagenum; $i++){
     if($i > 0){
   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
     }
 }
}

 $paginationCtrls .= ''.$pagenum.' &nbsp; ';

 for($i = $pagenum+1; $i <= $last; $i++){
   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
   if($i >= $pagenum+4){
     break;
   }
 }

if ($pagenum != $last) {
$next = $pagenum + 1;
$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-info">Next</a> ';
}
   }?>

  <div id="topicbar"><div  id="topic">รายการคำร้องของคุณ</div></div>
  <br>
  <label class="col-sm-12" style="text-align: center;"  id="headtable">ตารางคำร้องของนิสิต : <?php echo  $nisitcode." ".$title." ".$name."   ".$lastname?> </label>
  <label class="col-sm-12" style="text-align: center;"  id="headtable"> <?php echo  "อาจารย์ที่ปรึกษานิสิต : ".$advisor_id." ".$t_title." ".$t_name." ".$t_lastname?> </label>
  
  <form action="status_table.php" method="get" class="form-horizontal">
    <div class="form-group" >
            <div class="col-sm-3" style="margin-left: 250px;;"  >
                <select name="q" class="form-control" >
                    
                    <option value="" selected="selected"> ค้นหา</option>
                    <option value="" >: ค้นหาโดยแบ่งประเภทคำร้อง</option>
                    <option value="คำร้องทั่วไป">คำร้องทั่วไป</option>
                    <option value="คำร้องขอลงทะเบียนเรียน">คำร้องขอลงทะเบียนเรียน</option>
                    <option value="ใบลา">คำร้องใบลากิจ/ลาป่วย</option>
                    <option value="" >: ค้นหาโดยแบ่งตามสถานะคำร้อง</option>
                    <option value="In progress">อยู่ในระหว่างการดำเนินการ</option>
                    <option value="Approve">ผ่านการอนุมัติจากอาจารย์ที่ปรึกษา</option>
                    <option value="Deny">ปฏิเสธจากอาจารย์ที่ปรึกษา</option>
                    <option value="Draft">แบบร่าง</option>
                    <option value="Complete">เสร็จสิ้น</option>
                    <option value="Reject">ปฏิเสธจากเจ้าหน้าที่</option>
                </select>
                <input name="date" type="date"  class="form-control" >
				<button style="position: absolute; right:10px; top:0px;" type="submit" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
						</button>
            </div>
			
        </div>
		</form>




  <div class="container" style="margin-bottom: 70px;  margin-top: 20px;  ">
  <div class="row">
    <div class="col-md-auto" style="width:100px;"id="header">
      หมายเลขคำร้อง
    </div>
   
    <div class="col" id="header" >
      ประเภทคำร้อง 
    </div>
    <div class="col" id="header">
      สถานะ
    </div>
    <div class="col" id="header">
      วันที่ส่งคำร้อง
    </div>
    <div class="col" id="header" style="font-size: 14px;">
      วันที่อนุมัติจากอาจารย์ที่ปรึกษา
    </div>
    <div class="col" id="header">
      วันที่ดำเนินการล่าสุด
    </div>
  
    <div class="col" id="header">
      แจ้งการแก้ไข
    </div>

    <div class="col" id="header">
      เปิดเอกสาร
    </div>
    <div class="col" id="header">
      เปิดไฟล์แนบ
    </div>
    <div class="col" id="header">
      ร่างเอกสาร
    </div>     

  
  
  
  </div>

  <div style="text-align: center;">
  
  <?php 
             $email=$_SESSION['student_login'];
            $query = "SELECT name,lastname,role,id_no FROM testdb WHERE email = '$email' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $name=$row["name"];
                    $lastname=$row["lastname"];
                    $nisitcode=$row["id_no"];
                   
                }
                
            }

            $query = "SELECT * FROM tb_pdf  WHERE nisit_id  = '$nisitcode' ";
            $result = $conn->query($query);
            
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc() ){
                    $pdf_id= $row["pdf_id"];              
                    $advisor_id =$row["advisor_id"];
                    $type_form = $row["type_form"];
                    $pdf_file=$row["pdf_file"];
                    $status_form = $row["status_form"];
                    $date_upload=$row["date_upload"];        
                    $feedback=$row["feedback"];
                    $date_approve=$row["receive"];
                    $path_link=$row["path_link"];
                    $complete_date = $row["completedate"];
                             
           
                    ?>
                  <?php  

while($row = mysqli_fetch_array($nquery)){
?>
                  <div id="pagination_controls"> 
      <div class="row">
        
  <div class="col-md-auto" style="width:100px;"id="data">
  
  <?php echo"#"; echo $row["pdf_id"];?>
    </div>
    
   
    <div class="col" id="data">
    <?php echo $row["type_form"]?>
    </div>
    
    <div class="col" id="data">
    
    <?php  $status_form = $row["status_form"]; 
    if($status_form=="Approve") 
    {echo "อนุมัติจากอาจารย์ที่ปรึกษา";}
          else if($status_form=="Deny")
             { echo"ปฏิเสธจากอาจารย์ที่ปรึกษา";}
          else if($status_form=="In progress")
          { echo"กำลังดำเนินการ";}
          else if($status_form=="Draft")
          { echo"แบบร่าง";}
          else if($status_form=="Complete")
          { echo"เสร็จสิ้น";}
          else if($status_form=="Reject")
          { echo"ปฏิเสธจากเจ้าหน้าที่";}?>
    </div>
    <div class="col" id="data">
    <?php $date_upload=$row["date_upload"]; if($row["status_form"]!="Draft"){ echo $date_upload;}
     else{echo "-";}?>
   </div>
   
   <div class="col" id="data">
    <?php $date_approve=$row["receive"]; if($date_approve==""){echo"-";}else
    echo "$date_approve"?>
   </div>

   <div class="col" id="data">
    <?php echo   $row["completedate"];?>
   </div>
   
   


   <div class="col" style="word-wrap: break-word; width:50px" id="data">
  
    <?php  if($row["feedback"]!="") {echo "<a onclick = showPopup(this.href='../student/show_feedback.php?feedback=".$row["feedback"]."');return(false);><button class='btn btn-outline-danger'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-square-fill viewBox='0 0 16 16'>
  <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z'/>
</svg></button></a>";}else{echo "-";}?>

<script type="text/javascript">
function showPopup(url) {
newwindow=window.open(url,'name','height=190,width=520,top=200,left=300,resizable');
if (window.focus) {newwindow.focus()}
}
</script></div>
   
    <div class="col" id="data">
    <?php echo "<a target='_blank' href='../Eformpdf/" . $row['path_link'] . "'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div>

    <div class="col" id="data">
    <?php   echo "<a  target='_blank' href='../student/attch.php?pdf_name=".$row["pdf_file"]."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div>

    <td><div class="col" id="data" style="margin-left: 0;"  >
    
    <?php $status_form = $row["status_form"];
          $type_form = $row["type_form"];
          $pdf_id= $row["pdf_id"];
          $pdf_file=$row["pdf_file"];       
  if( $status_form=="Draft"){
   
    if($type_form=="คำร้องทั่วไป"){
    echo "<a  href='../Eformpdf/normalformdraft.php?pdf_id=".$pdf_id."&pdf_name=".$pdf_file."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";}

if($type_form=="คำร้องขอลงทะเบียนเรียน"){
  echo "<a  href='../Eformpdf/formregisdraft.php?pdf_id=".$pdf_id."&pdf_name=".$pdf_file."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
<path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";}

if($type_form=="ใบลา"){
  echo "<a  href='../Eformpdf/formforleavedraft.php?pdf_id=".$pdf_id."&pdf_name=".$pdf_file."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
<path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";} }else{
  echo "ไม่มีแบบร่าง";
}



?>
    </div></td>
    
   
   
     </div>

                  
                  
               <?php   

            } } } 
       ?><br></div> <div id="pagination_controls"><script>
       function Reload()   {
         location.reload();
       }
       </script>
       <button class="btn btn-success" onclick="Reload()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
     <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
     <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
   </svg></button> <?php echo $paginationCtrls; ?></div>

            </div>
          </div> 
          <?php
  } 
  ?>
          
          <?php
    require_once('..\connection.php');
  
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    if($q!=''){
    include('show.php');
    }
    include ('form.php');
    ?>
      
    
    
    
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
  
</html>