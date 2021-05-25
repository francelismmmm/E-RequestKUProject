<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');

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
		

	define('LINE_API',"https://notify-api.line.me/api/notify");
 
			 //ใส่Token ที่copy เอาไว้
?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 8,
	'default_font' => 'sarabun'
]);

$original_date = date("d");
$original_wday = date("l");
$original_month = date("F");
$original_year = date("Y");

//echo("$original_wday    $original_date    $original_month    $original_year");

$TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$TH_Month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

$nDay = date("w");
$nMonth = date("n")-1;
$date = date("j");
$year = date("Y")+543;

             $email=$_SESSION['student_login'];
            $query = "SELECT name,lastname,id_no,major,years,advisor_id,title FROM testdb WHERE email = '$email' ";
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
                }
				$query1 = "SELECT * FROM testdb WHERE id_no = '$advisorid' ";
                $result1 = $conn->query($query1);
                if($result1->num_rows > 0){
                    while($row = $result1->fetch_assoc()){
                        $t_name=$row["name"];
                        $t_lastname=$row["lastname"];
                        $t_title=$row["title"];
                    }
                    
                }
                
            }

                            
                            
         
            
$head = $_REQUEST['head'];
$ajname = "อ.".$t_name." ".$t_lastname;
$bannum = $_REQUEST['bannum'];
$moo = $_REQUEST['moo'];
$street = $_REQUEST['street'];
$tumbol = $_REQUEST['tumbol'];
$aumper = $_REQUEST['aumper'];
$province = $_REQUEST['province'];
$postcode = $_REQUEST['postcode'];
$phone = $_REQUEST['phone'];
$story = $_REQUEST['story'];
$check = $_REQUEST['check'];
$pdf_name = $_REQUEST['pdf_name'];
$pdf_draftid = $_REQUEST['pdf_draftid'];
$attch_name2 = $_REQUEST['attch_name'];
$btnSave = $_REQUEST['btnSave'];
if($btnSave<>''){$statusfile='Draft';}else{$statusfile='In progress';}

$mpdf->SetImportUse();
$mpdf->SetDocTemplate('normalform.pdf',true);
$html = '<div style="text-align:center;position:absolute;top:169px;left:530px;"><h1> '.$original_date.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;'.$TH_Month[$nMonth].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$year.'</h1></div>';
$html .= '<div style="font-size:10px;pxtext-align:center;position:absolute;top:198px;left:125px;"><h1>'.$head.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;pxtext-align:center;position:absolute;top:223px;left:125px;"><h1>'.$ajname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:252px;left:277px; font-size:9px;"><h1>'.$nisitname.' '.$nisitlastname.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:249px;left:560px;"><h1>'.$nisitcode.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:272px;left:170px;"><h1>'.$yearedu.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:274px;left:275px;"><h1>'.$major.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:297px;left:300px;"><h1>'.$bannum.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:297px;left:425px;"><h1>'.$moo.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:297px;left:550px;"><h1>'.$street.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:325px;left:152px;"><h1>'.$tumbol.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:325px;left:295px;"><h1>'.$aumper.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:325px;left:418px;"><h1>'.$province.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:322px;left:575px;"><h1>'.$postcode.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:347px;left:200px;"><h1>'.$phone.'&nbsp;</h1></div>';
$html .= '<div style="font-size:10px;text-align:center;position:absolute;top:398px;left:100px;width:620"><h1>'.$story/*_all*/.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:530px;left:540px; font-size:9px;"><h1>'.$nisitname.' '.$nisitlastname.'&nbsp;</h1></div>';



if($title =="นางสาว")
 {$html .= '<div style="font-size:14px;text-align:center;position:absolute;top:235px;left:228px;"><h1> / </h1></div>';
	}
	else if($title =="นาย")
	{$html .= '<div style="font-size:14px;text-align:center;position:absolute;top:235px;left:185px;"><h1> / </h1></div>';
		}
$mpdf->WriteHTML($html);
//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
date_default_timezone_set('Asia/Bangkok');
//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_his");
//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
$numrand = (mt_rand());
$type = ".pdf";
$newname =$numrand."_".$nisitcode."_".$original_date.$original_month.$original_year.$type;
$pdf_idd = 0;
$location = __DIR__ .'/pdf/';
$path = 'pdf/'.$newname;
if($check=='k')
{
	$newname = $pdf_name;
	$pdf_idd = $pdf_draftid;

	$sql = "UPDATE tb_pdf 
			SET status_form='$statusfile',pdf_file='$newname',draftA='$head',draftB='$ajname',draftC='$bannum',draftD='$moo',draftE='$street',draftF='$tumbol',draftG='$aumper',draftH='$province',draftI='$postcode',draftJ='$phone',draftK='$story'
			WHERE pdf_id = '$pdf_idd';
		";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

	if($btnSave<> 'Save'){
			
		$str = "แจ้งคำร้องจากนิสิต".
		"\r\n".'หมายเลขคำร้องที่ : #'.$pdf_idd.
	 "\r\n".'รหัสนิสิต : '.$nisitcode.
	 "\r\n".'ชื่อนิสิต : '.$nisitname.' '.$nisitlastname.
	 "\r\n".'ประเภทคำร้อง : คำร้องทั่วไป';
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
				( pdf_id,pdf_file, path_link,nisit_id,advisor_id,type_form,status_form,draftA,draftB,draftC,draftD,draftE,draftF,draftG,draftH,draftI,draftJ,draftK) 
				VALUES
				('$pdf_idd','$newname', '$path','$nisitcode','$advisorid','คำร้องทั่วไป','$statusfile','$head','$ajname','$bannum','$moo','$street','$tumbol','$aumper','$province','$postcode','$phone','$story')
		";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

	if($btnSave<> 'Save'){
			
		$str = "แจ้งคำร้องจากนิสิต".
		"\r\n".'หมายเลขคำร้องที่ : #'.$pdf_idd.
	 "\r\n".'รหัสนิสิต : '.$nisitcode.
	 "\r\n".'ชื่อนิสิต : '.$nisitname.' '.$nisitlastname.
	 "\r\n".'ประเภทคำร้อง : คำร้องทั่วไป';
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
	if($check=='k')
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
	if($check=='k'){
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
echo  "alert('คำร้องทั่วไปของคุณได้อัพโหลดแล้ว!');";
echo "window.location='../student/student_home.php';";
echo "</script>"


?>