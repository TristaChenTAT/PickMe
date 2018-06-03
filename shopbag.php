<?php 
  session_start(); 
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
	unset($_SESSION['isowner']);
  }
?>
<html>
<head>
<title>購物車</title>

<link rel="stylesheet" href="pickmestyle.css" type="text/css">  
<link rel="Shortcut Icon" type="image/x-icon" href="pickmeicon.ico" />


</head>


<body>

	<!-- 上欄 -->
	<div class="top">
		
		<?php  if (isset($_SESSION['username'])) : //登入狀態?>
    	<!-- <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>, -->
    	<a class="pointer" href="pickme.php?logout='1'" >logout</a>
		<?php endif ?>
		
		<?php  if (!isset($_SESSION['username'])) : //尚未登入狀態?>
    	<a class="pointer" onClick="location.href='login.html';">Login</a>
		<?php endif ?>
		
		<a class="pointer">Shopping Bag</a>
		
		
	</div>
	
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
		<br></br>
		<br></br>
		<!--標題-->
		<div style="text-align:center; font-family:SetoFont;"><font size="7">購物車</div>

		<table border="0" style="width:95%; margin:auto auto; color:black; font-size:30pt;background-color:rgba(255, 255, 255, 0.5);">
	<?php
		$servername = "localhost";//連接伺服器
		$username = "root";
		$password = "0513403";
		$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱	
		$conn = new mysqli($servername, $username, $password, $dbname);//create connection
		mysqli_query($conn, "SET NAMES 'UTF8'");
		
		//取得購物者的id
		$name = $_SESSION['username'];
		$sqlq = "SELECT id FROM member WHERE name='$name'";
		$resultq = $conn->query($sqlq);
		$row1 = mysqli_fetch_array($resultq); //$row1[0]

	
		$select="select * from member_order WHERE member_id='$row1[0]'";
		$result=$conn->query($select);

		$total=0;
	?>

		<?php
			while($row = mysqli_fetch_array($result)) {
				//$row[1] -> 商品序號 $row[2] -> 商品數量
		?>
		<div>
		
		<tr>
		<td style="font-family:SetoFont">
			<img type="image" width="200" height="200" src="image.php?cnum=<?php echo $row[1]; ?>">				
		</td>
		<!--商品名稱 -->
		<?php
			$shop="select * from clothes WHERE cnum='$row[1]'";
			$shopp=$conn->query($shop);
			$find = mysqli_fetch_array($shopp);
		?>
		<td style="font-family:SetoFont;">&nbsp;&nbsp;<?php echo $find[0]?></td>
		<td style="font-family:SetoFont;text-align:center;">&nbsp;&nbsp;&nbsp;<?php echo $row[2]?></td>
		<?php
			//運算價錢
			$money = $find[4]*$row[2];
			$total = $total + $money;
		?>
		<td style="font-family:SetoFont;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $money?></td>
		
		<form id="form2" action="" method="post">
		
		<td>&nbsp;&nbsp;&nbsp;<input type="button" onClick="GoodBYE('<?php echo $row[1]?>')" style="font-family:SetoFont; font-size:25pt;" value="刪除">
		<input type="hidden" name="byebye" id="byebye">
		
		</form>
		</tr>
		</div>
		<?php
			}
		?>
		<HR>
		<tr>
		<td><p><HR></p></td>
		<td style="font-family:SetoFont;">&nbsp;&nbsp;小計&nbsp;&nbsp;&nbsp;&nbsp;<td align="right" style="font-family:SetoFont;">NT$<?php echo $total?></td></td>
		</tr>
		<tr>
		<td><td><td><td><td align="right"><button type="button" onclick="location.href='pickme.php';" style="font-family:SetoFont; font-size:25pt;">結帳</button></td></td></td></td></td>
		</tr>
		</table>
	</div>
	
<?php
	if(isset($_POST["byebye"])){
		
		$byebye = $_POST["byebye"];
		// $row1[0] 購物者id
		$sql="DELETE FROM member_order WHERE member_id='$row1[0]' and product_ssn='$byebye'";
		$goo = $conn->query($sql);
		echo '<meta http-equiv=REFRESH CONTENT=1;url=shopbag.php>';
	}

	?>
<script>

	function GoodBYE(bye)
	{		
		document.getElementById('byebye').value = bye;
		document.getElementById("form2").submit();
	}
</script>	

	
	
	
</body>
</html>