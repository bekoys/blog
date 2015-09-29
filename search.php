<?php 
	require './includes/setting.php';
	$page_title = '搜索 | '.SITE_TITLE;
	$need_login=false;
	require_once './includes/header.inc';
	require_once './includes/right_side.inc';
	//去掉多余的空格
	$search_text=trim($_GET['search_text']);
	$dbc=mysqli_connect('localhost','root','','mlhu5y21_2013') or die('热文排行连接数据库错误'.mysqli_error());
	//获取一个合法的查询串
	$search_text=str_replace(',',' ', $search_text);
	$search_text=explode(' ', $search_text);
	$search_words=array();
	if(count($search_text)>0)
		foreach($search_text as $word)
			if(!empty($word))
				$search_words[]=$word;
	
	//获取where子句
	$where_list=array();
	if(count($search_words)>0){
		foreach($search_words as $word){
			$where_list[]="post_title LIKE '%$word%'";
		}
	}
	$where_clause=implode(' OR ',$where_list);
	$query="select post_id,post_date,post_title,post_excerpt,post_status,term_name from blog_posts where $where_clause";
	//$query="select post_id,post_date,post_title,post_excerpt,post_status,term_name from blog_posts 
	//where match(post_title) against('$search_text' in boolean mode)";
	$result=mysqli_query($dbc,$query) or die('查询出错'.mysqli_error());
	mysqli_close($dbc);
	echo '<div class="post">';
	while($row=mysqli_fetch_array($result))
	{
		if($row['post_status']=='publish')
		{
			$href=SITE_URL.'post.php?pageid='.$row['post_id'];
			echo "<h3><a href='$href'>$row[post_title]</a></h3><p>$row[post_excerpt]";
			echo "…… <a href=./post.php?pageid=$row[post_id]>阅读全文</a>
			<div class=date>分类：<a href='' title=>$row[term_name]  |</a> 评论：0 | 日期: $row[post_date].</div>";
		}
	}
	echo '</div></div>';//匹配right_side.inc中未匹配的</div>
	
?>