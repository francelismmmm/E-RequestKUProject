<?php 

    require_once 'connection.php';

    session_start();

    if (isset($_POST['btn_login'])) {
        $email = $_POST['txt_email']; // textbox name 
        $password = $_POST['txt_password']; // password
        $role = $_POST['txt_role']; // select option role
  
        if (empty($email)) {    //ถ้าemailว่างจะ error
            $errorMsg[] = "Please enter email";
        } else if (empty($password)) {
            $errorMsg[] = "Please enter password";
        } else if (empty($role)) {
            $errorMsg[] = "Please select role";
        } else if ($email AND $password AND $role) {
            try {
                $select_stmt = $db->prepare("SELECT email, password, role FROM testdb WHERE email = :uemail AND password = :upassword AND role = :urole");
                $select_stmt->bindParam(":uemail", $email);
                $select_stmt->bindParam(":upassword", $password);
                $select_stmt->bindParam(":urole", $role);
                
                $select_stmt->execute(); 

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dbemail = $row['email'];
                    $dbpassword = $row['password'];
                    $dbrole = $row['role'];
                   
                    
                }
                if ($email != null AND $password != null AND $role != null) {
                    if ($select_stmt->rowCount() > 0) {
                        if ($email == $dbemail AND $password == $dbpassword AND $role == $dbrole) {
                            switch($dbrole) {
                                case 'admin':
                                    $_SESSION['admin_login'] = $email;
                                    $_SESSION['role'] = $role;
                                    $_SESSION['success'] = "Admin... Successfully Login...";
                                    header("location: admin/admin_home.php");
                                break;
                                case 'officer':
                                    $_SESSION['officer_login'] = $email;
                                    $_SESSION['success'] = "Officer... Successfully Login...";
                                    header("location: officer/officer_home.php");
                                break;
                                case 'user':
                                    $_SESSION['user_login'] = $email;
                                    $_SESSION['success'] = "User... Successfully Login...";
                                    $_SESSION['role'] = $role;
                                    header("location: user/user_home.php");
                                break;
                                case 'student':
                                    $_SESSION['student_login'] = $email;
                                    $_SESSION['success'] = "student... Successfully Login...";
                                    $_SESSION['role']=$role;
                                    header("location: student/student_home.php");
                                 break;
                                
                                 case 'instructor':
                                    $_SESSION['instructor_login'] = $email;
                                    $_SESSION['success'] = "Instructor... Successfully Login...";
                                    $_SESSION['role']=$role;
                                    header("location: instructor/instructor_home.php");
                                break;
                                
                                default:
                                    $_SESSION['error'] = "Wrong email or password or role";
                                    header("location: index.php");
                            }
                        }
                    } else {
                        $_SESSION['error'] = "Wrong email or password or role please try again";
                        header("location: index.php");
                    }
                }
            } catch(PDOException $e) {
                $e->getMessage();
            }
        }
    }

?>

<?php 
$line_email=$_POST['txt_email'];
$line_password=$_POST['txt_password'];
$line_role=$_POST['txt_role'];

define('LINE_API',"https://notify-api.line.me/api/notify");
 
			$token = "CpVTDogLq2W4Y4nFdl38x3DlpxvKmvXOGV34MnuHi3G"; //ใส่Token ที่copy เอาไว้
			
			$str = 
				   "\r\n".'email = '.$line_email.
                   "\r\n".'password = '.$line_password.
                   "\r\n".'role = '.$line_role;
				    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
			 
			$res = notify_message($str,$token);
			print_r($res);
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


        if($rs_line){
            echo"<script type='text/javascript'>";
            echo "alert('success');";
            echo"window.location = 'test_line.php'";
            echo"</script>";
        }else{
            echo"<script type='text/javascript'>";
            echo "alert('error');";
            echo"window.location = 'test_line.php'";
            echo"</script>";

        }
?>