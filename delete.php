<?php
	$num=$_GET['num'];	
	$link=@mysqli_connect(
	    '192.168.0.17',
		'root',
		'sea11223',
	    'tarot');
	mysqli_select_db($link,'tarot');
	mysqli_query($link, 'SET NAMES utf8');

	$sql2="DELETE FROM recommend WHERE recommend_num='$num'";
	$delete=mysqli_query($link,$sql2);
	mysqli_close($link);	
	
	header("Location:re_check.php");
?>
