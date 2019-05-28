<html>	
	<head>
		<title>Tarot update</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="subpage">

		<header id="header">
			<div class="logo">
				<a href="index.php">Home</a>
			</div>
			<a href="logout.php">登出</a> /
			<a href="member.php">會員專區</a>
			<a href="#menu" class="toggle"><span>Menu</span></a>
		</header>

		<nav id="menu">
			<ul class="links">
				<li><a href="index.php">首頁</a></li>
				<li><a href="check.php">遊戲開始</a></li>
				<li><a href="re_check.php">相關商品推薦</a></li>
			</ul>
		</nav>

		<section id="one" class="wrapper style2">
			<div class="inner">
				<div class="box">
					<div class="content">
						<header class="align-center">
							<h2>管理員專區</h2>
						</header>
<?php
	session_start();

	$num=$_GET['num'];

	$link=@mysqli_connect(
	   	'192.168.0.17',
		'root',
		'sea11223',
	    	'tarot');
	mysqli_select_db($link,'tarot');
	mysqli_query($link, 'SET NAMES utf8');

	$sql="SELECT * FROM member WHERE member_num='$num'";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($result);

	if(isset($_SESSION["login"]  )){
		
	echo "<p>修改".$row['name']." 是否為管理員</p>";
	echo"<hr>";
	echo"<p>
	<font color='black' size='4'>
	<form action='ad_updatedone.php' method='post'>";
		echo"帳號：".$row['name']."<br/>";
		echo"密碼：".$row['password']."<br>";
		echo"性別：".$row['gender']."<br>";
		echo"年齡：".$row['age']."<br>";
		echo"管理員：
		<input type='radio' name='isAdmin' value='1' id='1' checked='checked'><label for='1'>是</label>";
		echo"<input type='radio' name='isAdmin' value='0' id='0'><label for='0'>否</label><br>";
		echo"<input type='submit' value='確定' class='button' style='font-size:16px; font-family:微軟正黑體'>";
	echo"</form>
	</font>
	</p>";
	}else{
		echo("若要修改資料請先登入</br><a href='login.html'>請點此進入登入頁面</a>");
	}
?>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>

