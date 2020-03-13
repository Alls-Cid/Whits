<?php

namespace App\Http\Controllers;
use App\categoria;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriasController extends Controller
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
        $cat = categoria::all();

        return view('categorias.index', compact('cat'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'
        ]);


        $categoria = new categoria();
        $categoria->nombre = $request->input('nombre');
        $categoria->estatus = $request->input('estatus');
        $categoria->categoria = $request->input('categoria');

        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/categorias/', $name);
            //$file->move('images/categorias/', $name);
            $categoria->img_profile = $name;
        }else{
            $categoria->img_profile = 'cabeza.png';
        }

        $categoria->save();
        $cat = categoria::all();

        //return($name);
        return redirect()->route('categorias.index')->with('status','Se ha creado correctamente la Categoria');
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
        $categoria = categoria::where('id','=',$id)->firstOrFail();
        
        return view('categorias.edit', compact('categoria'));
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
        $validateData = $request->validate([
            'nombre' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/'
        ]);
        $categoria = categoria::where('id','=',$id)->firstOrFail();
        $categoria->fill($request->except('profile'));

        if($request->hasFile('profile')){
        //$aux = public_path().'/images/categorias/'.$categoria->img_profile;
        $aux ='images/categorias/'.$categoria->img_profile;
         \File::delete($aux);

        
        $file = $request->file('profile');
        $name = time().$file->getClientOriginalName();
        //$file->move(public_path().'/images/categorias/', $name);
        $file->move('images/categorias/', $name);
        $categoria->img_profile = $name;
        }

        $categoria->save();

        $cat = categoria::all();

        return redirect()->route('categorias.index')->with('status','Se ha actualizado correctamente la categoria');
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
