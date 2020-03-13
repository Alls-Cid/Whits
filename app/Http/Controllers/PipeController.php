<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trabajador;
use App\Usuario;
use App\categoria;
use App\trabajo;
use App\Ride;
use App\Promocione;

class PipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return ($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$datos = Trabajador::where('categoria','=',$id)->get()->toJson();

        //$datos = Trabajador::select('id as key', 'nombre as name', 'img_profile as image')->where('categoria','=',$id)->get()->toJson();


        //return Response::json($data);
        //return ($datos);
    }

    public function obtenerCategoriaOficio(){
        $datos = Categoria::select('id as key', 'nombre as name', 'img_profile as image')->where('categoria','=',1)->where('estatus','=',1)->get()->toJson();


        return ($datos);
    }

   public function obtenerCategoriaProfesion(){
        $datos = Categoria::select('id as key', 'nombre as name', 'img_profile as image')->where('categoria','=',2)->where('estatus','=',1)->get()->toJson();


        return ($datos);
    }

    public function obtenerTrabajadoresDistancia($lat1,$lon1,$radio,$id){

        $trabajador = trabajador::where([
            ['actividad', '=' ,$id],
            ['conexion', '=', 1],
            ['estatus', '=', 1],
        ])->get();
        $arreglo = array();

        foreach ($trabajador as $trab) {
        $theta = $lon1 - $trab->lng;

        $dist = sin(deg2rad($lat1)) * sin(deg2rad($trab->lat)) +  cos(deg2rad($lat1)) * cos(deg2rad($trab->lat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $t_dist = $dist * 60 * 1.1515* 1.609344;
        $job='';
        $job = Categoria::select('nombre')->where('id', '=', $trab->actividad)->firstOrFail();

        //$rides = ride::select('id_usuario as id','calificacion','comentario')->where('id_trabajador','=',$id)->toArray();
        

        if($t_dist < $radio){


            array_push($arreglo,array('key'=> $trab->id,'name'=> $trab->nombre,'image'=> 'http://cabalapp.com.mx/images/trabajadores/'.$trab->img_profile,'email' => $trab->correo,'jobkey' => ((integer)$trab->actividad), 'job' => $job->nombre, 'rate'=>$trab->calificacion, 'distance'=>number_format((float)$t_dist, 2, '.', '').' km','data'=>array('exp'=>$trab->experiencia, 'worki'=>0, 'works'=>array('0'=>'','1'=>''), 'workr'=>array('0'=>'', '1'=>''), 'work'=>array('c0'=>array('image'=>'', 'text'=>'')),'lat' => ((double)$trab->lat),'long' => ((double)$trab->lng), 'phone'=>$trab->telefono, 'text'=>$trab->descripcion)));
        }
        }
    
        return response()->json($arreglo);
        
    }
    
    public function obtenerTrabajadores($lat1,$lon1,$id){

        $trabajador = trabajador::where([
            ['actividad', '=' ,$id],
            ['conexion', '=', 1],
            ['estatus', '=', 1],
        ])->get();
        $arreglo = array();

        foreach ($trabajador as $trab) {
        $theta = $lon1 - $trab->lng;

        $dist = sin(deg2rad($lat1)) * sin(deg2rad($trab->lat)) +  cos(deg2rad($lat1)) * cos(deg2rad($trab->lat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $t_dist = $dist * 60 * 1.1515* 1.609344;
        $job='';
        $job = Categoria::select('nombre')->where('id', '=', $trab->actividad)->firstOrFail();
        $works = trabajo::where('id', '=', $id)->get();
        $w=array();
        $ws=array();
        $wr=array();
        $c=0;
        foreach ($works as $work) {
            $cc='c'.$c;
            array_push($ws, $work->img_url);
            array_push($wr, $work->descripcion);
            array_push($w, array($cc=>array('image'=> $work->img_url, 'text'=>$work->descripcion)));
            $c++;
        }
        if($c==0){
            array_push($ws, '');
            array_push($wr, '');
            array_push($w, array('c0'=>array('image'=> '', 'text'=>'')));
            $c++;
            $cc='c'.$c;
            array_push($ws, '');
            array_push($wr, '');
            array_push($w, array($cc=>array('image'=> '', 'text'=>'')));
            $c++;
            $cc='c'.$c;
            array_push($ws, '');
            array_push($wr, '');
            array_push($w, array($cc=>array('image'=> '', 'text'=>'')));
            $c++;
        }
        $count = trabajo::where('id_trabajador','=',$id)->count();
        
        
        array_push($arreglo,array('key'=> $trab->id,'name'=> $trab->nombre,'image'=> 'http://cabalapp.com.mx/images/trabajadores/'.$trab->img_profile,'email' => $trab->correo,'jobkey' => ((integer)$trab->actividad), 'job' => $job->nombre, 'rate'=>$trab->calificacion, 'distance'=>number_format((float)$t_dist, 2, '.', '').' km','data'=>array('exp'=>$trab->experiencia, 'worki'=>$count, 'works'=>$ws, 'workr'=>$wr, 'work'=>$w,'lat' => ((double)$trab->lat),'long' => ((double)$trab->lng), 'phone'=>$trab->telefono, 'text'=>$trab->descripcion)));
        }
    
        return response()->json($arreglo);
        //return ();
    }

    public function obtenerHistorialTrabajador($id,$year,$month){
        //$datetime = new \DateTime();
        //$datetime->setDate($year, $month+1,'01');
        //$datetime->format('Y/m');

        $trab_r = ride::where('id_trabajador','=',$id)->whereYear('created_at','=',$year)->whereMonth('created_at','=',$month)->get();
        //$trab_r = ride::where('id_usuario','=',$id)->where('created_at','<=',$datetime)->get();
        //$user = usuario::where('id','=',$id)->firstOrFail();

        $array = array();

        foreach($trab_r as $ride){
            $user = usuario::where('id','=',$ride->id_usuario)->firstOrFail();
            $m='';
            switch($ride->created_at->format('m')){
                case 1: 
                    $m='ENE';
                    break;
                case 2: 
                    $m='FEB';
                    break;
                case 3: 
                    $m='MAR';
                    break;
                case 4: 
                    $m='ABR';
                    break;
                case 5: 
                    $m='MAY';
                    break;
                case 6: 
                    $m='JUN';
                    break;
                case 7: 
                    $m='JUL';
                    break;
                case 8: 
                    $m='AGO';
                    break;
                case 9: 
                    $m='SEP';
                    break;
                case 10: 
                    $m='OCT';
                    break;
                case 11: 
                    $m='NOV';
                    break;
                case 12: 
                    $m='DIC';
                    break;
            }
            $m=$ride->created_at->format('d ').$m.$ride->created_at->format(' H:i');
            array_push($array, array('key'=>$ride->id,'date'=>$m,'id_usuario'=>$user->id,'nombre'=>$user->nombre,'img_profile'=>$user->img_profile,'calificacion'=>$ride->calificacion_usuario));
        }


        return response()->json($array);
    }

    public function obtenerHistorialUsuario($id,$year,$month){
        //$datetime = new \DateTime();
        //$datetime->setDate($year, $month);
        //$datetime->format('Y/m');

        $trab_r = ride::where('id_usuario','=',$id)->whereYear('created_at','=',$year)->whereMonth('created_at','=',$month)->get();
        //$trab = trabajador::where('id','=',$id)->firstOrFail();

        $array = array();

        foreach($trab_r as $ride){
            $trab = trabajador::where('id','=',$ride->id_trabajador)->firstOrFail();
            $m='';
            switch($ride->created_at->format('m')){
                case 1: 
                    $m='ENE';
                    break;
                case 2: 
                    $m='FEB';
                    break;
                case 3: 
                    $m='MAR';
                    break;
                case 4: 
                    $m='ABR';
                    break;
                case 5: 
                    $m='MAY';
                    break;
                case 6: 
                    $m='JUN';
                    break;
                case 7: 
                    $m='JUL';
                    break;
                case 8: 
                    $m='AGO';
                    break;
                case 9: 
                    $m='SEP';
                    break;
                case 10: 
                    $m='OCT';
                    break;
                case 11: 
                    $m='NOV';
                    break;
                case 12: 
                    $m='DIC';
                    break;
            }
            $m=$ride->created_at->format('d ').$m.$ride->created_at->format(' H:i');
            array_push($array, array('key'=>$ride->id,'date'=>$m,'id_trabajador'=>$trab->id,'nombre'=>$trab->nombre,'img_profile'=>$trab->img_profile,'calificacion'=>$ride->calificacion_trab,'comentario'=>$ride->comentario));
        }


        return response()->json($array);
    }

    public function obtenerComentariosTrabajador($id){

        $ride = ride::where('id_trabajador','=', $id)->get();
        $array = array();
            foreach($ride as $r){
                $user = usuario::where('id','=',$r->id_usuario)->firstOrFail();
                $m='';
            switch($ride->created_at->format('m')){
                case 1: 
                    $m='ENE';
                    break;
                case 2: 
                    $m='FEB';
                    break;
                case 3: 
                    $m='MAR';
                    break;
                case 4: 
                    $m='ABR';
                    break;
                case 5: 
                    $m='MAY';
                    break;
                case 6: 
                    $m='JUN';
                    break;
                case 7: 
                    $m='JUL';
                    break;
                case 8: 
                    $m='AGO';
                    break;
                case 9: 
                    $m='SEP';
                    break;
                case 10: 
                    $m='OCT';
                    break;
                case 11: 
                    $m='NOV';
                    break;
                case 12: 
                    $m='DIC';
                    break;
            }
            $m=$ride->created_at->format('d ').$m.$ride->created_at->format(' Y');
                if($r->calificacion_trab > 0){
                    if(strlen($r->comentario) > 5){
                        array_push($array,array('nombre'=>$user->nombre,'calificacion'=>$r->calificacion_trab,'comentario'=>$r->comentario,'date'=>$m));
                    }

                }

            }

        return response()->json($array);

    }

    public function obtenerPromociones(){
        $now = new \DateTime('NOW');
        $promocions = Promocione::where('estatus','=',1)->get();
        $array = array();
        foreach($promocions as $promocion){
            array_push($array, (array('key'=>$promocion->id, 'name'=>$promocion->nombre_empresa, 'info'=>$promocion->nombre_promocion,'data'=>$promocion->descripcion,'location'=>$promocion->ubicacion,'vigencia'=>$promocion->vigencia,'image'=>$promocion->promocion,'logo'=>$promocion->logo_empresa,'estatus'=>$promocion->estatus)));
        }
        return response()->json($array);

        /*

        return response()->json(array('key'=>$promocion->id, 'nombre_empresa'=>$promocion->nombre_empresa, 'nombre_promocion'=>$promocion->nombre_promocion,'descripcion'=>$promocion->descripcion,'ubicacion'=>$promocion->ubicacion,'vigencia'=>$promocion->vigencia,'logo_empresa'=>$promocion->logo_empresa,'estatus'=>$promocion->estatus));/**/

    }

    public function inserta($nombre,$registro,$correo,$password=NULL,$telefono=NULL,$borndate=NULL){

        $usuario = new Usuario();

        $usuario->nombre = $nombre;
        $usuario->pasword = $password;
        $usuario->correo = $correo;
        $usuario->metodo_registro = $registro;
        $usuario->telefono = $telefono;
        $usuario->borndate = $borndate;
        $usuario->calificacion = 5;
        $usuario->estatus = 1;
            ;

        $usuario->save();

        return('Si lees esto se creo el usuario correctamente (TumbUp)');

    }

    public function registrarUsuario($nombre,$registro,$correo,$password=NULL,$telefono=NULL,$borndate=NULL){

        $date = new \DateTime($borndate);
        $hoy = new \DateTime();
        $annos = $hoy->diff($date);
        
        $usuario = usuario::where('correo','=',$correo)->first();


        if($usuario){

            return response()->json(array('success' => false));

        }
        if($annos->y < 18){
            $usuario = new Usuario();

        $usuario->nombre = $nombre;
        $usuario->pasword = $password;
        $usuario->correo = $correo;
        $usuario->metodo_registro = $registro;
        $usuario->telefono = $telefono;
        $usuario->borndate = $borndate;
        $usuario->calificacion = 5;
        $usuario->estatus = 0;
            

        $usuario->save();

        return response()->json(array('success' => true, 'id' => $usuario->id, 'nombre' => $usuario->nombre, 'correo' => $usuario->correo, 'registro' => $usuario->metodo_registro, 'telefono' => $usuario->telefono, 'borndate' => $usuario->borndate, 'calificacion' => $usuario->calificacion, 'estatus' => $usuario->estatus));
        }
        else{
        $usuario = new Usuario();

        $usuario->nombre = $nombre;
        $usuario->pasword = $password;
        $usuario->correo = $correo;
        $usuario->metodo_registro = $registro;
        $usuario->telefono = $telefono;
        $usuario->borndate = $borndate;
        $usuario->calificacion = 5;
        $usuario->estatus = 1;
            

        $usuario->save();

        return response()->json(array('success' => true, 'id' => $usuario->id, 'nombre' => $usuario->nombre, 'correo' => $usuario->correo, 'registro' => $usuario->metodo_registro, 'telefono' => $usuario->telefono, 'borndate' => $usuario->borndate, 'calificacion' => $usuario->calificacion, 'estatus' => $usuario->estatus));
    }

    }

    public function verificarUsuario($registro,$correo,$password=NULL){

        $usuario = usuario::where('correo','=',$correo)->first();

        if($usuario){
            return response()->json(array('success' => true, 'id' => $usuario->id, 'nombre' => $usuario->nombre, 'correo' => $usuario->correo, 'registro' => $usuario->metodo_registro, 'telefono' => $usuario->telefono, 'borndate' => $usuario->borndate, 'calificacion' => $usuario->calificacion, 'estatus' => $usuario->estatus));
        }   else {
            return response()->json(array('success'=>false));
        }

        //
    }
    
    public function verificarTrabajador($correo,$password=NULL){

        $trabajador = trabajador::where([
            ['correo', '=', $correo],
            ['password', '=', $password],
        ])->first();

        if($trabajador){
            
            $job='';
            $job = Categoria::select('nombre')->where('id', '=', $trabajador ->actividad)->firstOrFail();
            return response()->json(array('success' => true, 'id' => $trabajador->id, 'nombre' => $trabajador->nombre, 'correo' => $trabajador->correo, 'telefono' => $trabajador->telefono, 'calificacion' => $trabajador->calificacion, 'estatus' => $trabajador->estatus, 'conexion' => $trabajador->conexion, 'job' => $job->nombre, 'jobkey'=> $trabajador->actividad, 'image' => 'http://cabalapp.com.mx/images/trabajadores/'.$trabajador->img_profile));
        }   else {
            return response()->json(array('success'=>false));
        }

        //
    }
    
    public function actualizarConexion($id, $correo, $conexion){
        $trabajador = trabajador::where([
            ['correo', '=', $correo],
            ['id', '=', $id],
        ])->update(['conexion' => $conexion]);
        
        $trabajador = trabajador::where([
            ['correo', '=', $correo],
            ['id', '=', $id],
        ])->first();
        if($trabajador){
            return response()->json(array('success'=>true, 'conexion'=>$trabajador->conexion));
        }else{
            return response()->json(array('success'=>false));
        }
    }

    public function generarTrabajo($id, $posicion,$ruta, $texto){
        $count = trabajo::where('id_trabajador','=',$id)->count();

        if($count < 5){
        $enlace='https://firebasestorage.googleapis.com/v0/b/cabal-a7f47.appspot.com/o/'.$ruta;
        $trabajo= new trabajo();

        $trabajo->id_trabajador = $id;
        $trabajo->posicion = $posicion;
        $trabajo->img_url = $enlace;
        $trabajo->descripcion = $texto;

        $trabajo->save();

        return response()->json(array('success'=>true, 'key'=>$trabajo->id_trabajador, 'worki'=>$count));
        } else{
            return response()->json(array('success'=>false));

        }
    }

    public function actualizarTrabajo($id_trabajador, $posicion, $img_url, $descripcion){
        $trabajo = trabajo::where([
            ['id_trabajador', '=', $id_trabajador],
            ['posicion', '=', $posicion],
        ])->update([
            ['img_url'=>$img_url],
            ['descripcion'=>$descripcion]
        ]);

        

        return response()->json(array('success'=>true));

    }

    public function contratarServicio($id_usuario, $id_trabajador, $lat_serv, $lng_serv, $lat_trab, $lng_trab){

        $ride = new ride();

        $ride->id_usuario = $id_usuario;
        $ride->id_trabajador = $id_trabajador;
        $ride->lng_serv = $lng_serv;
        $ride->lat_serv = $lat_serv;
        $ride->lng_trab = $lng_trab;
        $ride->lat_trab = $lat_trab;
        $ride->estatus = 1;

        $ride->save();

        return response()->json(array('success' => true, 'key'=> $ride->id));


    }

    public function actualizarDistancia($id, $lat_trab, $lng_trab){

        $ride = ride::where('id','=',$id)->update([
            ['lat_trab'=>$lat_trab],
            ['lng_trab'=>$lng_trab]
        ]);


        return response()->json(array('success'=>true));
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
