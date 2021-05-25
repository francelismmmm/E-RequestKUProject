<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');

	define('LINE_API',"https://notify-api.line.me/api/notify");
	$email=$_SESSION['student_login'];
	$query = "SELECT advisor_id FROM testdb WHERE email = '$email' ";
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
	
			$advisorid = $row["advisor_id"];}}

			$query = "SELECT token FROM testdb WHERE id_no = '$advisorid' ";
	        $result = $conn->query($query);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
			
					$token = $row["token"];}}
		

	
 
 
			 //ใส่Token ที่copy เอาไว้
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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<link rel="stylesheet" href="style.css">

<?php
require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 8,
	'default_font' => 'sarabun'
]);

$email=$_SESSION['student_login'];
$query = "SELECT * FROM testdb WHERE email = '$email' ";
$result = $conn->query($query);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$nisitname = $row["name"];
		$nisitlastname = $row["lastname"];
		$nisitcode = $row["id_no"];
		$yearedu = $row["years"];
		$major = $row["major"];
		$advisorid = $row["advisor_id"];
		$title = $row["title"];
		$faculty = $row["faculty"];
	}
	$query1 = "SELECT * FROM testdb WHERE id_no = '$advisorid' ";
     $result1 = $conn->query($query1);
    if($result1->num_rows > 0){
	while($row = $result1->fetch_assoc()){
		$t_name = $row["name"];
		$t_lastname = $row["lastname"];
	}}
}

//ตัวแปลเก็บค่า
$day = $original_date;
$month = $TH_Month[$nMonth];
$head = $_REQUEST['head'];
$ajname = "อ.".$t_name." ".$t_lastname;


$phone = $_REQUEST['phone'];
$story = $_REQUEST['story'];
$check = $_REQUEST['select'];
$check23 = $_REQUEST['check'];
$pdf_name = $_REQUEST['pdf_name'];
$pdf_draftid = $_REQUEST['pdf_draftid'];
$attch_name2 = $_REQUEST['attch_name'];

$btnSave = $_REQUEST['btnSave'];
if($btnSave<>''){$statusfile='Draft';}else{$statusfile='In progress';}

$check1 = $_REQUEST['check3semester'];
$check2 = $_REQUEST['check3academicyear'];
$check3 = $_REQUEST['check3fromcredit'];
$check4 = $_REQUEST['check3tocredit'];

$check5 = $_REQUEST['check5semester'];
$check6 = $_REQUEST['check5academicyear'];

$check7 = $_REQUEST['check6formmajor'];
$check8 = $_REQUEST['check6tomajor'];

//แสดงผลpdf
$mpdf->SetImportUse();
$mpdf->SetDocTemplate('regissect.pdf',true);
$html = '<div style="text-align:center;position:absolute;top:112px;left:580px;"><h1> '.$day.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$month.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$year.'</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:115px;left:105px;"><h1>'.$ajname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:163px;left:240px;"><h1>'.$nisitname."   ".$nisitlastname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:210px;left:180px;letter-spacing: 16.5px"><h1>'.$nisitcode.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:200px;left:485px;"><h1>'.$yearedu.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:200px;left:560px;"><h1>'.$faculty.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:240px;left:140px;"><h1>'.$major.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:240px;left:430px;"><h1>'.$phone.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:240px;left:580px;"><h1>'.$email.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:610px;left:125px;width:620"><h1>'.$story.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:665px;left:520px;"><h1>'.$nisitname.' '.$nisitlastname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:688px;left:595px;"><h1> '.$day.' &nbsp;&nbsp;&nbsp;&nbsp; '.$month.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$year.'</h1></div>';
//นาย นางสาว
if($title =="นางสาว")
 {$html .= '<div style="text-align:center;position:absolute;top:163px;left:170px;"><h1> / </h1></div>';
	$html .= '<div style="text-align:center;position:absolute;top:163px;left:145px;"><h1> / </h1></div>';}
	else if($title =="นาย")
	{$html .= '<div style="text-align:center;position:absolute;top:163px;left:170px;"><h1> / </h1></div>';
		$html .= '<div style="text-align:center;position:absolute;top:163px;left:200px;"><h1> / </h1></div>';}

	switch ($check) {
	case '1':
		$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:303px;left:130px;"><h1>/</h1></div>';
		break;
	
	case '2':
		$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:341px;left:130px;"><h1>/</h1></div>';
		break;
		
		case '3':
			$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:375px;left:130px;"><h1>/</h1></div>';
			$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:430px;left:170px;"><h1>'.$check1.'&nbsp;</h1></div>';
			$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:430px;left:300px;"><h1>'.$check2.'&nbsp;</h1></div>';
			$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:430px;left:430px;"><h1>'.$check3.'&nbsp;</h1></div>';
			$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:430px;left:560px;"><h1>'.$check4.'&nbsp;</h1></div>';
		    break;

			case '4':
				$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:450px;left:130px;"><h1>/</h1></div>';
				break;
				
				case '5':
					$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:469px;left:130px;"><h1>/</h1></div>';
					$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:503px;left:170px;"><h1>'.$check5.'&nbsp;</h1></div>';
					$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:503px;left:310px;"><h1>'.$check6.'&nbsp;</h1></div>';


					break;
					

					case '6':
						$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:522px;left:130px;"><h1>/</h1></div>';
						$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:543px;left:160px;"><h1>'.$check7.'&nbsp;</h1></div>';
						$html .= '<div style="font-size:15px;text-align:center;position:absolute;top:543px;left:375px;"><h1>'.$check8.'&nbsp;</h1></div>';

						break;
}

$mpdf->WriteHTML($html);

//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
date_default_timezone_set('Asia/Bangkok');
//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_his");

//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
$numrand = (mt_rand());
$type = ".pdf";
$newname =$numrand."_".$nisitcode."_".$original_date.$original_month.$original_year.$type;;
$pdf_idd = 0;
$location = __DIR__ .'/pdf/';
$path = 'pdf/'.$newname;

if($check23=='k')
{
	$newname = $pdf_name;
	$pdf_idd = $pdf_draftid;

	$sql = "UPDATE tb_pdf 
			SET status_form='$statusfile',pdf_file='$newname',draftA='$ajname',draftB='$faculty',draftC='$major',draftD='$phone',draftE='$story',draftselect='$check',draftF='$check1',draftG='$check2',draftH='$check3',draftI='$check4'
			,draftJ='$check5',draftK='$check6',draftL='$check7',draftM='$check8' WHERE pdf_id = '$pdf_idd';
		";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
	if($btnSave <> 'Save'){
		$str = "แจ้งคำร้องจากนิสิต".
		"\r\n".'หมายเลขคำร้องที่ : #'.$pdf_idd.
		"\r\n".'รหัสนิสิต : '.$nisitcode.
		"\r\n".'ชื่อนิสิต : '.$nisitname.' '.$nisitlastname.
		"\r\n".'ประเภทคำร้อง : คำร้องขอลงทะเบียนเรียน';
	  //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
		 
		
		$res = notify_message($str,$token);
		print_r($res);
		}
}else{
$id_pdf= mysqli_query($conn,"SELECT pdf_id FROM tb_pdf") or die(mysqli_error($conn));
	while($info=mysqli_fetch_array($id_pdf))	
	if($info['pdf_id']>=1){ 
		$pdf_idd=$info['pdf_id'];
		$pdf_idd+=1;
		}else{
		$pdf_idd=1;
	}




		 $sql = "INSERT INTO tb_pdf 
				( pdf_id,pdf_file, path_link,nisit_id,advisor_id,type_form,status_form,draftA,draftB,draftC,draftD,draftE,draftselect,draftF,draftG,draftH,draftI,draftJ,draftK,draftL,draftM) 
				VALUES
				('$pdf_idd','$newname', '$path','$nisitcode','$advisorid','คำร้องขอลงทะเบียนเรียน','$statusfile','$ajname','$faculty','$major','$phone','$story','$check','$check1','$check2','$check3','$check4','$check5','$check6','$check7','$check8')
		";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

	
 

	if($btnSave <> 'Save'){
			$str = "แจ้งคำร้องจากนิสิต".
			"\r\n".'หมายเลขคำร้องที่ : #'.$pdf_idd.
			"\r\n".'รหัสนิสิต : '.$nisitcode.
			"\r\n".'ชื่อนิสิต : '.$nisitname.' '.$nisitlastname.
			"\r\n".'ประเภทคำร้อง : คำร้องขอลงทะเบียนเรียน';
		  //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
			 
			
			$res = notify_message($str,$token);
			print_r($res);
			}
		}
	foreach($_FILES['attch_file']['tmp_name'] as $key => $val)
	{
		
	$numrand = (mt_rand());
	
	
	//รับชื่อไฟล์จากฟอร์ม 
	
	$upload=$_FILES['attch_file'];
	if($upload <> '') { 
 
	/*$file_name = $_FILES['pdf_file']['name'][$key];*/
	$file_tmp =$_FILES['attch_file']['tmp_name'][$key];
	/*$type = strrchr($_FILES[$file_name]['name'],".");*/
	if($check23=='k')
	{$newname2 = $attch_name2;}  //จัดการตรงนี้นะเรื่องการเซฟทับไฟล์เดิม!! 
	else{ 
		$newname2 =$numrand.$date1.".pdf";  
	}
	$path_link="attch/".$newname2; //ตัวเก็บตำแหน่งไฟล์ ใช้ในการเรียกมาแสดงได้ เช่นกรณีเก็บเป็นรูปไว้ในโฟลเดอร์pdf  Img:<img style="width: 200px;height: 200px" src="pdf/<?php print_r $name_file?ง>"> ง ขั้นไว้เฉยๆ
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($file_tmp,"attch/".$newname2);

	
	$id_attch= mysqli_query($conn,"SELECT attch_id FROM tb_attch") or die(mysqli_error($conn));
	while($info=mysqli_fetch_array($id_attch))	
	if($info['attch_id']>=1){ 
		$attch_idd=$info['attch_id'];
		$attch_idd+=1;
    }else{
        $attch_idd=1;
    }
	
	
	}
	if($check23=='k'){
		$attch_idd='';
	}else{
 
 
			  $sql = "INSERT INTO tb_attch 
								( attch_id,nisit_id,advisor_id,attch_file,from_pdf, path_link) 
								VALUES
								('$attch_idd','$nisitcode','$advisorid','$newname2','$newname', '$path_link')
						";
		
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
 
	}
 
 	
	
}
	 
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

mysqli_close($conn);

//$mpdf->Output();
$mpdf->Output($location.$newname, \Mpdf\Output\Destination :: FILE );

echo "<script type='text/javascript'>";
echo  "alert('คำร้องขอลงทะเบียนของคุณได้อัพโหลดแล้ว!');";
echo "window.location='../student/student_home.php';";
echo "</script>"



?>





</body>
</html>