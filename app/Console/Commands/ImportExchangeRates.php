<?php

namespace App\Console\Commands;

use App\ExchangeRate;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportExchangeRates extends Command
{
    public const SERVICE_BASE_URL = 'http://www.floatrates.com/daily/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:exchange-rates {currency?}';

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
        if ($this->argument('currency')) {
            return $this->getExchangeRates($this->argument('currency'));
        }

        $allowedCurrencies = config('currencies.allowed');
        foreach ($allowedCurrencies as $allowedCurrency) {
            $this->getExchangeRates($allowedCurrency);
        }
    }

    /**
     * @param $currency
     */
    private function getExchangeRates($currency)
    {
        try {
            $request = $this->guzzleClient->get(self::SERVICE_BASE_URL . strtolower($currency) . '.json');

            $response = \GuzzleHttp\json_decode($request->getBody(), true);

            $exchangeRateFinalData = array_map(static function ($exchangeRateRawData) use ($currency) {
                return array(
                    'from_currency'   => $currency,
                    'to_currency'     => $exchangeRateRawData['code'],
                    'rate'            => $exchangeRateRawData['rate'],
                    'rate_updated_at' => Carbon::create($exchangeRateRawData['date']),
                );
            }, $response);

            DB::transaction(static function () use ($currency, $exchangeRateFinalData) {
                ExchangeRate::where('from_currency', $currency)->delete();
                ExchangeRate::insert($exchangeRateFinalData);
            });
        } catch (Exception $exception) {
            Log::debug($exception);
            $this->error($exception->getMessage());
        }
    }
}
