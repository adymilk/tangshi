<?php include './config/init.php'; ?>
<?php 
	if (!empty($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "select * from poetries inner join poets on poetries.poet_id = poets.id where poetries.id=$id";
		$row = mysql_fetch_array(mysql_query($sql));
	}else{
		alertMsg('失败！服务器异常。');
	}

 ?>

<!--编辑 诗词对话框-->
<!DOCTYPE html>
<html>
<head>
	<title>更新诗词-《<?php echo $row['title']; ?>》|古诗词检索系统</title>
	<?php include './comm/head.php'; ?>
</head>
<body>

<div class="container">
	
                        <h4 style="text-align: center;">编辑诗词</h4>
                        <form method='post'>
	                        <div class='input-group'>
	                        <span class='input-group-addon' id='sizing-addon2'>题目</span>

		                        <input name='title' type='text' class='form-control' placeholder='这首诗/词叫什么名字？' aria-describedby='sizing-addon2' value=<?php echo $row['title']; ?>>
	                        </div><br>
	                        <div class='input-group'>
		                        <span class='input-group-addon' id='sizing-addon2'>作者</span>
		                        <input name='author' type='text' class='form-control' placeholder='作者的名字?' aria-describedby='sizing-addon2' value=<?php echo $row['name']; ?>>
	                        </div><br>
	                        <div class='input-group'>
		                        <span class='input-group-addon' id='sizing-addon2'>内容</span>
		                        <textarea name="content" class="form-control" rows="7" aria-describedby='sizing-addon2' style="text-align: left;"><?php 
                                    echo $row['content'];?></textarea>

	                        </div>

	                        <div class='modal-body text-right'>
	                            <button class='btn btn-danger' type='submit' name='update'>更新</button>
	                            <button class='btn btn-primary' data-dismiss='modal'><a href="javaScript:history.go(-1)" >取消</a></button>
	                        </div>
                        	
                        </form>
</div>
</body>
</html>
<?php 

	if (isset($_POST['update'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];
		$author = $_POST['author'];
		$keywords = $_GET['keywords'];
		$sql = "select id from poets where name='$author'";
		$list = mysql_query($sql);
		if ($list) {
			$rs = mysql_fetch_array($list);
			$poet_id = $rs['id'];
			// var_dump($poet_id);
			// var_dump($row[0]);
		$sql = "update poetries set title='$title',content='$content',poet_id=$poet_id where id=$row[0]";
		$list = mysql_query($sql);
		if ($list) {
			// echo "<script>javaScript:history.go(-2)</script>";
			echo "<script>document.location = './Admin/adymilk.php?text=$keywords&submit=搜索';alert('成功！数据已更新。')</script>";
			alertMsg('成功！数据已更新。');

		}
		else{
			alertMsg('失败！服务器异常。');
			var_dump($list);
		}
	}
	}
		
 ?>