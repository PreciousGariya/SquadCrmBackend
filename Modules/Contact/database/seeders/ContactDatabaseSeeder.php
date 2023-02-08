<?php

namespace Modules\Contact\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\Contact;

class ContactDatabaseSeeder extends Seeder
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
         * Contacts Seed
         * ------------------
         */

        // DB::table('contacts')->truncate();
        // echo "Truncate: contacts \n";

        Contact::factory()->count(20)->create();
        $rows = Contact::all();
        echo " Insert: contacts \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
