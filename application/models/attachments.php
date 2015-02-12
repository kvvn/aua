<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attachments
 *
 * @author kvvn
 */
class Attachments extends CI_Model {
    //put your code here
    public $table = 'attachments';
    
    public function get_attachments_byid($id){
        $query = $this->db->get_where($this->table, array('lot_id' => $id));
        return $query->result_array();
    }
    
    public function newAttachment(array $data){
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}

?>
