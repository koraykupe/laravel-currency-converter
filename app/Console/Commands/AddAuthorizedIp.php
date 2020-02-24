<?php

namespace App\Console\Commands;

use App\AuthorizationIP;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class AddAuthorizedIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:authorized-ip {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds given ip address to the authorized ips table';

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
        try {
            AuthorizationIP::create(['ip_address' => $this->argument('ip_address')]);
        } catch (QueryException $exception) {
            $this->error('IP is already registered.');
        }
        Log::info($this->argument('ip_address'). ' is added to the authorization table.');
    }
}
