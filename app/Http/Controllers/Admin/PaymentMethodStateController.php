<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentMethoState;
use Illuminate\Http\Request;
use Session;

use Auth;
use Illuminate\Support\Facades\Storage;

class PaymentMethodStateController extends Controller
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
    
        $payments = PaymentMethoState::paginate(20);
        return view('admin.payment-method-state.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment-method-state.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $error = $this->validate($request, [
                'payment_method' => 'required',
                'state' => 'required',
            ]);

            $methodState = new PaymentMethoState();
            $methodState->state = $request->state;
            $methodState->payment_method = $request->payment_method;

           

            $methodState->save();

            Session::flash('success', 'Success');
            return back();

        } catch (\Throwable $th) {
            throw $th;
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
        $payment = PaymentMethoState::findOrFail($id);

        return view('admin.payment-method-state.edit', compact('payment'));
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
        $payment = PaymentMethoState::findOrFail($id);
        $payment->state = $request->state;

        $payment->save();

        return redirect('admin/payment-method-state');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $metodo =  PaymentMethoState::find($id);
       $metodo->delete();

       Session::flash('success', 'Success');
       return redirect('admin/payment-method-state');
    }
}
