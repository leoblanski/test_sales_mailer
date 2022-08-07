<?php

namespace App\Console\Commands;

use App\Jobs\SendMailOrders;
use App\Models\Config;
use Illuminate\Console\Command;

class MailCron extends Command
{
    protected $signature = 'send:email';
    protected $description = 'Command mailer';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Busca o e-mail configurado
        $config = Config::first();

        SendMailOrders::dispatch($config->email);

        return true;
    }
}
