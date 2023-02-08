<?php

namespace Modules\Sale\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\Sale;

class SaleDatabaseSeeder extends Seeder
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
         * Sales Seed
         * ------------------
         */

        // DB::table('sales')->truncate();
        // echo "Truncate: sales \n";

        Sale::factory()->count(20)->create();
        $rows = Sale::all();
        echo " Insert: sales \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
