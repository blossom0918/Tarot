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
							<h2>會員專區</h2>
							<p>修改您的個人資料</p>
						</header>
						<hr>
						<p>
							<?php
							$userID=$_COOKIE["ID"];

							$link=@mysqli_connect(
							  	'192.168.0.17',
								'root',
								'sea11223',
							    	'tarot');
							mysqli_select_db($link,'tarot');
							mysqli_query($link, 'SET NAMES utf8');

							$sql="SELECT * FROM member WHERE name='$userID'";
							$result=mysqli_query($link,$sql);

							$row=mysqli_fetch_assoc($result);
							
							session_start();
							if(isset($_SESSION["login"])){
								echo"<font color='black' size='4'>
								<form action='updatedone.php' method='post'>
								帳號：".$row['name']."<br/>";
								echo"請輸入新的密碼：<input type='text' name='password' value='".$row['password']."'><br/>";
								echo"請重新選擇性別：<br/>
								<input type='radio' name='gender' value='male' id='male'><label for='male'>男性</label>
								<input type='radio' name='gender' value='female' id='female'><label for='female'>女性</label><br/>";
								echo"請重新輸入年齡：<input type='text' name='age' value='".$row['age']."'><br/>";
								echo"<input type='submit' value='確定' class='button' style='font-size:18px; font-family:微軟正黑體'>
							</form>
							</font>";
							}else{
								echo("若要修改您的資料請先登入</br><a href='login.html'>請點此進入登入頁面</a>");
							}
							mysqli_close($link);
							?>
						</p>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>
