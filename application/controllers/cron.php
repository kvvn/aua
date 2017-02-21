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
                            $message = sprintf('<a href="https://vk.com/club%s?w=wall-%s_%s">Лот</a>', $auction['group_id'], $auction['group_id'], $lot['id']);
                            $this->sendToTelegram($message);
                        }
                    }
                }
            }
        }
    }

    
    
    private function sendToTelegram($message = null)
    {
        $result = [];
        if(!empty($message)) {
            $botToken = "telegram_token";
            $chat_id = "@ultras_auctions";
            $bot_url    = "https://api.telegram.org/bot$botToken/";
            $url = $bot_url."sendMessage?chat_id=".$chat_id."&text=".urlencode($message).'&parse_mode=HTML';
            $result = json_decode(file_get_contents($url), true);
        }
        
        return $result;
    }

    private function checkAttachments($attachments) {
        foreach ($attachments as $attach) {
            if($attach['type'] == 'photo'){
                return true;
            }
        }
        return false;
    }
    
// It is not needed anymore 
//    private function addComment($comment, $id) {
//        $comment_data = [
//            'post_id' => $id,
//            'text' => $comment['text'],
//            'date' => $comment['date'],
//            'comment_id' => $comment['id'],
//        ];
//        $this->bets->newBet($comment_data);
//    }

}

?>
