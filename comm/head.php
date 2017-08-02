	<meta charset="UTF-8">
	<meta http-equiv="content-language" content="zh-cn">
	<!-- 简体中文 -->
	<meta http-equiv="content-type" content="text/html; charset=gb2312">
	<!-- 繁体中文 -->
	<meta http-equiv="content-type" content="text/html; charset=big5">
	<!-- 英 语 -->
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<!-- 作者 -->
	<meta name="author" content="924114103@qq.com">
	<meta name="description" content="一个简洁高效的古诗词搜索引擎，目前系统收录的古诗词数量有70多万。古诗词爱好者通过该系统可以快速的查询到历代诗人的作品，出处及译文。">
	<meta name="keywords" content="古诗词检索系统,诗词检索,诗词查询">
	<meta http-equiv="window-target" content="_top">
	<meta http-equiv="Cache-Control" content="no-transform" /> 
	<!-- 禁止百度转码 -->
	<meta http-equiv="Cache-Control" content="no-siteapp" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link href="./css/loaders.min.css" rel="stylesheet">
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript" src='./js/bootstrap.min.js'></script>
	<!-- <script src="./js/loaders.css.js"></script> -->
	<link rel="stylesheet" type="text/css" href="./css/mystyle.css">
	<!-- <script type="text/javascript" src="./js/index.js"></script> -->
<script >
	$(document).ready(function(){
		$("#submit").click(function(){
			$('alert').hide();
		});
	});
</script>

<!-- 百度推送 -->
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();

// 谷歌分析

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102647119-1', 'auto');
  ga('send', 'pageview');
</script>



<?php include './comm/fun.php'; ?>