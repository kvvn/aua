<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lot
 *
 * @author kvvn
 */
class lot extends CI_Controller{
    //put your code here
    public function index($id){
        $this->load->model('lots');
        $this->load->model('attachments');
        $this->load->model('bets');
        $data['lot'] = $this->lots->get_lot_by_id($id);
        $data['attachments'] = $this->attachments->get_attachments_byid($id);
        $data['bets'] = $this->bets->get_bets_byid($id);
        $this->load->view('lot', $data);
    }
}

?>
