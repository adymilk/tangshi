<?php include './config/init.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>古诗词检索系统</title>
	<?php include './comm/head.php'; ?>
	<script type="text/javascript" src="./js/bootstrap-paginator.min.js"></script>
</head>
<body>
<div class="container">
<div style="text-align: center;" id="logo">
	<a href="./index.php"><img></a>
</div>
	<h2 align="center">古诗词检索系统</h2>

			<form action="" method="get" style="text-align: center;">
			<div id="s">
				<input id="s_ipt" type="text" name="text" class="form-control btn-lg" placeholder="关键词（诗名/作者/古诗句）" style="display: inline; width: 70%;padding: 23px 5px; font-size: 1em">
				<input id="s_btn" type="submit" name="submit" value="搜索" class="btn btn-primary btn-lg" style="font-size: 1.4em"><br/>
			</div>
					

					<p id="sm-btn">
					<button type="button" class="btn btn-default" data-toggle='modal' data-target='#layer'>发布诗词</button><button class="btn btn-default">贡献翻译</button>
					</p>
			</form>
	<br>
	
	<table class="table table-hover table-bordered table-striped" style="text-align: center;">
	<!-- 加载动画 -->
  		<div class='row col-sm-12' id="loading">
  			
  		</div>
  		<?php 
  		
  	// 表单查询数据库

  		//如果点击搜索按钮的情况
	if (isset($_GET['submit'])&&!empty($_GET['submit'])) {
		echo "<script>
			$(document).ready(function(){
							$('.fbar').hide();
						});
			</script>";
		// 点击搜索按钮的情况
		$user_text = $_GET['text'];
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
            var_dump($totalPage);
        }
        if (isset($_GET['pageNum']) && $_GET['pageNum'] < $totalPage) {
            $pageNum = $_GET['pageNum'];
            $offset = ($pageNum - 1) * 10;
        }
        $sql = "select * from poetries inner join poets on poetries.poet_id = poets.id where poets.name='$user_text' or title like'%$user_text%' or content like'%$user_text%' order by poetries.updated_at desc limit $offset,10";
        $list = mysql_query($sql);
        
		
	if(mysql_affected_rows() > 0){
	echo "<tr style='font-weight: bold;'>
  			<th>名称</th>
  			<th>作者</th>
  			<th>更新时间</th>
  			<th>操作</th>
  		</tr>";
  		// 循环输出查询数据
  	while ($row = mysql_fetch_array($list)) {
			echo "<tr><td><a href='./content.php?id=$row[0]'>$row[title]</a></td><td>$row[name]</td><td>$row[5]</td><td><button class='btn btn-primary'><a href='./content.php?id=$row[0]'>查看</a></button></td></tr>";
		}
		echo "</table><div style='text-align:center'><ul class='pagination'>";
		for ($i=1; $i <=$totalPage ; $i++) { 	
			echo "<li><a href='./index.php?text=$user_text&submit=搜索&pageNum=$i'>第$i 页</a></li>";
		}
		echo "</ul></div>";


	}else if(mysql_affected_rows()==0){
		echo '<p align=center>数据库未收录和【'.$user_text.'】相关数据</p>';
	}
}

  		?>
</div>



<!--模状框 对话框-->
        <div role="dialog" class="modal fade" id="layer"">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <h4 style="text-align: center;">发布诗词</h4>
                        <form method="post">
	                        <div class="input-group">
		                        <span class="input-group-addon" id="sizing-addon2">题目</span>
		                        <input name="title" type="text" class="form-control" placeholder="这首诗/词叫什么名字？" aria-describedby="sizing-addon2">
	                        </div><br>
	                        <div class="input-group">
		                        <span class="input-group-addon" id="sizing-addon2">作者</span>
		                        <input name="author" type="text" class="form-control" placeholder="作者的名字?" aria-describedby="sizing-addon2">
	                        </div><br>
	                        <div class="input-group">
		                        <span class="input-group-addon" id="sizing-addon2">内容</span>
		                        <textarea name="content" type="text" class="form-control" placeholder="请输入内容部分，注意用标点符号断句。" aria-describedby="sizing-addon2"></textarea>
	                        </div>

	                        <div class="modal-body text-right">
	                            <button class="btn btn-danger" name="insert" id='submit'>提交</button>
	                            <button class="btn btn-primary" data-dismiss="modal">取消</button>
	                        </div>
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
    		<span id="fr"><a href="./about.php">关于本站</a></span>
    		<span id="fr"><a href="#">隐私权</a></span>
    	</div>
    </div>

</body>
</html>

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
			if ($list) {
				alertMsg('成功！信息已发布。');
				// showMaxId('poetries');
		}

			}else{
				alertMsg('警告！提交的信息不完整。');
				
			}
			// 提交作品译文后马上刷新页面
        	// echo "<script>window.location.href=window.location.href;</script>";
		}
		// else{
		// 	alertMsg('失败！服务器异常。');
		// }
		// showPagination($totalPage);
 ?>



