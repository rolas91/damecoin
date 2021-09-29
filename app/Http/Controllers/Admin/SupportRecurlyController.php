<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RequestSupportRecurly;
use App\StripeAccount;
use App\SupportRecurly;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Exception;
use Redirect;

class SupportRecurlyController extends Controller
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

        
        $supports = SupportRecurly::paginate(20);
/*
        foreach($supports as $support){
            echo $support->stripe_account->gateways();
            echo "<br>";

        }
        */

       

       // dd($supports);

        return view('admin.support-recurly.index',compact('supports'));
        
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $currencies = DB::table('currencies')->where('status', 1)->pluck('name', 'id');

        $stripe = DB::table('stripe_accounts')->where('status', 1)->pluck('stripe_id', 'id');
        //dd($currencies);
        return view('admin.support-recurly.create',compact('currencies','stripe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(RequestSupportRecurly $request)
    {
        DB::beginTransaction();
        try{

            SupportRecurly::create($request->all());
           
            DB::commit();

            Session::flash('success', 'Divisa añadido con exito a soporte Recurly');

            return redirect('admin/support-recurly');
            
        }
        catch (Exception $e) {
            DB::rollback();
            if ($e->errorInfo[1]==1062){
                return Redirect::back()->with('error',"La divisa ya registrada en el sistema");
                
            }  

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
       // return $id;
        $currencies = DB::table('currencies')->where('status', 1)->pluck('name', 'id');

        $stripe = DB::table('stripe_accounts')->pluck('stripe_id', 'id');

       
       
        $support = SupportRecurly::findOrFail($id);

        $selectedGateway = DB::table('gateway_recurly')
        ->select("currencies.id","currencies.code")
            ->join('currencies', 'gateway_recurly.currency_id', '=', 'currencies.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('gateway_recurly.stripe_account_id', $support->stripe_account->id)
            ->get();

         $selectedGateway=$selectedGateway->pluck('code', 'id');


        return view('admin.support-recurly.edit',compact('currencies','support','stripe','selectedGateway'));



       // dd($support);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSupportRecurly $request, $id)
    {
       

        DB::beginTransaction();
        try{

            $support = SupportRecurly::findOrFail($id);


            $support->update($request->all());
           
            DB::commit();

            Session::flash('success', 'Divisa editada con exito');

            return redirect('admin/support-recurly');
            
        }
        catch (Exception $e) {
            DB::rollback();
            if ($e->errorInfo[1]==1062){
                return Redirect::back()->with('error',"ha ocurrido un error en la operacion");
                
            }  
            return Redirect::back()->with('error',"ha ocurrido un error en la operacion");

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
