<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="style.css" type="text/css"> 
<link rel="Shortcut Icon" type="image/x-icon" href="pickmeicon.ico" />
<!-- 引用CSS -->


</head>

<body>

	<div class="body-content" style="border:3px #025648 solid;">
	<!-- 設計邊框 文字效果-->

		<br><br>
		<font color="#e595b3" size="7"><b>Join Now</b></font>

		<!--建立<form>，要求使用者必須填寫ID、帳號、密碼、性別-->
		<form action="" method="post"><!--將資訊傳給自己-->
		<font color="#025648"><b>帳號:</b></font>  <input type="text" name="name"required><br><br>
		<font color="#025648"><b>密碼: </b></font> <input type="text" name="pw"required><br><br>
		<font color="#025648"><b>信箱: </b></font> <input type="text" name="email"required><br><br>
		<input type="radio" name="isowner" value="1" checked> <font color="#025648"><b>賣家</b></font>
		<input type="radio" name="isowner" value="0"> <font color="#025648"><b>買家</b></font><br>><br>
		<input type="submit"style="width:60px;height:25px;border:3px #e595b3 double;" onClick="window.open('login.html')">
		</form>


		<?php
		if($_POST){


		$servername = "localhost";//連接伺服器
		$username = "root";
		$password = "0513403";
		$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱


		 $name = $_POST['name'];
		 $pw = $_POST['pw'];
		 $email = $_POST['email'];
		 $isowner = $_POST['isowner'];

		 $conn = new mysqli($servername, $username, $password, $dbname);//create connection
		 $sql=" INSERT into member(name,pw,email,isowner)VALUES('$name','$pw','$email','$isowner')";
		 //利用SQL將會員資料INSERT至資料庫
		$conn->query($sql);

		}
		?>
	</div>
</body>
</html>
