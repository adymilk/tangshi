<?php 
include '../config/init.php';
include './fun.php';
// 删除诗词
	// if (isset($_GET['id'])){
	// 	$id = $_GET['id'];
	// 	var_dump($id);
	// 	$sql = "delete from poetries where id='$id'";
	// 	$list = mysql_query($sql);
	// 	var_dump($list);
	// 	$rows = mysql_affected_rows();
	// 	var_dump($rows);
		
	// 	if (!empty($rows)) {
	// 		alertMsg('成功！一条信息已删除。');
	// 		echo "<script>setTimeout(function(){window.location.reload();},2000);</script>";
	// 	}else{
	// 		alertMsg('成功！一条信息已删除。');
	// 		// echo "<script>window.location.href=window.location.href;</script>";
	// 	}

	// }
	
 ?>
 <!-- 删除 诗词对话框 -->
        <!-- <div role="dialog" class="modal fade" id="del">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                        <form method="post">
                        <h4>你确定要删除吗？</h4>
                        	<div class="modal-body text-right">
	                            <input name="sub-del" class="btn btn-danger" type="submit" value="确定">
	                            <input name="cancel" class="btn btn-primary" type="button" value="取消">
                        	</div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> -->