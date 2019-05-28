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

		<?php
			$userID=$_POST["name"];
			$userPASS=$_POST["password"];
			$usergender=$_POST["gender"];
			$userage=$_POST["age"];

			if ($userID!=null && $userPASS!=null && $usergender!=null && $userage!=null){
				echo "
				<section id='one' class='wrapper style2'>
					<div class='inner'>
						<div class='box'>
							<div class='content'>";
								echo "
								<header class='align-center'>
								    <h2>會員專區</h2>
								    <p>恭喜".$_COOKIE['ID']."，資料更新成功～</p>
								</header>
				                		<hr>";

								echo "
								<p>
								<font size='5' color='black'>個人資料</font>
								<br/>
								<font size='4' color='black'>";

								$link=@mysqli_connect(
								    	'192.168.0.17',
									'root',
									'sea11223',
								    	'tarot');
								mysqli_select_db($link,'tarot');
								mysqli_query($link, 'SET NAMES utf8');

								$sql2="UPDATE member SET password='$userPASS', gender='$usergender', age='$userage' WHERE name='$userID'";
								$update=mysqli_query($link,$sql2);

								$sql="SELECT * FROM member WHERE name='$userID'";
								$result=mysqli_query($link,$sql);
								$row=mysqli_fetch_assoc($result);

								echo "帳號：".$row['name']."<br/>";
								echo "密碼：".$row['password']."<br/>";
								echo "性別：".$row['gender']."<br/>";
								echo "年齡：".$row['age']."<br/>";
								echo "<a href='update.php' class='button special scrolly' style='font-size:18px; font-family:微軟正黑體'>編輯</a><br/>";

									if ($row['isAdmin']!=0) {
										echo "<a href='backstage.php' class='button special' style='font-size:18px; font-family:微軟正黑體'>進入管理者後台</a><br/>";
									}
								
								echo "
								</font>
								</p>
								<hr>";

								echo "
								<font size='5' color='black'>遊戲紀錄</font>
								<br/>
				                		<p>
								<font size='4' color='black'>";

								$count=0;
								$sql="SELECT member.name,result_content,game_record.date,card_name,card.card_num,game_record.accuracy,game_record.record_num
									FROM result,game_record,member,card
									WHERE result.result_num = game_record.result_num AND 
									member.member_num = game_record.member_num AND
									card.card_num=result.card_num AND
									name='$userID'";

								$result=mysqli_query($link,$sql);
								while($row=mysqli_fetch_assoc($result)){
									$count=$count+1;
									echo "<img src='images/card/".$row['card_num'].".jpg' class ='image left' height='30%'><br/>";
									echo "第 ".$count." 次占卜<br/>";
									echo "日期:".$row['date']."<br/>";
									echo "卡牌:".$row['card_name']."<br/>";
									
									echo "解析:".$row['result_content']."<br/>";
									if ($row['accuracy']=='') {
										echo '<form action="accuracy.php" method="POST">
										<p>準確率：
										<input type="hidden" name="send" value='.$row["record_num"].'>
										<input type="radio" name="accuracy" value="high" id="high"><label for="high">高</label>
										<input type="radio" name="accuracy" value="normal" id="normal"><label for="normal">普通</label>
										<input type="radio" name="accuracy" value="low" id="low"><label for="low">低</label>
										<input type="submit" style="font-size:18px; font-family:微軟正黑體"></p>
										</form>';
									}
									else{
										echo "<p>準確率：".$row['accuracy']."</p>";
									}

									echo "<hr></br>";

								}
								
								echo "
								</font>
				                		</p>
								<br/>";
								echo "
							</div>
						</div>
					</div>
				</section>";

			}
			else {
				echo "		
				<section id='one' class='wrapper style4'>
					<div class='content'>
						<header class='align-center'>
							<h2>欄位不可為空值，請重新輸入</h2>
						</header>
					</div>
				</section>";
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


