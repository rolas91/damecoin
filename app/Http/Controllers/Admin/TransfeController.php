<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TransfAdmin;
use Illuminate\Http\Request;
use Session;

class TransfeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transfers = TransfAdmin::paginate(10);

        return view('admin.transferencia.index_transfe', compact('transfers'));

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
        $transfe = TransfAdmin::find($id);

        return view('admin.transferencia.edit_transfe', compact('transfe'));
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

        $transfe = TransfAdmin::find($id);
         $transfe->status =$request->status;
        $transfe->save();
        Session::flash('success', 'Operacion actualizada con exito');
        return redirect('admin/transfe');
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
