<?php

class Comment_Model {

    private $db;
    private static $instance;

    function __construct() {
        $this->db = MySql::getInstance();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Comment_Model();
        }
        return self::$instance;
    }

    function getCommentsNum($post_id) {
        $sql = "select comment_count from blog_posts where post_id=$post_id";
        $ret = $this->db->query($sql);
        return $this->db->fetch_array($ret);
    }

    function getComments($post_id) {
        $comments = array();
        $sql = "SELECT * FROM blog_comments WHERE hide = 'n' && post_ID = $post_id ORDER BY cmt_date";

        $ret = $this->db->query($sql);
        while($row = $this->db->fetch_array($ret)) {
            $comments[] = $row;
        }
        return $comments;
    }

    /**
     * 更新评论
     */
    function updateComment($name, $content, $post_id) {
        $sql = "insert into blog_comments values(0, '$name', NOW(), '$content', $post_id, 'n')";
        $this->db->query($sql);

        $sql = "update blog_posts set comment_count=comment_count+1 where post_id=$post_id ";
        $this->db->query($sql);
    }

}