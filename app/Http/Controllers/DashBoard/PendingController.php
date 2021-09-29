<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Payment;
use Auth;

class PendingController extends Controller
{
    public function index()
    {
        $payment_pendings = Payment::select(
            'payments.total',
            'payments.pasarela',
            'payments.id',
            'payments.total',
            'currencies.code as code_currencies',
            'cryptos.code as code_crypto',
            'crypto_wallets.compra'
        )
            ->join('crypto_wallet_pyments', 'crypto_wallet_pyments.payment_id', 'payments.id')
            ->join('crypto_wallets', 'crypto_wallets.id', 'crypto_wallet_pyments.crypto_wallet_id')
            ->join('currencies', 'currencies.id', 'payments.currency_id')
            ->join('cryptos', 'cryptos.id', 'crypto_wallets.cripto_id')
            ->where('payments.user_id', Auth::user()->id)
            ->where('payments.status', 0)
            ->get();

        return view('home_usuario.pending', ['payment_pendings' => $payment_pendings]);
    }
}
