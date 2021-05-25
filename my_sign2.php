<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>jQuery Signature Pad & Canvas Image</title>
		<link href="./css/jquery.signaturepad.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./js/numeric-1.2.6.min.js"></script> 
		<script src="./js/bezier.js"></script>
		<script src="./js/jquery.signaturepad.js"></script> 
		
		<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
		<script src="./js/json2.min.js"></script>
		
		
		<style type="text/css">
			body{
				font-family:monospace;
				text-align:center;
			}
			#btnSaveSign {
				color: #fff;
				background: #f99a0b;
				padding: 5px;
				border: none;
				border-radius: 5px;
				font-size: 20px;
				margin-top: 10px;
			}
			#signArea{
				width:304px;
				margin: 50px auto;
			}
			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px green;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}
		</style>
	</head>
	<body>
	<?php 
    session_start();

    if (!isset($_SESSION['instructor_login'])) {
        
    }
	include('..\connection.php');
	
	
	$email=$_SESSION['instructor_login'];
	$query = "SELECT id_no FROM testdb WHERE email = '$email' ";
	$result = $conn->query($query);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc())
			$advisorid = $row["id_no"];
		}
		
	
?>




		<h2>Create Signature Image</h2>
		
		<div id="signArea" >
			<h2 class="tag-ingo">Put Signature Below,</h2>
			<div class="sig sigWrapper" style="height:auto;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
			</div>
		</div>
		
		
		
		
		</div>
		
		<form   name="form1" id="form1">

  <p>
	  
    <button  onClick="javascript:location.reload();">Clear</button>
    &nbsp; &nbsp;
    <label>
    <button id="btnSaveSign">Save Signature</button>
    </label>
	&nbsp; &nbsp;
	<!--<?php/*
	$sqll ="SELECT advisor_id FROM tb_sign ";
	$result = mysqli_query($conn, $sqll) or die ("Error in query: $sql " . mysqli_error($conn));
	while($row = mysqli_fetch_array($result))
	{if($row['advisor_id']=$advisor_id)
   	 {
        echo "<script type='text/javascript'>";
			echo  "alert('คุณได้สร้างลายเซ็นไว้อยู่แล้ว!');";
			echo "window.location='my_sign2.php';";
			echo "</script>";
   // }else{*/?>-->
 <script>
			$(document).ready(function() {
				$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
			});
			
			$("#btnSaveSign").click(function(e){
				html2canvas([document.getElementById('sign-pad')], {
					onrendered: function (canvas) {
						var canvas_img_data = canvas.toDataURL('image/png');
						var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
						//ajax call to save image inside folder
						$.ajax({
							url: 'save_sign2.php',
							data: { img_data:img_data },
							type: 'post',
							dataType: 'json',
							
						});
					}
				});
                
			});

           
          </script> 
          
    <?php
	//}

	//} //mysqli_close($conn);
	echo $advisorid;?>
   
          
  </p>
</form>
		
		

	</body>
</html>