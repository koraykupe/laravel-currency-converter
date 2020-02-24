<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportExchangeRates extends Command
{
    const SERVICE_URL = 'http://www.floatrates.com/daily/eur.json';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports exchange rates from an external service to our own database.';

    protected $guzzleClient;

    /**
     * Create a new command instance.
     *
     * @param Client $guzzleClient
     */
    public function __construct(Client $guzzleClient)
    {
        parent::__construct();
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $request = $this->guzzleClient->get(self::SERVICE_URL);
        $response = $request->getBody();
        Log::debug($response);
    }
}
