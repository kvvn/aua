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

        $this->data['page'] = $page;

        $auction = $this->auctions->getBy(['id' => $this->data['lot'][0]['auction_id']]);
        $this->data['auction'] = $auction;

        $bets = [];

        $comments_data = file_get_contents('https://api.vk.com/method/wall.getComments?v=5.3&owner_id=-' . $auction[0]['group_id'] . '&count=5&post_id=' . $this->data['lot'][0]['post_id'] . '&sort=desc');
        $comments = json_decode($comments_data, TRUE);
        if (!empty($comments['response']['items'])) {
            print_r($comments, true);
            foreach ($comments['response']['items'] as $comment) {
                $bets[] = $comment;
            }
        }
        $this->data['bets'] = $bets;

        $this->layout();
    }
}

?>
