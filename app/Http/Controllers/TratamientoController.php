<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tratamiento;

class TratamientoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar=='') {
            $tratamientos = Tratamiento::orderBy('id', 'desc')->paginate(5);
        }
        else{
            $tratamientos = Tratamieno::where($criterio, 'like','%'.$buscar .'%')->orderBy('id','desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $tratamientos->total(),
                'current_page' => $tratamientos->currentPage(),
                'per_page'     => $tratamientos->perPage(),
                'last_page'    => $tratamientos->lastPage(),
                'from'         => $tratamientos->firstItem(),
                'to'           => $tratamientos->lastItem(),
            ],
            'tratamientos' => $tratamientos
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
        $tratamiento = new Tratamiento();
        $tratamiento->nombre = $request->nombre;
        $tratamiento->color = $request->color;
        $tratamiento->precio = $request->precio;
        $tratamiento->condicion ='1';
        $tratamiento->save();
        
        
        
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
        $tratamiento = Tratamiento::findOrFail($request->id);
        $tratamiento->nombre = $request->nombre;
        $tratamiento->color = $request->color;
        $tratamiento->precio = $request->precio;
        $tratamiento->condicion ='1';
        $tratamiento->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tratamiento = Tratamiento::findOrFail($request->id);
        $tratamiento->condicion ='0';
        $tratamiento->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tratamiento = Tratamiento::findOrFail($request->id);
        $tratamiento->condicion ='1';
        $tratamiento->save();
    }
}
