<?php #logout.php
	ob_start();
	require './includes/setting.php';
	$page_title = '注销 | '.SITE_TITLE;
	$need_login=false;
	require_once './includes/header.inc';
	require_once './includes/right_side.inc';
	require_once './includes/connect_db.php';
	
	//如果未登录则返回主页
if (!isset($_SESSION['user_name'])) {

	// 定义URL
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	// 检查dirname产生的最后一个字符，如果为 '\'或'/'则去掉
	if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
		$url = substr ($url, 0, -1);
	}
	$url .= '/index.php';
	
	ob_end_clean(); // 删除输出缓存
	header("Location: $url");
	exit();
	
} else { // 登录则注销

	$_SESSION = array(); // 将所有session置空
	session_destroy(); // 销毁session本身
	setcookie (session_name(), '', time()-300, '/', '', 0); // 销毁cookie
	//echo '<div id="post"><h1>注销成功!......</h1></div>';
	$url = SITE_URL.'index.php';
	header("Location: $url");
}
		ob_end_flush();
		echo '</div>';//匹配right_side.inc中未匹配的</div>
		require_once './includes/footer.inc';
?>