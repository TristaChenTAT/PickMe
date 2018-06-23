<?php 
  session_start(); 
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
	unset($_SESSION['isowner']);
  }
?>
	
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="pickmestyle.css" type="text/css">  
<link rel="Shortcut Icon" type="image/x-icon" href="pickmeicon.ico" />
</head>

<body>
	
	<!-- 上欄 -->
	<div class="top" style="cursor:url('poro.cur'),auto;">
		
		<?php  if (isset($_SESSION['username'])) : //登入狀態?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>, -->
    	<a class="pointer" href="pickme.php?logout='1'" >logout</a>
		<?php endif ?>
		<?php  if (isset($_SESSION['isowner'])&&($_SESSION['isowner']==1)) ://賣家登入狀態?>
		<a class="pointer" href="manage.php" style="font-family:SetoFont; background-color: #4d4d4d;">賣家廣場</a>
		<?php endif ?>
		
		<?php  if (!isset($_SESSION['username'])) : //尚未登入狀態?>
    	<a class="pointer" onClick="location.href='login.html';">Login</a>
		<?php endif ?>
			
		<!-- 音樂 -->
		<div class="mucon">
			<audio id="music2" src="pickme.mp3" loop="loop"></audio>
			<a href="javascript:playPause();"><img src="r1.png" width="20" height="20" style="background-color:white" id="music_btn2" border="0"></a>
		</div>

		
	</div>
	
	<?php if (isset($_SESSION['success'])) :
			unset($_SESSION['success']);
        	endif ?>
			
	<!-- 左欄 -->
	<div id="mainmenu" class="leftcolumn" style="cursor:url('poro.cur'),auto;">
			
			<!-- 商標 -->
			<br>
			<img src="pickme.png" class="pointer" height="80" width="250" onClick="location.href = 'pickme.php';">
			<br><br>
			
			<!-- 商品 -->
			<div id="item">
			<a class="bar-item button pointer" onClick="location.href='newarrivals.php';">~NEW ARRIVALS~</a>
			<a class="bar-item button pointer" onClick="location.href='#';">TOP 20</a>
			<a class="bar-item button pointer" onClick="location.href='#';">SALE -up to 70% off-</a>
			<b>Shop by Categories</b>
			<a class="bar-item button pointer" onClick="location.href='#';">Tops</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Bottoms</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Dresses</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Jackets</a>
			</div>
			
			<!-- 資訊 -->
			<div id="info">
			<b>About PickMe</b>
			<a class="bar-item button pointer" onClick="location.href='whoarewe.php';">Who are we</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Contact</a>
			<a class="bar-item button pointer" onClick="location.href='message.php';">Message</a>
			</div>
			
	</div>
	
	<h1 style="margin-top: 100px; text-align:center; color:black;">賣家廣場</h1>
	
		<div class="table" style="margin-top:50px;">
			<h1>新增商品</h1>
			<!--建立<form>，要求使用者必須填寫ID、帳號、密碼、性別-->
			<form action="" method="post" enctype="multipart/form-data"><!--將資訊傳給自己-->
			<font color="#025648"><b>衣服名稱:</b></font>  <input type="text" name="clothesname"required><br><br>
			<font color="#025648"><b>尺寸大小:</b></font>  <input type="text" name="csize"required><br><br>
			<font color="#025648"><b>定價:</b></font>  <input type="number" name="cprice"required><br><br>
			<font color="#025648"><b>分類:</b></font>
			<select name="category">
				<option selected value="top">上衣</option>
				<option value="bottom">褲子</option>
				<option value="dress">裙子</option>
				<option value="jacket">外套</option>
			</select>
			<br><br>
			<font color="#025648"><b>庫存數量: </b></font> <input type="number" name="inventory"required><br><br>
			<br>
			<div class="input">
				<input type="file" name="image" />
				<br><br><br>
				<input type="submit"style="width:60px;height:25px;border:3px #e595b3 double;">
			</div>
			</form>
		</div>


		<?php
		if($_POST){
		$servername = "localhost";//連接伺服器
		$username = "root";
		$password = "0513403";
		$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱
		$clothesname = $_POST['clothesname'];
		$inventory = $_POST['inventory'];
		$csize = $_POST['csize'];
		$cprice = $_POST['cprice'];
		//$category = $_POST['#category'];
		$category = isset($_POST['category']) ? $_POST['category'] : "top";
		
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
		
		$sql = "INSERT INTO `clothes`(`cname`, `cinventory`, `image`, `cprice`, `csize`, `category`) VALUES ('$clothesname',$inventory, $imagedata ,$cprice,'$csize','$category')";
		$conn->query($sql);
		}
		
		?>

		
		
</body>

</html>
