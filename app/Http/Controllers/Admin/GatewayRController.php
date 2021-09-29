<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestGatewayR;
use App\GatewayRecurly;
use DB;
use Session;
use Exception;
use Redirect;

class GatewayRController extends Controller
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
        $gateways = GatewayRecurly::paginate(10);

        return view('admin.gateway-recurly.index',compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = DB::table('currencies')->where('status', 1)->pluck('name', 'id');

        //dd($currencies);
        return view('admin.gateway-recurly.create',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestGatewayR $request)
    {
        GatewayRecurly::create($request->all());

       // Session::flash('successgateway', 'Divisa añadido con exito a soporte Recurly');

        return Redirect::back()->with('successgateway',"gateway añadido correctamente");

        
        //return redirect('admin/gateway-recurly');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $data = DB::table('gateway_recurly')
        ->select("currencies.id","currencies.code")
            ->join('currencies', 'gateway_recurly.currency_id', '=', 'currencies.id')
            //->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('gateway_recurly.stripe_account_id', $id)
            ->get();

        return $data;
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        

        $currencies = DB::table('currencies')->where('status', 1)->pluck('name', 'id');

       
        $gateway = GatewayRecurly::findOrFail($id);

        return view('admin.gateway-recurly.edit',compact('currencies','gateway'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestGatewayR $request, $id)
    {
        DB::beginTransaction();
        try{

            $gateway = GatewayRecurly::findOrFail($id);

            $gateway->update($request->all());
           
            DB::commit();

            Session::flash('success', 'Gateway editado con exito');

            return redirect('admin/gateway-recurly');
            
        }
        catch (Exception $e) {
            DB::rollback();
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
        GatewayRecurly::destroy($id);

        return Redirect::back()->with('successgateway',"gateway eliminado correctamente");

    }
}
