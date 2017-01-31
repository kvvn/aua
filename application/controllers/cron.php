<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cron
 *
 * @author kvvn
 */
class cron extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        // this controller can only be called from the command line
        if (!$this->input->is_cli_request())
            show_error('Direct access is not allowed');
        $this->load->model('auctions');
        $this->load->model('lots');
        $this->load->model('attachments');
        $this->load->model('bets');
    }

    public function doCronJob()
    {
        $auctions = $this->auctions->getList();
        print_r($auctions);
        foreach ($auctions as $auction) {
            if(!empty($auction['url'])) {
                $url = 'https://api.vk.com/method/wall.get?v=5.3&filter=owner&domain=' . $auction['url'] . '&count=10';
            } else {
                $url = 'https://api.vk.com/method/wall.get?v=5.3&filter=owner&owner_id=-' . $auction['group_id'] . '&count=10';
            }

            $vk_data = file_get_contents($url);
            print_r($vk_data);
            $lots = json_decode($vk_data, TRUE);
            if (!empty($lots['response']['items']) && is_array($lots['response']['items'])) {
                foreach ($lots['response']['items'] as $lot) {
                    if (empty($lot['is_pinned']) && !empty($lot['attachments'])) {
                        if(!$this->checkAttachments($lot['attachments'])) {
                            continue;
                        }
                        echo 1 . PHP_EOL;
                        $saved_lot = $this->lots->getBy(['post_id' => $lot['id']]);
                        if (empty($saved_lot)) {
                            $data = [
                                'post_id' => $lot['id'],
                                'from_id' => $lot['from_id'],
                                'to_id' => $lot['to_id'],
                                'date' => $lot['date'],
                                'text' => $lot['text'],
                                'comments' => $lot['comments']['count'],
                                'auction_id' => $auction['id']
                            ];
                            $new_id = $this->lots->newLot($data);
                            foreach ($lot['attachments'] as $attacment) {
                                $attachment_data = [
                                    'lot_id' => $new_id,
                                    'url_1' => $attacment['photo']['photo_130'],
                                    'url_2' => $attacment['photo']['photo_604'],
                                ];
                                $this->attachments->newAttachment($attachment_data);
                            }
                            if ($lot['comments']['count'] > 0) {
                                $comments_data = file_get_contents('https://api.vk.com/method/wall.getComments?v=5.3&owner_id=-' . $auction['group_id'] . '&count=5&post_id=' . $lot['id'] . '&sort=asc');
                                echo $comments_data;
                                $comments = json_decode($comments_data, TRUE);
                                if (!empty($comments['response']['items'])) {
                                    foreach ($comments['response']['items'] as $comment) {
                                        $this->addComment($comment, $new_id);
                                    }
                                }
                            }
                        } else {
                            echo 2 . PHP_EOL;
                            if ($lot['comments']['count'] != $saved_lot[0]['comments'] && $lot['comments']['count'] != 0) {
                                $ex_comments_ids = [];
                                $existing = $this->bets->get_bets_byid($saved_lot[0]['id']);
                                foreach ($existing as $ex_comm) {
                                    array_push($ex_comments_ids, $ex_comm['comment_id']);
                                }
                                $comments_data = file_get_contents('https://api.vk.com/method/wall.getComments?v=5.3&owner_id=' . $auction['group_id'] . '&count=5&post_id=' . $lot['id'] . '&sort=asc');
                                $comments = json_decode($comments_data, TRUE);
                                if (!empty($comments['response']['items'])) {
                                    print_r($comments, true);
                                    foreach ($comments['response']['items'] as $comment) {
                                        if (!in_array($comment['id'], $ex_comments_ids)) {
                                            $this->addComment($comment, $saved_lot[0]['id']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function addComment($comment, $id) {
        $comment_data = [
            'post_id' => $id,
            'text' => $comment['text'],
            'date' => $comment['date'],
            'comment_id' => $comment['id'],
        ];
        $this->bets->newBet($comment_data);
    }

    private function checkAttachments($attachments) {
        foreach ($attachments as $attach) {
            if($attach['type'] == 'photo'){
                return true;
            }
        }
        return false;
    }

}

?>
