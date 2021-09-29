<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Currency;
use App\DetailCurrency;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeds/sql/currencies.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Currencies table seeded!');

        $path2 = 'database/seeds/sql/detail_currencies.sql';
        DB::unprepared(file_get_contents($path2));
        $this->command->info('Currencies details table seeded!');
    }
}