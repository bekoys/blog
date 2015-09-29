<?php
require 'admin_init.php';
require TEMPLATE_PATH . 'header.php';

// 删除文章
if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'del') {
    Post_Model::getInstance()->deleteLog($_GET['pid']);
	header ( "location:" . TEMPLATE_PATH . "log.php?del=true" );
}

// default order by title
$order = isset($_GET['order']) ? $_GET['order'] : 'title';
// title => asc order, time and comment => desc order
if(isset($_GET['sort'])) {
	$order = $_GET['sort'];
} else {
	$order = $order == 'title' ? 'asc' : 'desc';
}

switch ($order) {
	case 'time' :
		$order_clause = "order by post_date $order";
		break; // sort表示升降序
	case 'title' :
		$order_clause = "order by post_title $order";
		break;
	case 'comment' :
		$order_clause = "order by comment_count $order";
		break;
}

$query = "select post_id,post_date,post_title,post_status,term_name,comment_count from blog_posts $order_clause";
$result = mysqli_query ( $dbc, $query ) or die (  );
mysqli_close ( $dbc );
echo "<div id='post'>";
// $sort=$_GET['sort']=='asc'?'desc':'asc';
$order = isset ( $_GET ['sort'] ) ? ($_GET ['sort'] == 'asc' ? 'desc' : 'asc') : 'desc';
echo "<table id='post_admin'><thead><tr><th><a href='" . SITE_URL . "admin/log.php?order=title&sort=$order'>标题</a></th>
  	<th>分类</th>
  	<th><a href='" . SITE_URL . "admin/log.php?order=time&sort=$order'>时间</a></th>
  	<th><a href='" . SITE_URL . "admin/log.php?order=comment&sort=$order'>评论</a></th></tr></thead>";
while ( $row = mysqli_fetch_array ( $result ) ) {
	$url = "delete-ajax.php?action=post_del&pid=$row[post_id]&order=$order&sort=$order";
	echo "<tbody><tr class='item'><td width='490'><a href=../post.php?pageid=$row[post_id]>$row[post_title]</a></td>
				<td width='120'><a href='" . SITE_URL . "term.php?term_name=$row[term_name]' title=>$row[term_name]</a></td>
				<td width='170'>$row[post_date]</td><td width='40'>$row[comment_count]</td></tr>";
	echo "<tr class='action_list'><td><a href='" . SITE_URL . "write_log.php?action=edit&pid=$row[post_id]'>编辑</a></td>" . "<td><a href='javascript:post_del(\"$url\")'>删除</a></td></tr></tbody>";
}
echo '</table>';
echo '</div>'; // div id=post
require_once '../includes/footer.inc';
?>
<script type="text/javascript">
var http_request = false;
function createRequest(url) {
	//初始化对象并发出XMLHttpRequest请求
	http_request = false;
	if (window.XMLHttpRequest) { 										//Firefox,chrome等其他浏览器
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType("text/xml");
		}
	} else if (window.ActiveXObject) { 								//IE浏览器
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
		   } catch (e) {}
		}
	}
	if (!http_request) {
		alert("不能创建XMLHTTP实例!");
		return false;
	}
	http_request.onreadystatechange = alertContents;   					 //指定响应方法
	
	http_request.open("GET", url, true);								 //发出HTTP请求
	http_request.send(null);
}
function alertContents() {   											 //处理服务器返回的信息
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			post_admin.innerHTML=http_request.responseText;				//设置album_admin HTML文本替换的元素内容
		} else {
			alert('您请求的页面发现错误');
		}
	}
}
</script>
<script type="text/javascript">
	function post_del(url) {
		createRequest(url);
	}
</script>

<?php
require TEMPLATE_PATH . 'footer.php';
