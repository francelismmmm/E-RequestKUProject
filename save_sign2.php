<?php 
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
       
    }
    include('..\connection.php');
?>

<?php
include('..\connection.php');
$email = $_SESSION['instructor_login'];
	$query = "SELECT id_no FROM testdb WHERE email = '$email' ";
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc())
			$id = $row["id_no"];
		}
		
//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
date_default_timezone_set('Asia/Bangkok');

//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_his");
$numrand = (mt_rand());

$imagedata = base64_decode($_POST['img_data']);
$filename = $numrand.$date1.'.png';
//Location to where you want to created sign image
$path_link = 'doc_signs/'.$filename;




	$sql = "INSERT INTO tb_sign
	(advisor_id,sign_file, path_link)
	VALUES
	('$id','$filename','$path_link')";
	$result2 = mysqli_query($conn, $sql) or die ("คุณมีลายเซ็นอยู่แล้ว" . mysqli_error($conn));

if($result2){file_put_contents('./'.$path_link,$imagedata);}else{echo "ERROR";}
	

	
?>