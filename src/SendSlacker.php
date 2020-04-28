<?php
namespace sendSlacker;
class SendSlacker{
    private $token;
    private $contents = [];
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
        $this->contents["blocks"][] = $block;
    }

    /**
     * addAttachments
     *
     * @param string[] $attachments attachmentsの設定連想配列
     * @return void
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function addAttachments($attachments){
        $this->contents["attachments"][] = $attachments;
    }

    /**
     * setDebug
     *　デバッグモードを設定する(セットすると400で例外を投げる)
     * @return void
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function setDebug(){
        $this->debug = true;
    }

    /**
     * sendContents
     * blocksやattachmentsを使った場合はこちらを使う
     * @return boolean
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function sendContents(){
        $payload = $this->contents;
        $client = new \GuzzleHttp\Client();
        if($this->debug == false){
            $res = $client->request('POST',$this->token,['json' => $payload,'http_errors' => false]);
            if(preg_match("/4..|5../",(string)$res->getStatusCode())){
                return false;
            }
            return true;
        }
        else{
            $client->request('POST',$this->token,$this->token,['json' => $payload]);
            return true;
        }
        $this->contents = null;
    }
    /**
     * sendText
     *
     * @param string $text 送信したいテキスト
     * @return void
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function sendText($text){
        $payload =["text" => $text];
        $client = new \GuzzleHttp\Client();
        if($this->debug == false){
            $client->request('POST',$this->token,['json' => $payload,'http_errors' => false]);
            if(preg_match("/4..|5../",(string)$res->getStatusCode())){
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