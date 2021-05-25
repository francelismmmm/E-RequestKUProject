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
		
?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'default_font_size' => 8,
	'default_font' => 'sarabun'
]);

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
$countday = $_REQUEST['countday'];
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
$attch_name2 = $_REQUEST['attch_name'];
$btnSave = $_REQUEST['btnSave'];
$select = $_REQUEST['select'];
if($btnSave<>''){$statusfile='Draft';}else{$statusfile='In progress';}

$check = $_REQUEST['check'];
$pdf_name = $_REQUEST['pdf_name'];
$pdf_draftid = $_REQUEST['pdf_draftid'];

echo $present_date = date("Y-n-d H:i:s");

echo $startdate = $_REQUEST['startdate'];
$startdates = date("Y-n-d H:i:s",$startdate);
 	list($dates,$times) = explode(" ",$startdate); //แบก เวลา วดป
 	list($startyear,$startmonth,$startdays) = explode("-",$startdate); //แยก ว/ด/ป
	//list($hour,$minit,$sec) = explode("-",$startdate); แยกเวลา

	$startyears = date($startyear)+543;

	$Arraymonths = date($startmonth)-1;
	$startmonths = $TH_Month[$Arraymonths];
    // ว/ด/ป วันเริ่ม


	


$enddate = $_REQUEST['enddate'];
$enddates = date("Y-n-d H:i:s",$enddate);
 	list($dates,$times) = explode(" ",$enddate); //แบก เวลา วดป
 	list($endyear,$endmonth,$enddays) = explode("-",$enddate); //แยก ว/ด/ป
	//list($hour,$minit,$sec) = explode("-",$startdate); แยกเวลา
    
	$endyears = date($endyear)+543;

	$Arraymonths = date($endmonth)-1;
	$endmonths = $TH_Month[$Arraymonths];

	function compareDate( $startdate ,$enddate,$select) {
		$present = explode("-",date("Y-n-d"));
		$arrDate1 = explode("-",$startdate);
		$arrDate2 = explode("-",$enddate);
		
		$timStmp1 = mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]);
		$timStmp2 = mktime(0,0,0,$arrDate2[1],$arrDate2[2],$arrDate2[0]);
		$timStmp3 = mktime(0,0,0,$present[1],$present[2],$present[0]);
		
		if ($timStmp1 <= $timStmp3 && $select == "business" ) {
		
			return false;
			
		}
		//elseif ($timStmp1 == $timStmp2) {
		//	echo "<script>alert('หยุดวันเดียว');</script>";
		//} 
		else if ($timStmp1 > $timStmp2) {
			return false;
		}  
		else if ($timStmp1 < $timStmp2) {
			echo "<script>alert('Date 1 น้อยกว่า Date 2 สามารถลาได้');</script>";
			return true;
		}  
	
	}
	$process = compareDate($startdate,$enddate,$select);
	if($process == false){
		echo "<script>alert('วันที่ลาต้องล่วงหน้า1วัน');";
		echo "window.location='../Eformpdf/forleave1.php';</script>";
	}else{
//คำนวณจำนวนวันที่หยุด
$totalday=strtotime("$enddate")-strtotime("$startdate");
$summaryday=floor($totalday / 86400)+1; // 86400 มาจาก 24*360 (1วัน = 24 ชม.)


$idsub1 = $_REQUEST['idsub1'];
$namesub1 = $_REQUEST['namesub1'];
$secsub1 = $_REQUEST['secsub1'];
$teachersub1 = $_REQUEST['teachersub1'];

$idsub2 = $_REQUEST['idsub2'];
$namesub2 = $_REQUEST['namesub2'];
$secsub2 = $_REQUEST['secsub2'];
$teachersub2 = $_REQUEST['teachersub2'];

$idsub3 = $_REQUEST['idsub3'];
$namesub3 = $_REQUEST['namesub3'];
$secsub3 = $_REQUEST['secsub3'];
$teachersub3 = $_REQUEST['teachersub3'];

$idsub4 = $_REQUEST['idsub4'];
$namesub4 = $_REQUEST['namesub4'];
$secsub4 = $_REQUEST['secsub4'];
$teachersub4 = $_REQUEST['teachersub4'];

$idsub5 = $_REQUEST['idsub5'];
$namesub5 = $_REQUEST['namesub5'];
$secsub5 = $_REQUEST['secsub5'];
$teachersub5 = $_REQUEST['teachersub5'];


$mpdf->SetImportUse();
$mpdf->SetDocTemplate('forleave.pdf',true);
$html = '<div style="text-align:center;position:absolute;top:143px;left:490px;"><h1> '.$original_date.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$TH_Month[$nMonth].' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$year.'</h1></div>';
if($select=="sick"){
	$html .= '<div style="text-align:center;position:absolute;top:156px;left:182px;font-size:16px;"><h1>/</h1></div>';
} else if($select =="business"){
	$html .= '<div style="text-align:center;position:absolute;top:156px;left:284px;font-size:16px;"><h1>/</h1></div>';
} 
$html .= '<div style="text-align:center;position:absolute;top:198px;left:125px;"><h1>'.$ajname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:229px;left:240px; font-size:9px;"><h1>'.$nisitname.' '.$nisitlastname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:224px;left:566px;"><h1>'.$nisitcode.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:250px;left:140px;"><h1>'.$yearedu.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:250px;left:275px;"><h1>'.$major.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:276px;left:280px;"><h1>'.$bannum.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:276px;left:335px;"><h1>หมู่ '.$moo.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:276px;left:380px;"><h1>ถนน '.$street.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:276px;left:500px;"><h1>ต. '.$tumbol.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:276px;left:600px;"><h1>อ. '.$aumper.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:303px;left:70px;"><h1>จ. '.$province.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:303px;left:190px;"><h1>'.$postcode.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:303px;left:520px;"><h1>'.$phone.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:380px;left:100px;width:620"><h1>'.$story/*_all*/.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:625px;left:516px; font-size:9px;"><h1>'.$nisitname.' '.$nisitlastname.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:328px;left:270px;"><h1>'.$countday.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:328px;left:400px;"><h1>'.$startdays.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:328px;left:480px;"><h1>'.$startmonths.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:328px;left:613px;"><h1>'.$startyears.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:355px;left:100px;"><h1>'.$enddays.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:355px;left:190px;"><h1>'.$endmonths.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:355px;left:313px;"><h1>'.$endyears.'&nbsp;</h1></div>';

$html .= '<div style="text-align:center;position:absolute;top:475px;left:70px;"><h1>'.$idsub1.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:475px;left:180px;"><h1>'.$namesub1.'&nbsp; </h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:476px;left:460px;"><h1>'.$secsub1.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:475px;left:560px;"><h1>'.$teachersub1.'&nbsp;</h1></div>';

$html .= '<div style="text-align:center;position:absolute;top:500px;left:70px;"><h1>'.$idsub2.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:500px;left:180px;"><h1>'.$namesub2.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:501px;left:460px;"><h1>'.$secsub2.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:500px;left:560px;"><h1>'.$teachersub2.'&nbsp;</h1></div>';

$html .= '<div style="text-align:center;position:absolute;top:525px;left:70px;"><h1>'.$idsub3.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:525px;left:180px;"><h1>'.$namesub3.'&nbsp; </h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:526px;left:460px;"><h1>'.$secsub3.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:525px;left:560px;"><h1>'.$teachersub3.'&nbsp;</h1></div>';

$html .= '<div style="text-align:center;position:absolute;top:550px;left:70px;"><h1>'.$idsub4.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:550px;left:180px;"><h1>'.$namesub4.'&nbsp; </h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:551px;left:460px;"><h1>'.$secsub4.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:550px;left:560px;"><h1>'.$teachersub4.'&nbsp;</h1></div>';

$html .= '<div style="text-align:center;position:absolute;top:575px;left:70px;"><h1>'.$idsub5.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:575px;left:180px;"><h1>'.$namesub5.'&nbsp; </h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:576px;left:460px;"><h1>'.$secsub5.'&nbsp;</h1></div>';
$html .= '<div style="text-align:center;position:absolute;top:575px;left:560px;"><h1>'.$teachersub5.'&nbsp;</h1></div>';
if($title =="นางสาว")
 {$html .= '<div style="font-size:14px;text-align:center;position:absolute;top:217px;left:165px;"><h1> / </h1></div>';
	}
	else if($title =="นาย")
	{$html .= '<div style="font-size:14px;text-align:center;position:absolute;top:217px;left:210px;"><h1> / </h1></div>';
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
			SET countday='$countday',status_form='$statusfile',pdf_file='$newname',draftA='$ajname',draftB='$bannum',draftC='$moo',draftD='$street',draftE='$tumbol',draftF='$aumper',draftG='$province',draftH='$postcode',draftI='$phone',draftJ='$story',draftK='$idsub1',draftL='$namesub1',draftM='$secsub1',draftN='$teachersub1',draftO='$idsub2',draftP='$namesub2',draftQ='$secsub2',draftR='$teachersub2',draftS='$idsub3',draftT='$namesub3',draftU='$secsub3',draftV='$teachersub3',draftW='$idsub4',draftX='$namesub4',draftY='$secsub4',draftZ='$teachersub4',draftAA='$idsub5',draftBB='$namesub5',draftCC='$secsub5',draftDD='$teachersub5'
			,draftselect='$select',draftstartdate='$startdate',draftenddate='$enddate' WHERE pdf_id = '$pdf_idd';
		";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
	if($btnSave <> 'Save'){
		$str = "แจ้งคำร้องจากนิสิต".
		"\r\n".'หมายเลขคำร้องที่ : #'.$pdf_idd.
	 "\r\n".'รหัสนิสิต : '.$nisitcode.
	 "\r\n".'ชื่อนิสิต : '.$nisitname.' '.$nisitlastname.
	 "\r\n".'ประเภทคำร้อง : ใบลา';
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
				( countday,pdf_id,pdf_file, path_link,nisit_id,advisor_id,type_form,status_form,draftA,draftB,draftC,draftD,draftE,draftF,draftG,draftH,draftI,draftJ,draftK,draftL,draftM,draftN,draftO,draftP,draftQ,draftR,draftS,draftT,draftU,draftV,draftW,draftX,draftY,draftZ,draftAA,draftBB,draftCC,draftDD,draftselect,draftstartdate,draftenddate) 
				VALUES
				('$countday','$pdf_idd','$newname', '$path','$nisitcode','$advisorid','ใบลา','$statusfile','$ajname','$bannum','$moo','$street','$tumbol','$aumper','$province','$postcode','$phone','$story','$idsub1','$namesub1','$secsub1','$teachersub1','$idsub2','$namesub2','$secsub2','$teachersub2','$idsub3','$namesub3','$secsub3','$teachersub3','$idsub4','$namesub4','$secsub4','$teachersub4','$idsub5','$namesub5','$secsub5','$teachersub5','$select'
				  ,'$startdate','$enddate')
		";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

	
			if($btnSave <> 'Save'){
			$str = "แจ้งคำร้องจากนิสิต".
			"\r\n".'หมายเลขคำร้องที่ : #'.$pdf_idd.
		 "\r\n".'รหัสนิสิต : '.$nisitcode.
		 "\r\n".'ชื่อนิสิต : '.$nisitname.' '.$nisitlastname.
		 "\r\n".'ประเภทคำร้อง : ใบลา';
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


mysqli_close($conn);

//$mpdf->Output();
$mpdf->Output($location.$newname, \Mpdf\Output\Destination :: FILE );
$button=$_REQUEST["btnSubmit"];
if ($button=="Submit") {
echo "<script type='text/javascript'>";
echo  "alert('ใบลาของคุณได้อัพโหลดแล้ว!');";
echo "window.location='../student/student_home.php';";
echo "</script>";}else{
	echo "<script type='text/javascript'>";
	echo  "alert('ใบลาของคุณได้บันทึกแบบร่างแล้ว!');";
	echo "window.location='../student/student_home.php';";
	echo "</script>";}
	

	}
//echo("วันนี้เป็นวัน  $TH_Day[$nDay]  ที่  $date  เดือน  $TH_Month[$nMonth]  ปี พ.ศ.  $year");
?>
