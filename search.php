<html>

<head>
<title>查詢結果</title>
<meta charset="utf-8">
<link rel="stylesheet" href="pickmestyle.css" type="text/css">  
<link rel="Shortcut Icon" type="image/x-icon" href="pickmeicon.ico" />
</head>

<body>
<?php
$searchtxt=$_POST['searchtxt'];
?>

	<div class="content">
		<table border="1" style="color:black; width:60%; margin:auto auto; text-align:center;">
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
		$select="select * from clothes where cname like '%$searchtxt%'";
		$data=mysqli_query($conn,$select);//從member中選取全部(*)的資料
		$result=$conn->query($select);
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
	<a href='pickme.php'>回首頁</a>


</body>
</html>


