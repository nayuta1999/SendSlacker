<?php
require_once 'vendor/autoload.php';
class SendSlacker{
    private $token;
    private $block = [];
    private $attachments = [];
    private $debug = false;
    /**
     * __construct
     *
     * @param string $token incomingwebhooksのtokenのURL
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function __construct($token){
        $this->token = $token;
    }

    /**
     * addBlock
     *
     * @param string[] $block blockの設定連想配列
     * @return void
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function addBlock($block){
        $this->block[] = $block;
    }

    /**
     * addAttachments
     *
     * @param string[] $attachments attachmentsの設定連想配列
     * @return void
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function addAttachments($attachments){
        $this->attachments[] = $attachments;
    }

    /**
     * setDebug
     *
     * @return void
     */
    public function setDebug(){
        $this->debug = true;
    }

    /**
     * sendText
     *
     * @param string $text 送信したいテキスト
     * @return void
     */
    public function sendText($text){
        $payload =["text" => $text];
        if(!empty($this->block)){
            $payload[] = $this->block;
        }
        if(!empty($this->attachments)){
            $payload[] = $this->atachments;
        }
        $client = new \GuzzleHttp\Client();
        if($this->debug == false){
            try {
                $client->request('POST',$this->token,['json' => $payload]);
            } catch (ClientException $e) {
                return false;
            }
            return true;
        }
        else{
            $client->request('POST',$this->token,$this->token,['json' => $payload]);
            return true;
        }
    }
}