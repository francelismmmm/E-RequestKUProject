<body>


  <div id="topicbar"><div  id="topic">รายการคำร้องของคุณ</div></div>
  <br>
  <label class="col-sm-12" style="text-align: center;"  id="headtable">ตารางคำร้องของนิสิต : <?php echo  $nisitcode." ".$title." ".$name."   ".$lastname?> </label>
  <label class="col-sm-12" style="text-align: center;"  id="headtable"> <?php echo  "อาจารย์ที่ปรึกษานิสิต : ".$advisor_id." ".$t_title." ".$t_name." ".$t_lastname?> </label>
  <center>
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
                   
                }}
                
            $q=$_GET["q"];
            $date=$_GET["date"];
            $query = "SELECT * FROM tb_pdf WHERE nisit_id  = '$nisitcode'  AND  pdf_id LIKE '%$q%' 
                                              OR nisit_id  = '$nisitcode'  AND  nisit_id LIKE '%$q%'
                                              OR nisit_id  = '$nisitcode'  AND  status_form LIKE '%$q%' AND date_upload LIKE '%$date%'
                                              OR nisit_id  = '$nisitcode'  AND  type_form LIKE '%$q%'   AND date_upload LIKE '%$date%'
                                              
                                                ";
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
            
                             
                   $query1 = "SELECT attch_file,path_link FROM tb_attch WHERE from_pdf  = '$pdf_file'  ";
                   $result1 = $conn->query($query1);

                   if($result1->num_rows > 0){
                    while($row1 = $result1->fetch_assoc() ){
                       $attchfile = $row1["attch_file"];
                       $pathlinkattch = $row1["path_link"];
             
            
                    
                      } }        
         
                    ?>
                  <?php


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
    <?php echo "-"?>
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
    <?php   echo "<a  href='../student/attch.php?pdf_name=".$row["pdf_file"]."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
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
         
            } } 
       ?><br><a href="status_table.php"><button class='btn btn-outline-warning'>Reset</button></div><br></center>

            </div>
          </div> </body>