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
            				<h2>新增相關商品</h2>
						</header>
                        <hr/>

			<p>		
			<form action='insertdone.php' method='post' enctype='multipart/form-data'>
				圖片：<input type='file' name='file'><br/>
    				書名：<input type='text' name='name'><br/>
      				作者：<input type='text' name='author'><br/>
       				出版社：<input type='text' name='publisher'><br/>
       				譯者：<input type='text' name='translator'><br/>
       				標題：<input type='text' name='title'><br/>
				內容：<input type='text' name='content'><br/>
				網址：<input type='text' name='url'><br/>
       			<input class='button special' type='submit' value='確定送出'><br/>
    			</form>
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
