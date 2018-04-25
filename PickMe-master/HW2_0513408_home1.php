<?php 
  session_start(); 

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="HW2_0513403_stylehome.css">
</head>
<body>

<div id="header_homepage">
	百裡挑衣
</div>

<div id="menu">

	<!-- 歡迎使用者-->
	
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>, 
    	<a href="HW2_0513408_home1.html?logout='1'" style="color: red;">logout</a></p>
    <?php endif ?>
	<?php  if (!isset($_SESSION['username'])) : ?>
    	<a href="HW2_0513408_home.html" style="color: red;">Login</a></p>
    <?php endif ?>
</div>
		
  	<?php if (isset($_SESSION['success'])) :
			unset($_SESSION['success']);
        	endif ?>

    

</body>
</html>