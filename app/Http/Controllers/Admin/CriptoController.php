<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\RequestCripto;
use App\Http\Controllers\Controller;
use App\Crypto;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
//use Image;
//use Image;


class CriptoController extends Controller
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
        //return "si";
        $criptos = Crypto::orderBy('orden', 'asc')->orderBy('name', 'asc')->paginate(30);
        //return $crypto;
        return view('admin.cripto.index',compact('criptos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cripto.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCripto $request)
    {
//echo "si";
        $file = $request->file('img');
        $extension = $file->getClientOriginalExtension(); // getting image extension
        $filename =time().'.'.$extension;
        $file->move('uploads/img/', $filename);
        /*
        $image  = $request->file('img');
        $fileName   = $request->code.time() . '.' . $image->getClientOriginalExtension();
        $imgx = Image::make($image->getRealPath());
        $image->move('uploads/img/', $filename);
        return $imgx;
        */
        $cripto = new Crypto;
            $cripto->name =ucwords($request->name);
            $cripto->code =strtoupper($request->code);
            $cripto->img =$filename;
            $cripto->taker_fee=$request->taker_fee;
            $cripto->maker_fee =$request->maker_fee;
            
        $cripto->save();
        Session::flash('success', 'Criptodivisa añadida con exito');
        return redirect('admin/cripto');
        //return "si";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cripto=Crypto::where('id',$id)->first();
        //return $cripto;
        return view('admin.cripto.edit',compact('cripto'));
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
       // return $id;
      // $status=($request->status) ? 1 : 0;
      
            //return $request->status;
        $cripto = Crypto::find($id);
        //return $cripto;
            $cripto->name =ucwords($request->name);
            $cripto->code =strtoupper($request->code);
            $cripto->taker_fee=$request->taker_fee;
            $cripto->orden=$request->orden;
            if($request->file('img')){
                $file = $request->file('img');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename =time().'.'.$extension;
                $file->move('uploads/img/', $filename);
                $cripto->img =$filename;
              }
            
            $cripto->maker_fee =$request->maker_fee;
            $cripto->status = ($request->status) ? 1 : 0;//$status ;//$request->status ? 0;
        $cripto->save();
        Session::flash('success', 'Criptodivisa actualizada con exito');
        return redirect('admin/cripto');
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
