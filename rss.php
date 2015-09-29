<?php header('Content-Type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
  <channel>
    <title>青年博客</title>
    <link>
    <?php 
    	require 'includes/setting.php';
    	echo SITE_URL.'index.php';
    ?>
    </link>
    <description></description>
    <language>en-us</language>

<?php
  require_once('includes/connect_db.php');

  $query = "SELECT post_id, post_title, DATE_FORMAT(post_date,'%a, %d %b %Y %T') AS post_date, " .
    "post_excerpt, term_name FROM blog_posts ORDER BY post_date DESC";
  $data = mysqli_query($dbc, $query);

  while ($row = mysqli_fetch_array($data)) {
    echo '<item>';
    echo "\n";
    echo '  <title>' . $row['post_title'] . '</title>';
    echo "\n";
    echo '  <link>'.$_SERVER['HTTP_HOST'].SITE_URL.'post.php?pageid=' . $row['post_id'] . '</link>';
    echo "\n";
    echo '  <pubDate>' . $row['post_date'] . ' ' . date('T') . '</pubDate>';
    echo "\n";
    echo '  <description>' . htmlspecialchars($row['post_excerpt']) . '</description>';
    echo "\n";
    echo "\n";
    echo '</item>';
    echo "\n";
  }
?>

  </channel>
</rss>
