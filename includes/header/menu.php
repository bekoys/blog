<div id="menu">
	<ul class="sf-menu">
		<li class="current"><a href="<?php echo SITE_URL?>index.php">主页</a></li>
		<li><a href=''>分类</a>
			<ul>
				<li><a href="<?php echo SITE_URL?>term.php?term_name=数据库"
					title="数据库">数据库</a></li>
				<li><a href="<?php echo SITE_URL?>term.php?term_name=asp.net"
					title="ASP.NET">ASP.NET</a></li>
				<li><a href="<?php echo SITE_URL?>term.php?term_name=wamp"
					title="WAMP">WAMP</a></li>
				<li><a href="<?php echo SITE_URL?>term.php?term_name=计算机网络"
					title="计算机网络">计算机网络</a></li>
				<li><a href="<?php echo SITE_URL?>term.php?term_name=java"
					title="Java">Java</a></li>
				<li><a href="<?php echo SITE_URL?>term.php?term_name=综合"
					title="Java">综合</a></li>
			</ul></li>
		<li><a href="<?php echo SITE_URL?>album.php" title="相册">相册</a></li>

		<li><a href="<?php echo SITE_URL?>write_log.php" title="新博客">写博客</a>
		</li>

		<li><a href='' title="管理">管理</a>
			<ul>
				<li><a href=''>管理博客</a>
					<ul>
						<li><a href="<?php echo SITE_URL?>admin/admin_log.php" title="">管理</a></li>
						<li><a href="<?php echo SITE_URL?>write_log.php" title="">写博客</a></li>
					</ul></li>
				<li><a href=''>管理收藏</a>
					<ul>
						<li><a href="<?php echo SITE_URL?>admin/admin_link.php" title="">管理</a></li>
						<li><a href="<?php echo SITE_URL?>collect.php" title="">查看</a></li>
						<li><a href="<?php echo SITE_URL?>link.php" title="">添加</a></li>
					</ul></li>
				<li><a href=''>管理相册</a>
					<ul>
						<li><a href="<?php echo SITE_URL?>admin/admin_album.php" title="">管理
						</a></li>
						<li><a href="<?php echo SITE_URL?>link.php" title="">添加</a></li>
					</ul></li>

			</ul></li>
		<li><a href='' title="统计">统计</a>
			<ul>
				<li><a href="<?php echo SITE_URL?>statistics.php?category=cpu"
					title="">CPU Usage</a></li>
				<li><a href="<?php echo SITE_URL?>statistics.php?category=mem"
					title="">Memery Usage</a></li>
				<li><a href="<?php echo SITE_URL?>statistics.php?category=load"
					title="">CPU Load</a></li>
			</ul>
		
		<li>
		
		<li><a href='' title="统计">统计</a>
			<ul>
				<li><a href="<?php echo SITE_URL?>chart.php?stat_cat=term" title="">按分类统计
				</a></li>
				<li><a href="<?php echo SITE_URL?>chart.php?stat_cat=album"
					title="">按相册统计</a></li>
				<li><a
					href="<?php echo SITE_URL?>chart.php?stat_cat=date&graph_cat=pie"
					title="">按日期统计</a></li>
			</ul>
		
		<li><span class='feed_icon'> <a id='feed'
				href="<?php echo SITE_URL.'rss.php'?>">&nbsp;&nbsp;订阅青年博客</a>
		</span></li>

	</ul>
</div>