![](https://s1.ax1x.com/2017/10/19/twWaF.png)
### tesk list
1. 实现作者或名称或古诗句模糊查询			yes!
2. 点击标题进入详情页>获取诗词的ID GET传递	yes!
3. mysql 修改时间戳为正确的显示时间			yes!
4. 从数据库显示最新的10条数据 				yes! 
5. 列表编辑操作 添加一首古诗到数据库			yes!
6. 显示分页								yes!
7. 后台实现删除编辑						yes!	
8. 添加谷歌分析 							yes!

<!-- 修改表结构
		修改字段: alter table 表名 change 旧字段名 新字段名 字段类型；
		增加字段: alter table 表名 add 字段名 字段类型；
		
 -->
### 1. 搜索功能
```
select * from poetries inner join poets on poetries.poet_id = poets.id where poets.name='$user_text' or title like'%$user_text%' or content like'%$user_text%';
```

### 2. 通过标题进入详情页
```
// A 页面
<a href='./B.php?id=$row[0]'>$row[title]</a>

// B 页面
	$mpoet_id = $_GET['id'];
	$sql  = "select * from poetries inner join poets on poetries.poet_id = poets.id where poetries.id='$mpoet_id'";
	$result = mysql_query($sql);
	$rows = mysql_fetch_array($result);
	$strs= $rows['content'];
// 把古诗词从句号换行输出
 	$strs = str_replace("。", "。<br />", $strs);
 	<h1><?php echo $rows['title']; ?></h1>
	<h5>作者：<?php echo $rows['name']; ?></h5>
	<p><?php echo $strs; ?></p>
```

### 3. 把数据库中的datetime 转换成字符串
```
SELECT unix_timestamp(updated_at) from poetries;
```

### 4. 从数据库显示最新的10条数据 
```
 select title from poetries order by updated_at desc limit 10;
```
 

### 5. 新增字段
在poetries鸟中新增字段`translate`用于存储古诗词的作品翻译
```
 alter table poetries add translate text COLLATE utf8_unicode_ci;
 ```
   

### end 插入一条测试数据
```
insert into `poetries`(`translate`)values("春眠不觉晓，处处闻啼鸟。
夜来风雨声，花落知多少") where id='43029';
```

update `poetries` set `translate`='江南的风景多么美好，如画的风景久已熟悉。春天到来时，太阳从江面升起，把江边的鲜花照得比火红，碧绿的江水绿得胜过蓝草。怎能叫人不怀念江南？江南的回忆，最能唤起追思的是像天堂一样的杭州：游玩灵隐寺寻找皎洁月亮中的桂子，登上郡亭，枕卧其上，欣赏那起落的钱塘江大潮。什么时候能够再次去游玩？江南的回忆，再来就是回忆苏州的吴宫，喝一喝吴宫的美酒春竹叶，看一看吴宫的歌女双双起舞像朵朵迷人的芙蓉。不知何时会再次相逢。' where id='43041';


### 关于【bootstrap modal 模态框弹出瞬间消失的问题】
提供一个小例子说明。
```
<button class="btn btn-primary btn-lg"  type="button"  data-toggle="modal"data-target="#myModal">
```
注意红字部分*type="button"*，在需要触发的按钮处，加入这一段就好了。
