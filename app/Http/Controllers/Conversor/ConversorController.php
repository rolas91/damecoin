<?php

namespace App\Http\Controllers\Conversor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentLimit;
use General;

class ConversorController extends Controller
{
   

    public function store(Request $request)
    {
        try {
            $from = 'USD';
            $limit = PaymentLimit::first();
            $to = $request->currency;
            $metodo=$request->metodo;//metodo paypal/skrill/bizum

            switch ($metodo) {
                case "paypal":
                    return $this->convertPaypal($limit,$from,$to);
                    break;
                case "skrill":
                    return $this->convertSkrill($limit,$from,$to);
                    break;
                case "payoneer":
                    return $this->convertPayoneer($limit,$from,$to);
                    break;
                case "transfe":
                    return $this->convertTransfe($limit,$from,$to);
                    break;
                case "wechat":
                    return $this->convertWechat($limit,"CNY",$to);
                    break;
                case "alipay":
                    return $this->convertAlipay($limit,"CNY",$to);
                    break;
                default:
                    return ['success' => 'false'];
            }
        } catch (Exception $e) {

            return ['success' => 'false'];

        }

    }

    public function convertPaypal($limit,$from,$to){

        $minPaypal = $limit->paypal_minimum;
        $emailPaypal = $limit->paypal_email;
        $convert=General::getConverFromToNew($from, $to, $minPaypal);

        return ['success' => 'true', "min" => round($convert, 2)." ".$to, "minUsd" => round($minPaypal, 2)." ".$from, "emailPaypal" => $emailPaypal];
   

    }

    public function convertSkrill($limit,$from,$to){

        $minSkrill = $limit->skrill_minimum;
        $emailSkrill = $limit->skrill_email;
        $convert=General::getConverFromToNew($from, $to, $minSkrill);

        return ['success' => 'true', "min" => round($convert, 2)." ".$to, "minUsd" => round($minSkrill, 2)." ".$from, "emailSkrill" => $emailSkrill];

    }

    public function convertPayoneer($limit,$from,$to){

        $minPayoneer= $limit->payoneer_minimum;
        $emailPayoneer = $limit->payoneer_email;
        $convert=General::getConverFromToNew($from, $to, $minPayoneer);
        return ['success' => 'true', "min" => round($convert, 2)." ".$to, "minUsd" => round($minPayoneer, 2)." ".$from, "emailPayoneer" => $emailPayoneer];
    }

    public function convertTransfe($limit,$from,$to){

        $mintransfe = $limit->bank_minimum;
        $convert=General::getConverFromToNew($from, $to, $mintransfe);

        return ['success' => 'true', "min" => round($convert, 2)." ".$to, "minUsd" => round($mintransfe, 2)." ".$from];
    }

    public function convertWechat($limit,$from,$to){

        $minWetchat = $limit->wechatpay_minimum;
        $emailWechatpay = $limit->cuenta_wechatpay;
        $imagenWechat = $limit->qr_wechat;
 
        $convert=General::getConverFromToNew($from, $to, $minWetchat);

        $maxWechat = $limit->wechatpay_maximum;

        $convertMax=General::getConverFromToNew($from, $to, $maxWechat);


        return [
            'success' => 'true', 
            "min" => round($convert, 2)." ".$to, 
            "minUsd" => round($minWetchat, 2)." ".$from,
            "emailWechatpay" => $emailWechatpay, 
             "imagen" => $imagenWechat,
             "max" => round($convertMax, 2)." ".$to, 
             "maxUsd" => round($maxWechat, 2)." ".$from
            ];
    }

    public function convertAlipay($limit,$from,$to){

        $minAlipay = $limit->alipay_minimum;
        $emailAlipay = $limit->cuenta_alipay;
        $imagenAlipay = $limit->qr_alipay;
        $maxAlipay = $limit->alipay_maximum;

        $convert=General::getConverFromToNew($from, $to, $minAlipay);

        $convertMax=General::getConverFromToNew($from, $to, $maxAlipay);

        return [
            'success' => 'true',
            "min" => round($convert, 2)." ".$to,
            "minUsd" => round($minAlipay, 2)." ".$from, 
            "emailAlipay" => $emailAlipay,
            "imagen" => $imagenAlipay,
            "max" => round($convertMax, 2)." ".$to,
            "maxUsd" => round($maxAlipay, 2)." ".$from
        ];


    }

    public function flutter(Request $request)
    {
        $card = $request->card;
        $currency = $request->currency;
        $amount = $request->amount;
        $limit = PaymentLimit::first();
       
        try {
            $toUsd="USD";
            $convertedAmountUSD=General::getConverFromTo($currency, $toUsd, $amount);

            if ($card == 'true') {
                if (($convertedAmountUSD >= $limit->card_minimum) && ($convertedAmountUSD <= $limit->card_maximum)) {
                    return ['type' => 'card', "data" => "true"];
                } else {
                    if($currency==$toUsd){
                        return ['type' => 'card', "min" => $limit->card_minimum." ".$toUsd, "max" => $limit->card_maximum." ".$toUsd, "data" => "false"];
                  
                    }else{
                        $minCurrency=General::getConverFromTo($toUsd, $currency, $limit->card_minimum);
                        $minCurrency=$minCurrency." ".$currency;
                        $maxCurrency=General::getConverFromTo($toUsd, $currency, $limit->card_maximum);
                        $maxCurrency=$maxCurrency." ".$currency;
                        return ['type' => 'card', "min" => $limit->card_minimum." ".$toUsd."(".$minCurrency.")", "max" => $limit->card_maximum." ".$toUsd."(".$maxCurrency.")", "data" => "false"];
                    }
                }
            }

        } catch (Exception $e) {
            return ['type' => 'card', "data" => "true"];

        }

    }

    public function mercadopago(Request $request)
    {
        $card = $request->card;
        $currency = $request->currency;
        $amount = $request->amount;
        $limit = PaymentLimit::first();
        try {
            $toArs="ARS";
            $convertedAmountARS=General::getConverFromTo($currency, $toArs, $amount);

            if ($card == 'true') {
                if (($convertedAmountARS >= $limit->mercadopago_minimum)) {
                    return ['type' => 'card', "data" => "true"];
                } else {
                    if($currency==$toArs){
                        return ['type' => 'card', "min" => $limit->mercadopago_minimum." ".$toArs, "data" => "false"];
                  
                    }else{
                        $minCurrency=General::getConverFromTo($toArs, $currency, $limit->mercadopago_minimum);
                        $minCurrency=$minCurrency." ".$currency;
                        return ['type' => 'card', "min" => $limit->mercadopago_minimum." ".$toArs."(".$minCurrency.")", "data" => "false"];
                    }
                }
            }

        } catch (Exception $e) {
            return ['type' => 'card', "data" => "true"];
        }

    }

    


   
}
