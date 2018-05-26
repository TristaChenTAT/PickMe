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
<link rel="stylesheet" href="stylew3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- 音樂 -->
<script type="text/javascript">
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

<style>
body.modal-open {
    position: fixed;
	width:100%;
	
}
</style>
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
		<div class="mucon">
			<audio id="music2" src="pickme.mp3" autoplay="autoplay" loop="loop"></audio>
			<a href="javascript:playPause();"><img src="r1.png" width="20" height="20" style="background-color:white" id="music_btn2" border="0"></a>
		</div>
		
		<!-- 搜尋 -->
		<form action="search.php" method="post">
			<button type="submit">搜尋</button>
			<input type="text" placeholder="想找甚麼衣服呢?" name="searchtxt">
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
			</div>
			
	</div>
	
	
	<!-- 內容 -->
	<div id="itemcondition" class="content">
		<table border="1" style="width:60%; margin:auto auto; text-align:center;">
		<tr>
		<td style="font-family:SetoFont">商品名稱</td>
		<td style="font-family:SetoFont">商品庫存</td>
		<td style="font-family:SetoFont">商品展示</td>
		<td style="font-family:SetoFont">售價</td>
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
		$count=0;
	?>

		<?php
			while($row = mysqli_fetch_array($result)) {
			?>
		<div>
		<?php if($count == 4){
			?>
			<tr></tr>
			<?php $count=0;
		}
		?>
		<td style="font-family:SetoFont">	
			<input type="image" width="200" height="200" src="image.php?cnum=<?php echo $row["cnum"]; ?>"
			title="<?php echo $row[0]?>" onClick="onClick(this,'<?php echo $row[2]?>','<?php echo $row[5]?>','<?php echo $row[4]?>')">			
		<p style="font-family:SetoFont; font-size:15pt;"><?php echo $row[0]?></p>
		<p style="font-family:SetoFont; font-size:15pt;">$<?php echo $row[4]?></td>

		</td>
		</div>
		<?php
			$count=$count+1;	
			}
		?>
		</tr>	
		</table>
	</div>
	<!-- modal的內容-->
	<div id="intro" class="modal fade" tabindex="-1" role="dialog">
		<div class="w3-modal-content w3-animate-zoom">
			<div class="w3-container w3-black">
				<h2><button type="button" class="close" data-dismiss="modal" style="color: white;">x</button></h2>						
				<h1><div id="test" style="font-family:SetoFont"></div></h1>
			</div>

			<div class="w3-container">
				<img id="img01" width="300" height="300">
			</div>
			<div class="w3-container w3-black">
				<h1><div style="font-family:SetoFont">商品庫存</div></h1>
			</div>
			<div class="w3-container">
				<h2><div id="inven" style="font-family:SetoFont"></div></h2>
			</div>
			<div class="w3-container w3-black">
				<h1><div style="font-family:SetoFont">商品資訊</div></h1>
			</div>
			<div class="w3-container">
				<h2><div id="money" style="font-family:SetoFont"></div></h2>
				<HR color="#000000" size="50px" width="100%">
				<h2><div id="si" style="font-family:SetoFont"></div></h2>
				<div class="modal-footer">
					<button type="button" style="font-family:SetoFont;font-size:25px;width:150px;height:40px;right:0;top:-10%;" onClick="alert('成功加入商品' )">加入購物車</button>
				</div>
			</div>
			
			
		</div>
	</div>
	
	<!--提示內容-->

	<!--購物車添加成功提示-->
	<!--call modal的function-->
	<script>
	

	function onClick(element,inventory,size,mon)
     {
		 
		 document.getElementById("img01").src = element.src;
		 document.getElementById("test").innerHTML = "商品名稱: " + element.title;
		 document.getElementById("inven").innerHTML = inventory;
		 document.getElementById("si").innerHTML = "尺寸" + size;
		 document.getElementById("money").innerHTML ="NT$" + mon;
		 document.getElementById("intro").style.display = "block";
         $("#intro").modal();
		 
         
     }
	</script>	

	
</body>

</html>
