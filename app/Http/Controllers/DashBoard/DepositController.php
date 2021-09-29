<?php

namespace App\Http\Controllers\DashBoard;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\DashTransfRequest;
use App\TransfAdmin;
use App\PaymentLimit;
use General;
use App\User;
use Auth;
use Dashboard;
use DB;
use Illuminate\Http\Request;
use Session;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idDivisa = null)
    {

        $email = Auth::user()->email;

        $email = explode("@", $email);

        $concept = substr($email[0], 0, 8);

        // dd($concept);
        if ($idDivisa) {
            $defaultCurrency = Currency::where('id', $idDivisa)->first();
            session(['currencyDefault' => $defaultCurrency->id]);
        } else {
            $currencyDefault = Dashboard::getCurrencyDefault();
            $defaultCurrency = Currency::where('id', $currencyDefault)->first();
        }

        $limit = PaymentLimit::first();
        $mintransfe=$limit->bank_deposit_minimum;
        $convertBank=General::getConverFromToNew("USD", $defaultCurrency->code, $mintransfe);
        $minBank=round($convertBank, 2)." ".$defaultCurrency->code;

        // return $defaultCurrency;
        $getCurrencies = DB::table('currencies')->pluck('name', 'id');
        $meta['title'] = "Damecoins | Deposit";
        $meta['key'] = __('home_deposit.key');
        $meta['descripcion'] = __('home_deposit.description');
        $page = 'deposit';
        //$default=$getCurrency["default"];
        return view('dashboard.deposit', compact('getCurrencies', 'minBank','defaultCurrency', 'meta', 'concept', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function transfe(DashTransfRequest $request)
    {

        $file = $request->file('filex');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename = time() . '.' . $extension;
        $file->move('uploads/comprobante/', $filename);

        DB::beginTransaction();

        try {
            $Transfe = new TransfAdmin;
            $Transfe->account_id = $request->account_id;
            $Transfe->recipient = $filename;
            $Transfe->currency_id = $request->currency_id;
            $Transfe->status = "Pendiente";
            $Transfe->user()->associate(Auth::user());
            $Transfe->save();

            DB::commit();
            //  General::email(" ", " ", Auth::user(), "Transfer");

            Session::flash('success', __('home_deposit.success_transfe'));
            return redirect("/dash/portfolio");
        } catch (Exception $e) {

            DB::rollback();
            return Redirect::back()->with('msg', __('home_deposit.error_transfe'));
        }

    }
}
