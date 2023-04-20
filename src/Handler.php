<?php

namespace Jeffreyvr\SimpleSlackErrorChannel;

use Maknz\Slack\Client;

class Handler
{
    public $client;

    public function __construct(public string $webhookUrl, public array $config = [])
    {
        $this->client = new Client($this->webhookUrl, $this->config);
    }

    public function send($message)
    {
        $this->client->send($message, $this->config);

        return $this;
    }

    public function handle($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            return false;
        }

        $errstr = htmlspecialchars($errstr);

        $this->send("⚠️ An error occured: ```[$errno] $errstr in $errfile:$errline```", $this->config);

        return true;
    }
}
