<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentMethods;
use App\SendCryptoWallet;
use General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class PaymentMethod extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payments = PaymentMethods::all();
        return view('admin.payment-method.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment-method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $method = new PaymentMethods();
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            'form' => 'required',
        ]);

        //Image
        if ($request->file('file')) {
            $path = Storage::disk('public')->put('/img/metodo-pago', $request->file('file'));
            $method->file = $path;
        }

        $toUsd = "USD";
        $currency = "EUR";

        $convert = General::getConverFromTo($toUsd, $currency, $request->amount);

        $method->name = $request->name;
        $method->amount = $request->amount;
        // $method->send_comission = $request->send_comission;
        $method->convert = $convert;
        $method->form = $request->form;

        $method->save();

        Session::flash('success', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $method = PaymentMethods::find($id);
        return view('admin.payment-method.edit', ['method' => $method]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $method = PaymentMethods::find($id);
        //Image
        if ($request->file('file')) {
            $path = Storage::disk('public')->put('/img/metodo-pago', $request->file('file'));
            $method->file = $path;
        }

        $toUsd = "USD";
        $currency = "EUR";

        $convert = General::getConverFromTo($toUsd, $currency, $request->amount);

        $method->name = $request->name;
        $method->amount = $request->amount;
        $method->description = $request->description;
        $method->file_idioma = $request->file_idioma;
        $method->cuenta_pago = $request->cuenta_pago;
        $method->modal=$request->modal;
        $method->deposit_fees=$request->deposit_fees;
        $method->status=$request->status;

        

        
        // $method->send_comission = $request->send_comission;
        $method->convert = $convert;
        $method->form = $request->form;

        $method->save();

        Session::flash('success', 'Success');

        return redirect("admin/payment-method");

    }

    public function destroy($id)
    {
        $method = PaymentMethods::find($id);
        $method->delete();
        Session::flash('success', 'Success');
        return back();
    }

    public function idioma(Request $request)
    {

        //return __DIR__.'/../../../../resources/lang/en/dashboard_payment_method.php';

        //$request->idioma;
        // return $request->file;

        $nombre_fichero = "/var/www/html/damecoins/resources/lang/en/dashboard_payment_method.php";

        /* $gestor = fopen($nombre_fichero, "r");
        $contenido = fread($gestor, filesize($nombre_fichero));
        fclose($gestor);
         */

        $gestor = fopen($nombre_fichero, "a+");

        $contenido = fread($gestor, filesize($nombre_fichero));

        fclose($gestor);
        return $contenido;
        /*
        $texto="\n use App\Http\Controllers\SeoController;
        \n Route::get('/comprar-{criptp?}', [SeoController::class,'buy']);
        ";*/
/*
$texto="\n Route::get('/comprar-{criptp?}', [SeoController::class,'buy']);";

fputs($file, $texto);

fclose($file);
 */
/*
$open = fopen(',"w+"); //abres el fichero en modo lectura/escritur

$text = fread($open);
//recuperas el contenido del fichero
return  $text;
 */
    }

    public function idiomaSave(Request $request)
    {

        
        $nombre_fichero = "/var/www/html/damecoins/resources/lang/en/dashboard_payment_method.php";

        $gestor = fopen($nombre_fichero, "w");
        fputs($gestor, $request->info);

        fclose($gestor);
    }
}
