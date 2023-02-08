<?php

namespace Modules\Sale\Console\Commands;

use Illuminate\Console\Command;

class SaleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SaleCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sale Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
