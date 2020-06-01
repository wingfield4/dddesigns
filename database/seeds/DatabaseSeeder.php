<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // factory(App\Item::class, 50)->create();
        $this->call([
            ItemTypeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            StatusSeeder::class,
            CustomizationTypeSeeder::class,
            ImageSeeder::class,
            ItemSeeder::class,
            ReviewSeeder::class,
            ReviewImageSeeder::class,
            ItemInformationSeeder::class,
            ItemImageSeeder::class,
            CustomizationSeeder::class,
            OptionSeeder::class
        ]);
    }
}
