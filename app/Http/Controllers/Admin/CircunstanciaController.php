<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Circumstance;
use App\Http\Requests\RequestCircunstancia;
use Session;

class CircunstanciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circunstancias = Circumstance::paginate(20);
        //return $crypto;
        return view('admin.circunstancia.index',compact('circunstancias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.circunstancia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCircunstancia $request)
    {
        DB::beginTransaction();
        try{
            $circunstancia = new Circumstance;
            $circunstancia->name =$request->name;
            $circunstancia->description=$request->description;
            $circunstancia->slug=$request->slug;
            $circunstancia->idioma=$request->idioma;
            $circunstancia->save();

            DB::commit();
            Session::flash('success', 'Circunstancia Guardado con exito');
            return redirect('admin/circunstancia');
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
        $circunstancia=Circumstance::where('id',$id)->first();
       // return $currency;
        return view('admin.circunstancia.edit',compact('circunstancia'));
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
        DB::beginTransaction();
        try{
            $circunstancia = Circumstance::find($id);    
            $circunstancia->name =$request->name;
            $circunstancia->description =$request->description;
            $circunstancia->slug =$request->slug;
            $circunstancia->idioma=$request->idioma;
            $circunstancia->save();
            DB::commit();
            Session::flash('success', 'Circumstance actualizada con exito');
            return redirect('admin/circunstancia');
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
        $circunstancia = Circumstance::find($id);
        if($circunstancia){
            $circunstancia->delete();
        }
        return redirect('admin/circunstancia');
    }
}
