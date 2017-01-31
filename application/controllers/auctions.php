<?php

/**
 * Created by PhpStorm.
 * User: kvvn
 * Date: 1/2/17
 * Time: 7:17 PM
 */
class auctions extends Adv_Controller
{
    public function index(){
        $this->middle = 'auctions';

        $this->load->model('auctions');
        $this->data['auctions'] = $this->auctions->getList();
        $this->layout();
    }
}