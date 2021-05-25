<?php 
    session_start();

    if (!isset($_SESSION['officer_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
     
                     
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">
    
	<meta http-equiv="refresh" content=";URL=table_approved.php">
<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/extensions/auto-refresh/bootstrap-table-auto-refresh.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\officer\style_table.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <div class="sidenav">
        <a href="officer_home.php">HOME</a>
        
       
        <a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>

       </div>
    <title>list form</title>
    
  </head>
  
  
  <body>
  <div id="topicbar"><div  id="topic"> 
  คำร้องขอที่อยู่ระหว่างการพิจารณาและดำเนินการต่อ</div></div>

  <form action="table_approved.php" method="get" class="form-horizontal">
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
        

  <?php
  $q = (isset($_GET['q']) ? $_GET['q'] : '');
  if(($q =='')){

      
    $email=$_SESSION['officer_login'];
    
    $query = "SELECT * FROM testdb WHERE email = '$email' ";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
           $officer_department=$row["department"];
         }
    }
    
    $query = "SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department'";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            
            $pdf_id=$row["pdf_id"];
            $nisit_id=$row["nisit_id"];
            $type_form=$row["type_form"];
            $advisor_id=$row["advisor_id"];
            $status_form=$row["status_form"];
            $date_upload=$row["date_upload"];
            $pdf_file=$row["pdf_file"];
            $receive=$row["receive"]; 
            
      
            

            $query1 = "SELECT * FROM tb_attch WHERE from_pdf  = '$pdf_file'  ";
            $result1 = $conn->query($query1);
            if($result1->num_rows > 0){
             while($row1 = $result1->fetch_assoc() ){
                $attchfile = $row1["attch_file"];
                $pathlinkattch = $row1["path_link"];
      
     
             
               } }        }}

     //query
 $query=mysqli_query($conn,"SELECT COUNT(pdf_id) FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department' ");
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

 $nquery=mysqli_query($conn,"SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department'  $limit  ");

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
  <div  class="container">
      <div class="row" >
        <div class="col-md">
   <table class="table  table-hover table-responsive" style="width:1300px; "  >
 
   
  <thead class="thead-dark">
    <tr>
      <th scope="col" width="1%"style="vertical-align: middle"># </th>
      <th scope="col" width="8%"style="vertical-align: middle">รหัสนิสิต</th>
      <th scope="col" width="10%"style="vertical-align: middle">ประเภท</th>
      <th scope="col" width="5%"style="vertical-align: middle">วันที่นิสิตสร้าง</th>
      <th scope="col" width="5%"style="vertical-align: middle">วันที่ผ่านการอนุมัติ</th>
      <th scope="col" width="5%"style="vertical-align: middle">เปิดเอกสารคำร้อง</th>
      <th scope="col" width="9%"style="vertical-align: middle">เปิดเอกสารแนบ</th>
      <th scope="col" width="2%"style="vertical-align: middle">เสร็จสิ้น</th>
      <th scope="col" width="2%"style="vertical-align: middle">ปฏิเสธ</th>
  
  
  </div>

  <div style="text-align: center;">
  
  <?php 
  
             $email=$_SESSION['officer_login'];
            $query =  "SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department'";
            $result = $conn->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $pdf_id=$row["pdf_id"];
                    $nisit_id=$row["nisit_id"];
                    $type_form=$row["type_form"];
                    $advisor_id=$row["advisor_id"];
                    $status_form=$row["status_form"];
                    $date_upload=$row["date_upload"];
                    $pdf_file=$row["pdf_file"];
                    $receive=$row["receive"];
              
                    

                    $query1 = "SELECT * FROM tb_attch WHERE from_pdf  = '$pdf_file'  ";
                    $result1 = $conn->query($query1);
                    if($result1->num_rows > 0){
                     while($row1 = $result1->fetch_assoc() ){
                        $attchfile = $row1["attch_file"];
                        $pathlinkattch = $row1["path_link"];
              
             
                     
                       } }        
          
                     
                            
                            
         
                    
                    ?>
                     
  <?php

while($row = mysqli_fetch_array($nquery)){
?>    
 
    </tr>
  </thead>
    <tbody>
    <tr>
      <th scope="row"><?php echo $row["pdf_id"] ?></th>
      <td><?php echo $row["nisit_id"] ?></td>
      <td><?php echo $row["type_form"] ?></td>
      <td><?php echo $row["date_upload"]?></td>
      <td><?php echo $row["receive"] ?></td>
      
      <td><div style="margin-left: 0;"  >
    <?php echo "<a target='_blank' href='../Eformpdf/" . $row['path_link'] . "'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div></td>
    
        <td>
        <div style="margin-left: 10px;">
    <?php   echo "<a  target='_blank' href='../officer/attch.php?pdf_name=".$row["pdf_file"]."'><button class='btn btn-outline-dark'><svg width='1em' height='1em' viewBox='0 0 16 16 class='bi bi-file-earmark-text-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z'/>
</svg></button></a>";?>
    </div>
    </td>

    <td>
    <div style="margin-left:10px;">
    <a href='complete.php?pdfname=<?=$row["pdf_file"]?>'><button onclick="return confirm('ยืนยันคำร้องนี้เสร็จสิ้นใช่หรือไม่?');" class='btn btn-outline-success'><svg width='1em' height='1em' viewBox=0 0 16 16 class='bi bi-check-square-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
          <path fill-rule='evenodd' d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
        </svg></button></a> 
    
    </div></td>



    <?php //echo $pdf_file=$row["pdf_file"]?>
    <td>
        <div style="margin-left: 10px;"></div>
    <?php   echo "<a onclick = showPopup(this.href='../officer/sendfeedback.php?pdf_name=".$row["pdf_file"]."');return(false);><button class='btn btn-outline-danger'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-square-fill viewBox='0 0 16 16'>
  <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z'/>
</svg></button></a>";?>

<script type="text/javascript">
function showPopup(url) {
newwindow=window.open(url,'name','height=190,width=520,top=200,left=300,resizable');
if (window.focus) {newwindow.focus()}
}
</script>
    </div>
    </td>
   
</tr>
  </tbody> 
  <?php   
                
                
              } } }
         ?>
                
</table>

</div></div><script>
    function Reload()   {
      location.reload();
    }
    </script>
    <button class="btn btn-success" onclick="Reload()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
  <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
  <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
</svg></button></div>
            </div>
          </div> <br>
            </div><div id="pagination_controls" style="position: absolute; left:450px;"><?php echo $paginationCtrls; ?>
          </div> <?php
 }
    
  ?>


    
        <?php
           include('..\connection.php');
    $q = (isset($_GET['q']) ? $_GET['q'] : '');
    include('form.php');
    if($q!=''){
    include('show.php');
    }
    ?>
    
    
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  
  </body>
  
</html>