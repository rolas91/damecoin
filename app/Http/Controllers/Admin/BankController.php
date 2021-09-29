<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBank;
use App\Bank;
use DB;
use Session;

class BankController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $banks=Bank::orderBy("status","desc")->get();
        //dd($bank);
        return view('admin.bank.index_bank',compact('banks'));
    }
    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
       // dd($id);

        return view('admin.bank.edit_bank',compact('bank'));
    }
    public function create()
    {
        return view('admin.bank.create_bank');
    }

    public function update(RequestBank $request, $id)
    {
       

        DB::beginTransaction();
        try{

            $support = Bank::findOrFail($id);


            $support->update($request->all());
           
            DB::commit();

            Session::flash('success', 'Cuenta editada con exito');

            return redirect('admin/bank');
            
        }
        catch (Exception $e) {
            DB::rollback();
             
            return Redirect::back()->with('error',"ha ocurrido un error en la operacion");

       }


    }

    public function store(RequestBank $request)
    {
        DB::beginTransaction();
        try{

            
            Bank::create($request->all());

            //$support->update($request->all());
           
            DB::commit();

            Session::flash('success', 'Agregada con exito');

            return redirect('admin/bank');
            
        }
        catch (Exception $e) {
            DB::rollback();
             
            return Redirect::back()->with('error',"ha ocurrido un error en la operacion");

       }
    }

}
