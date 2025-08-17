<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateTestSchemaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:create-schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает БД для тестов';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS luna_test');
        $this->info('Схема luna_test для тестов создана');
    }
}
