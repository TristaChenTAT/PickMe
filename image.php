<?php
    
    //從資料庫取得圖片
    $servername = "localhost";//連接伺服器
	$username = "root";
	$password = "0513403";
	$dbname = "groupsix_db";//選擇欲讀取的資料庫名稱
		
	$conn = new mysqli($servername, $username, $password, $dbname);//create connection
	mysqli_query($conn, "SET NAMES 'UTF8'");
      
	if(isset($_GET['cnum'])){	
		$sql=sprintf("select * from clothes where cnum=". $_GET['cnum']);        
		$result=$conn->query($sql);        
		$row = mysqli_fetch_array($result);    
        header("Content-type: image/jpeg");     
        echo $row['image']; 		
    }
?>