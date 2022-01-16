<?php

namespace app\src;

/**
 * @package app\src
 */
class Response
{
    protected $body;
    protected $headers;

    /**
     * @param $body
     * @param array $headers
     */
    public function __construct($body = null, $headers = [])
    {
        $this->body = $body;
        $this->headers = $headers;
    }

    public function setBody($body){
        $this->body = $body;
        return $body;
    }

    public function setHeaders($key, $value){
        $this->headers[$key] = $value;
    }

    public function send(){
        foreach ($this->headers as $key => $value){
            header("$key: $value");
        }
        echo $this->body;
    }
}