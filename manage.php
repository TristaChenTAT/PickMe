<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="Shortcut Icon" type="image/x-icon" href="pickmeicon.ico" />
</head>

<body>

		<h2>新增商品</h2>
		<!--建立<form>，要求使用者必須填寫ID、帳號、密碼、性別-->
		<form action="" method="post" enctype="multipart/form-data"><!--將資訊傳給自己-->
		<font color="#025648"><b>衣服名稱:</b></font>  <input type="text" name="clothesname"required><br><br>
		<font color="#025648"><b>庫存數量: </b></font> <input type="number" name="inventory"required><br><br>
		<br>
		<input type="file" name="image" />
		<input type="submit"style="width:60px;height:25px;border:3px #e595b3 double;">
		</form>
			
		
		Hello there!
		<a href='display.php'>display</a>

		<?php
		if($_POST){
		$servername = "localhost";//連接伺服器
		$username = "root";
		$password = "123";
		$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱

		$clothesname = $_POST['clothesname'];
		$inventory = $_POST['inventory'];
		
		$filename=$_FILES['image']['name'];
		$tmpname=$_FILES['image']['tmp_name'];
		$filetype=$_FILES['image']['type'];
		$filesize=$_FILES['image']['size'];    
		$file=NULL;
		
		if(isset($_FILES['image']['error'])){    
			if($_FILES['image']['error']==0){                                    
				$instr = fopen($tmpname,"rb" );
				$file = addslashes(fread($instr,filesize($tmpname)));        
			}
		}	
		$conn = new mysqli($servername, $username, $password, $dbname);//create connection
		mysqli_query($conn, "SET NAMES 'UTF8'");
		$imagedata = sprintf("(%s)","'".$file."'");
		$sql="INSERT into clothes(cname,cinventory,image)VALUES('$clothesname',$inventory,$imagedata)";
		 //利用SQL將會員資料INSERT至資料庫
		$conn->query($sql);
		}
		
		?>

		
		
</body>

</html>
