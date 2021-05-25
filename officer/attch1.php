<?php 
include("../connection.php");
$pdf_file = $_REQUEST["pdf_name"];

//WHERE from_pdf = '$pdf_file'

 $result= mysqli_query($conn,"SELECT * FROM tb_attch WHERE from_pdf = '$pdf_file' ") or die(mysqli_error($conn));
if($result->num_rows > 0){ 	
 while($row = $result->fetch_assoc())	
	{ 
      $from_pdf = $row["from_pdf"];
      $attchfile = $row["attch_file"];
      $pathlinkattch = $row["path_link"];
     }
	}
if($from_pdf==$pdf_file){
 header('Content-type: application/pdf');
 header('Content-Disposition: inline; filename="'.$attchfile.'"');
 header('Content-Transfer-Encoding: binary');
 header('Accept-Ranges: byte');
 @readfile('../Eformpdf/'.$pathlinkattch);}
 else{
    echo "<script type='text/javascript'>";
    echo  "alert('ไม่พบไฟล์แนบ!');";
   // echo "window.location='../officer/table_successfully.php';";
    echo "</script>";
 }
?>