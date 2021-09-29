<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolsTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(paymentMethod::class);
        
        $this->call(BanksTableSeeder::class);
        $this->call(ConfigTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(PaymentMethodStateTableSeeder::class);
        $this->call(AccountRecurlyTableSeeder::class);
        $this->call(SupportRecurlyTableSeeder::class);
        $this->call(CrytosTableSeeder::class);
        $this->call(PaypalGatewayLinksTableSeeder::class);
        $this->call(PaymentLimitTableSeeder::class);
    }
}
