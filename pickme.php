<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  }
?>
	
<!DOCTYPE html>
<html>

<!-- 標題 -->
<head>
<title>PickMe | 百裡挑衣</title>

<link rel="stylesheet" href="pickmestyle.css" type="text/css">  
<link rel="Shortcut Icon" type="image/x-icon" href="pickmeicon.ico" />

<!-- 音樂 -->
<script type="text/javascript">
	//function playPause() {
	//var song = document.getElementsByTagName('audio')[0];
	//if (song.paused)
	//	song.play();
	//else
	//	song.pause();
 //}
	function playPause() {
		var music = document.getElementById('music2');
		var music_btn = document.getElementById('music_btn2');
		if (music.paused){
			music.play();
			music_btn2.src = 'r1.png';
		}
		else{
			music.pause();
			music_btn2.src = 'r2.png'; 
		}
	}
</script>

</head>

<body>

	<!-- 上欄 -->
	<div class="top">
		
		<?php  if (isset($_SESSION['username'])) : //登入狀態?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>, -->
    	<a class="pointer" href="pickme.php?logout='1'" >logout</a>
		<a class="pointer" href="manage.php" style="font-family:SetoFont">賣家廣場</a>
		<?php endif ?>
		
		<?php  if (!isset($_SESSION['username'])) : //尚未登入狀態?>
    	<a class="pointer" onClick="location.href='login.html';">Login</a>
		<?php endif ?>
		
		<a href="#bag">Shopping Bag</a>
		
			
		<!-- 音樂 -->
		<!--<div class="thumbnail" id="paparazzixxx">
			<a href="javascript:playPause();">
			<img id="play" src="r1.png"/>
			</a>
			<audio id="paparazzi">
			<source src="../audio/fernando_garibay_paparazzisnlmix.ogg" type="audio/ogg"/>
			<source src="pickme.mp3" type="audio/mpeg"/>
			</audio>
		</div>-->
		<div class="mucon">
			<audio id="music2" src="pickme.mp3" autoplay="autoplay" loop="loop"></audio>
			<a href="javascript:playPause();"><img src="r1.png" width="20" height="20" style="background-color:white" id="music_btn2" border="0"></a>
		</div>
		
		<form action="search.php" method="post">
			<input type="text" placeholder="想找甚麼衣服呢?" name="searchtxt">
			<button type="submit">搜尋</button>
		</form>
	</div>
	
		<?php if (isset($_SESSION['success'])) :
			unset($_SESSION['success']);
        	endif ?>
	
	
	
	<!-- 左欄 -->
	<div id="mainmenu" class="leftcolumn">
			
			<!-- 商標 -->
			<br>
			<img src="pickme.png" class="pointer" height="80" width="250" onClick="location.href = 'pickme.php';">
			<br><br>
			
			<!-- 商品 -->
			<div id="item">
			<a class="bar-item button pointer" onClick="location.href='newarrivals.html';">~NEW ARRIVALS~</a>
			<a class="bar-item button pointer" onClick="location.href='top20.html';">TOP 20</a>
			<a class="bar-item button pointer" onClick="location.href='sale.html';">SALE -up to 70% off-</a>
			<b>Shop by Categories</b>
			<a class="bar-item button pointer" onClick="location.href='tops.html';">Tops</a>
			<a class="bar-item button pointer" onClick="location.href='bottoms.html';">Bottoms</a>
			<a class="bar-item button pointer" onClick="location.href='dresses.html';">Dresses</a>
			<a class="bar-item button pointer" onClick="location.href='jackets.html';">Jackets</a>
			<a class="bar-item button pointer" onClick="location.href='sets.html';">Sets</a>
			</div>
			
			<!-- 資訊 -->
			<div id="info">
			<b>About PickMe</b>
			<a class="bar-item button pointer" onClick="location.href='introduction.html';">Who are we</a>
			<a class="bar-item button pointer" onClick="location.href='contact.html';">Contact</a>
			</div>
			
	</div>
	
	<div id="itemcondition" class="content">
		<table border="1" style="width:60%; margin:auto auto; text-align:center;">
		<tr>
		<td style="font-family:SetoFont">商品名稱</td>
		<td style="font-family:SetoFont">商品庫存</td>
		<td style="font-family:SetoFont">商品展示</td>
		</tr>
	<?php
		$servername = "localhost";//連接伺服器
		$username = "root";
		$password = "0513403";
		$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱	
		$conn = new mysqli($servername, $username, $password, $dbname);//create connection
		mysqli_query($conn, "SET NAMES 'UTF8'");
		$select="select * from clothes";
		$data=mysqli_query($conn,$select);//從member中選取全部(*)的資料
		$sql=sprintf("select * from clothes ORDER BY cnum");
		$result=$conn->query($sql);
	?>

		<?php
			while($row = mysqli_fetch_array($result)) {
			?>
		<tr>
		<td style="font-family:SetoFont"><?php echo $row[0]?></td>
		<td style="font-family:SetoFont"><?php echo $row[2]?></td>
		<td style="font-family:SetoFont">	
			<img width="120" height="120" src="image.php?cnum=<?php echo $row["cnum"]; ?>" /><br/>			
		</td>
		</tr>
		<?php
			}
		?>

		</table>
	</div>
	
	
</body>

</html>
