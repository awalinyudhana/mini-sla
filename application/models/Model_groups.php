<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 2/8/17
 * Time: 1:27 PM
 */
class Model_groups extends CI_Model {

    public function get_group()
    {
        return$this->db->get("groups");
    }
}

