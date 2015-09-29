<?php
// dmin_link.php
require '../includes/setting.php';
$page_title = '链接管理 | ' . SITE_TITLE;
$need_login = true;
require_once '../includes/header.inc';
// require_once './includes/right_side.inc';
require_once '../function.php';
// 删除链接
if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'del') {
	$query_del = "delete from blog_links where link_id=$_GET[lid]";
	$result_del = mysqli_multi_query ( $dbc, $query_del ) or die ( mysqli_error () );
	header ( "location:" . SITE_URL . "admin/admin_link.php?del=true" );
}

// default order by title
$order = isset ( $_GET ['order'] ) ? $_GET ['order'] : 'title';
// title => asc order, time and comment => desc order
if (isset ( $_GET ['sort'] )) {
	$sort = $_GET ['sort'];
} else {
	$sort = $order == 'title' ? 'asc' : 'desc';
}

switch ($order) {
	case 'time' :
		$order_clause = "order by link_date $sort";
		break; // sort表示升降序
	case 'title' :
		$order_clause = "order by link_name $sort";
		break;
}

$query = "select link_id,link_url,link_name,link_date from blog_links $order_clause";
$result = mysqli_query ( $dbc, $query ) or die ( mysqli_error () );
mysqli_close ( $dbc );
echo "<div id='post'>";
$sort = isset ( $_GET ['sort'] ) ? ($_GET ['sort'] == 'asc' ? 'desc' : 'asc') : 'asc';
echo "<table><thead><tr><th><a href='" . SITE_URL . "admin/admin_link.php?order=title&sort=$sort'>标题</a></th>
  	<th>地址</th>
  	<th><a href='" . SITE_URL . "admin/admin_link.php?order=time&sort=$sort'>时间</a></th>
  	</tr></thead>";
while ( $row = mysqli_fetch_array ( $result ) ) {
	$url = "delete-ajax.php?action=link_del&lid=$row[link_id]&order=$order&sort=$sort";
	echo "<tbody><tr class='item'><td width='290'><a href=../collect.php>$row[link_name]</a></td>
				<td width='320'><a href='$row[link_url]' title=>$row[link_url]</a></td>
				<td width='170'>$row[link_date]</td></tr>";
	echo "<tr class='action_list'><td><a href='" . SITE_URL . "link.php?action=edit&lid=$row[link_id]'>编辑</a></td>" . "<td><a href='$_SERVER[PHP_SELF]?action=del&lid=$row[link_id]'>删除</a></td></tr></tbody>";
}
echo '</table>';
echo '</div>'; // div id=post
require_once '../includes/footer.inc';
?>	