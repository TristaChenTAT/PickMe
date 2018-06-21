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

<!-- 標題 -->
<head>
<title>Messages | 百裡挑衣</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<div class="top" style="cursor:url('poro.cur'),auto;">
		
		<?php  if (isset($_SESSION['username'])) : //登入狀態?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>, -->
    	<a class="pointer" href="pickme.php?logout='1'" >logout</a>
		<?php endif ?>
		<?php  if (isset($_SESSION['isowner'])&&($_SESSION['isowner']==1)) ://賣家登入狀態?>
		<a class="pointer" href="manage.php" style="font-family:SetoFont">賣家廣場</a>
		<?php endif ?>
		
		<?php  if (!isset($_SESSION['username'])) : //尚未登入狀態?>
    	<a class="pointer" onClick="location.href='login.html';">Login</a>
		<?php endif ?>
		
		<a class="pointer" href="shopbag.php">Shopping Bag</a>
		
			
		<!-- 音樂 -->
		<div class="mucon">
			<audio id="music2" src="pickme.mp3" loop="loop"></audio>
			<a href="javascript:playPause();"><img src="r1.png" width="20" height="20" style="background-color:white" id="music_btn2" border="0"></a>
		</div>
		
		<!-- 搜尋 -->
		<form action="search.php" method="post">
			<button type="submit" style="float:right; font-family:SetoFont; font-size:12pt; margin-top:10px;">搜尋</button>
			<input type="text" placeholder="想找甚麼衣服呢?" name="searchtxt" style="float:right; font-family:SetoFont; font-size:12pt; margin:12px 5px;" >
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
			<a class="bar-item" style="font-size:15pt; background-color:rgba(61, 139, 173, 0.8);">~NEW ARRIVALS~</a>
			<a class="bar-item button pointer" onClick="location.href='#';">TOP 20</a>
			<a class="bar-item button pointer" onClick="location.href='#';">SALE -up to 70% off-</a>
			<b>Shop by Categories</b>
			<a class="bar-item button pointer" onClick="location.href='#';">Tops</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Bottoms</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Dresses</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Jackets</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Sets</a>
			</div>
			
			<!-- 資訊 -->
			<div id="info">
			<b>About PickMe</b>
			<a class="bar-item button pointer" onClick="location.href='whoarewe.php';">Who are we</a>
			<a class="bar-item button pointer" onClick="location.href='#';">Contact</a>
			<a class="bar-item button pointer" onClick="location.href='message.php';">Message</a>
			</div>
			
	</div>
	
	
	<!-- 中間欄 -->
	
	<div id="itemcondition" class="content">
		<br></br>
		<br></br>
		<!--標題-->
	
		<?php
		$servername = "localhost";//連接伺服器
		$username = "root";
		$password = "0513403";
		$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱	
		$conn = new mysqli($servername, $username, $password, $dbname);//create connection
		mysqli_query($conn, "SET NAMES 'UTF8'");
		$select="select * from message";
		$data=mysqli_query($conn,$select);//從member中選取全部(*)的資料
		for($i=1;$i<=mysqli_num_rows($data);$i++){
		$rs=mysqli_fetch_row($data);
		$sqlq = "SELECT name FROM member WHERE id='$rs[1]'";
		$resultq = $conn->query($sqlq);
		$row = mysqli_fetch_array($resultq);
		$sqlq2 = "SELECT cname FROM clothes WHERE cnum='$rs[3]'";
		$resultq2 = $conn->query($sqlq2);
		$row2 = mysqli_fetch_array($resultq2);
		?>
		<div style="background-color:#ebebe0;width:800px;height:100px;padding-left:20px;padding-top:10px;border-radius:10px;margin-top:20px"><font size="3">
			<?php echo $row[0]?>
			<font color="black"> 認為商品 </font>
			<?php echo $row2[0]?>
			<font color="black">... </font>
			<br>
			<font color="black">&nbsp;&nbsp;&nbsp;</font>
			<?php echo $rs[2]?>
		</div>
			<?php
				}
			?>
		
	</div>
	
	
	<!-- 超重要!!!!  因為可以submit時 頁面不會出現重整的畫面-->
	<iframe hidden id="exec_target" name="exec_target"></iframe>
	?>
	<script>
	var IMG;
	<!--叫出提示已加入購物車的資訊-->
	function operate()
	{
		<!--最麻煩的地方  因為php 和 java之間不能互相傳值 所以要用下面的方法來寫-->
		<!--先幫shopnum寫好值 利用偷偷傳送的形式傳出去-->
		document.getElementById('shopnum').value = IMG;
		document.getElementById("form1").submit();
	
		
		document.getElementById('div_test').style.display="block";
		setTimeout("disappeare()",500);
	}
	function disappeare(){
		document.getElementById('div_test').style.display="none";
	}
		
	<!--call modal的function-->
	function onClick(element,inventory,size,mon,cnum)
     {
		 document.getElementById("img01").src = element.src;
		 document.getElementById("test").innerHTML = "商品名稱: " + element.title;
		 document.getElementById("inven").innerHTML = inventory;
		 document.getElementById("si").innerHTML = "尺寸" + size;
		 document.getElementById("money").innerHTML ="NT$" + mon;
		 IMG = cnum;
		 document.getElementById("intro").style.display = "block";
         $("#intro").modal();   
     }
	</script>	
	
</body>

</html>