<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: kvvn
 * Date: 1/2/17
 * Time: 8:45 PM
 */
class Adv_Controller extends CI_Controller
{
    //set the class variable.
    var $template = [];
    var $data = [];

    //Load layout    
    public function layout()
    {
        // making temlate and send data to view.
        $this->template['header'] = $this->load->view('layout/header', $this->data, true);
        $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
        $this->load->view('layout/index', $this->template);
    }
}