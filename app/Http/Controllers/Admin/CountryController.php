<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\LandingCountry;
use App\Http\Requests\RequestCountry;
use Session;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
       // return "si";
        $countries = LandingCountry::paginate(20);
       // return $countries;
        return view('admin.country.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
    }

    public function store(RequestCountry $request)
    {
        DB::beginTransaction();
        try{
            $file = $request->file('bandera');
            $nombre = time().$file->getClientOriginalName();
            $country = new LandingCountry;
            $country->name =$request->name;
            $country->cod_iso2 =$request->code;
            $country->bandera=$nombre;
            $country->idioma=$request->idioma;
            $country->save();

            $file->move(public_path().'/banderas', $nombre );

            DB::commit();
            Session::flash('success', 'País Guardado con exito');
            return redirect('admin/country');
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
        $country=LandingCountry::where('id',$id)->first();
       // return $currency;
        return view('admin.country.edit',compact('country'));
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
        //return $status;
        DB::beginTransaction();
        try{
            $country = LandingCountry::find($id);
            if($request->hasFile('bandera')){
                $file = $request->file('bandera');
                $nombre = time().$file->getClientOriginalName();
                //unlink(public_path().'/banderas/'.$country->bandera);
                $file->move(public_path().'/banderas', $nombre);
                $country->bandera=$nombre;
            }
            
            $country->name =$request->name;
            $country->cod_iso2 =$request->code;
            $country->idioma=$request->idioma;
            $country->save();

        DB::commit();
        Session::flash('success', 'Country actualizada con exito');
        return redirect('admin/country');
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
        $country = LandingCountry::find($id);
        if($country){
            $country->delete();
        }
        return redirect('admin/country');
    }
}
