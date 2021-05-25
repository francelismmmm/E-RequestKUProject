<?php

if($_FILES['attch_file']['tmp_name'][0] == ''){
	echo "<script type='text/javascript'>";
echo  "alert('ไม่พบไฟล์!');";
echo "window.location='admin/account.php';";
echo "</script>";
}else{
 
foreach($_FILES['attch_file']['tmp_name'] as $key => $val)
{ 
$upload=$_FILES['attch_file'];
  if($upload <> ''){ 
 
	$file_tmp =$_FILES['attch_file']['tmp_name'][$key];
	$newname2 = 'CreateAccount.xlsx';
	move_uploaded_file($file_tmp,"admin/".$newname2);
	}

}



include 'connection.php';
/** PHPExcel */
require_once('./Classes/PHPExcel.php');

/** PHPExcel_IOFactory - Reader */
include './Classes/PHPExcel/IOFactory.php';


$inputFileName = "admin/CreateAccount.xlsx";  



$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  

//$objReader->setReadDataOnly(true); 

$objPHPExcel = $objReader->load($inputFileName);  

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}


$objConnect = mysqli_connect("localhost","root","") or die(mysqli_error($conn));
$objDB = mysqli_select_db($conn,"eform");
$i = 0;
$noti = mysqli_query($conn,"SELECT id FROM testdb ")  or die(mysqli_error($conn));
    $idd = mysqli_num_rows($noti);
	
foreach ($namedDataArray as $result) {
	$idd = $idd+1;
	//$id_pdf= mysqli_query($conn,"SELECT id FROM testdb") or die(mysqli_error($conn));
	/*$id_pdf = $conn->query($conn,"SELECT id FROM testdb");
	while($info=mysqli_fetch_array($id_pdf))	
	if($info -> num_rows > 0){ 
	echo	
		}
		if($id_pdf->num_rows > 0){
			while($info = $id_pdf->fetch_assoc()){
			$idd=$info['id'];
		    $idd+=1;}
			}*/
	$strSQL = "";
	$strSQL .= "INSERT INTO testdb ";
	$strSQL .= "(id,email,password,role,title,name,lastname,id_no,years,faculty,major,department,advisor_id,bannum,moo,roadname,tumbon,aumper,city,postcode,phonenum) ";
	$strSQL .= "VALUES ";
	$strSQL .= "('".$idd."','".$result["E-Mail"]."','".$result["รหัสสำหรับเข้าใช้ระบบ"]."' ";
	$strSQL .= ",'student','".$result["คำนำหน้าชื่อ"]."','".$result["ชื่อจริง"]."' ";
	$strSQL .= ",'".$result["นามสกุล"]."','".$result["รหัสนิสิต"]."' ";
	$strSQL .= ",'1','".$result["คณะ"]."','".$result["สาขาวิชา"]."' ";
	$strSQL .= ",'".$result["ภาค"]."','".$result["รหัสอาจารย์ที่ปรึกษา"]."' ";
	$strSQL .= ",'".$result["เลขที่บ้าน"]."','".$result["หมู่"]."' ";
	$strSQL .= ",'".$result["ถนน"]."','".$result["ตำบล"]."' ";
	$strSQL .= ",'".$result["อำเภอ"]."','".$result["จังหวัด"]."' ";
	$strSQL .= ",'".$result["รหัสไปรษณีย์"]."','".$result["เบอร์โทร"]."') ";

	mysqli_query($conn,$strSQL) ;
	
  }
mysqli_close($objConnect);
echo "<script type='text/javascript'>";
echo  "alert('เพิ่มบัญชีนิสิตเรียบร้อย!');";
echo "window.location='admin/account.php';";
echo "</script>";}
?>