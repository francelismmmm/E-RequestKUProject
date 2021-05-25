<?php
include("../connection.php");
$pdf_name = $_REQUEST['pdf_name'];
$date =  date("Y-m-d")." ".date("H:i:s");
foreach($_FILES['attch_file']['tmp_name'] as $key => $val)
	{
			
	//รับชื่อไฟล์จากฟอร์ม 
	
	$upload=$_FILES['attch_file'];
	if($upload <> '') { 
 
	
	$file_tmp =$_FILES['attch_file']['tmp_name'][$key];
	
	
	
	$pathlink = "../Eformpdf/pdf/".$pdf_name;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($file_tmp,$pathlink);

	
}
    }
	$sql = "UPDATE tb_pdf
				SET status_form = 'Approve' , receive = '$date' 
                WHERE pdf_file = '$pdf_name';";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

    $query = mysqli_query($conn,$sql);
	
$query = "SELECT * FROM tb_pdf WHERE pdf_file = '$pdf_name'";
$result = $conn->query($query);
if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
   $pathlink = $row["path_link"];
   $type_form = $row["type_form"];
   $nisit_id = $row["nisit_id"];
   $advisor_id = $row["advisor_id"];
   $pdf_id = $row["pdf_id"];}
}

$query = "SELECT * FROM tb_pdf INNER JOIN testdb  ON tb_pdf.nisit_id = testdb.id_no WHERE tb_pdf.nisit_id = '$nisit_id' ";
$result = $conn->query($query);
if($result->num_rows>0){
   while($row = $result->fetch_assoc()){
   $student_department = $row["department"];
   $student_name = $row["name"];

}}

$query = "SELECT * FROM testdb  WHERE department = '$student_department' AND role = 'officer'";
$result = $conn->query($query);
if($result->num_rows>0){
   while($row = $result->fetch_assoc()){
   $officer_department = $row["department"];
   $officer_token = $row["token"];
}}

define('LINE_API',"https://notify-api.line.me/api/notify");
 
			$token = "$officer_token"; //ใส่Token ที่copy เอาไว้
			
			$str = "แจ้งคำร้องที่ผ่านการอนุมัติจากอาจารย์ที่ปรึกษา".
			       "\r\n".'หมายเลขคำร้องที่ : #'.$pdf_id.
				   "\r\n".'รหัสนิสิต : '.$nisit_id.
				   "\r\n".'ชื่อ : '.$student_name.
				   "\r\n".'ภาค : '.$student_department.
				   "\r\n".'รหัสอาจารย์ที่ปรึกษา : '.$advisor_id.
				   "\r\n".'ประเภทคำร้อง : '.$type_form;
				    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
			 
			$res = notify_message($str,$token);
			print_r($res);
			function notify_message($message,$token){
			 $queryData = array('message' => $message);
			 $queryData = http_build_query($queryData,'','&');
			 $headerOptions = array( 
			         'http'=>array(
			            'method'=>'POST',
			            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
			                      ."Authorization: Bearer ".$token."\r\n"
			                      ."Content-Length: ".strlen($queryData)."\r\n",
			            'content' => $queryData
			         ),
			 );
			 $context = stream_context_create($headerOptions);
			 $result = file_get_contents(LINE_API,FALSE,$context);
			 $res = json_decode($result);
			 return $res;
			}


        if($rs_line){
            echo"<script type='text/javascript'>";
            echo "alert('success');";
            echo"window.location = 'test_line.php'";
            echo"</script>";
        }else
    mysqli_close($conn);
   // echo $pdf_name;

echo "<script type='text/javascript'>";
echo  "alert('คำร้องของคุณได้อัพโหลดแล้ว!');";
echo "window.location='../instructor/status_table.php';";
echo "</script>";



?>