<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Crypto;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CrytosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @re
     * turn void
     */

    public function run()
    {
        // $faker = Faker::create('es_VE');
        // $cripto[0]=array("cripto"=>"BTC","nombre"=>"Bitcoins","maker_fee"=>5,"taker_fee"=>5);
        // $cripto[1]=array("cripto"=>"LTC","nombre"=>"Litecoin","maker_fee"=>10,"taker_fee"=>10);
        // $cripto[2]=array("cripto"=>"ETH","nombre"=>"Etherium","maker_fee"=>15,"taker_fee"=>15);
        // for($i=0;$i<=2;$i++){
        //     Crypto::create([
        //         //'code' =>$faker->randomElement($array = array("BTC","ETH","LTC")),
        //         'code' =>$cripto[$i]["cripto"],
        //         'name' => $cripto[$i]["nombre"],
        //         'maker_fee' => $cripto[$i]["maker_fee"],
        //         'taker_fee' => $cripto[$i]["taker_fee"],
        //         'status' => 1
        //     ]);
        // }
        $path = 'database/seeds/sql/cryptos.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cryptos table seeded!');
    }
}
