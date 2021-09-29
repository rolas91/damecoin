<?php


namespace App\Http\Controllers\Admin;
use App\StripeAccount;
use App\Http\Requests\RequestStripeAccount;
//use App\GatewayRecurly;
use DB;
use Session;
use Exception;
use Redirect;
//use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StripeAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $stripes = StripeAccount::paginate(20);

        return view('admin.stripe-account.index',compact('stripes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stripe-account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStripeAccount $request)
    {
        DB::beginTransaction();
        try{

            StripeAccount::create($request->all());
           
            DB::commit();

            Session::flash('success', 'Stripe Account agregado satisfacoriamente!');

            return redirect('admin/stripe-account');
            
        }
        catch (Exception $e) {

            DB::rollback();
            return Redirect::back()->with('error',"error en el sistema");
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
        $stripe = StripeAccount::findOrFail($id);

        $currencies = DB::table('currencies')->where('status', 1)->pluck('name', 'id');


        $banks = DB::table('banks')->pluck('name', 'id');

       // dd($banks);

        return view('admin.stripe-account.show',compact('stripe','currencies','banks'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stripe = StripeAccount::findOrFail($id);
        return view('admin.stripe-account.edit',compact('stripe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStripeAccount $request, $id)
    {
        DB::beginTransaction();
        try{

            $stripe = StripeAccount::findOrFail($id);

            $stripe->update($request->all());
           
            DB::commit();

            Session::flash('success', 'Stripe Account editado con exito');

            return redirect('admin/stripe-account');
            
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
        //
    }
}
