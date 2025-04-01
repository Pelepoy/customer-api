<?php

namespace App\Console\Commands;

use App\Services\CustomerImportService;
use Illuminate\Console\Command;

class ImportCustomersCommand extends Command
{
    protected $signature = 'customers:import 
                            {--count= : Number of customers to import}
                            {--nationality= : Nationality filter}';

    protected $description = 'Import customers from randomuser.me API';

    public function handle(CustomerImportService $importer): int
    {
        try {
            $count = $this->option('count') ? (int)$this->option('count') : null;
            $nationality = $this->option('nationality') ?: null;

            $imported = $importer->import($count, $nationality);

            $this->info("Successfully imported {$imported} customers");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}