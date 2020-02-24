<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportExchangeRates extends Command
{
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
        //
    }
}
