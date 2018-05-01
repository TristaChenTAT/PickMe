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
</head>

<body>

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
		
	</div>
	
		<?php if (isset($_SESSION['success'])) :
			unset($_SESSION['success']);
        	endif ?>
	
	<!-- 左欄 -->
	<div class="leftcolumn" style="border:transparent;">
			
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
			<a class="bar-item button pointer" onClick="location.href='accessories.html';">Accessories</a>
			<a class="bar-item button pointer" onClick="location.href='shoes.html';">Shoes</a>
			<a class="bar-item button pointer" onClick="location.href='underwears.html';">Underwears</a>
			<a class="bar-item button pointer" onClick="location.href='sets.html';">Sets</a>
			</div>
			
			<!-- 資訊 -->
			<div id="info">
			<b>About PickMe</b>
			<a class="bar-item button pointer" onClick="location.href='introduction.html';">Who are we</a>
			<a class="bar-item button pointer" onClick="location.href='contact.html';">Contact</a>
			<a class="bar-item button pointer" onClick="location.href='subscride.html';">Subscribe</a>
			</div>
			
	</div>

	
	
</body>

</html>