<?php

namespace TNM\UssdSimulator\Http;

interface UssdResponseInterface
{
    public function render();

    public function successful(): bool;

    public function interactive(): bool;
}
