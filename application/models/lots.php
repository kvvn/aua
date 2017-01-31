<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lots
 *
 * @author kvvn
 */
class Lots extends CI_Model {
    //put your code here
    public $table = 'lots';
    
     function __construct()
    {
        parent::__construct();
    }
    
    function get_last_lots($page)
    {
        $this->db->order_by('date', 'desc');
        $query = $this->db->get($this->table, 18, $page*18);
        return $query->result_array();
    }
    function get_lot_by_id($id){
        /*
        $query = $this->db->select()
                ->from($this->table)
                ->join('attachments', 'attachments.lot_id = lots.id')
                ->join('bets', 'bets.post_id = lots.id', 'left')->where(['lots.id'=>$id]);
         * 
         */
        $query = $this->db->get_where($this->table,['id'=>$id]);
        return $query->result_array();
        
    }
    function getBy(array $where){
        $query = $this->db->get_where($this->table, $where);
        return $query->result_array();
    }
    function newLot(array $data){
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    
}

?>
