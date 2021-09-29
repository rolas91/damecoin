<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;

class PerfilController extends Controller
{
    public function index(){
        $user=User::find(Auth::user()->id);
         return view('admin.perfil.index_perfil',compact('user'));
    }

    public function update(Request $request)
    {
       
        $user = User::find(Auth::user()->id);
            $user->name =ucfirst($request->name);
            $user->lastName =ucfirst($request->lastname);
            //$user->symbol=strtoupper($request->symbol);
            //$user->isoCountry=strtoupper($request->isocode);
        $user->save();



        Session::flash('success', 'Datos actualizados');
        return redirect('admin/perfil');
        
    }
    
}
