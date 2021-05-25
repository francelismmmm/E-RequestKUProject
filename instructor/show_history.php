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
</head>
<body>

<div class="container" style="position:absolute; top:70px; right:90px;">

<div class="row" style="width: 1300px;">
    <div class="col-md-auto" style="width:100px;"id="header">
     หมายเลขคำร้อง
    </div>
    <div class="col-sm-1" id="header">
     รหัสนิสิต
    </div>
   
    <div class="col-sm" id="header">
      ประเภทของคำร้อง
    </div>
    <div class="col-sm-1" id="header">
      วันที่นิสิตส่งคำร้อง
    </div>
    <div class="col-sm-1" id="header">
      เปิดเอกสารคำร้อง
    </div>
    <div class="col-sm-1" id="header">
      เปิดเอกสารแนบ
    </div>
    <div class="col-sm-1" id="header">
      วันที่พิจารณา
    </div>  
    <div class="col-md-1" id="header">
      ผลการดำเนินการล่าสุด
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
          
            //echo '<font color="red">';   
            //echo 'คำค้น = ';
            $q=$_GET['q']; //echo $q;
            $date=$_GET['date']; //echo $date;
           // echo '</font>';
            //echo '<br/>';  

                $query = "SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode'AND tb_pdf.pdf_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.nisit_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.status_form LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.type_form LIKE '%$q%' AND tb_pdf.receive LIKE '%$date%' 
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.receive LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.name LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.lastname LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.title LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Approve' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,' ',testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.status_form LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode'AND tb_pdf.pdf_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.nisit_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.type_form LIKE '%$q%' AND tb_pdf.receive LIKE '%$date%' 
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.receive LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.name LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.lastname LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.title LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Complete' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,' ',testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.status_form LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode'AND tb_pdf.pdf_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.nisit_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.type_form LIKE '%$q%' AND tb_pdf.receive LIKE '%$date%' 
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.receive LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.name LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.lastname LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.title LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Deny' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,' ',testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.status_form LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode'AND tb_pdf.pdf_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.nisit_id LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.type_form LIKE '%$q%' AND tb_pdf.receive LIKE '%$date%' 
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND tb_pdf.receive LIKE '%$q%' 
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.name LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.lastname LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND testdb.title LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  OR tb_pdf.status_form  = 'Reject' AND tb_pdf.advisor_id ='$nisitcode' AND CONCAT(testdb.title,' ',testdb.name,' ',testdb.lastname) LIKE '%$q%'
                                                  
                                                ";
                                       
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
             
            
                    
                      } }        
                      
                      $query2 = "SELECT name,lastname,title FROM testdb WHERE id_no  = '$nisit_id '  ";
                      $result2 = $conn->query($query2);
   
                      if($result2->num_rows > 0){
                       while($row2 = $result2->fetch_assoc() ){
                          $student_title = $row2["title"];
                          $student_name = $row2["name"];
                          $student_lastname = $row2["lastname"];
                
               
                       
                         } }      
         
                    
                    ?>
  
                  
  <div class="row"style="width: 1300px;">
  <div class="col-md-auto" style="width:100px;"id="data">
  <?php echo"#"; echo $row["pdf_id"];?>
    </div>
    <div class="col-1" id="data">
    <?php echo $row["nisit_id"]?>
    </div>
   
    <div class="col-md" id="data">
    <?php echo $row["type_form"]?>
    </div>
    <div class="col-sm-1" id="data">
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

    <div class="col-sm-1" id="data">
    
    <?php echo $row["receive"]; ?>
    
    
    </div>

    
   
   <div class="col-sm-1" id="data" >
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
   
   
     </div>

                  
                  
               <?php   
                
                
            } }
       ?>

            </div>
            <br>
            <a href="table_history.php"><button class='btn btn-outline-warning'>Reset</button></a>
          </div>
          
</body>