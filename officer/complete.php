<?php
require_once('../connection.php');
$receive_date = date("Y-m-d")." ".date("H:i:s");
$filename = '';
$filename = $_REQUEST['pdfname'];


$query = "SELECT * FROM tb_pdf WHERE pdf_file = '$filename'";
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
		$student_token = $row["token"];

	}}

	$sql = "UPDATE tb_pdf
				SET status_form = 'Complete' , completedate = '$receive_date' 
                WHERE pdf_file = '$filename';";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

    $query = mysqli_query($conn,$sql);
    mysqli_close($conn);

	define('LINE_API',"https://notify-api.line.me/api/notify");
 
			

			$token = "$student_token"; //ใส่Token ที่copy เอาไว้
			
			$str = "คำร้องนี้ได้ดำเนินการในระบบเสร็จสิ้นแล้วจากผู้บริหารงานทั่วไป".
			       "\r\n".'หมายเลขคำร้องที่ : #'.$pdf_id.
				   "\r\n".'รหัสนิสิต : '.$nisit_id.
				   "\r\n".'ชื่อ : '.$student_name.
				   "\r\n".'ภาค : '.$student_department.
				   "\r\n".'รหัสอาจารย์ที่ปรึกษา : '.$advisor_id.
				   "\r\n".'ประเภทคำร้อง : '.$type_form;
				    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
			 
			$res2 = notify_message($str,$token);
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

	if($query===TRUE) {
		echo "<script type='text/javascript'>";
            echo  "alert('คำร้องนี้ดำเนินการเสร็จสิ้นแล้ว');";
			echo "window.location='table_approved.php';";
			echo "</script>";
	}
	else{
	echo "พบข้อผิดพลาดโปรดลองใหม่อีกครั้ง";
	}
?>