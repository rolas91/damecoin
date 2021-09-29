<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Landing;

class LandingController extends Controller
{
    public function index()
    {
        $lading = Landing::all();
        return view('admin.landings.index',['lading' => $lading]);
    }

    public function create()
    {
        return view('admin.landings.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'comentarios' => 'required',
            // 'url' => 'required',
            // 'link_asana' => 'required',
            'state' => 'required',
            'agent' => 'required',
        ]);

        if($request->url == '') $request->url = 'No posee';
        if($request->link_asana == '') $request->link_asana = 'No posee';

        Landing::create([
            'name' => $request->name,
            'url' => $request->url,
            'comentarios' => $request->comentarios,
            'link_asana'=>$request->link_asana,
            'state' => $request->state,
            'agent' => $request->agent
        ]);

        return back()->with('success','successful update');
    }

    public function edit($id)
    {
        return view('admin.landings.edit', ['landing' => Landing::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $landing = Landing::find($id);

        $landing->name = $request->name;
        $landing->url = $request->url;
        $landing->comentarios = $request->comentarios;
        $landing->link_asana=$request->link_asana;
        $landing->state = $request->state;
        $landing->agent = $request->agent;
        $landing->save();

        return back()->with('success','successful update');
    }
}
