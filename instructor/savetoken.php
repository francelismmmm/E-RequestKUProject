<?php 
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
        header("location: ../index.php");
    }
    include('..\connection.php');
?>
<?php
$token=$_REQUEST["txt_token"];
$email=$_SESSION['instructor_login'];

$sql = "UPDATE testdb
			SET token ='$token'
			WHERE email = '$email';
		";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

echo "<script type='text/javascript'>";
echo  "alert('บันทึก Line Notify token ลงในระบบเสร็จสิ้น');";
echo "window.location='../instructor/inputtoken.php';";
echo "</script>";
?>