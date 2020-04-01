<?php


namespace TNM\UssdSimulator\Http;


use Psr\Http\Message\ResponseInterface;

class UssdResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /** @var string */
    private $message;

    /** @var int */
    private $type;

    /**
     * UssdResponse constructor.
     * @param ResponseInterface $response
     * @throws \Exception
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->decodeResponse();
    }

    public function decodeResponse()
    {
        $response = json_decode(json_encode(simplexml_load_string($this->response->getBody()->getContents())));
        if(!isset($response->msg) || !isset($response->type)) throw new \Exception("Invalid response");

        $this->message = $response->msg;
        $this->type = $response->type;
    }

    public function render()
    {
        return $this->message;
    }

    public function interactive(): bool
    {
        return $this->type == 2;
    }
}
