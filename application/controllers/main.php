<?php

/**
 * Description of main
 *
 * @author kvvn
 */
class main extends Adv_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index($page = 0)
    {

        $this->load->model('lots');
        $this->load->model('attachments');
        $this->load->model('auctions');

        $this->middle = 'main';

        $lots = $this->lots->get_last_lots($page);
        $this->data['auctions'] = $this->auctions->getList();
        $this->data['page'] = $page;
        $this->data['lots'] = [];
        //$data['attachments'] = [];
        foreach ($lots as $lot) {

            $lot['attachments'] = $this->attachments->get_attachments_byid($lot['id']);
            array_push($this->data['lots'], $lot);
        }

        $this->layout();
    }

}

?>
