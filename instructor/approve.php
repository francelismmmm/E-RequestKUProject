<?php 
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
       
    }
	define('LINE_API',"https://notify-api.line.me/api/notify");

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


date_default_timezone_set("Asia/Bangkok");
$original_date = date("d");
$original_month = date("F");
$original_year = date("Y");

$receive_date = date("Y-m-d")." ".date("H:i:s");
?>
<?php
$original_date = date("d");
$original_wday = date("l");
$original_month = date("F");
$original_year = date("Y");

//echo("$original_wday    $original_date    $original_month    $original_year");

$TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$TH_Month = array("01","02","03","04","05","06","07","08","09","10","11","12");

$nDay = date("w");
$nMonth = date("n")-1;
$date = date("j");
$year = date("Y")+543;

//echo("วันนี้เป็นวัน  $TH_Day[$nDay]  ที่  $date  เดือน  $TH_Month[$nMonth]  ปี พ.ศ.  $year");
?>
<?php
require_once '../Eformpdf/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 8,
	'default_font' => 'sarabun'
]);

require_once('../connection.php');
$filename = '';
$filename = $_POST['pdfname'];
$txt_approve = $_POST['txt_approve'];

$email=$_SESSION['instructor_login'];
$query1 = "SELECT name,lastname,id_no FROM testdb WHERE email = '$email' ";
$result1 = $conn->query($query1);
if($result1->num_rows > 0){
	while($row1 = $result1->fetch_assoc()){
		$name  = $row1["name"];
		$lastname = $row1["lastname"];
		$fullname  = $name.' '.$lastname;
		$id = $row1["id_no"];	
	}
	
}

$query2 = "SELECT sign_file FROM tb_sign WHERE advisor_id = '$id' ";
	$result2 = $conn->query($query2);
	if($result2->num_rows > 0){
		while($row2 = $result2->fetch_assoc())
			$signname = $row2["sign_file"];
			$sign_id = $row2["advisor_id"];
		}

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

	$query = "SELECT * FROM testdb  WHERE department = '$student_department' AND role = 'officer'";
	$result = $conn->query($query);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
		$officer_department = $row["department"];
        $officer_token = $row["token"];
	}}

	
/*$mpdf->SetImportUse();
$mpdf->SetDocTemplate('../Eformpdf/'.$pathlink,true);	
		
/*if($type_form=="คำร้องทั่วไป"){
$html = '<div style="text-align:center;position:absolute;top:653px;left:180px;"><h1>'.$fullname.'</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:700px;left:170px;"><h1> '.$original_date.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$TH_Month[$nMonth].' &nbsp;&nbsp;&nbsp;&nbsp; '.$year.'</h1></div>';
$mpdf->WriteHTML($html);
$mpdf->Image('../Eformpdf/doc_signs/'.$signname,47,165,35);
$mpdf->Output('../Eformpdf/pdf/'.$filename, \Mpdf\Output\Destination :: FILE );
       
	$sql = "UPDATE tb_pdf
				SET status_form='Approve',receive='$receive_date'
                WHERE pdf_file = '$filename';";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

    $query = mysqli_query($conn,$sql);
	mysqli_close($conn);

}else if($type_form=="คำร้องขอลงทะเบียนเรียน") 
  { $html = '<div style="text-align:center;position:absolute;top:755px;left:142px;font-size:16px;"><h1>/</h1></div>';
	$html .= '<div style="text-align:center;position:absolute;top:835px;left:250px;"><h1>'.$fullname.'</h1></div>';
	$html .= '<div style="text-align:center;position:absolute;top:855px;left:265px;"><h1> '.$original_date.' &nbsp;&nbsp; '.$TH_Month[$nMonth].'&nbsp;&nbsp;'.$year.'</h1></div>';
	$mpdf->WriteHTML($html);
	$mpdf->Image('../Eformpdf/doc_signs/'.$signname,65,214,35);
    $mpdf->Output('../Eformpdf/pdf/'.$filename, \Mpdf\Output\Destination :: FILE );
	//$mpdf->Output();  
	$sql = "UPDATE tb_pdf
			SET status_form='Approve',receive='$receive_date'
            WHERE pdf_file = '$filename';";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

    $query = mysqli_query($conn,$sql);
	mysqli_close($conn);
	
}*/
if($signname==""){
	echo "<script type='text/javascript'>";
	echo  "alert('ยังไม่ได้มีการบันทึกลายเซ็นดิจิทัลในระบบ');";
	echo "window.location='../Eformpdf/signcreate.php';";
	echo "</script>";
	
}else{

switch ($type_form) {
	case 'คำร้องทั่วไป':
		$mpdf->SetImportUse();
        $mpdf->SetDocTemplate('../Eformpdf/'.$pathlink,true);	
		$html = '<div style="font-size:10px;text-align:center;position:absolute;top:585px;left:220px;"><h1>'.$txt_approve.'&nbsp;</h1></div>';
		$html .= '<div style="text-align:center;position:absolute;top:653px;left:180px;"><h1>'.$fullname.'</h1></div>';
		$html .= '<div style="text-align:center;position:absolute;top:700px;left:170px;"><h1> '.$original_date.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$TH_Month[$nMonth].' &nbsp;&nbsp;&nbsp;&nbsp; '.$year.'</h1></div>';
		$mpdf->WriteHTML($html);
		$mpdf->Image('../Eformpdf/doc_signs/'.$signname,47,165,35);
		//$mpdf->Output();
		$mpdf->Output('../Eformpdf/pdf/'.$filename, \Mpdf\Output\Destination :: FILE );
		$sql = "UPDATE tb_pdf
		SET status_form='Approve',receive='$receive_date'
		WHERE pdf_file = '$filename';";
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
		$query = mysqli_query($conn,$sql);
		mysqli_close($conn);
    

		break;
	
	case 'คำร้องขอลงทะเบียนเรียน':
		$mpdf->SetImportUse();
        $mpdf->SetDocTemplate('../Eformpdf/'.$pathlink,true);	
		$html = '<div style="font-size:14px; text-align:center;position:absolute;top:760px;left:140px;"><h1>/</h1></div>';
		$html .= '<div style="text-align:center;position:absolute;top:835px;left:250px;"><h1>'.$fullname.'</h1></div>';
		$html .= '<div style="text-align:center;position:absolute;top:855px;left:265px;"><h1> '.$original_date.' &nbsp;&nbsp; '.$TH_Month[$nMonth].'&nbsp;&nbsp;'.$year.'</h1></div>';
		$mpdf->WriteHTML($html);
		$mpdf->Image('../Eformpdf/doc_signs/'.$signname,65,214,35);
		//$mpdf->Output();
		$mpdf->Output('../Eformpdf/pdf/'.$filename, \Mpdf\Output\Destination :: FILE );
		$sql = "UPDATE tb_pdf
		SET status_form='Approve',receive='$receive_date'
		WHERE pdf_file = '$filename';";
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
		$query = mysqli_query($conn,$sql);
		mysqli_close($conn);
		break;

		case 'ใบลา':
			$mpdf->SetImportUse();
			$mpdf->SetDocTemplate('../Eformpdf/'.$pathlink,true);	
			$html = '<div style="font-size:14px; text-align:center;position:absolute;top:670px;left:88px;"><h1>/</h1></div>';
			$html .= '<div style="text-align:center;position:absolute;top:770px;left:140px;"><h1>'.$fullname.'</h1></div>';
			$html .= '<div style="text-align:center;position:absolute;top:791px;left:152px;"><h1> '.$original_date.' &nbsp;&nbsp;&nbsp; '.$TH_Month[$nMonth].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$year.'</h1></div>';
			$mpdf->WriteHTML($html);
			$mpdf->Image('../Eformpdf/doc_signs/'.$signname,35,196,35);
			//$mpdf->Output();
			$mpdf->Output('../Eformpdf/pdf/'.$filename, \Mpdf\Output\Destination :: FILE );
			$sql = "UPDATE tb_pdf
			SET status_form='Approve',receive='$receive_date'
			WHERE pdf_file = '$filename';";
			$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
			$query = mysqli_query($conn,$sql);
			mysqli_close($conn);
			break;

		
		
}	
		





	if($query===TRUE) {
		echo "<script type='text/javascript'>";
		echo  "alert('This Request has approved!');";
			//echo  "alert('filename=$filename');";
			//echo  "alert('filename=$signname');";
			//echo  "alert('filename=$pdfile');";
			//echo  "alert('filename=$id');";
			echo "window.location='status_table.php';";
			echo "</script>";
	}
	else{
	echo "Record update fail";
	}



$email=$_POST['email'];
$password=$_POST['password'];

//echo $officer_token;



 
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

			$token2 = "$student_token"; //ใส่Token ที่copy เอาไว้
			
			$str2 = "แจ้งคำร้องที่ผ่านการอนุมัติจากอาจารย์ที่ปรึกษา".
			       "\r\n".'หมายเลขคำร้องที่ : #'.$pdf_id.
				   "\r\n".'รหัสนิสิต : '.$nisit_id.
				   "\r\n".'ชื่อ : '.$student_name.
				   "\r\n".'ภาค : '.$student_department.
				   "\r\n".'รหัสอาจารย์ที่ปรึกษา : '.$advisor_id.
				   "\r\n".'ประเภทคำร้อง : '.$type_form;
				    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
			 
			$res2 = notify_message($str2,$token2);
			print_r($res2);
}

			
		


        if($rs_line){
            echo"<script type='text/javascript'>";
            echo "alert('success');";
            echo"window.location = 'test_line.php'";
            echo"</script>";
        }else{
            echo"<script type='text/javascript'>";
            echo "alert('error');";
            echo"window.location = 'test_line.php'";
            echo"</script>";

        }
?>