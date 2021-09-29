<?php

return [
     'default' => [
        'currency' => 'USD',
        'idCurrency'=>1,
        'crypto' => 'BTC',
        'idCrypto'=>1,
    ],
    'statusPayment' =>[
        '1'=>'Aprobado',
        '2'=>'ChargeBack',
        '3'=>'Devolución',
        '4'=>'Cancelado',
    ],
    'wallets'=>[
    'aprobado'=>1,
    'pendiente'=>2,
    ],
    "emails"=>[
        "bank"=>"info@damecoins.com"
    ]   
];