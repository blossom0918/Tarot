<?php

	$link = @mysqli_connect('192.168.0.17','root','sea11223','tarot'
	);

	$accuracy = $_POST['accuracy'];
	$send=$_POST['send'];
//	$sql1="SELECT last_insert_id()";
	$sql2="UPDATE game_record SET accuracy='$accuracy' WHERE record_num='$send'";
	
	$updating=mysqli_query($link, $sql2);

	header("Location:member.php");
?>