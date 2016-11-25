<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TableSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tables:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seeder the all tables when init application';

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
        $this->call('migrate:refresh');
        $this->call('db:seed');
    }
}
