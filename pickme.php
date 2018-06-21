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
<title>PickMe | 百裡挑衣</title>

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
	
	
	<!-- 內容 -->
	<div id="itemcondition" class="content" style="cursor:url('poro.cur'),auto;">
		<table border="0" style="width:95%; margin:auto auto; text-align:center;background-color:rgba(255, 255, 255, 0.5);">
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
			title="<?php echo $row[0]?>" onClick="onClick(this,'<?php echo $row[2]?>','<?php echo $row[5]?>','<?php echo $row[4]?>','<?php echo $row["cnum"]; ?>')">		
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
				<img id="img01" width="350" height="350">
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
					<div id="div_test" style="font-family:SetoFont;display:none;color:white;position:absolute;z-index:100;left:50%;top:43%;margin-left:-75px;text-align:center;width:250px;height:50px;background-color:#b3e6cc;font-size:40px;">
						成功加入商品
					</div>
					<form id="form1" action="" method="post" enctype="multipart/form-data" target="exec_target"><!--將資訊傳給自己-->
					<select name="shopbox">
						<option selected value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
					<input type="button" onclick="operate()" style="font-family:SetoFont;font-size:25px;width:150px;height:40px;right:0;top:-10%;" value="加入購物車">
					<!-- 這個的功能是傳遞一些參數，同時不需要再界面顯示控件-->
					<input type="hidden" name="shopnum" id="shopnum">
					</form>
				</div>
			</div>
			<div class="w3-container w3-black">
				<h1><div style="font-family:SetoFont">留言板</div></h1>
			</div>
			<div class="w3-container">
				<div id="div_test2" style="font-family:SetoFont;display:none;color:white;position:absolute;z-index:100;left:50%;top:65%;margin-left:-75px;text-align:center;width:250px;height:50px;background-color:#b3e6cc;font-size:40px;">
					成功提交
				</div>
				<form id="form2" action="" method="post" enctype="multipart/form-data" target="exec_target"><!--將資訊傳給自己-->
				<font color="#025648"><b>留言內容: </b></font> <input type="text" style="height:80px;width:830px;" name="message"required><br><br>
				<input type="button" onclick="mess()" style="width:60px;height:25px;border:3px #e595b3 double;" value="提交">
				<input type="hidden" name="shopnum2" id="shopnum2">
				</form>
			</div>
			
			
		</div>
	</div>

	<!-- 超重要!!!!  因為可以submit時 頁面不會出現重整的畫面-->
	<iframe hidden id="exec_target" name="exec_target"></iframe>
	<?php 
		
	
	?>
	<?php
		if(isset($_POST["shopnum2"])){
		$name = $_SESSION['username'];
		$sqlq = "SELECT id FROM member WHERE name='$name'";
		$resultq = $conn->query($sqlq);
		$row2 = mysqli_fetch_array($resultq);
		
		$message = $_POST['message'];
		$shopnum2 = $_POST["shopnum2"];
		
		$conn = new mysqli($servername, $username, $password, $dbname);//create connection
		mysqli_query($conn, "SET NAMES 'UTF8'");
		$sql="INSERT into message(mem_id,mmessage,mclothes_id)VALUES('$row2[0]','$message','$shopnum2')";
		 //利用SQL將會員資料INSERT至資料庫
		$conn->query($sql);
		}
		
		?>
	<?php
	if(isset($_POST["shopnum"])){
		//在有商品號碼的況下  取member id -> $row[0] shopnum就是商品號碼
		$name = $_SESSION['username'];
		$sqlq = "SELECT id FROM member WHERE name='$name'";
		$resultq = $conn->query($sqlq);
		$row = mysqli_fetch_array($resultq);

		$shopnum = $_POST["shopnum"];
		
		$shopbox = (int)$_POST['shopbox'];
		
		//判斷資料庫是否有商品編號
		$find = "SELECT product_ssn FROM member_order WHERE product_ssn='$shopnum'";
		$go = $conn->query($find);
		
		//傳到資料庫上
		if($go->num_rows > 0){
			
			$sql2 = "UPDATE member_order SET quantity = quantity + '$shopbox' WHERE member_id='$row[0]' and product_ssn='$shopnum' ";
			$conn->query($sql2);
		}
		else{
			$sql = "INSERT INTO `member_order`(`member_id`, `product_ssn`, `quantity`) VALUES ($row[0],$shopnum,$shopbox)";
			$conn->query($sql);
		}

	}

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
	function mess()
	{
		<!--最麻煩的地方  因為php 和 java之間不能互相傳值 所以要用下面的方法來寫-->
		<!--先幫shopnum寫好值 利用偷偷傳送的形式傳出去-->
		document.getElementById('shopnum2').value = IMG;
		document.getElementById("form2").submit();
		
		document.getElementById('div_test2').style.display="block";
		setTimeout("disappeare()",500);
	}
	function disappeare(){
		document.getElementById('div_test').style.display="none";
		document.getElementById('div_test2').style.display="none";
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
