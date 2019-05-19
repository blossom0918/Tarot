<?php	
session_start();
	$userID=$_COOKIE["ID"];
	$link=@mysqli_connect(
	    	'192.168.0.17',
		'root',
		'sea11223',
		'tarot');

	mysqli_select_db($link,'tarot');
	$sql="SELECT isAdmin FROM member WHERE name='$userID'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($result);
				
	if (isset($_SESSION["login"]) &&  $row["isAdmin"]==1) {
		header("Location:ad_recommend.php");
	}else{
		header("Location:recommend.php");
	}

?>
