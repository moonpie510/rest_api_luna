<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class UpdateSearchIndexCommand extends Command
{
    protected $signature = 'search:update-index';
    protected $description = 'Команда для обновления индекса поиска';

    public function handle(): void
    {
        $this->info('Удаление старых данных из индекса Organization');
        Artisan::call('scout:flush', ['model' => 'App\Models\Organization']);

        $this->info('Обновление данных в индексе Organization');
        Artisan::call('scout:import', ['model' => 'App\Models\Organization']);

        $this->info('Индекс успешно обновлен');

    }
}
