<meta charset="UTF-8" />
<?php 
    session_start();

    if (!isset($_SESSION['student_login'])) {
        header("location: ../index.php");
    }
	include('..\connection.php');
	
     
?>

<?php $original_date = date("d");
$original_wday = date("l");
$original_month = date("F");
$original_year = date("Y");



$TH_Day = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$TH_Month = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

$nDay = date("w");
$nMonth = date("n")-1;
$date = date("j");
$year = date("Y")+543;

?>

<?php 
require_once('connection.php');



    //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_his");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
	
	//รับชื่อไฟล์จากฟอร์ม 
	$pdf_file = (isset($_REQUEST['pdf_file']) ? $_REQUEST['pdf_file'] : '');
	
	$upload=$_FILES['pdf_file'];
	if($upload <> '') { 
 
	//โฟลเดอร์ที่เก็บไฟล์
	$path="pdf/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['pdf_file']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname =$numrand.$nisitid.$original_date.$original_month.$original_year.$type;
 
	$path_copy=$path.$newname;
	$path_link="pdf/".$newname; //ตัวเก็บตำแหน่งไฟล์ ใช้ในการเรียกมาแสดงได้ เช่นกรณีเก็บเป็นรูปไว้ในโฟลเดอร์pdf  Img:<img style="width: 200px;height: 200px" src="pdf/<?php print_r $name_file?ง>"> ง ขั้นไว้เฉยๆ
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['pdf_file']['tmp_name'],$path_copy);  
	$id_pdf= mysqli_query($conn,"SELECT pdf_id FROM tb_pdf") or die(mysqli_error($link));
	while($info=mysqli_fetch_array($id_pdf))	
	if($info['pdf_id']>=1){ 
		$pdf_idd=$info['pdf_id'];
		$pdf_idd+=1;
    }else{
        $pdf_idd=1;
    }

	
	}
 
 
			 $sql = "INSERT INTO tb_pdf 
					( pdf_id,nisit_id,advisor_id,pdf_file, path_link) 
					VALUES
					('$pdf_idd','$nisitid','$advisorid','$newname','$path_link')
			";
		
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($link));
 
	mysqli_close($link);
 
 
	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('xxxxxxxxxx');";
			echo "window.location='upload.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				echo "window.location='upload.php';";
			echo "</script>";
	  }
 
 ?>