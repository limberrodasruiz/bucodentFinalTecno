<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Servicio;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar=='') {
            $servicios = Servicio::orderBy('id', 'desc')->paginate(5);
        }
        else{
            $servicios = Servicio::where($criterio, 'like','%'.$buscar .'%')->orderBy('id','desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $servicios->total(),
                'current_page' => $servicios->currentPage(),
                'per_page'     => $servicios->perPage(),
                'last_page'    => $servicios->lastPage(),
                'from'         => $servicios->firstItem(),
                'to'           => $servicios->lastItem(),
            ],
            'servicios' => $servicios
        ];
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = new Servicio();
        $servicio->nombre = $request->nombre;
        $servicio->descripcion = $request->descripcion;
        $servicio->precio = $request->precio;
        $servicio->condicion ='1';
        $servicio->save();
        
        
        
    }

    

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($request->id);
        $servicio->nombre = $request->nombre;
        $servicio->descripcion = $request->descripcion;
        $servicio->precio = $request->precio;
        $servicio->condicion ='1';
        $servicio->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($request->id);
        $servicio->condicion ='0';
        $servicio->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicio = Servicio::findOrFail($request->id);
        $servicio->condicion ='1';
        $servicio->save();
    }
}
