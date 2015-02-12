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
    
    public function index(){
        $this->load->model('lots');
        $this->load->model('attachments');
        $lots = $this->lots->get_last_lots();
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
