<?php
    $num=$_POST['num'];
    $name=$_POST['name'];
    $author=$_POST['author'];
    $publisher=$_POST['publisher'];
    $translator=$_POST['translator'];
    $title=$_POST['title'];
    $content=$_POST['content'];
    $url=$_POST['url'];

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
    }elseif ($fname=='') {
	$sql2="UPDATE recommend SET recommend_name='$name', author='$author', publisher='$publisher', translator='$translator', title='$title', content='$content',url='$url' WHERE recommend_num='$num'";
    }else{
    	$sql2="UPDATE recommend SET recommend_name='$name', author='$author', publisher='$publisher', translator='$translator', title='$title', content='$content',url='$url',photo_name='$fname' WHERE recommend_num='$num'";
   	$result2=mysqli_query($link,$sql2);
	header("Location:re_check.php");
    }
    mysqli_close($link);
?>
