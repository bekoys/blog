<?php
/**
 * category model
 */
class Category_Model {

    private $db;
    private static $instance;

    function __construct() {
        $this->db = MySql::getInstance();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Category_Model();
        }
        return self::$instance;
    }

    /**
     * 获取所有分类数据
     * @return array
     */
    function  getTermsAll() {
        $res = $this->db->query("SELECT * FROM blog_terms");
        $terms = array();
        while($row = $this->db->fetch_array($res)) {
            $row['term_name'] = htmlspecialchars($row['term_name']);
            $row['term_description'] = htmlspecialchars($row['term_description']);
            $terms[] = $row;
        }
        return $terms;
    }

    /*function updateTerm($sortData, $sid) {
        $Item = array();
        foreach ($sortData as $key => $data) {
            $Item[] = "$key='$data'";
        }
        $upStr = implode(',', $Item);
        $this->db->query("update ".DB_PREFIX."sort set $upStr where sid=$sid");
    }*/

    function addTerm($term_name, $description) {
        $sql="insert into blog_terms(term_name, term_description) values('$term_name', '$description')";
        $this->db->query($sql);
    }

    /**
     * 删除分类，将原来属于此分类的文章的term_id设为0
     * @param $term_id
     */
    function deleteTerm($term_id) {
        $this->db->query("update blog_posts set term_id=0 where term_id=$term_id");
        $this->db->query("DELETE FROM blog_terms where term_id=$term_id");
    }

    /**
     * 更新分类
     */
    function updateTerm($term_id, $term_name, $term_description) {
        $this->db->query("update blog_terms set term_name='$term_name',term_description='$term_description' where term_id=$term_id");
    }

    /**
     * 通过id获取一个分类的详细信息
     * @param $term_id
     * @return array
     */
    function getTermById($term_id) {
        $sql = "select * from blog_terms where term_id=$term_id";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_array($res);
        $term = array();
        if ($row) {
            $term = array(
                'term_name' => htmlspecialchars(trim($row['term_name'])),
                'term_id' => $term_id,
                'term_description' => htmlspecialchars(trim($row['term_description']))
            );
        }
        return $term;
    }

    /**
     * @param $term_id
     * @return string
     */
    function getTermName($term_id) {
        if ($term_id > 0) {
            $res = $this->db->query("SELECT term_name FROM blog_terms WHERE term_id = $term_id");
            $row = $this->db->fetch_array($res);
            $term_name = htmlspecialchars($row['term_name']);
        } else {
            $term_name = '未分类';
        }
        return $term_name;
    }

    /**
     * 获取指定分类所包含的文章数
     */
    function getPostsNumByTerm($term_id) {
        $sql = "select post_id from blog_posts where term_id=$term_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

}