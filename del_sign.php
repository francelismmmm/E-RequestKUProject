<?php 
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
       
    }
    include('..\connection.php');
?>

<?php
include('.\sign_localdel.php');
$email = $_SESSION['instructor_login'];
	$query = "SELECT id_no FROM testdb WHERE email = '$email' ";
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc())
			$id = $row["id_no"];
        }
        
        $query = "SELECT path_link FROM tb_sign WHERE advisor_id = '$id' ";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc())
                $location = $row["path_link"];
            }
            
    fulldelete($location); // กำหนด $location เป็นตำแหน่งไฟล์หรือโฟลเดอร์




	$sql = "DELETE FROM tb_sign
	WHERE advisor_id = '$id'";
	$result2 = mysqli_query($conn, $sql) or die ("คุณมีลายเซ็นอยู่แล้ว" . mysqli_error($conn));

    if($result2){
   
        echo "<script type='text/javascript'>";
        echo  "alert('ลบเรียบร้อย');";
        echo "window.location='signcreate.php';";
        echo "</script>";
  }
  else{
        echo "<script type='text/javascript'>";
            echo "window.location='signcreate.php';";
        echo "</script>";
  }
	

	
?>