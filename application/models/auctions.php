<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auctions
 *
 * @author kvvn
 */
class Auctions extends CI_Model{
    //put your code here
    private $table = 'auctions';
    
    function getList(){
        $auctions = $this->db->get($this->table)->result_array();
        return $this->arrayDecorator($auctions);
    }
    
    function getBy(array $where){
        $query = $this->db->get_where($this->table, $where);
        return $query->result_array();
    }
    
}

?>
