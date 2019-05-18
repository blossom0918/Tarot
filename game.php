<html>	
<head>
	<title>tarot game</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/game.css" />
	<link rel="stylesheet" type="text/css" href="css/wickedcss.min.css">
</head>
<body class="subpage">

		<header id="header" class="">
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
					<div class="image fit">
						<img src="images/gamebg.jpg" alt="" />
					</div>
<?php

session_start();
if(isset($_SESSION["login"])){
	$link = @mysqli_connect(
		'192.168.0.17',
		'root',
		'sea11223',
		'tarot');

	mysqli_select_db($link,'tarot');
	mysqli_query($link, 'SET NAMES utf8');

	date_default_timezone_set('Asia/Taipei');

	echo '<div class="content">
			<header class="align-center">
				<h2>塔羅解析</h2>
			</header>
		<hr />
		<font color="black" size="4">';
		$cardnum=rand(0,21);
		$category=$_POST[category];
		$datetime = date ("Y-m-d/H:i:s");
		$userID=$_COOKIE["ID"];
		$sql="SELECT member.member_num FROM member WHERE name='$userID'";
		$re=mysqli_query($link,$sql);
		$row1=mysqli_fetch_row($re);

		echo "<img src='images/card/".$cardnum.".jpg' class='image left'>";

		$search="SELECT result_num, result_content FROM result
				WHERE card_num='$cardnum' AND category='$category'";
		$result=mysqli_query($link, $search);
		$row=mysqli_fetch_assoc($result);
		echo "解析：".$row['result_content']."<br/><br/>";


		$sql1="INSERT INTO game_record(member_num,result_num ,date, accuracy) VALUES('$row1[0]','$row[result_num]','$datetime','')";
		$insert=mysqli_query($link,$sql1);

		$sql2="SELECT last_insert_id()";
		$send=mysqli_query($link, $sql2);
		$row2=mysqli_fetch_row($send);

		echo '<form action="accuracy.php" method="POST">
			<p>準確率：
			<input type="hidden" name="send" value='.$row2[0].'>
			<input type="radio" name="accuracy" value="high" id="high"><label for="high">高</label>
			<input type="radio" name="accuracy" value="normal" id="normal"><label for="normal">普通</label>
			<input type="radio" name="accuracy" value="low" id="low"><label for="low">低</label>
			<input type="submit" class="button special scrolly"></p>
			</form>';

		echo "<br/>";
		echo "<a href='game.html' class='button special scrolly'>再玩一次</a><br/>
				<br/>
				<br/>";
		echo "<br/></font></div>";
		mysqli_close($link);
}else{
	echo("若要開始遊戲請先登入</br><a href='login.html'>請點此進入登入頁面</a>");
}
?>							
					
				</div>
			</div>
		</section>
			
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
	</body>
</html>
