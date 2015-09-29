<?php #login.php
	require './includes/setting.php';
	$page_title = '登陆 | '.SITE_TITLE;
	//标记此页面为登陆页面，header.inc中奖用到，用于返回登陆前页面
	$flag_login=TRUE;
	require_once './includes/header.inc';
	//require_once './includes/right_side.inc';
	require_once './includes/connect_db.php';
	
	if(isset($_SESSION['user_name'])){
		echo '<h1>您已经登陆,无需再次登录！</h1>';
		exit();
	}
if (isset($_POST['submitted'])) {

	// 验证邮箱
	if (!empty($_POST['email'])) {
		//$email = escape_data($_POST['email']);
		//$email = mysqli_real_escape_string($dbc, $_POST['email']);
		$email = $_POST['email'];
	} else {
		echo '<p><font color="red" size="+1">请输入邮箱地址!</font></p>';
		$e = FALSE;
	}
	
	// 验证密码
	if (!empty($_POST['password'])) {
		//$password = escape_data($_POST['password']);
		//$password = mysqli_real_escape_string($dbc, $_POST['password']);
		$password = $_POST['password'];
	} else {
		$password = FALSE;
		echo '<p><font color="red" size="+1">请输入密码!</font></p>';
	}
	
	//验证账号
	if ($email && $password) {
		$query = "SELECT user_id, user_name,user_email FROM blog_users WHERE user_email='$email' AND user_password=SHA('$password') AND user_active_code=''";		
		//echo $query;
		$result = mysqli_query($dbc,$query) or die("查询出错: " . mysqli_error($dbc));
		if (@mysqli_num_rows($result) > 0) { 
			// 添加session
			$row = mysqli_fetch_array($result, MYSQL_NUM); 
			mysqli_free_result($result);
			mysqli_close($dbc);
			$_SESSION['user_email'] = $row[2];
			$_SESSION['user_name'] = $row[1];
			$_SESSION['user_id'] = $row[0];
			
			//记住密码
			if($_POST['rememberme']){
				switch($_POST['rememberme']){
					case '1':		
						setcookie('email',$email,time()+60*60*24*1);
						setcookie('pwd',$password,time()+60*60*24*1);
						break;
					case '2':
						setcookie('email',$email,time()+60*60*24*7);
						setcookie('pwd',$password,time()+60*60*24*7);
						break;
					case '3':
						setcookie('email',$email,time()+60*60*24*30);
						setcookie('pwd',$password,time()+60*60*24*30);
						break;
				}
			}	
						
			// 定义URL，返回登陆前的页面
			//$url=substr($_SERVER['QUERY_STRING'], 12);
			//点击登录前页面就是登录页面,返回首页
			//if(!$url) $url=SITE_PATH.'index.php';
			$url=SITE_URL.'index.php';
			ob_end_clean();
			//echo "<script type=text/javascript>location.href='$url';</script>";
			header("Location: $url");
			exit(); 
				
		} else { // 验证失败
			echo '<p><font color="red" size="+1">邮箱或密码错误，也可能没验证邮箱。</font></p>'; 
		}
		
	} else {
		echo '<p><font color="red" size="+1">请重试！</font></p>';		
	}
	
	mysqli_close($dbc);

}
?>
<div id='login'>
<h1>登录</h1>
<p>您的浏览器必须支持cookie以便顺利登录。</p>
<!-- $_SERVER['REQUEST_URI']，方便返回登陆前的页面 -->
<form action=<?php echo $_SERVER['REQUEST_URI'];?> method="post">
	<fieldset>
	<p><b>邮箱:</b> <input type="text" name="email" size="20" maxlength="40" value="<?php 
	if(isset($_POST['email']))echo $_POST['email'];		
	elseif(isset($_COOKIE['email']))echo $_COOKIE['email'];?>" /></p>
	<p><b>密码:</b> <input type="password" name="password" size="20" maxlength="20"  value="<?php 		
	if(isset($_COOKIE['pwd']))echo $_COOKIE['pwd']; ?>"/></p>
	<label>记住我:  </label><input type="radio" name='rememberme' value='1' checked="checked"/>一天
	<input type="radio" name='rememberme' value='2' />一周
	<input type="radio" name='rememberme' value='3' />一个月
	<div><input type="submit" name="submit" value="登录" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
	</fieldset>
</form>
</div>
<?php 
		
		echo '</div>';//匹配right_side.inc中未匹配的</div>
		require_once './includes/footer.inc';
?>