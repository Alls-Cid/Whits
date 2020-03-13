<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promocione;

class PromocionesController extends Controller
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
        $promo = Promocione::all();

        return view('promociones.index', compact('promo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promociones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promociones = new Promocione();
        $promociones->nombre_empresa = $request->input('nombre_empresa');
        $promociones->nombre_promocion = $request->input('nombre_promocion');
        $promociones->descripcion = $request->input('descripcion');
        $promociones->ubicacion = $request->input('ubicacion');
        $promociones->vigencia = $request->input('vigencia');

        $promociones->estatus = 1;

        
        $file = $request->file('logo_empresa');
        $name = time().$file->getClientOriginalName();
        //$file->move(public_path().'/images/promociones/', $name);
        $file->move('images/pronociones/', $name);
        $promociones->logo_empresa = $name;
        //}

         $file1 = $request->file('promocion');
        $name1 = time().$file1->getClientOriginalName();
        //$file1->move(public_path().'/images/promociones/', $name1);
        $file1->move('images/pronociones/', $name);
        $promociones->promocion = $name1;
        //}

        $promociones->save();
        $promo = Promocione::all();

        return redirect()->route('promociones.index')->with('status','Se ha creado correctamente la Promoción');
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
