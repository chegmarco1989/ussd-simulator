<?php


namespace TNM\UssdSimulator\Http;


class FailedUssdResponse implements UssdResponseInterface
{
    public function render()
    {
        return "Failed to contact the USSD app";
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
