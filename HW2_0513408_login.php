<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="style.css" type="text/css"> 
<!-- 引用CSS -->

</head>

<body>
	<div class="body-content" style="color:#e595b3 ;font-size:xx-large;border:3px #025648 solid;">
	<!-- 設計邊框 文字效果-->
	
	<br><br><br><br>
		<?php
				include ("HW2_0513408_connMySQL.php");
				$name = $_POST['name'];
				$pw = $_POST['pw'];
				if(isset($name)&&isset($pw)){
							$sql ="SELECT name,pw FROM member WHERE name='$name'";                     
							$result = $conn->query($sql);
								  if($result->num_rows > 0){
								 while($row = $result->fetch_assoc()){
									if($row["name"]==$name&&$row["pw"]==$pw){
										echo "登入成功！ 歡迎使用本系統";
										echo '<meta http-equiv=REFRESH CONTENT=1;url=HW2_0513408_home1.php>';
									}else{
										echo "登入失敗！";
									}
							}}else{
								echo "資料庫連接失敗";
							}
				}else{
					echo "未輸入帳號密碼";
				}
		?>
	</div>
</body>
</html>