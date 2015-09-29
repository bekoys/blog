<?php
/**
 * tag model
 */
class Tag_Model {

    private $db;
    private static $instance;

    function __construct() {
        $this->db = MySql::getInstance();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Tag_Model();
        }
        return self::$instance;
    }

    function  getTagsAll() {
        $res = $this->db->query("SELECT * FROM blog_tags GROUP BY tag_id");
        $tags = array();
        while($row = $this->db->fetch_array($res)) {
            $row['tag_name'] = htmlspecialchars($row['tag_name']);
            $tags[] = $row;
        }
        return $tags;
    }

    /*function updateTag($sortData, $sid) {
        $Item = array();
        foreach ($sortData as $key => $data) {
            $Item[] = "$key='$data'";
        }
        $upStr = implode(',', $Item);
        $this->db->query("update ".DB_PREFIX."sort set $upStr where sid=$sid");
    }*/

    function addTag($tag_name) {
        $sql = "insert into blog_tags(tag_name) values('$tag_name')";
        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function addTagRelationship($post_id, $tag_id) {
        $sql = "insert into blog_tag_relationship(post_id, tag_id) values($post_id, $tag_id)";
        $this->db->query($sql);
    }

    /**
     * 删除tag
     * @param $tag_id
     */
    function deleteTag($tag_id) {
        $this->db->query("DELETE FROM blog_tags where tag_id=$tag_id");
    }

    /**
     * 删除某个文章所关联的tag_id
     * @param $post_id
     */
    function deleteTagRelationship($post_id) {
        $this->db->query("DELETE FROM blog_tag_relationship where post_id=$post_id");
    }

    /**
     * 通过id获取一个tag的详细信息
     * @param $tag_id
     * @return array
     */
    function getTagById($tag_id) {
        $sql = "select * from blog_tags where tag_id=$tag_id";
        $res = $this->db->query($sql);
        $row = $this->db->fetch_array($res);
        $tag = array();
        if ($row) {
            $tag = array(
                'tag_name' => htmlspecialchars(trim($row['tag_name'])),
                'tag_id' => $tag_id,
            );
        }
        return $tag;
    }


    /**
     * 返回某文章的tag
     * @param $post_id
     * @return string
     */
    function getTagByPostId($post_id) {
        $where_query = "t.tag_id=r.tag_id and r.post_id=$post_id";
        $sql = "select tag_name from blog_tags as t, blog_tag_relationship as r where $where_query";

        $res = $this->db->query($sql);
        $tags = array();
        while($row = $this->db->fetch_array($res)) {
             $tags[] = $row['tag_name'];
        }

        return implode(',', $tags);
    }

    /**
     * 不同的id间用英文逗号分隔
     * @param $tag_ids
     * @return array
     */
//    function getTagName($tag_ids)
//    {
//        // if ($tag_ids > 0) {
//        $ids = explode(',', $tag_ids);
//        $tag_names = array();
//        foreach ($ids as $id) {
//            $id = trim($id);
//            if ($id > 0) {
//                $res = $this->db->query("SELECT tag_name FROM blog_tags WHERE tag_id = $id");
//                $row = $this->db->fetch_array($res);
//                $tag_name = htmlspecialchars($row['tag_name']);
//            } else {
//                $tag_name = "未分类";
//            }
//            $tag_names[] = $tag_name;
//        }
//        /*$res = $this->db->query("SELECT tag_name FROM blog_tags WHERE tag_id = $tag_ids");
//        $row = $this->db->fetch_array($res);
//        $tag_name = htmlspecialchars(trim($row['tag_name']));*/
//        /*} else {
//            $tag_name = '未分类';
//        }*/
//        return $tag_names;
//    }
    function getTagName($tag_id) {

    }

    /**
     * 获取指定分类所包含的文章数
     */
    function getPostsNumByTag($tag_id) {
        $sql = "select post_id from blog_posts where tag_id=$tag_id";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
}