<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 13-11-18
 * Time: 下午3:40
 */

class Option_model {
    private $db;
    private static $instance;

    function __construct() {
        $this->db = MySql::getInstance();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Option_model();
        }
        return self::$instance;
    }

    /**
     * 获取配置选项
     * @param $opt string option_name
     * @return string option_value
     */
    function getOption($opt) {
        $res = $this->db->query("select * from blog_options where option_name = '$opt'");
        $row = $this->db->fetch_array($res);
        return $row['option_value'];
    }

    function updateOption($opt_name, $opt_value) {
        $this->db->query("update blog_options set option_value = '$opt_value' where option_name = '$opt_name'");
    }

    function deleteOption($opt) {
        $this->db->query("delete from blog_options where option_name = '$opt'");
    }
} 