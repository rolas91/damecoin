<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Currency;
use App\DetailCurrency;
use DB;
use App\Http\Requests\RequestCurrency;

use Session;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //return "si";
        $currencies = Currency::paginate(20);
        //return $crypto;
        return view('admin.currency.index_currency',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.new_currency');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCurrency $request)
    {
        
        DB::beginTransaction();
        try{

        $currency = new Currency;
            $currency->name =$request->name;
            $currency->code =strtoupper($request->code);
            $currency->symbol=strtoupper($request->symbol);
            $currency->idioma=$request->idioma;
            $currency->status=1;
            $currency->secure=1;
            $currency->isoCountry=strtoupper($request->isocode);
        $currency->save();

        $details= new DetailCurrency;
            $details->currency()->associate($currency);
            $details->min_deposito=$request->min_deposito;
            $details->max_deposito=$request->max_deposito;
            $details->comision_abono=$request->comision_abono;
            $details->comision_retiro=$request->comision_retiro;
        $details->save();

        DB::commit();
        Session::flash('success', 'Divisa Guardada con exito');
        return redirect('admin/currency');
        }
        catch (Exception $e) {
            DB::rollback();
            return $e;
            //DB::rollback();
        // something went wrong
       }
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
        $currency=Currency::where('id',$id)->first();
       // return $currency;
        return view('admin.currency.edit_currency',compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestCurrency $request, $id)
    {
        $status=0;
        $secure=0;
        if($request->status){
            $status=1;
        }
        if($request->secure){
            $secure=1;
        }else{

        }
        //return $status;
        DB::beginTransaction();
        try{
        $currency = Currency::find($id);
            $currency->name =$request->name;
            $currency->code =strtoupper($request->code);
            $currency->idioma=$request->idioma;
            $currency->status=$status;
            $currency->secure=$secure;
            $currency->symbol=strtoupper($request->symbol);
            $currency->isoCountry=strtoupper($request->isocode);
        $currency->save();
       // return $currency;

        $details=DetailCurrency::where("currency_id",$currency->id)->first();
            $details->min_deposito=$request->min_deposito;
            $details->max_deposito=$request->max_deposito;
            $details->comision_abono=$request->comision_abono;
            $details->comision_retiro=$request->comision_retiro;
        $details->save();

        DB::commit();
        Session::flash('success', 'Divisa actualizada con exito');
        return redirect('admin/currency');
        }
        catch (Exception $e) {
            DB::rollback();
            return $e;
            //DB::rollback();
        // something went wrong
       }
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
}
