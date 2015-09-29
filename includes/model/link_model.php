<?php
/**
 * 收藏的博客链接
 */
class Link_Model {

    private $db;
    private static $instance = null;

    function __construct() {
        $this->db = MySql::getInstance();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Link_Model();
        }
        return self::$instance;
    }

    function getLinks($limit) {
        $links = array();
        $select_query = 'link_url, link_name, link_description';
        $sql = "select $select_query from blog_links limit 0,$limit";

        $ret = $this->db->query($sql);
        while($row = $this->db->fetch_array($ret)) {
            $links[] = $row;
        }
        return $links;
    }
}