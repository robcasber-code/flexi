<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CustomerService;

class FetchRandomCustomerData extends Command
{
    protected $signature = 'randomuser:fetch {count=100}';
    protected $description = 'Fetch random Australian users from randomuser.me API';

    public function __construct(protected CustomerService $customerService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $count = (int) $this->argument('count');

        if($count < 100){
           $this->info("Minimum of 100 customers to be import.");
           exit;
        }
        try {
            $imported = $this->customerService->import($count);
            $this->info("Imported {$imported} customers.");
        } catch (\Exception $e) {
            $this->error("Import failed: " . $e->getMessage());
        }
    }
}
