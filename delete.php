<?php 
  session_start(); 
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
	unset($_SESSION['isowner']);
  }

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
	
	while($row = mysqli_fetch_array($result)) {
		//$row[1] -> 商品序號 $row[2] -> 商品數量
			
		$cost="UPDATE clothes SET cinventory = cinventory - '$row[2]' WHERE cnum='$row[1]'";
		$conn->query($cost);
		$insert="UPDATE clothes SET sold = sold + '$row[2]' WHERE cnum = '$row[1]'";
		$conn->query($insert);
	}
	

	//刪除一切
	$go="DELETE FROM member_order WHERE member_id ='$row1[0]' ";
	$down = $conn->query($go);
	
	echo '<meta http-equiv=REFRESH CONTENT=0;url=pickme.php>';

?>
	


