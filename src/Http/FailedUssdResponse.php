<?php


namespace TNM\UssdSimulator\Http;


class FailedUssdResponse implements UssdResponseInterface
{
    /**
     * @var string
     */
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return $this->message;
    }

    public function successful(): bool
    {
        return false;
    }

    public function interactive(): bool
    {
        return false;
    }
}
