<?php
	$servername = "localhost";//連接伺服器
	$username = "root";
	$password = "0513403";
	$dbname = "groupsix_db";
	$conn = new mysqli($servername, $username, $password, $dbname);//create connection
	mysqli_query($conn, "SET NAMES 'UTF8'");
	$sql=sprintf("select * from clothes ORDER BY cnum");
	$result=$conn->query($sql);
?>
<HTML>
<BODY>

	<?php
	while($row = mysqli_fetch_array($result)) {
	?>
	<img src="image.php?cnum=<?php echo $row["cnum"]; ?>" /><br/>
	<?php
	}
?>
</BODY>
</HTML>
