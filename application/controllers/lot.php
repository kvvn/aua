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
class lot extends Adv_Controller
{
    //put your code here
    public function index($id, $page)
    {

        $this->load->model('lots');
        $this->load->model('attachments');
        $this->load->model('bets');
        $this->load->model('auctions');

        $this->middle = 'lot';

        $this->data['lot'] = $this->lots->get_lot_by_id($id);
        $this->data['attachments'] = $this->attachments->get_attachments_byid($id);
        $this->data['bets'] = $this->bets->get_bets_byid($id);
        $this->data['page'] = $page;
        $this->data['auction'] = $this->auctions->getBy(['id' => $this->data['lot'][0]['auction_id']]);

        $this->layout();
    }
}

?>
