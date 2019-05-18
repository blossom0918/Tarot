<html>
	<head>
		<title>Tarot member</title>
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
<?php
	$userID=$_POST["name"];
	$isAdmin=$_POST['isAdmin'];

	if ($isAdmin!=null){

		$link=@mysqli_connect(
		    '192.168.0.17',
			'root',
			'sea11223',
		    'tarot');
		mysqli_select_db($link,'tarot');
		mysqli_query($link, 'SET NAMES utf8');

		$sql2="UPDATE member SET isAdmin='$isAdmin' WHERE name='$userID'";
		$update=mysqli_query($link,$sql2);

 		echo "
			<header class='align-center'>
           		<h2>管理員專區</h2>
               		<p>恭喜 ".$userID." 的資料更新成功～</p>
               		<p>三秒後為您轉跳回管理者後台～</p>
			</header>";
		header("Refresh:3; url='backstage.php'");
    }

	mysqli_close($link);
?>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>
