<?php

namespace Modules\File\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\File;

class FileDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Files Seed
         * ------------------
         */

        // DB::table('files')->truncate();
        // echo "Truncate: files \n";

        File::factory()->count(20)->create();
        $rows = File::all();
        echo " Insert: files \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
