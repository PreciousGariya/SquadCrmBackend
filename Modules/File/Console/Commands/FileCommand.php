<?php

namespace Modules\File\Console\Commands;

use Illuminate\Console\Command;

class FileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:FileCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'File Command description';

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
