<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' =>    'AKIAJXR6IDWSYAVE4KKA',
        'secret' => 'AqahceAttdCpFK0lDJnWgwBZOsWrvhjvLQ7k6h1V1kyr',
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        // 'key' => 'pk_test_9xNXo61OfyqVdw04MCm7X7uh005iImuXO3',//env('STRIPE_KEY'),
        //'secret' => 'sk_test_5POLERYLxpC5uZLs9Yt0xSh500oZniO082',//env('STRIPE_SECRET'),

        'key' => 'pk_live_rgJnBU3RlVc4GychKBqm8ghC00YZplVnga',//'pk_test_9xNXo61OfyqVdw04MCm7X7uh005iImuXO3',//env('STRIPE_KEY'),
        'test' => 'pk_test_GnfTz7pty6zVKM8e3Chwar6G',
        //'sk_test_5POLERYLxpC5uZLs9Yt0xSh500oZniO082',//env('STRIPE_SECRET'),
    ],
    
    'fixer' => [
        'key' => "27692546960c2e421da5a5513b76491d",

    ],

    'coinlayer' => [
        'key' => "91be84e379936ae81d9d962a06567993",

    ],

    'pay' => [
        'max_error_diario' => 99,
        'max_error' => 5,

    ],

    'mail' => [
        'title' => ' <p style="text-align: justify;margin-top:10px;color:#212121"> <b> The most complete crypto trading platform on the internet</b>. Instantly buy Bitcoin, Ethereum, Tether (USDT) and +100 different cryptocurrencies with card, bank transfer and +30 payment methods.</p>',
        'body'  => ' <p style="text-align: justify;margin-top:10px;color:#212121">Our World Class Support Team is <b>available by chat and Telegram 24/7 365 days a year</b> to kindly help and guide you whenever you need it (use the chat widget on <a href="https://damecoins.com">Damecoins.com</a> ). You can also <b>directly reply to this email</b> and a Support ticket will be created. Our Support Team will reply in less than 24h. You are very important for us and we are committed to working side by side with you to satisfy any specific needs. Thanks for trusting Damecoins.</p>',
        'gretting' => '<h4 class="secondary"><strong> Greetings,<br> DameCoins team</strong></h4>',   
        'contact'  => ' <p style="margin-top:20px;color:#212121">  <b>DAME Banking Group Ltd.</b><br>
                        27 Old Gloucester Street<br>
                        London, WC1N 3AX , United Kingdom<br>
                        +44 20 3856 3532 (only business hours)<br>
                        info@damecoins.co.uk</p>',

    ],


    

];
