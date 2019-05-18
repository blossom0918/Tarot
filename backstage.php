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
						<header class="align-center">
            			    <h2>管理員專區</h2>
						</header>
          				<hr/>

						<p>		
						<font size="5" color="black">會員管理</font>
						<br/>

						<font size="4" color="black">
	
						<form action="" method="get">
							會員編號：<input type="number" name="member_num" min="1">
							性別：<input type="radio" name="gender" value="male" id="male"><label for="male">男性</label>
							<input type="radio" name="gender" value="female" id="female"><label for="female">女性</label>
							管理者：<input type="radio" name="admin" value="1" id="1"><label for="1">是</label>
							<input type="radio" name="admin" value="0" id="0"><label for="0">否</label>
							<input type="submit" name="submit" value="查詢">
						</form>	
						<form action="" method="get">
							<input type="hidden" name="send" value="all">
							<input type="submit" name="submit" value="全部查詢">
						</form>		
					
						<?php
							$link=@mysqli_connect(
							    '192.168.0.17',
								'root',
								'sea11223',
							    'tarot');
							mysqli_select_db($link,'tarot');
							mysqli_query($link, 'SET NAMES utf8');

							if (!empty($_GET['send'])) {
								$sql_search="SELECT * FROM member";
								$result_search=mysqli_query($link,$sql_search);

								echo "<table>
										<tr>
											<td>會員編號</td>
											<td>帳號</td>
											<td>密碼</td>
											<td>性別</td>
											<td>年齡</td>
											<td>管理員</td>
											<td>修改資料</td>
										</tr>";
							
								while($row=mysqli_fetch_assoc($result_search)){
									$count=$count+1;
									$num=$row['member_num'];
									echo "<tr><td>".$row['member_num']."</td>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['password']."</td>";
									echo "<td>".$row['gender']."</td>";
									echo "<td>".$row['age']."</td>";
									echo "<td>".$row['isAdmin']."</td>";
									echo "<td><a href='ad_update.php?num=$num' class='button alt'>修改</a></td></tr>";		
								}}
							elseif (!empty($_GET['member_num']) OR !empty($_GET['gender'])OR !empty($admin=$_GET['admin'])) {

								$member_num=$_GET['member_num'];
								$gender=$_GET['gender'];
								$admin=$_GET['admin'];

								if (!empty($_GET['member_num'])) {
									$sql_search="SELECT * FROM member WHERE member.member_num='$member_num'";
								}
								elseif (!empty($_GET['gender'])AND !empty($admin=$_GET['admin'])) {
									$sql_search="SELECT * FROM member WHERE member.gender = '$gender' AND member.isAdmin = '$admin'";
								}
								elseif (!empty($_GET['gender'])) {
									$sql_search="SELECT * FROM member WHERE member.gender = '$gender'";
								}
								elseif (!empty($admin=$_GET['admin'])) {
									$sql_search="SELECT * FROM member WHERE member.isAdmin = '$admin'";
								}

								$result_search=mysqli_query($link,$sql_search);

								echo "<table>
										<tr>
											<td>會員編號</td>
											<td>帳號</td>
											<td>密碼</td>
											<td>性別</td>
											<td>年齡</td>
											<td>管理員</td>
											<td>修改資料</td>
										</tr>";
							
								while($row=mysqli_fetch_assoc($result_search)){
									$count=$count+1;
									$num=$row['member_num'];
									echo "<tr><td>".$row['member_num']."</td>";
									echo "<td>".$row['name']."</td>";
									echo "<td>".$row['password']."</td>";
									echo "<td>".$row['gender']."</td>";
									echo "<td>".$row['age']."</td>";
									echo "<td>".$row['isAdmin']."</td>";
									echo "<td><a href='ad_update.php?num=$num' class='button alt'>修改</a></td></tr>";		
								}
								echo "</table>";
							}

							echo'</font>
								<hr/>
								<font size="5" color="black">分析資訊</font>
								</p>';

						$sql1 = "SELECT result.category, COUNT(result.category) as total
							FROM game_record
							LEFT JOIN result
							ON result.result_num = game_record.result_num
							GROUP BY result.category
							ORDER BY total DESC";
						$result1 = mysqli_query($link,$sql1);

						$sql2= "SELECT gender,COUNT(name) as count
							FROM `member` 
							GROUP BY gender";
						$result2 = mysqli_query($link,$sql2);

						$sql3= "SELECT game_record.accuracy as accuracy, COUNT(game_record.accuracy) as total
							FROM game_record
							WHERE accuracy !=''
							GROUP BY game_record.accuracy
							ORDER BY total DESC";
						$result3 = mysqli_query($link,$sql3);

						$sql4= "SELECT result.category as category, SUM(CASE result.category WHEN member.gender = 'male' THEN 1 ELSE 0 END) AS male, SUM(CASE result.category WHEN member.gender = 'female' THEN 1 ELSE 0 END) AS female 
							FROM game_record 
							INNER JOIN member 
							ON member.member_num = game_record.member_num 
							LEFT JOIN result 
							ON result.result_num = game_record.result_num 
							GROUP BY result.category";
						$result4 = mysqli_query($link,$sql4);


						$arr1 = array();
						$arr2 = array();
						$arr3 = array();
						$arr4 = array();
						$arr5 = array();
						$arr6 = array();
						$arr7 = array();
						$arr8 = array();
						$arr9 = array();


						while($row = mysqli_fetch_assoc($result1)){
							array_push($arr1, $row['category']);
							array_push($arr2, $row['total']);
						}
						while($row = mysqli_fetch_assoc($result2)){
							array_push($arr3, $row['gender']);
							array_push($arr4, $row['count']);
						}
						while($row = mysqli_fetch_assoc($result3)){
							array_push($arr5, $row['accuracy']);
							array_push($arr6, $row['total']);
						}
						while($row = mysqli_fetch_assoc($result4)){
							array_push($arr7, $row['category']);
							array_push($arr8, $row['male']);
							array_push($arr9, $row['female']);
						}

						?>
		
				        <font size="4" color="black">五種類別點擊率<br/></font>
						<canvas id="Chart1"></canvas>
						<br/>
						<font size="4" color="black">會員男女比<br/></font>
						<canvas id="Chart2" height="130%"></canvas>
						<br/>
						<font size="4" color="black">準確率<br/></font>
						<canvas id="Chart3" height="130%"></canvas>
						<br>
						<font size="4" color="black">男女分別最喜愛類別<br/></font>
						<canvas id="Chart4" height="130%"></canvas>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

	</body>
</html>

<script>
	var ctx = document.getElementById('Chart1').getContext('2d');
	var chart = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: <?php echo json_encode($arr1); ?>,
	        datasets: [{
	        	label: '五種類別點擊率',
	            backgroundColor: ["rgba(255, 159, 64, 0.4)","rgba(255, 205, 86, 0.4)","rgba(75, 192, 192, 0.4)","rgba(54, 162, 235, 0.4)","rgba(201, 203, 207, 0.4)"],
	            borderColor:["rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(201, 203, 207)"],
	            data: <?php echo json_encode($arr2); ?>,
	        }]
	    },
	    options: {
	    	scales:{
				yAxes:[{
					ticks:{
						beginAtZero:true
					}
				}]
			}
		}
	});
	
</script>

<script>
	var ctx1 = document.getElementById('Chart2').getContext('2d');
	var chart2 = new Chart(ctx1, {
	    type: 'pie',
	    data: {
	        labels: <?php echo json_encode($arr3); ?>,
	        datasets: [{
	            backgroundColor: ["rgba(114, 147, 219, 0.534)","rgba(235, 54, 114, 0.452)"],
	            borderColor: "rgb(255, 255, 255)",
	            data: <?php echo json_encode($arr4); ?>,
	        }]
	    },
	    options: {}
	});
	
</script>

<script>
	var ctx3 = document.getElementById('Chart3').getContext('2d');
	var chart3 = new Chart(ctx3, {
	    type: 'pie',
	    data: {
	        labels: <?php echo json_encode($arr5); ?>,
	        datasets: [{
	            backgroundColor: ["rgba(82, 111, 240, 0.541)","rgba(212, 221, 221, 0.514)","rgba(83, 167, 236, 0.37)"],
	            borderColor: "rgb(255, 255, 255)",
	            data: <?php echo json_encode($arr6); ?>,
	        }]
	    },
	    options: {}
	});
	
</script>

<script>
	var ctx4 = document.getElementById('Chart4').getContext('2d');
	var chart4 = new Chart(ctx4, {
	    type: 'radar',
	    data: {
	        labels: <?php echo json_encode($arr7); ?>,
	        datasets: [
				{
				label: "female",
				backgroundColor:"rgba(255, 99, 132, 0.2)",
				borderColor:"rgb(255, 99, 132)",
				pointBackgroundColor:"rgb(255, 99, 132)",
				pointBorderColor:"#fff",
				pointHoverBackgroundColor:"#fff",
				pointHoverBorderColor:"rgb(255, 99, 132)",
	            data: <?php echo json_encode($arr8); ?>,
				},
				{
				label: "male",
	            backgroundColor:"rgba(54, 162, 235, 0.2)",
				borderColor:"rgb(54, 162, 235)",
				pointBackgroundColor:"rgb(54, 162, 235)",
				pointBorderColor:"#fff",
				pointHoverBackgroundColor:"#fff",
				pointHoverBorderColor:"rgb(54, 162, 235)",
	            data: <?php echo json_encode($arr9); ?>,
				}
			]
	    },
	    options: {}
	});
	
</script>

