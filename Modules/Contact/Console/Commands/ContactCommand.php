<?php

namespace Modules\Contact\Console\Commands;

use Illuminate\Console\Command;

class ContactCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ContactCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Contact Command description';

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
