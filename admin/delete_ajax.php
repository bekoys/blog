<?php #delete-ajax.php
	ob_start();
	require_once '../includes/connect_db.php';
	//删除相册
	if($_GET['action']=='album_del'){
		$aid=$_GET['aid'];
		//读更新后的数据库
		if(isset($_GET['order'])){
			$sort=$_GET['sort'];
			switch($_GET['order']){
				case 'time':  $order_clause="order by album_date $sort";break;	//sort表示升降序
				case 'name': $order_clause="order by album_name $sort";break;
			}
		}
		$query="select album_id,album_date,album_name,album_status from blog_albums where album_id!=$aid $order_clause ";
		$result=mysqli_query($dbc,$query) or die(mysqli_error($sql));	
		//从数据库中删除
		$query_del="delete from blog_albums where album_id=$_GET[aid];";
		$query_del.="delete from blog_imgs where album_id=$_GET[aid];";
		$result_del=mysqli_multi_query($dbc,$query_del) or die(mysqli_error($sql));
  		mysqli_close($dbc);
  		header('Content-type: text/html;charset=UTF-8');
  		//更新<table>中的内容
  		echo "<thead><tr><th><a href='".SITE_URL."admin/admin_album.php?order=name&sort=$sort'>相册名</a></th>
  		<th><a href='".SITE_URL."admin/admin_album.php?order=time&sort=$sort'>时间</a></th>
  		<th>公开</th></tr></thead>";
		while($row=mysqli_fetch_array($result))
		{
			echo "<tbody><tr class='item'><td width='490'><a href=../album.php?pageid=$row[post_id]>$row[album_name]</a></td>
				<td width='270'>$row[album_date]</td><td width='40'>$row[album_status]</td></tr>";
			echo "<tr class='action_list'><td><a href='".SITE_URL."write_log.php?action=edit&aid=$row[album_id]'>编辑</a></td>".
			"<td><a href='$_SEVER[PHP_SELF]?action=del&aid=$row[album_id]&order=$_GET[order]&sort=$_GET[sort]'>删除</a></td></tr></tbody>";
		}
	}
	//删除文章
	if($_GET['action']=='post_del'){
	$pid=$_GET['pid'];
		//读更新后的数据库
		if(isset($_GET['order'])){
			$sort=$_GET['sort'];
			switch($_GET['order']){
				case 'time':  $order_clause="order by album_date $sort";break;	//sort表示升降序
				case 'name': $order_clause="order by album_name $sort";break;
			}
		}
		$query="select post_id,post_date,post_title,post_status,term_name,comment_count from blog_posts where post_id!=$pid $order_clause";
		$result=mysqli_query($dbc,$query) or die(mysqli_error($sql));	
		//从数据库中删除
		$query_del="delete from blog_posts where post_id=$pid;";
		$query_del.="delete from blog_comments where post_id=$pid;";
		$query_del.="delete from blog_terms where post_id=$pid";
		$result_del=mysqli_multi_query($dbc,$query_del) or die(mysqli_error($sql));
  		mysqli_close($dbc);
  		header('Content-type: text/html;charset=UTF-8');
  		//更新<table>中的内容
  		echo "<thead><tr><th><a href='".SITE_URL."admin/log.php?order=title&sort=$sort'>标题</a></th>
  		<th>分类</th>
  		<th><a href='".SITE_URL."admin/log.php?order=time&sort=$sort'>时间</a></th>
  		<th><a href='".SITE_URL."admin/log.php?order=comment&sort=$sort'>评论</a></th></tr></thead>";
		while($row=mysqli_fetch_array($result))
		{
			echo "<tbody><tr class='item'><td width='490'><a href=./post.php?pageid=$row[post_id]>$row[post_title]</a></td>
				<td width='120'><a href='".SITE_URL."term.php?term_name=$row[term_name]' title=>$row[term_name]</a></td>
				<td width='170'>$row[post_date]</td><td width='40'>$row[comment_count]</td></tr>";
			echo "<tr class='action_list'><td><a href='".SITE_URL."write_log.php?action=edit&pid=$row[post_id]'>编辑</a></td>".
			"<td><a href='$_SEVER[PHP_SELF]?action=del&pid=$row[post_id]'>删除</a></td></tr></tbody>";
		}
	}
	ob_end_flush();
?>
	