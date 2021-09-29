<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Dashboard
{

    public static function key()
    {
        return config("services.coinlayer.key");
    }
    public static function expireAt()
    {
        return 30;
    }

    public static function getCryptoPrices()
    {

        $cache = "crypto";
        // cache::flush();
        if (Cache::has($cache)) {

            return Cache::get($cache);

        } else {

            $expiresAt = Carbon::now()->addMinutes(self::expireAt());
            $ch = curl_init('https://api.coinlayer.com/list?access_key=' . self::key() . '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            $exchangeRates = json_decode($json, true);

            Cache::add($cache, $exchangeRates, $expiresAt);

            return $exchangeRates;

        }
    }

    public static function getPrices($currency)
    {

        $cache = "cryptoRatesPrices" . $currency;
        $endpoint = 'live';
        // cache::flush();
        if (Cache::has($cache)) {

            return Cache::get($cache);

        } else {
            $expiresAt = Carbon::now()->addMinutes(self::expireAt());
            $ch = curl_init('https://api.coinlayer.com/' . $endpoint . '?access_key=' . self::key() . '&target=' . $currency . '&expand=1');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            $exchangeRates = json_decode($json, true);

            Cache::add($cache, $exchangeRates, $expiresAt);

            return $exchangeRates;
        };
    }

    public static function getList($cryptos, $prices, $getCryptosSistem)
    {
        // return $cryptos["crypto"]["BTC"]["max_supply"];
        // return $prices;
        // return $prices["rates"]["BTC"]["rate"];
        $pricesSliders = array();
        foreach ($getCryptosSistem as $v) {
            if (isset($prices["rates"][$v['code']])) {
                $change = $prices["rates"][$v['code']]["change"];
                $price = $prices["rates"][$v['code']]["rate"]; //$prices["rates"][$v['code']]["rate"];
                $max_supply = $cryptos["crypto"][$v['code']]["max_supply"]; //$cryptos["crypto"][$v['code']]['max_supply'];
                $pricesSliders[] = [
                    "price" => number_format($price, 2, '.', ''),
                    "code" => $v['code'],
                    "img" => $v['img'],
                    "name" => $v['name'],
                    "code" => $v['code'],
                    "change" => $change,
                    "id" => $v["id"],
                    "max_supply" => $max_supply,
                ];
            }
            // }
        }
        return $pricesSliders;

    }

    public static function Balance()
    {
        $currency = DB::table('currencies')
            ->select('id', 'code')
            ->where('code', config("settings.default.currency"))
            ->first();

        $idCurrency = $currency->id;
        $codeCurrency = $currency->code;

        $crypto = DB::table('cryptos')->select('id', 'code')->where('code', config("settings.default.crypto"))->first();
        return $crypto->id;
        return "si";
        if (Auth::user()->preference) {
            $idCurrency = Auth::user()->preference->fiat_wallet_default;
            $codeCurrency = Auth::user()->preference->currency->code;
            $idCrypto = Auth::user()->preference->crypto_wallet_default;
            $codeCrypto = Auth::user()->preference->crypto->code;

        } else {
            $currency = Currency::select('id')->where('code', config("settings.default.currency"))->first();
            $default = $currency;
            $currency = $currency->id;
            $crypto = Crypto::select('id')->where('code', config("settings.default.crypto"))->first();
            $crypto = $crypto->id;

            //return $crypto->id;
        }
        return $cryptoCurrency;

    }

    public static function balanceWallet()
    {

        if (Auth::user()->preference) {
            $idCrypto = Auth::user()->preference->crypto_wallet_default;
            $codeCrypto = Auth::user()->preference->crypto->code;
            $amount = self::getCryptoAprobado($idCrypto);
            return $amount . " " . $codeCrypto;

        } else {
            $crypto = DB::table('cryptos')
                ->select('id', 'code')
                ->where('code', config("settings.default.crypto"))
                ->first();
            if ($crypto) {
                $idCrypto = $crypto->id;
                $codeCrypto = $crypto->code;
                $amount = self::getCryptoAprobado($idCrypto);
                return $amount . " " . $codeCrypto;
            }
        }

    }

    public static function balanceFiat()
    {

        if (Auth::user()->preference) {
            $idCurrency = Auth::user()->preference->fiat_wallet_default;
            $codeCurrency = Auth::user()->preference->currency->code;
            return General::getCryptoWalettUser($idCurrency) . " " . $codeCurrency;

        } else {
            $currency = DB::table('currencies')
                ->select('id', 'code')
                ->where('code', config("settings.default.currency"))
                ->first();
            if ($currency) {
                $idCurrency = $currency->id;
                $codeCurrency = $currency->code;
                return General::getCryptoWalettUser($idCurrency) . " " . $codeCurrency;
            }
        }

    }

    public static function getCryptoAprobado($crypto)
    {
        //emplear status adicional para diferencial pedidos reales y pedidos pendientes.
        $id = Auth::user()->id;
        $cryptoId = $crypto;
        $valor = DB::table("crypto_wallets")
            ->select(DB::raw("SUM(compra-venta) as total"))
            ->orderBy("created_at")
            ->where(['user_id' => $id, 'cripto_id' => $cryptoId, 'status' => config("settings.wallets.aprobado")])
            ->first();
        $result = $valor->total;
        return number_format($result, 7, '.', '');
    }

    public static function deposit_fee($total, $comision)
    {
        return ($total - ($total * ($comision / 100)));
    }

    public static function maker_fee($total, $desc)
    {
        $totalx = ($total - ($total * $desc / 100));
        return number_format($totalx, 2, '.', '');
    }

    public static function getCurrencyDefault()
    {
        if (session('currencyDefault')) {
            return session('currencyDefault');
        } else {
            return config("settings.default.idCurrency");
        }
    }

    public static function getCryptoDefault()
    {
        if (session('cryptoDefault')) {
            return session('cryptoDefault');
        } else {
            return config("settings.default.idCrypto");
        }
    }

    public static function getPagos()
    {
        return DB::table("payment_methods")->where('status', 1)->get();
    }

    public static function getAccounts()
    {

        $cache = "accounts";

        if (Cache::has($cache)) {

            return Cache::get($cache);

        } else {

            $expiresAt = Carbon::now()->addMinutes(self::expireAt());

            $accounts = DB::table("banks")->where('status', 1)->get();

            Cache::add($cache, $accounts, $expiresAt);

            return $accounts;
        };

    }

    public static function convertK($n)
    {
        if (is_numeric($n)) {

            if ($n > 1000000000000) {
                return round(($n / 1000000000000), 1) . "T";
            } else if ($n > 1000000000) {
                return round(($n / 1000000000), 1) . "G";
            } else if ($n > 1000000) {
                return round(($n / 1000000), 1) . "M";
            } else if ($n > 1000) {
                return round(($n / 1000), 1) . "K";
            }

            return number_format($n);
            /*
            $num = round($num);
            $leng = strlen($num);
            if ($leng) {
                $resto = $leng - 2;
            }

            return $n;
            return substr($num, 0, 2) . "-" . $resto;
            */
        }
        return $n;

    }

}
