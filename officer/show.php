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
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="..\student\styletable.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

 
<body>

 
  <div class="container">
      <div class="row">
        <div class="col-md">
        <table class="table  table-hover table-responsive" style="width:1300px; "  >
  <thead class="thead-dark">
    <tr>
    <th scope="col" width="1%"style="vertical-align: middle">#</th>
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
        $date=$_GET["date"];
        $q=$_GET["q"];

             $email=$_SESSION['officer_login'];
              
    $query = "SELECT * FROM testdb WHERE email = '$email' ";
    $result = $conn->query($query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
           $officer_department=$row["department"];
         }
    }
    
            $query =  "SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no 
            WHERE tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department' AND  tb_pdf.nisit_id LIKE '%$q%'
            OR tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department' AND  tb_pdf.type_form LIKE '%$q%' AND tb_pdf.date_upload LIKE '%$date%'
            OR tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department' AND  tb_pdf.date_upload LIKE '%$q%'  
            OR tb_pdf.status_form  = 'Approve' AND testdb.department ='$officer_department' AND CONCAT(testdb.title,' ',testdb.name,' ',testdb.lastname) LIKE '%$q%'";
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
 
    </tr>
  </thead>
    <tbody>
    <tr>
      <th scope="row"><?php echo $pdf_id ?></th>
      <td><?php echo $nisit_id ?></td>
     
      <td><?php echo $type_form ?></td>
      <td><?php echo $date_upload ?></td>
      <td><?php echo $receive ?></td>
      
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

    <td><div style="margin-left:2px;">
     <form method="post" action="reject.php">
        <button style="margin-left:0px;"type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-x-square-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
  <path fill-rule='evenodd' d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
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
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea type="text" name="feedback"class="form-control" id="message-text"></textarea>
            <input type="hidden" name="pdfname" value="<?=$pdf_file?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
   </form>
    </div></td>
   
</tr>
  </tbody>  
  <?php   
                
                
              } }
         ?>
                
</table>
</div>    </div>
            <br>
            <a href="table_approved.php"><button class='btn btn-outline-warning'>Reset</button></a>
          </div></div></div>
            </div>
            
          </div>


    
         
    
    
    
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  
  </body>