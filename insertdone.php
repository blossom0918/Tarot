<?php
	$link=@mysqli_connect(				        
		'192.168.0.17',
		'root',
		'sea11223',
		'tarot');
    mysqli_select_db($link,'tarot');
    mysqli_query($link,'SET NAMES utf8');
	
	$fname=$_FILES["file"]["name"];
	$tmp=$_FILES["file"]["tmp_name"];
	if(!empty($fname)){
		copy($tmp,'images/book/'.$fname);
		unlink($tmp);
	}

    $name=$_POST['name'];
    $author=$_POST['author'];
    $publisher=$_POST['publisher'];
    $translator=$_POST['translator'];
    $title=$_POST['title'];
    $content=$_POST['content'];
    $url=$_POST['url'];

    echo "<a href='insert.php' class='button special big' style='font-size:18px; font-family:微軟正黑體'>新增資料</a><br/>";

    if($name!=null && $content!=null){
    	$sql2="INSERT INTO recommend(recommend_name,author,publisher,translator,title,content,url,photo_name) VALUES('$name','$author','$publisher','$translator','$title','$content','$url','$fname')";
	$insert=mysqli_query($link,$sql2);
    }
	
	header("Location:re_check.php");
?>
