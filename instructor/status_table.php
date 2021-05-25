<?php 
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\student\styletable.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <div class="sidenav">
        <a href="instructor_home.php">HOME</a>
       
       
        <a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>
     
       </div>
    <title>consider request form</title>
  </head>
  

  
  
  <body>
  
  <div id="topicbar"> <div  id="topic">คำร้องขอที่ต้องพิจารณา</div></div>
 
  <?php
  $q = (isset($_GET['q']) ? $_GET['q'] : '');
  if(($q =='')){ 
            $email=$_SESSION['instructor_login'];
            $query = "SELECT name,lastname,role,id_no,advisor_id FROM testdb WHERE email = '$email' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                  $name=$row["name"];
                  $lastname=$row["lastname"];
                  $nisitcode=$row["id_no"];
                  $advisorid=$row["advisor_id"];
                 
              }
              
          }
     //query
 $query=mysqli_query($conn,"SELECT COUNT(pdf_id) FROM tb_pdf WHERE status_form  = 'In progress' AND advisor_id ='$nisitcode'  ");
 $row = mysqli_fetch_row($query);

 $rows = $row[0];

 $page_rows = 10;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

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

 $nquery=mysqli_query($conn,"SELECT * from  tb_pdf  WHERE status_form  = 'In progress' AND advisor_id ='$nisitcode'  $limit  ");

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
   }
    
  ?>
   <form action="status_table.php" method="get" class="form-horizontal">
  <div class="form-group" >
            <div class="col-sm-3" style="margin-left: 800px;"  >
                <select name="q" class="form-control" >
                    
                   
                    <option value="" >: ค้นหาโดยแบ่งประเภทคำร้อง</option>
                    <option value="คำร้องทั่วไป">คำร้องทั่วไป</option>
                    <option value="คำร้องขอลงทะเบียนเรียน">คำร้องขอลงทะเบียนเรียน</option>
                    <option value="ใบลา">คำร้องใบลากิจ/ลาป่วย</option>
                   
                </select>
                <input name="date" type="date"  class="form-control" >
				<button style="position: absolute; right:10px; top:0px;" type="submit" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
						</button>
            </div>
			
        </div></form>


  <div class="container" style="position:absolute; top:70px;">
  
  <div class="row">
    <div class="col-md-auto" style="width:100px;"id="header">
     หมายเลขคำร้อง
    </div>
    <div class="col-sm-1" id="header">
     รหัสนิสิต
    </div>
    <div class="col-sm-3" id="header">
    ชื่อนิสิต
    </div>
    <div class="col-md" id="header">
      ประเภทของคำร้อง
    </div>
    <div class="col-sm" id="header">
      วันที่นิสิตส่งคำร้อง
    </div>
    <div class="col-sm-1" id="header">
      เปิดเอกสารคำร้อง
    </div>
    <div class="col-sm-1" id="header">
      เปิดเอกสารแนบ
    </div>
    <div class="col-sm-2" id="header">
      อนุมัติ
    </div>  
    <div class="col-sm-1" id="header">
      ปฏิเสธ
    </div>  
  
  
  </div>

  <div style="text-align: center;">
  
  <?php 
             $email=$_SESSION['instructor_login'];
            $query = "SELECT name,lastname,role,id_no,advisor_id FROM testdb WHERE email = '$email' ";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $name=$row["name"];
                    $lastname=$row["lastname"];
                    $nisitcode=$row["id_no"];
                    $advisorid=$row["advisor_id"];
                   
                }
                
            }
 
           

        
           
                $query = "SELECT * FROM tb_pdf WHERE status_form  = 'In progress' AND advisor_id ='$nisitcode' ";
                $result = $conn->query($query);
             
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc() ){
                        $pdf_id= $row["pdf_id"];              
                        $nisit_id =$row["nisit_id"];
                        $pdf_file =$row["pdf_file"];
                        $type_form = $row["type_form"];
                        $date_upload=$row["date_upload"];
                        
                      
                   $query1 = "SELECT attch_file,path_link FROM tb_attch WHERE from_pdf  = '$pdf_file'  ";
                   $result1 = $conn->query($query1);

                   if($result1->num_rows > 0){
                    while($row1 = $result1->fetch_assoc() ){
                       $attchfile = $row1["attch_file"];
                       $pathlinkattch = $row1["path_link"];
             
                    }}
                    
                             
                           
                      $query = "SELECT * FROM testdb WHERE id_no  = '$nisit_id '  ";
                      $result2 = $conn->query($query);
   
                      if($result2->num_rows > 0){
                       while($row2 = $result2->fetch_assoc() ){

                     $student_title = $row2["title"];
                     $student_name = $row2["name"];
                     $student_lastname = $row2["lastname"];
                
               
                       
                         } }     
    
                   ?>
         
      <div class="row">
  <div class="col-md-auto" style="width:100px;"id="data">
  <?php echo"#"; echo $row["pdf_id"];?>
    </div>
    <div class="col-1" id="data">
    <?php echo $row["nisit_id"]?>
    </div>
    <div class="col-3" id="data">
    <?php echo    $student_title." ".$student_name." ". $student_lastname?>
    </div>
    <div class="col-md" id="data">
    <?php echo $row["type_form"]?>
    </div>
    <div class="col-sm" id="data">
    <?php echo $row["date_upload"]?>
    </div>
    
    <div class="col-sm-1" id="data">
    <?php echo "<a target='_blank' href='../Eformpdf/" . $row['path_link'] . "'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div>
    
    <div class="col-sm-1" id="data">
    <?php   echo "<a  target='_blank' href='../instructor/attch.php?pdf_name=".$row["pdf_file"]."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div>

    <div class="col-sm-2" id="data">
    
    <form method="post"  action="approve.php">
    <label style="font-size: 12px;">เซ็นระบบ</label>
   <button  onclick="return confirm('คุณต้องการอนุมัติคำร้องนี้โดยผ่านลายเซ็นในระบบใช่หรือไม่?');" type="submit" class='btn btn-outline-primary'><svg width='1em' height='1em' viewBox=0 0 16 16 class='bi bi-check-square-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
          <path fill-rule='evenodd' d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
        </svg></button>
     <input type="hidden" name="pdfname" value="<?=$row["pdf_file"]?>">
    </form>
    
    <div >
    <label style="font-size: 12px;">เซ็นด้วยตนเอง</label> 
    <?php  echo "<a  href='uploadpdf.php?pdf_name=".$row["pdf_file"]."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
<path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div>
    
    </div>

    
   
   <div class="col-sm-1" id="data" >
      
      <form method="post" action="deny.php">
        <button style="margin-left:0px;"type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><svg width='1.2em' height='1.2em' viewBox='0 0 17 16' class='bi bi-exclamation-triangle-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
        <path fill-rule='evenodd' d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z'/>
      </svg></button>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แจ้งรายละเอียดของการปฏิเสธคำร้อง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="message-text" class="col-form-label" style="position: relative; right:200px;">Message:</label>
            <textarea type="text" name="feedback"class="form-control" id="message-text"></textarea>
            <input type="hidden" name="pdfname" value="<?=$row["pdf_file"]?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
   </form>
</div>
   
   
     </div>

                  
                  
               <?php   
                
             
            } } }
       ?>
             <br>
            </div><div id="pagination_controls" style="position: absolute; left:450px;"><?php echo $paginationCtrls; ?>
          </div> 
          <?php
  
  ?>

   <?php
    require_once('..\connection.php');
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    if($q!=''){
    include('show.php');
    }include ('form.php');
    ?>
      
    
    
    
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  
  </body>
  
</html>