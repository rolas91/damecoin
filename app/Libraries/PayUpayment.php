<?php

require 'payu/PayU.php';

class PayUpayment
{

    public function __construct()
    {

    }

    public static function test()
    {
        return "test ok";
    }

    public function processPayM($total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test)
    {

        if ($is_test) {

            Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.9/");
            PayU::$apiKey = "4Vj8eK4rloUd272L48hsrarnUA"; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = "pRRXKOl8ikMmt9u"; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = "508029"; //Ingrese aquí su Id de Comercio.
            PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
            PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
        }

        if (!$is_test) {

            Environment::setPaymentsCustomUrl("https://api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://api.payulatam.com/payments-api/rest/v4.9/");
            //tlive
            PayU::$apiKey = "k93ij0ta7an7ga3i4n0nou2tt"; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = "098e394f48dcab1"; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = "513370"; //Ingrese aquí su Id de Comercio.
            PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
            PayU::$isTest = false; //Dejarlo True cuando sean pruebas.
        }

        $reference = "megac-" . uniqid();

        $info = $this->getAccount($iso_code);

        $value = $total;
        try {
            $parameters = array(
                //Ingrese aquí el identificador de la cuenta.
                // PayUParameters::ACCOUNT_ID =>  $info->idAccountTest,//cambiar en live

                PayUParameters::ACCOUNT_ID => $info->idAccountLive, //cambiar en live

                //PayUParameters::ACCOUNT_ID => "559086",
                //Ingrese aquí el código de referencia.
                PayUParameters::REFERENCE_CODE => $reference,
                //Ingrese aquí la descripción.
                PayUParameters::DESCRIPTION => "Payment",

                // -- Valores --
                //Ingrese aquí el valor.
                PayUParameters::VALUE => $total,
                //Ingrese aquí la moneda.
                PayUParameters::CURRENCY => $info->currency,
                // -- Comprador
                //Ingrese aquí el nombre del comprador.
                PayUParameters::BUYER_NAME => $name,
                //Ingrese aquí el email del comprador.
                PayUParameters::BUYER_EMAIL => $email,

                PayUParameters::PAYER_NAME => $name,
                PayUParameters::CREDIT_CARD_NUMBER => $cc,
                //Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $yy,
                //Ingrese aquí el código de seguridad de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_SECURITY_CODE => $cv,
                //Ingrese aquí el nombre de la tarjeta de crédito
                // "MASTERCARD" || "AMEX" || "ARGENCARD" || "CABAL" || "NARANJA" || "CENCOSUD" || "SHOPPING"
                PayUParameters::PAYMENT_METHOD => $type_card,

                //Ingrese aquí el número de cuotas.
                PayUParameters::INSTALLMENTS_NUMBER => "1",
                //Ingrese aquí el nombre del pais.
                PayUParameters::COUNTRY => $info->country,

                PayUParameters::IP_ADDRESS => "127.0.0.1",

            );
            $responsex = PayUPayments::doAuthorizationAndCapture($parameters);
            if ($responsex) {
                $response = ["success" => true, "response" => $responsex];
                return $response;
            } else {
                $response = ["success" => false, "code" => "error"];
                return $responde;
            }

        } catch (PayUException $e) {
            $response = ["success" => false, "code" => $e->payUCode];
            //$response=["success"=>false,"code"=>$e];
            return $response;
        }

    }

    public static function processPayU($total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test)
    {

        if ($is_test) {
            Environment::setPaymentsCustomUrl("https://api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://api.payulatam.com/payments-api/rest/v4.9/");
            //tlive
            PayU::$apiKey = "Ou1YZp5gTZ63sicMscEJ5Q6INf"; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = "1NaBxkjDEq2rc5m"; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = "676646"; //Ingrese aquí su Id de Comercio.
            PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
            PayU::$isTest = false; //Dejarlo True cuando sean pruebas.
            $accounId = "679389";
            

        }

        if (!$is_test) {

            Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.9/");
            //tlive
            PayU::$apiKey = "4Vj8eK4rloUd272L48hsrarnUA"; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = "pRRXKOl8ikMmt9u"; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = "508029"; //Ingrese aquí su Id de Comercio.
            PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
            PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
            $accounId = "512321";
           
        }


        $reference = "Live-" . uniqid();

        try {
            $parameters = array(
                //Ingrese aquí el identificador de la cuenta.
                PayUParameters::ACCOUNT_ID => $accounId,
                //Ingrese aquí el código de referencia.
                PayUParameters::REFERENCE_CODE => $reference,
                //Ingrese aquí la descripción.
                PayUParameters::DESCRIPTION => "Pago Live",
                // -- Valores --
                //Ingrese aquí el valor.
                PayUParameters::VALUE => $total,
                //Ingrese aquí la moneda.
                PayUParameters::CURRENCY => "COP",
                // -- Comprador
                //Ingrese aquí el nombre del comprador.
                PayUParameters::BUYER_NAME => $name,
                //Ingrese aquí el email del comprador.
                PayUParameters::BUYER_EMAIL => $email,
                // -- pagador --
                //Ingrese aquí el nombre del pagador.
                PayUParameters::PAYER_NAME => $name,
                //Ingrese aquí el email del pagador.
                PayUParameters::PAYER_EMAIL => $email,
                // -- Datos de la tarjeta de crédito --
                //Ingrese aquí el número de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_NUMBER => $cc,
                //Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $yy,
                //Ingrese aquí el código de seguridad de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_SECURITY_CODE => $cv,
                //Ingrese aquí el nombre de la tarjeta de crédito
                //VISA||MASTERCARD||AMEX||DINERS
                PayUParameters::PAYMENT_METHOD => $type_card,
                //Ingrese aquí el número de cuotas.
                PayUParameters::INSTALLMENTS_NUMBER => "1",
                //Ingrese aquí el nombre del pais.
                PayUParameters::COUNTRY => PayUCountries::CO,

                //IP del pagadador
                PayUParameters::IP_ADDRESS => $ip,

            );

//solicitud de autorización y captura
            //$response = PayUPayments::doAuthorizationAndCapture($parameters);

            $responsex = PayUPayments::doAuthorizationAndCapture($parameters);
            if ($responsex) {
                $response = ["success" => true, "response" => $responsex];
                return $response;
            } else {
                $response = ["success" => false, "code" => "error"];
                return $responde;
            }
        } catch (PayUException $e) {
            $response = ["success" => false, "code" => $e->payUCode];
            //$response=["success"=>false,"code"=>$e];
            return $response;
        }

    }

    public static function processPayUIndex($origen,$total, $cv, $yy, $type_card, $name, $cc, $email, $currency, $iso_code, $ip, $is_test,$dni,$postal,$ciudad,$phone,$direccion,$isoCode)
    {

        if ($is_test) {
            //return "live";
            Environment::setPaymentsCustomUrl("https://api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://api.payulatam.com/payments-api/rest/v4.9/");
            //tlive
            PayU::$apiKey = "Ou1YZp5gTZ63sicMscEJ5Q6INf"; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = "1NaBxkjDEq2rc5m"; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = "676646"; //Ingrese aquí su Id de Comercio.
            PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
            PayU::$isTest = false; //Dejarlo True cuando sean pruebas.
            $accounId = "679389";
            

        }

        if (!$is_test) {
            //return "test";
            Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
            Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
            Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.9/");
            //tlive
            PayU::$apiKey = "4Vj8eK4rloUd272L48hsrarnUA"; //Ingrese aquí su propio apiKey.
            PayU::$apiLogin = "pRRXKOl8ikMmt9u"; //Ingrese aquí su propio apiLogin.
            PayU::$merchantId = "508029"; //Ingrese aquí su Id de Comercio.
            PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
            PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
            $accounId = "512321";
           
        }

        /*

         */

        $reference = "live-" . uniqid();

        try {
            $parameters = array(
                //Ingrese aquí el identificador de la cuenta.
                PayUParameters::ACCOUNT_ID => $accounId,
                //Ingrese aquí el código de referencia.
                PayUParameters::REFERENCE_CODE => $reference,
                //Ingrese aquí la descripción.
                PayUParameters::DESCRIPTION => "Pago live ".$origen,
                // -- Valores --
                //Ingrese aquí el valor.
                PayUParameters::VALUE => $total,
                //Ingrese aquí la moneda.
                PayUParameters::CURRENCY => "COP",
                // -- Comprador
                //Ingrese aquí el nombre del comprador.
                PayUParameters::BUYER_NAME => $name,
                //Ingrese aquí el email del comprador.
                PayUParameters::BUYER_STREET => $direccion,
                PayUParameters::BUYER_EMAIL => $email,
                PayUParameters::BUYER_DNI => $dni,
                PayUParameters::BUYER_CONTACT_PHONE => $phone,
                PayUParameters::BUYER_CITY => $ciudad,
                PayUParameters::BUYER_COUNTRY => $isoCode,
                PayUParameters::BUYER_POSTAL_CODE => $postal,
                PayUParameters::BUYER_PHONE => $phone,
                PayUParameters::BUYER_STATE => $ciudad,

                // -- pagador --
                //Ingrese aquí el nombre del pagador.
                PayUParameters::PAYER_NAME => $name,
                //Ingrese aquí el email del pagador.
                PayUParameters::PAYER_EMAIL => $email,
                PayUParameters::PAYER_DNI => $dni,
                PayUParameters::PAYER_CITY => $ciudad,
                PayUParameters::PAYER_POSTAL_CODE => $postal,
                PayUParameters::PAYER_PHONE => $phone,
                PayUParameters::PAYER_STREET => $direccion,
                PayUParameters::PAYER_STATE => $ciudad,

                PayUParameters::PAYER_COUNTRY => $isoCode,
                PayUParameters::PAYER_CONTACT_PHONE => $phone,
                // -- Datos de la tarjeta de crédito --
                //Ingrese aquí el número de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_NUMBER => $cc,
                //Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $yy,
                //Ingrese aquí el código de seguridad de la tarjeta de crédito
                PayUParameters::CREDIT_CARD_SECURITY_CODE => $cv,
                //Ingrese aquí el nombre de la tarjeta de crédito
                //VISA||MASTERCARD||AMEX||DINERS
                PayUParameters::PAYMENT_METHOD => $type_card,
                //Ingrese aquí el número de cuotas.
                PayUParameters::INSTALLMENTS_NUMBER => "1",
                //Ingrese aquí el nombre del pais.
                PayUParameters::COUNTRY => PayUCountries::CO,

                //IP del pagadador
                PayUParameters::IP_ADDRESS => $ip,

            );

//solicitud de autorización y captura
            //$response = PayUPayments::doAuthorizationAndCapture($parameters);

            $responsex = PayUPayments::doAuthorizationAndCapture($parameters);
            if ($responsex) {
                $response = ["success" => true, "response" => $responsex];
                return $response;
            } else {
                $response = ["success" => false, "code" => "error"];
                return $responde;
            }
        } catch (PayUException $e) {
            $response = ["success" => false, "code" => $e->payUCode];
            //$response=["success"=>false,"code"=>$e];
            return $response;
        }

    }

    public static function getAccount($code)
    {
        if ($code == "ar") {
            $response = (object) [
                'currency' => "ARS",
                'idAccountTest' => '512322',
                'idAccountLive' => '559086',
                'country' => PayUCountries::AR,
            ];
            return $response;
        }
        if ($code == "co") {
            $response = (object) [
                'currency' => "COP",
                'idAccountTest' => '512321',
                'idAccountLive' => '679389',
                'country' => PayUCountries::CO,
            ];
            return $response;
        }
        if ($code == "mx") {
            $response = (object) [
                'currency' => "MXN",
                'idAccountTest' => '512324',
                'idAccountLive' => '515602',
                'country' => PayUCountries::MX,
            ];
            return $response;
        }

        if ($code == "pa") {
            $response = (object) [
                'currency' => "USD",
                'idAccountTest' => '512326',
                'idAccountLive' => '514704',
                'country' => PayUCountries::PA,
            ];
            return $response;
        }

        if ($code == "pe") {
            $response = (object) [
                'currency' => "PEN",
                'idAccountTest' => '512323',
                'idAccountLive' => '515605',
                'country' => PayUCountries::PE,
            ];
            return $response;
        }

        if ($code == "cl") {
            $response = (object) [
                'currency' => "CLP",
                'idAccountTest' => '512325',
                'idAccountLive' => '515603',
                'country' => PayUCountries::CL,
            ];
            return $response;
        }

        //espacio para las cuentas internacionales

    }

}
