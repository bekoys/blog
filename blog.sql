-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 03 月 23 日 04:29
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_imgs`
--

CREATE TABLE IF NOT EXISTS `blog_imgs` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_name` varchar(100) NOT NULL,
  `img_date` datetime NOT NULL,
  `album_id` int(10) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_links`
--

CREATE TABLE IF NOT EXISTS `blog_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '' COMMENT '此链接对应网站的简介',
  `user_id` int(10) unsigned NOT NULL,
  `link_date` datetime DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `blog_options`
--

CREATE TABLE IF NOT EXISTS `blog_options` (
  `option_id` int(10) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(32) NOT NULL,
  `option_value` varchar(2048) NOT NULL,
  `option_description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `blog_options`
--

INSERT INTO `blog_options` (`option_id`, `option_name`, `option_value`, `option_description`) VALUES
(1, 'theme_menu', '[{"id":1},{"id":4,"children":[{"id":2},{"id":3},{"id":5,"children":[]}]}]', NULL),
(2, 'current_theme', 'default', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `post_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章的ID号',
  `post_date` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '最近一次提交的日期',
  `post_content` text NOT NULL COMMENT '文章内容',
  `post_title` varchar(100) NOT NULL DEFAULT '无标题文档' COMMENT '标题',
  `post_excerpt` text COMMENT '摘要',
  `post_status` enum('publish','draft') DEFAULT 'publish',
  `term_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`post_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `blog_posts`
--

INSERT INTO `blog_posts` (`post_ID`, `post_date`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `term_id`) VALUES
(4, '2013-11-18 09:59:38', 'adfa', 'sf', 'sdf', 'publish', 1),
(5, '2013-11-18 14:51:11', '```\r\nvar o = {\r\n    foo: ''bar''\r\n}\r\n```', '测试一下', '', 'publish', 4),
(6, '2013-12-20 20:12:52', '# 安装Nginx+PHP+MySQL\r\n## 安装Nginx\r\n```\r\nsudo apt-get install nginx\r\n# 启动\r\nsudo service nginx start\r\n```\r\n\r\n<!-- more -->\r\n\r\n## 配置PHP给Nginx\r\n```.bash\r\n# 安装PHP\r\nsudo apt-get install php5-fpm\r\n# 启动PHP\r\nsudo service php5-fpm start\r\n\r\n```\r\n\r\nphp5-fpm是一个守护进程（与初始化脚本 / etc/init.d/php5-fpm ）运行FastCGI服务器上的端口9000，通过`sudo netstat -anp|grep 9000`查看9000端口是否为php5-fpm占用\r\n\r\n修改Nginx配置文件。Nginx的配置文件为/etc/nginx/nginx.conf，而虚拟机的默认网站(即localhost)配置在/etc/nginx/sites-available/default中\r\n```\r\n# You may add here your\r\n# server {\r\n# ...\r\n# }\r\n# statements for each of your virtual hosts to this file\r\n\r\n##\r\n# You should look at the following URL''s in order to grasp a solid understanding\r\n# of Nginx configuration files in order to fully unleash the power of Nginx.\r\n# http://wiki.nginx.org/Pitfalls\r\n# http://wiki.nginx.org/QuickStart\r\n# http://wiki.nginx.org/Configuration\r\n#\r\n# Generally, you will want to move this file somewhere, and start with a clean\r\n# file but keep this around for reference. Or just disable in sites-enabled.\r\n#\r\n# Please see /usr/share/doc/nginx-doc/examples/ for more detailed examples.\r\n##\r\n\r\nserver {\r\nlisten 80; ## listen for ipv4; this line is default and implied\r\nlisten [::]:80 default ipv6only=on; ## listen for ipv6\r\nroot /usr/share/nginx/www;\r\nindex index.php index.html index.htm;\r\n# Make site accessible from http://localhost/\r\nserver_name _;\r\nlocation / {\r\n# First attempt to serve request as file, then\r\n# as directory, then fall back to index.html\r\ntry_files $uri $uri/ /index.html;\r\n}\r\nlocation /doc {\r\nroot /usr/share;\r\nautoindex on;\r\n#allow 127.0.0.1;\r\nallow all;\r\n}\r\nlocation /images {\r\nroot /usr/share;\r\nautoindex off;\r\n}\r\n#error_page 404 /404.html;\r\n# redirect server error pages to the static page /50x.html\r\n#\r\nerror_page 500 502 503 504 /50x.html;\r\nlocation = /50x.html {\r\nroot /usr/share/nginx/www;\r\n}\r\n# proxy the PHP scripts to Apache listening on 127.0.0.1:80\r\n#\r\n#location ~ \\.php$ {\r\n# proxy_pass [url]http://127.0.0.1[/url];\r\n#}\r\n# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000\r\n#\r\nlocation ~ \\.php$ {\r\nfastcgi_pass 127.0.0.1:9000;\r\nfastcgi_index index.php;\r\ninclude fastcgi_params;\r\n}\r\n# deny access to .htaccess files, if Apache’s document root\r\n# concurs with nginx’s one\r\n#\r\nlocation ~ //.ht {\r\ndeny all;\r\n}\r\n}\r\n```\r\n\r\n## 安装MySQL\r\n```\r\nsduo apt-get install mysql-server mysql-client\r\nsudo service mysql start\r\n```\r\n进入mysql创建数据库，测试\r\n```\r\nsudo mysql -u root -p\r\ncreate database db_test;\r\nuse db_test;\r\ncreate table foo(f1 int, f2 int);\r\n```\r\n\r\n有关Nginx, PHP, MySQL安装文件或者配置文件都在`/usr/share`或者`/etc`下\r\n修改/etc/php5/fpm/php.ini，修改有关输出错误信息的配置，方便开发调试\r\n```\r\nerror_reporting = E_ALL & ~E_STRICT\r\ndisplay_errors = On\r\n```', '安装Nginx+PHP+MySQL', '', 'publish', 1);

-- --------------------------------------------------------

--
-- 表的结构 `blog_tags`
--

CREATE TABLE IF NOT EXISTS `blog_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `blog_tags`
--

INSERT INTO `blog_tags` (`tag_id`, `tag_name`) VALUES
(1, '无标签'),
(2, '');

-- --------------------------------------------------------

--
-- 表的结构 `blog_tag_relationship`
--

CREATE TABLE IF NOT EXISTS `blog_tag_relationship` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `blog_tag_relationship`
--

INSERT INTO `blog_tag_relationship` (`post_id`, `tag_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `blog_terms`
--

CREATE TABLE IF NOT EXISTS `blog_terms` (
  `term_name` varchar(30) NOT NULL,
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term_description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`term_id`),
  KEY `name` (`term_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `blog_terms`
--

INSERT INTO `blog_terms` (`term_name`, `term_id`, `term_description`) VALUES
('未分类', 1, NULL),
('PHP', 2, NULL),
('Java', 3, NULL),
('技术', 4, NULL),
('Python', 5, '');

-- --------------------------------------------------------

--
-- 表的结构 `blog_users`
--

CREATE TABLE IF NOT EXISTS `blog_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_password` varchar(42) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_last_login_date` datetime NOT NULL,
  `user_create_date` datetime NOT NULL,
  `user_active_code` varchar(32) NOT NULL,
  `default_albumid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
