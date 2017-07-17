<?php 
	function alertMsg($ErrorMsg,$time='9000')
	{
		echo "<div  class='alert alert-danger alert-dismissible navbar-fixed-top' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
                </button>
     <strong>$ErrorMsg</strong></div><script >
    $(document).ready(function(){
        $('.alert').fadeOut($time);
    });
</script>";
	}

    function showPagation(){
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
        $sql = "select * from poetries inner join poets on poetries.poet_id = poets.id where poets.name='$user_text' or title like'%$user_text%' or content like'%$user_text%' order by poetries.updated_at desc limit $offset,20";
        $list = mysql_query($sql);
    }

//     function showPagination($totalPage){
//     echo "<script>
//     $('.pagination').bootstrapPaginator({    
//     currentPage: 1,    
//     totalPages: $totalPage,    
//     size:'normal',    
//     bootstrapMajorVersion: 3,    
//     alignment:'left',    
//     numberOfPages:5,    
//     itemTexts: function (type, page, current) {        
//         switch (type) {            
//         case 'first': return '首页';            
//         case 'prev': return '上一页';            
//         case 'next': return '下一页';            
//         case 'last': return '末页';            
//         case 'page': return page;
//         }
//     }
// });
// });
// </script>";
//     }

 ?>