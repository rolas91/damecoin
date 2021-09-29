<?php

use Illuminate\Database\Seeder;
use App\Wallet;
use Faker\Factory as Faker;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=1000;$i++){
            if ($i==5000){
                sleep(2);
            }
            if ($i==10000){
                sleep(2);
            }
            if ($i==20000){
                sleep(2);
            }
            if ($i==30000){
                sleep(2);
            }
            if ($i==40000){
                sleep(2);
            }
            if ($i==50000){
                sleep(2);
            }

        Wallet::create([
            'abono' => $i,
            'retiro' => 0,
            'userid' => 11,
           // 'password' => bcrypt('123'),
            
        ]);
       
        
    }
    }

   /*
   seeder support recurly
    $currencies = DB::table('currencies')->where('status', 1)->get();
    $i=1;
    foreach($currencies as $currency){

        $payment=new SupportRecurly;

                       $payment->currency_id=$currency->id;
                       $payment->note="nota".$i;
                       $payment->conversion_id=rand(1,2);
                       
                      
        $payment->save();
     $i++;
    }
     $currencies = DB::table('currencies')->where('status', 1)->get();
        $i=1;
        foreach($currencies as $currency){
    
            $payment=new SupportRecurly;
    
                           $payment->currency_id=$currency->id;
                           $payment->note="nota".$i;
                           $payment->default_conversion=0;
                           $payment->currency_default=1;
                           $payment->stripe_account_id=1;
                           
                          
            $payment->save();
         $i++;
        }
    */
}
