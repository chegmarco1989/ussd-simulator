<?php


namespace TNM\UssdSimulator\Services;


use GuzzleHttp\Client;
use TNM\UssdSimulator\Http\UssdResponse;

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

    public function initialize(): ?UssdResponse
    {
        return $this->send(1,1);
    }

    public function respond(string $message): ?UssdResponse
    {
        return $this->send($message, 2);
    }

    private function send(string $message, int $type): ?UssdResponse
    {
        try {
            $response = $this->http->request("POST", $this->url, [
                "body" => $this->buildRequest($message, $type),
                "verify" => false
            ]);
            return new UssdResponse($response);
        } catch (\Exception $exception) {
            return null;
        }
    }

    private function buildRequest(string $message, int $type = 2)
    {
        return sprintf("<ussd><msisdn>%s</msisdn><sessionid>%s</sessionid><type>%s</type><msg>%s</msg></ussd>",
            $this->phone, $this->id, $type, $message
        );
    }
}
