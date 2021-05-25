<?php
//1. เชื่อมต่อ database: 
include('connection.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//สร้างตัวแปรสำหรับรับค่า member_id จากไฟล์แสดงข้อมูล
$id = $_POST["id"];
$status = $_POST["txt_status"];
$email = $_POST["txt_email"];
$password = $_POST["txt_password"];
$title = $_POST["txt_title"];
$name = $_POST["txt_name"];
$lastname = $_POST["txt_lastname"];
$idno = $_POST["txt_id_no"];
$years = $_POST["txt_years"];
$major = $_POST["txt_major"];
$advisorid = $_POST["txt_advisor_id"];
$role = $_POST["txt_role"];
$phoneNo = $_POST["txt_phoneNo"];
$bannum = $_POST["txt_bannum"];
$moo = $_POST["txt_moo"];
$roadname = $_POST["txt_roadname"];
$tumbon = $_POST["txt_tumbon"];
$aumper = $_POST["txt_aumper"];
$city = $_POST["txt_city"];
$postcode = $_POST["txt_postcode"];
//ลบข้อมูลออกจาก database ตาม member_id ที่ส่งมา
$sql = "UPDATE testdb 
SET email='$email',password='$password',title='$title',name='$name',lastname='$lastname',id_no='$idno',years='$years',major='$major',status='$status',
advisor_id='$advisorid',role='$role',phonenum='$phoneNo',bannum='$bannum',moo='$moo',roadname='$roadname',tumbon='$tumbon',aumper='$aumper',city='$city',postcode='$postcode'
WHERE id = '$id';
";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

 
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('ระบบอัพเดตข้อมูลบัญชีเสร็จสิ้น');";
	echo "window.location = 'account.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('ระบบไม่สามารถอัพเดตข้อมูลได้ โปรดลองอีกครั้ง');";
	echo "</script>";
}
?>