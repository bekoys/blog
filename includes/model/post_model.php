<?php

class Post_Model {

    private $db;
    private static $instance = null;

    function __construct() {
        $this->db = MySql::getInstance();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Post_Model();
        }
        return self::$instance;
    }

    /**
     * 发布新文章
     * @param $data : array
     * @return int
     */
    function addLog($data) {
        $conn = $this->db;
        $fields = "post_title, post_content, post_excerpt, post_status, term_id, post_date";
        $values = "'" . implode("','", $data) . "'" . ',NOW()';

        $sql = "INSERT INTO blog_posts ($fields) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]', $data[4], NOW())";
        $this->db->query($sql);
        $post_id = $conn->insert_id();

        return $post_id;
    }

    /**
     * 更新文章
     * @param $post_id
     * @param $data : array
     * @return int
     */
    function updateLog($post_id, $data) {
        $conn = $this->db;

        $fields = "post_title='$data[0]', post_content='$data[1]', post_excerpt='$data[2]', post_status='$data[3]', term_id=$data[4]";
        $sql = "update blog_posts set $fields where post_id=$post_id";
        $conn->query($sql);

        return $post_id;
    }

    /**
     * 删除文章
     * @param $post_id
     */
    function deleteLog($post_id) {
        $sql = "delete from blog_posts where post_id=$post_id";
        $this->db->query($sql);
    }

    /**
     * 获取文章数量
     */
    function getPostsNum() {
        $sql = "select post_id from blog_posts";

        $res = $this->db->query($sql);
        return $this->db->num_rows($res);
    }

    /**
     * 主页显示的文章列表
     */
    function getPostlist($order = 'post_date desc', $paging_id = 1) {
        if (isset ($paging_id)) {
            $item_start = ($paging_id - 1) * ITEM_NUM;
            $limit_query = "$item_start," . ITEM_NUM;
        } else {
            $limit_query = '0,' . ITEM_NUM;
        }

        $posts = array();
        $select_query = 'post_id, post_date, post_title, post_excerpt, post_status, term_id';
        $where_query = "post_status = 'publish'";
        $sql = "select $select_query from blog_posts where $where_query order by $order limit $limit_query";

        $res = $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $Cat_model = Category_Model::getInstance();
            while ($row = $this->db->fetch_array($res)) {
                list ($row['post_date'], $row['post_time']) = explode(' ', $row['post_date']);
                $row['post_title'] = htmlspecialchars($row['post_title']);
                $row['post_excerpt'] = md_to_html($row['post_excerpt']);
                $row['post_excerpt'] = str_replace("\n", '<br />', $row['post_excerpt']);
                $term_name = $Cat_model->getTermName($row['term_id']);
                $row['term_name'] = htmlspecialchars($term_name);
                $posts[] = $row;
            }
            return $posts;
        } else {
            return null;
        }
    }

    /**
     * 获取单一的文章
     * @params $display 设置为true时返回转换为HTML的Markdown文档，否则为原生markdown文本
     */
    function getPostById($post_id, $display = true) {
        $select_query = 'post_id, post_title, post_date, post_content, term_id, post_status, post_excerpt';
        $where_query = "post_id = $post_id and post_status = 'publish'";
        $sql = "select $select_query from blog_posts where $where_query";

        $res = $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            $row = $this->db->fetch_array($res);
            $row['post_title'] = htmlspecialchars($row['post_title']);
            if ($display) {
                $row['post_content'] = md_to_html($row['post_content']);
            } else {
                $row['post_content'] = htmlspecialchars($row['post_content']);
            }
            $term_name = Category_Model::getInstance()->getTermName($row['term_id']);
            $row['term_name'] = htmlspecialchars($term_name);
            $row['post_id'] = $post_id;
            return $row;
        } else {
            return null;
        }
    }

    /**
     * 按评论数排行获取文章列表
     */
    function  getPostsSortByComment($limit) {
        $posts = array();
        $select_query = 'post_id, post_title, comment_count, post_status';
        $where_query = "post_status = 'publish'";
        $sql = "select $select_query from blog_posts where $where_query order by comment_count desc limit 0,$limit";

        $res = $this->db->query($sql);
        while($row = $this->db->fetch_array($res)) {
            $row['post_title'] = htmlspecialchars($row['post_title']);
            $posts[] = $row;
        }
        return $posts;
    }

    /**
     * 按存档日期获取文章
     * 供widget使用，只返回简单的信息
     */
    function getPostlistByArchive($limit) {
        $posts = array();
        $select_query = 'DATE_FORMAT( post_date,  "%Y-%m" ) AS post_date, COUNT( DATE_FORMAT( post_date,  "%Y-%m" ) ) AS post_count, post_status';
        $where_query = "post_status = 'publish'";
        $sql = "SELECT $select_query FROM blog_posts WHERE $where_query GROUP BY DATE_FORMAT( post_date,  \"%Y-%m\" ) limit 0,$limit";

        $res = $this->db->query($sql);
        while($row = $this->db->fetch_array($res)) {
            $posts[] = $row;
        }
        return $posts;
    }

    /**
     * 返回文章的完整信息
     */
    function getPostsByArchive($date, $paging_id = 1) {
        if (isset ($paging_id)) {
            $item_start = ($paging_id - 1) * ITEM_NUM;
            $limit_query = "$item_start," . ITEM_NUM;
        } else {
            $limit_query = '0,' . ITEM_NUM;
        }

        $posts = array();
        $select_query = 'post_id, post_date, post_title, post_excerpt, post_status, term_id';
        $where_query = "post_status = 'publish' and date_format(post_date, \"%Y-%m\")='$date'";
        $sql = $query="select $select_query from blog_posts where $where_query limit $limit_query";

        $res = $this->db->query($sql);
        while($row = $this->db->fetch_array($res)) {
            $row['post_title'] = htmlspecialchars($row['post_title']);
            $row['post_excerpt'] = htmlspecialchars($row['post_excerpt']);
            $term_name = Category_Model::getInstance()->getTermName($row['term_id']);
            $row['term_name'] = htmlspecialchars($term_name);
            $posts[] = $row;
        }
        return $posts;
    }

    /**
     * 按分类获取文章
     * @param $term_id
     * @param string $order
     * @param int $paging_id
     * @return array
     */
    function getPostsByTerm($term_id, $order = 'post_date desc', $paging_id = 1) {
        if (isset ($paging_id)) {
            $item_start = ($paging_id - 1) * ITEM_NUM;
            $limit_query = "$item_start," . ITEM_NUM;
        } else {
            $limit_query = '0,' . ITEM_NUM;
        }

        $posts = array();
        $select_query = 'post_id, post_date, post_title, post_excerpt, post_status, term_id';
        $where_query = "post_status = 'publish' and term_id=$term_id";
        $sql = "select $select_query from blog_posts where $where_query order by $order limit $limit_query";
        $res = $this->db->query($sql);

        while($row = $this->db->fetch_array($res)) {
            list ($row['post_date'], $row['post_time']) = explode(' ', $row['post_date']);
            $row['post_title'] = htmlspecialchars($row['post_title']);
            $row['post_excerpt'] = htmlspecialchars($row['post_excerpt']);
            $term_name = Category_Model::getInstance()->getTermName($row['term_id']);
            $row['term_name'] = htmlspecialchars($term_name);
            $posts[] = $row;
        }
        return $posts;
    }
}
