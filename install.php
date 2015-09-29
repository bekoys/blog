<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<h1>正在安装。。。</h1>
<?php #login.php
	require './includes/setting.php';
	$page_title = '安装 | '.SITE_TITLE;

	$setting_file = "/includes/setting.php";
	if( !is_writable($setting_file))
	{
		echo "<font color='red'>配置文件不可写！！！</font>";
	}
	else
	{
		echo "<font color='green'>配置文件可写</font>";
	}
	if(isset($_POST['submit'])){
		$content = readfile('include/setting.php');
		str_replace('__WEBPATH__', dirname(__FILE__), $content);
		
		$FH_setting = fopen($setting_file, "a+");
		fwrite($FH_setting, $setting_str);
		//=====================
		include_once ("data/config.php"); //嵌入配置文件
		if (!@$link = mysql_connect($mysql_host, $mysql_user, $mysql_pass)) { //检查数据库连接情况
		echo "数据库连接失败! 请返回上一页检查连接参数 <a href=install.php>返回修改</a>";
	} 
	else 
	{
		$mysql_dbname = 'mlhu5y21_2013';
		mysql_query("CREATE DATABASE '$mysql_dbname'");
		mysql_select_db($mysql_dbname);
		$sql_query[] = "CREATE TABLE `" . $mysql_tag . "admin_log1` (
		`id` int(8) unsigned NOT NULL auto_increment,
		`username` varchar(40) NOT NULL COMMENT '操作用户名称',
		`types` varchar(60) NOT NULL,
	PRIMARY KEY (`id`)
	) ;";
	$sql_query[] = "CREATE TABLE `" . $mysql_tag . "admin_log2` (
	`id` int(8) unsigned NOT NULL auto_increment,
	`username` varchar(40) NOT NULL COMMENT '操作用户名称',
	`types` varchar(60) NOT NULL,
	PRIMARY KEY (`id`)
	) ;";
	$sql_query[] = "CREATE TABLE `" . $mysql_tag . "admin_log3` (
	`id` int(8) unsigned NOT NULL auto_increment,
	`username` varchar(40) NOT NULL COMMENT '操作用户名称',
	`types` varchar(60) NOT NULL,
	PRIMARY KEY (`id`)
	) ;";
	foreach($sql_query as $val){
	mysql_query($val);
	}
	echo "<script>alert('安装成功!');location.href='index.php'</script>";
	rename("install.php","install.lock");
	}
	}
?>
<hr>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <table>
    	<tr>
    		<th>blog文件夹安装路径：（如E:/wamp/www/blog/)</th>
			<td><input type="text" name="web_path" value=""/></td>
		</tr>	
		<tr>
        	<th></th>
        	<td><input type='submit' name='submit' value='下一步'/></td>
        </tr>
</form>
</body>
</html>