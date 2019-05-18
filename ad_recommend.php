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
<?php
session_start();
			
if(isset($_SESSION["login"])){
    echo "<a href='logout.php'>登出</a>/";
    echo "<a href='member.php'>會員專區</a>";
}else{
    echo "<a href='login.html'>登入</a>/";
    echo "<a href='enroll.html'>註冊</a>";
}

?>
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
					<img src="images/rebg.jpg" alt="" />
				</div>
				<div class="content">
					<header class="align-center">
						<h2>相關商品推薦</h2>
					</header>
				<p>
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
				
	if (isset($_SESSION["login"]) && $row['isAdmin']==1) {
		
	$link2=@mysqli_connect(
	    '192.168.0.17',
		'root',
		'sea11223',
	    'tarot');
	mysqli_select_db($link2,'tarot');
	mysqli_query($link2, 'SET NAMES utf8');
	$sql2="SELECT * FROM recommend";
	$result2=mysqli_query($link2,$sql2);

	echo "<a href='insert.php?' class='button special big'>新增資料</a>";
				
	while($row2=mysqli_fetch_assoc($result2)){	
		echo "<hr>";
		$num=$row2['recommend_num'];
		if(file_exists("images/book/".$row2['photo_name'])&& $row2['photo_name']!=''){
			$img="images/book/".$row2['photo_name'];
		}
		else{
			$img="images/book/re0.jpg";
		}
	
		echo "<span class='image left'><img src=$img></span>";
		echo "<b><font color='black' size='5'>".$row2['recommend_name']."</font><br><br>";
		echo "<font color='black' size='4'>";
		if ($row2['author']!=null)
			echo "作者：".$row2['author']."<br>";
		if ($row2['translator']!=null)
			echo "譯者：".$row2['translator']."<br>";
		if ($row2['publisher']!=null)
			echo "出版社：".$row2['publisher']."<br>";
   		 echo $row2['title']."</b>";
		echo "
			<p><font size='3.5'>
          	<dd>
				".$row2['content']."<br/><br/>
            <ul class='actions'>
		<li><a href='".$row2['url']."' class='button alt'><font color='gray'>前往購買</font></a></li>     	
       	<li><a href='re_update.php?num=$num' class='button alt'><font color='gray'>修改</font></a></li>		
		<li><a href='delete.php?num=$num' class='button alt'><font color='gray'>刪除</font></a></li>
            </ul>
            </dd>
            </p>";	
	}

	mysqli_close($link2);	

	}else{
		echo "您非管理員，若要查看相關商品推薦頁面<a href='recommend.php'>請點此進入</a>";
	}

	mysqli_close($link);
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
