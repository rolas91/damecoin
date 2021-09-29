<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Wallet;
use General;

class AnalitycsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payments=Payment::where(['status'=>1,'descripcion'=>'compra','pasarela'=>'PayU'])
        //->whereBetween('created_at', [$start, $end])
        ->orderBy('created_at',"desc")
        ->paginate(5);

        //return $payments;

        $wallets=Wallet::where(['status'=>1,'status_user'=>'Aprobado'])
         //->whereBetween('created_at', [$start, $end])
         ->orderBy('created_at',"desc")
         ->paginate(5);
         //$wallets=[];
        // $payments=[];

        return view('admin.analytics.index_analytics',compact('payments','wallets'));

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
        $date=$request->range;

        $pasarela=$request->metodo;

        //return $pasarela;

        $range=explode('-',$date);

        $start=$range[0];
        $end=$range[1];

        $start = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $start)));
        $end = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $end)));


            if ($pasarela=="Todas") {

               // $payments=Payment::where(['status'=>1])
                $payments=Payment::whereBetween('created_at', [$start, $end])
                ->orderBy('created_at',"desc")
                ->get();

               // $wallets=Wallet::where(['status'=>1,'status_user'=>'Aprobado'])
                $wallets=Wallet::whereBetween('created_at', [$start, $end])
                ->orderBy('created_at',"desc")
                ->get();

            } else {
                $payments=Payment::where(['status'=>1,'pasarela'=>$pasarela])
                ->whereBetween('created_at', [$start, $end])
                ->orderBy('created_at',"desc")
                ->get();

        
                $wallets=Wallet::where(['status'=>1,'status_user'=>'Aprobado'])
                 //->whereBetween('created_at', [$start, $end])
                 ->orderBy('created_at',"desc")
                 ->paginate(5);

            }
        
        return view('admin.analytics.index_analytics',compact('payments','wallets'));
        //return $payments;
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
}
