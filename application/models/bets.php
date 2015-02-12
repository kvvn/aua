<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bets
 *
 * @author kvvn
 */
class Bets extends CI_Model {
    //put your code here
    public $table = 'bets';
    
    public function get_bets_byid($id){
        $query = $this->db->get_where($this->table, array('post_id' => $id));
        return $query->result_array();
    }
    
    public function newBet(array $data){
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
}

?>
