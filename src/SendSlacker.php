<?php
namespace sendSlacker;

class SendSlacker{
    private $token;
    private $contents = [];
    private $debug = false;
    private $icon = "";
    private $name = "";
    
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
     * icon_emojiを設定する
     * 
     * @param string $icon
     * 
     * @return void
     */
    public function setIconEmoji(string $icon){
        $this->icon = $icon;
    }

    
    /**
     * 名前を設定する
     * 
     * @param string $name
     * 
     * @return void
     */
    public function setName(string $name){
        $this->name = $name;
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
        if(strcmp($this->icon,"") !== 0){
            $payload["icon_emoji"] = $this->icon;
        }
        if(strcmp($this->name,"") !== 0){
            $payload["username"] = $this->name;
        }
        $client = new \GuzzleHttp\Client();
        if($this->debug == false){
            $res = $client->request('POST',$this->token,['json' => $payload,'http_errors' => false]);
            if(preg_match("/4..|5../",(string)$res->getStatusCode())){
                return false;
            }
        }
        else{
            $client->request('POST',$this->token,['json' => $payload]);
            $this->contents = null;
        }
        return true;
        
    }
    /**
     * sendText
     *
     * @param string $text 送信したいテキスト
     * @return boolean
     * @author nayuta1999 <youmu331@gmail.com>
     */
    public function sendText($text){
        $payload =["text" => $text];
        if(strcmp($this->icon,"") !== 0){
            $payload["icon_emoji"] = $this->icon;
        }
        if(strcmp($this->name,"") !== 0){
            $payload["username"] = $this->name;
        }
        $client = new \GuzzleHttp\Client();
        if($this->debug == false){
            $res = $client->request('POST',$this->token,['json' => $payload,'http_errors' => false]);
            if(preg_match("/4..|5../",(string)$res->getStatusCode())){
                return false;
            }
            return true;
        }
        else{
            $client->request('POST',$this->token,['json' => $payload]);
            return true;
        }
    }
}
