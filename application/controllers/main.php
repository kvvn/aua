<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author kvvn
 */
class main extends CI_Controller {
    //put your code here
    function __construct()
    {
        parent::__construct();
    }
    
    public function index($page = 0){
        $this->load->model('lots');
        $this->load->model('attachments');
        $this->load->model('auctions');
        $lots = $this->lots->get_last_lots($page);
        $data['auctions'] = $this->auctions->getList();
        $data['page'] = $page;
        $data['lots'] = [];
        //$data['attachments'] = [];
        foreach ($lots as $lot){
            
            $lot['attachments'] =  $this->attachments->get_attachments_byid($lot['id']);
            array_push($data['lots'], $lot);
        }
        
        $this->load->view('main', $data);
    }
    
}

?>
