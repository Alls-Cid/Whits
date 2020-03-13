<?php

namespace App\Http\Controllers;
 use App\Trabajador;
 use App\categoria;
 use App\documento;
 use Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TrabajadoresController extends Controller
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
        $worker = Trabajador::all();
        $categorias = categoria::all(); 

        return view('trabajadores.index', compact('worker','categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = categoria::all();
        return view('trabajadores.workers', compact('categorias'));
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
            'nombre' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚ ]+$/',
            'profile'=> 'required'
        ]);


        $trabajador = new Trabajador();
        $trabajador->nombre = $request->input('nombre');
        $trabajador->telefono = $request->input('telefono');
        $trabajador->actividad = $request->input('actividad');
        $trabajador->correo = $request->input('correo');
        $trabajador->password = $request->input('password');
        $trabajador->conexion = 0;
        //$trabajador->categoria = $request->input('categoria');
        $trabajador->descripcion = $request->input('descripcion');
        $trabajador->experiencia = $request->input('experiencia');
        $trabajador->lat = $request->input('lat');
        $trabajador->lng = $request->input('lng');
        $trabajador->estatus = 0;
        $trabajador->calificacion = 5;
        $trabajador->meses_pagados = 1;

        
        $file = $request->file('profile');
        $name = time().$file->getClientOriginalName();
        //$file->move(public_path().'/images/trabajadores/', $name);
        $file->move('images/trabajadores/', $name);
        $trabajador->img_profile = $name;
        //}

        $trabajador->save();
        $worker = Trabajador::all();


        return redirect()->route('trabajadores.index')->with('status','Se ha creado correctamente al Trabajador');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=Crypt::decrypt($id);
        $trabajador = Trabajador::where('id','=',$id)->firstOrFail();
        $categorias = categoria::all();
        //$trabajador = Trabajador::find($id);

        return view('trabajadores.show', compact('trabajador','categorias'));    
    }

    public function show_documents($id){

        $id=Crypt::decrypt($id);
        $trabajador = Trabajador::where('id','=',$id)->firstOrFail();

        return view('trabajadores.documents', compact('trabajador'));
    }

    public function saveDocuments(Request $request){

        //Storage::makeDirectory(public_path().'/images/documentos/'.$request->input('id'));
        //Storage::makeDirectory('images/documentos/'.$request->input('id'));

        foreach($request->file('documents') as $documentos){
        $documento = new documento();
        $file = $documentos;
        $name = time().$documentos->getClientOriginalName();
        //$file->move(public_path().'/images/documentos/', $name);
        $file->move('images/documentos/'.$request->input('id'), $name);

        $documento->id_trabajador = $request->input('id');
        $documento->img_profile = $name;
        $documento->save();
        }

        return redirect()->route('trabajadores.index')->with('status','Los documentos se han agregado correctamente al Trabajador');
    }

    public function validateDocuments($id){
                $id=Crypt::decrypt($id);
                $documentos = documento::all();
                $trabajador = Trabajador::where('id','=',$id)->firstOrFail();





        return view('trabajadores.validate', compact('documentos','trabajador'));

    }


    public function saveValidateDocuments(Request $request){

        $trabajador = Trabajador::where('id','=',$request->id)->firstOrFail();

        $trabajador->fill($request->except('profile'));

        $trabajador->estatus = $request->input('estatus');

         $trabajador->save();

        $worker = Trabajador::all();

        return redirect()->route('trabajadores.index')->with('status','Se ha actualizado correctamente el Estatus del Trabajador');

        //return ($request);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=Crypt::decrypt($id);
        $trabajador = Trabajador::where('id','=',$id)->firstOrFail();
        $categorias = categoria::all(); 
        
        return view('trabajadores.edit', compact('trabajador','categorias'));    
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
        $trabajador = Trabajador::where('id','=',$id)->firstOrFail();

        $trabajador->fill($request->except('profile'));

        $trabajador->nombre = $request->input('nombre');
        $trabajador->telefono = $request->input('telefono');
        $trabajador->password = $request->input('password');
        //$trabajador->categoria = $request->input('categoria');
        $trabajador->descripcion = $request->input('descripcion');
        $trabajador->experiencia = $request->input('experiencia');
        $trabajador->lat = $request->input('lat');
        $trabajador->lng = $request->input('lng');

        if($request->hasFile('profile')){
        //$aux = public_path().'/images/trabajadores/'.$trabajador->img_profile;
        $aux ='images/trabajadores/'.$trabajador->img_profile;
         \File::delete($aux);

         $file = $request->file('profile');
        $name = time().$file->getClientOriginalName();
        //$file->move(public_path().'/images/trabajadores/', $name);
        $file->move('images/trabajadores/', $name);
        $trabajador->img_profile = $name;
        }

        $trabajador->save();

        $worker = Trabajador::all();

        return redirect()->route('trabajadores.index')->with('status','Se ha actualizado correctamente al Trabajador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $trabajador = Trabajador::where('id','=',$id)->firstOrFail();

         $file_path = '/images/trabajadores/'.$trabajador->avatar;
         \File::delete($file_path);
        $trabajador->delete();

        $worker = Trabajador::all();
        return redirect()->route('trabajadores.index')->with('status','Se ha eliminado correctamente al Trabajador');
    }
}
