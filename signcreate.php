<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		 
			
		<title>Signature Create</title>
		<link href="./css/jquery.signaturepad.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="./js/numeric-1.2.6.min.js"></script> 
		<script src="./js/bezier.js"></script>
		<script src="./js/jquery.signaturepad.js"></script> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
		<script src="./js/json2.min.js"></script>
		
		
		<style type="text/css">
			body{
				font-family: 'Prompt', sans-serif;
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
				
				margin: 120px auto;
			}
			.sign-container {
				width: 60%;
				margin: auto;
			}
			.sign-preview {
				width: 150px;
				height: 50px;
				border: solid 1px #CFCFCF;
				margin: 10px 5px;
			}
			.tag-ingo {
				font-family: cursive;
				font-size: 12px;
				text-align: left;
				font-style: oblique;
			}
		
		</style>
		<link rel="stylesheet" href="style.css">
   
	</head>
	<body style="height: 120vh;">
	<div class="sidenav">
        
		<a href="../instructor/instructor_home.php">HOME</a>
	
        <button style="background-color: #111; color:#818181; width:100px; border:none; outline:none; font-size:18px; position:relative; right:42px "   onClick="javascript:location.reload();"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg> Clear</button>
		<button style="background-color: #111; width:200px; border:0px; position:relative; left:-10px " ><a style="font-size:18px;" href="del_sign.php"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg> ลบ</a></button>
		<a href="../logout.php"><svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/>
  <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/>
</svg> Logout</a>
            </div>
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
	
	$query2 = "SELECT path_link FROM tb_sign WHERE advisor_id = '$advisorid' ";
	$result2 = $conn->query($query2);
	if($result2->num_rows > 0){
		while($row2 = $result2->fetch_assoc())
			$pathlink = $row2["path_link"];
		}
		
	
?>




		<h2 style="font-family: Avant Garde, Avantgarde, Century Gothic, CenturyGothic, AppleGothic, sans-serif; 
		background-color: #57605D; font-size:35px; color:#C1B985; text-align:right; width:100%; height:50px;border:#57605D; border-bottom:#111 4px; border-style:solid;" >
		
		Create Signature <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-vector-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.4A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908l-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z"/>
  <path fill-rule="evenodd" d="M2.832 13.228L8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z"/>
</svg></h2>

        <?php if($pathlink <> ''){ ?>
			<h2 style="font-size: 20px; color: white; font-weight:lighter;" >ลายเซ็นของคุณล่าสุด</h2>
		<img src="../Eformpdf/<?=$pathlink;?>" style = "position:absolute top:200 left:300">
		<?php } ?>
		
		<div id="signArea" >
			<h2 style="font-size: 20px; color: white; font-weight:lighter;" >**โปรดเซ็นลายเซ็นในกรอบนี้</h2>
			<div class="sig sigWrapper" style="height:103px;">
				<div class="typed"></div>
				<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
			</div>
		</div>
		
		
		
		
		</div>
		<script>
   function Reload() {
	<?php echo "window.location = 'signcreate.php'"?>
   }
   </script>
		<form   name="form1" id="form1">

  <p>
	  
   
    &nbsp; &nbsp;
    <label>
    <button id="btnSaveSign" onclick="Reload()" >บันทึก</button>
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
		  
		 
   
          
  </p>
 
  
  
</form>
		
		

	</body>
</html>