<?php


namespace TNM\UssdSimulator\Services;


use GuzzleHttp\Client;
use TNM\UssdSimulator\Http\FailedUssdResponse;
use TNM\UssdSimulator\Http\UssdResponse;
use TNM\UssdSimulator\Http\UssdResponseInterface;

class Session
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var Client
     */
    private $http;
    /**
     * @var int
     */
    private $id;

    public function __construct(string $url, string $phone, int $id = null)
    {
        $this->id = (!$id) ? random_int(1000, 9999) : $id;
        $this->url = $url;
        $this->phone = $phone;
        $this->http = new Client();
    }

    public function initialize(): UssdResponseInterface
    {
        return $this->send(1,1);
    }

    public function respond(string $message): UssdResponseInterface
    {
        return $this->send($message, 2);
    }

    private function send(string $message, int $type): UssdResponseInterface
    {
        try {
            $response = $this->http->request("POST", $this->url, [
                "body" => $this->buildRequest($message, $type),
                "verify" => false
            ]);
            return new UssdResponse($response);
        } catch (\Exception $exception) {
            return new FailedUssdResponse($exception->getMessage());
        }
    }

    private function buildRequest(string $message, int $type = 2)
    {
        return sprintf("<ussd><msisdn>%s</msisdn><sessionid>%s</sessionid><type>%s</type><msg>%s</msg></ussd>",
            $this->phone, $this->id, $type, $message
        );
    }
}
