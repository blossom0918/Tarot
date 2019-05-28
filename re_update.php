<html>
	<head>
		<title>Tarot recommend</title>
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
                            				<h2>編輯相關商品</h2>
						</header>
                        			<hr/>
						<p>		
<?php
    $num=$_GET['num'];
    $link=@mysqli_connect(
	'192.168.0.17',
	'root',
	'sea11223',
	'tarot');
    mysqli_select_db($link,'tarot');
    mysqli_query($link,'SET NAMES utf8');

    $sql="SELECT * FROM recommend WHERE recommend_num =$num";
    $result=mysqli_query($link,$sql);

    $row=mysqli_fetch_assoc($result);
    echo "
        <img src='images/book/".$row['photo_name']."' alt='' />
	<form action='re_updatedone.php' method='post' enctype='multipart/form-data'>
	<input type='hidden' name='num' value='".$num."'>
	<input type='file' name='file' value='更改圖片'><br/>
		書名：<input type='text' name='name' value='".$row['recommend_name']."'><br/>
		作者：<input type='text' name='author' value='".$row['author']."'><br/>
		出版社：<input type='text' name='publisher' value='".$row['publisher']."'><br/>
		譯者：<input type='text' name='translator' value='".$row['translator']."'><br/>
		標題：<input type='text' name='title' value='".$row['title']."'><br/>
		內容：<input type='text' name='content' value='".$row['content']."'><br/>
		網址：<input type='text' name='url' value='".$row['url']."'><br/>
        <input class='button special' type='submit' value='確定送出' style='font-size:18px; font-family:微軟正黑體'><br/>
        </form>";
?>
		                		</p>
					</div>
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
