<?php

namespace TNM\UssdSimulator\Commands;

use Illuminate\Console\Command;
use TNM\UssdSimulator\Http\UssdResponseInterface;
use TNM\UssdSimulator\Services\Session;

class Simulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ussd:simulate {url} {phone} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simulate a USSD session';
    /**
     * @var UssdResponseInterface
     */
    private $response;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $session = new Session($this->argument('url'), $this->argument('phone'), $this->option('id'));
        $this->response = $session->initialize();

        while ($this->response->interactive()) {
            $input = $this->ask($this->response->render());

            if (!$input && $input !== '0') {
                $this->error("USSD session was terminated because no response was given");
                return;
            }
            $this->response = $session->respond($input);
        }
        $this->info($this->response->render());
    }
}
