<?php
   session_start();

   if (!isset($_SESSION['student_login'])) {
       header("location: ../index.php");
   }
   include('..\connection.php');
$email=$_SESSION['student_login'];
$q1=$_GET['question1'];
$a1=$_GET['answer1'];
$q2=$_GET['question2'];
$a2=$_GET['answer2'];

//echo $q1. $a1. $q2. $a2;
$sql = "UPDATE testdb
SET q1 = '$q1' , a1 = '$a1' , q2 = '$q2' , a2 = '$a2'
WHERE email = '$email';";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

$query = mysqli_query($conn,$sql);
mysqli_close($conn);
if($query===TRUE) {
    echo "<script type='text/javascript'>";
        echo  "alert('คำถามลืมรหัสบันทึกเรียบร้อยแล้ว');";
        echo "window.close();";
        echo "</script>";
}
else{
echo "Record update fail";
}
?>