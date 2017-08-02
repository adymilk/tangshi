<?php include '../config/init.php'; ?>
<?php include '../comm/fun.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>古诗词检索系统</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src='../js/bootstrap.min.js'></script>
	<script type="text/javascript" src='../js/index.js'></script>
</head>
<body>
<?php 
$user_text = '';
if (isset($_GET['submit'])) {
	$user_text = $_GET['text'];
}
 ?>
<div class="container">
<div style="text-align: center;" id="logo">
	<a href="./adymilk.php"><img></a>
</div>
	<h2 align="center">古诗词检索系统</h2>
			<form action="" method="get" style="text-align: center;">
				<input id="s_ipt" type="text" name="text" class="form-control btn-lg" placeholder="关键词（诗名/作者/古诗句）" style="display: inline; width: 70%;padding: 23px 5px; font-size: 1em" value="<?php echo $user_text; ?>">
					<input id="s_btn" type="submit" name="submit" value="搜索" class="btn btn-primary btn-lg" style="font-size: 1.4em"><br/>
					<p id="sm-btn">
					<button type="button" class="btn btn-default" data-toggle='modal' data-target='#layer-publish'>发布诗词</button><button class="btn btn-default">贡献翻译</button>
					</p>
			</form>
	<br>
	<table class="table table-hover table-bordered table-striped" style="text-align: center;">
  		<?php 
  		// 表单查询数据库

  		//如果搜索按钮被点击
	if (isset($_GET['submit'])&&!empty($_GET['submit'])) {
		echo "<script>
			$(document).ready(function(){
							$('.fbar').hide();
						});
			</script>";
		// 点击搜索按钮的情况
			
        $firstPage = '1';
        $curPage = '1';
        $limit = '10';
        $totalDate = '';
        $offset = 0;
        $sql = "select * from poetries inner join poets on poetries.poet_id = poets.id where poets.name='$user_text' or title like'%$user_text%' or content like'%$user_text%'";
        mysql_query($sql);
        $totalDate = mysql_affected_rows();
        if ($totalDate > 10) {
            $totalPage = (($totalDate % $limit) == 0)?$totalDate / $limit:ceil($totalDate / $limit);
            ($totalPage > 10)?$totalPage=10:$totalPage;
        }else{
            $totalPage = 1;
        }
        if (isset($_GET['pageNum']) && $_GET['pageNum'] < $totalPage) {
            $pageNum = $_GET['pageNum'];
            $offset = ($pageNum - 1) * 10;
        }
        $sql = "select * from poetries inner join poets on poetries.poet_id = poets.id where poets.name='$user_text' or title like'%$user_text%' or content like'%$user_text%' order by poetries.updated_at desc limit $offset,20";
        $list = mysql_query($sql);

		
		$sql = "select * from poetries inner join poets on poetries.poet_id = poets.id where poets.name='$user_text' or title like'%$user_text%' or content like'%$user_text%' order by poetries.updated_at desc limit 15 ";
		$list = mysql_query($sql);
		if (mysql_affected_rows() < 0) {
			// loading动画
		echo "<div class='row col-sm-12'>
		<div class='ball-pulse'><div></div><div></div><div></div></div>
	</div>";
	}else if(mysql_affected_rows() > 0){
	echo "<tr style='font-weight: bold;'>
  			<th>名称</th>
  			<th>作者</th>
  			<th>更新时间</th>
  			<th>操作</th>
  		</tr>";
  		// 循环输出查询数据
  			while ($row = mysql_fetch_array($list)) {
			echo "<tr><td><a href='../content.php?id=$row[0]'>$row[title]</a></td><td>$row[name]</td><td>$row[5]</td><td><button type='button' id='btn-del' name='sub-del' class='btn btn-danger' data-toggle='modal' data-target='#del'><a href='./adymilk.php?text=$user_text&submit=搜索&id=$row[0]'>删除</a></button><button name='sub-edit' type='submit' id='btn-edit'data-toggle='modal' data-target='#layer-edit' class='btn btn-primary'><a href='../edit.php?id=$row[0]&keywords=$user_text'>编辑</a></button></td></tr>";
		}
	echo "</table><div style='text-align:center'><ul class='pagination'>";
		for ($i=1; $i <=$totalPage ; $i++) { 	
			echo "<li><a href='./adymilk.php?text=$user_text&submit=搜索&pageNum=$i'>第$i 页</a></li>";
		}
		echo "</ul></div>";

	}else if(mysql_affected_rows()==0){
		echo '<p align=center>数据库未收录和【'.$user_text.'】相关数据</p>';
	}
	
}
		
  		?>
  	</table>	
</div>
<!--发布 诗词对话框-->
        <div role="dialog" class="modal fade" id="layer-publish"">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <h4 style="text-align: center;">发布诗词</h4>
                        <form method='post'>
	                        <div class='input-group'>
	                        <span class='input-group-addon' id='sizing-addon2'>题目</span>

		                        <input name='title' type='text' class='form-control' placeholder='这首诗/词叫什么名字？' aria-describedby='sizing-addon2'>
	                        </div><br>
	                        <div class='input-group'>
		                        <span class='input-group-addon' id='sizing-addon2'>作者</span>
		                        <input name='author' type='text' class='form-control' placeholder='作者的名字?' aria-describedby='sizing-addon2'>
	                        </div><br>
	                        <div class='input-group'>
		                        <span class='input-group-addon' id='sizing-addon2'>内容</span>
		                        <textarea name='content' type='text' class='form-control' placeholder='请输入内容部分，注意用标点符号断句。' aria-describedby='sizing-addon2'></textarea>
	                        </div>

	                        <div class='modal-body text-right'>
	                            <button class='btn btn-danger' type='submit' name='insert'>提交</button>
	                            <button class='btn btn-primary' data-dismiss='modal'>取消</button>
	                        </div>;
                        	
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="fbar navbar-fixed-bottom">
    	<div class="container">
    		<span id="fl"><a href="#">诗词地理</a></span>
    		<span id="fl"><a href="#">诗词大全</a></span>
    		<span id="fr"><a href="../about.php">关于本站</a></span>
    		<span id="fr"><a href="#">隐私权</a></span>
    	</div>
    </div>
</body>
</html>

<?php  ?>
<?php 
	// 发布诗词

	if (isset($_POST['insert'])) {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$content = $_POST['content'];
		if (!empty($title&&$author&&$content)) {
			// 插入作者name到作者表
			$sql = "insert into poets(`name`) values('$author')";
			$list = mysql_query($sql);
			// 查找刚刚插入的作者name对应的ID
			$sql = "select * from poets where name='$author'";
			$list = mysql_query($sql);
			$row = mysql_fetch_array($list);
			// 获取ID号
			$new_id = $row[0];
			// 把id号、内容、题目插入到poetries表
			$sql = "insert into poetries(`poet_id`,`content`,`title`) values('$new_id','$content','$title')";
			$list = mysql_query($sql);
			if (mysql_affected_rows()) {
				echo "<script>javaScript:history.go(-1);</script>";
				// echo "<script>location:reload();</script>";
				alertMsg('成功！信息已发布。');
			}else{
				alertMsg('失败！服务器异常。');
			}
			// 提交作品译文后马上刷新页面
        	echo "<script>window.location.href=window.location.href;</script>";
		}else{
			alertMsg('警告！不允许提交空信息。');
		}
	}

	


// 删除诗词
if (!empty($_GET['id'])) {
	$user_text = $_GET['text'];
	$mid = $_GET['id'];
	$sql = "delete from poetries where id='$mid'";
		$list = mysql_query($sql);
		var_dump($list);
		$rows = mysql_affected_rows();
		var_dump($rows);
		
		if (!empty($rows)) {
			echo "<script>document.location = 'adymilk.php?text=$user_text&submit=搜索';alert('删除成功！')</script>";
			alertMsg('成功！!一条信息已删除。');
			// echo "<script>javascript:history.go(-1);</script>";
			// echo "<script>window.location.href='$CurUrl'</script>";
		}else{
			alertMsg('失败！！操作不成功。');
		}
}
	
	

 ?>
 



