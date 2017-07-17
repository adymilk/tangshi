<?php 
// config
include './config/init.php';

	$mid = $_GET['id'];
	$sql  = "select * from poetries inner join poets on poetries.poet_id = poets.id where poetries.id='$mid'";
	$result = mysql_query($sql);
	$rows = mysql_fetch_array($result);
	$strs= $rows['content'];

	// 把古诗词从句号换行输出
    $strs = str_replace(['。'], '。<br />', $strs);
    $strs = str_replace(['？'], '？<br />', $strs);
 	$strs = str_replace(['；'], '；<br />', $strs);
	// echo $strs;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <title><?php echo "《$rows[title]》|古诗词检索系统"; ?></title>
    <?php include './comm/head.php'; ?>
    <script type="text/javascript" src="./js/bootstrap-paginator.min.js"></script>
</head>
 <body>
 <!-- 作品原文区 -->
 	<div class="jumbotron" style="text-align: center;">
	  <h1><?php echo $rows['title']; ?></h1>
	  <h5>作者：<?php echo $rows['name']; ?></h5>
	  <p><?php echo $strs; ?></p>
	  <p><a class="btn btn-primary btn-lg" href="javascript:history.go(-1);" role="button">查询更多</a></p>
	</div>

	<!-- 注释译文区 -->
	<div class="panel panel-success">
		<div class="panel-heading">
        <h3 class="panel-title">作品相关</h3>
      </div>
      <div class="panel-body">
        <?php 
        	$sql = "select translate from poetries where id='$mid'";
        	$list = mysql_query($sql);
        	$row = mysql_fetch_array($list);
        	// 判断查询字段是否为null
        	if (empty($row['translate'])) {

        		echo "<p style=text-align:center>此作品相关尚未添加，才华横溢的你愿意帮助我们完善这首诗吗？</p><br/><button class='btn btn-primary' data-toggle='modal' data-target='#layer'>添加</button>";
        	}else{
                $strs = $row['translate'];
                $strs = str_replace("。", "。<br />", $row['translate']);
        		echo "<p>$strs</p><br/><button class='btn btn-primary' data-toggle='modal' data-target='#layer' name='Edit'>编辑</button>";
        	}
         ?>
      </div>
	</div>

	<!--模状框 对话框-->
        <div role="dialog" class="modal fade" id="layer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                        </button>
                        <h4>翻译<?php 
                           echo '《'.$rows['title'].'》';
                           ?>
                        </h4>
                        <form method="post">
                        	<textarea name="translate" class="form-control" rows="10" style="text-align: left;"><?php 
                                    echo $row['translate'];?></textarea>
                        	<div class="modal-body text-right">
                            <input type='submit' name="submit" class="btn btn-danger" value="提交">
                            <button class="btn btn-primary" data-dismiss="modal">取消</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

 </body>
 </html>

 <?php if (isset($_POST['submit'])) {
 	$translateTxt = $_POST['translate'];
    if (empty($translateTxt)) {
        // echo "你提交的数据为空？请在试一次！";
        alertMsg('你提交的数据为空？请在试一次！');
    }else{
        $sql = "update poetries set translate='$translateTxt' where id='$mid'";
        $list = mysql_query($sql);
        // 提交作品译文后马上刷新页面
        echo "<script>window.location.href=window.location.href;</script>";
        alertMsg('成功！数据已更新。');

    }
 	
   
          
 	

 } ?>
 