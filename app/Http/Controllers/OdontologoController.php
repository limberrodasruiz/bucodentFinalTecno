<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Odontologo;

class OdontologoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar=='') {
            $odontologo = Odontologo::orderBy('id', 'desc')->paginate(5);
        }
        else{
            $odontologo = Odontologo::where($criterio, 'like','%'.$buscar .'%')->orderBy('id','desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $odontologo->total(),
                'current_page' => $odontologo->currentPage(),
                'per_page'     => $odontologo->perPage(),
                'last_page'    => $odontologo->lastPage(),
                'from'         => $odontologo->firstItem(),
                'to'           => $odontologo->lastItem(),
            ],
            'odontologo' => $odontologo
        ];
    }

 

    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $odontologo = new Odontologo();
        $odontologo->nombre = $request->nombre;
        $odontologo->apellido = $request->apellido;
        $odontologo->ci = $request->ci;
        $odontologo->fechanacimiento = $request->fechanacimiento;
        $odontologo->direccion = $request->direccion;
        $odontologo->telefono = $request->telefono;
        $odontologo->email = $request->email;
        $odontologo->especialidad = $request->especialidad;
        $odontologo->ruc = $request->ruc;
        $odontologo->save();
        
    }

 
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $odontologo = Odontologo::findOrFail($request->id);
        $odontologo->nombre = $request->nombre;
        $odontologo->apellido = $request->apellido;
        $odontologo->ci = $request->ci;
        $odontologo->fechanacimiento = $request->fechanacimiento;
        $odontologo->direccion = $request->direccion;
        $odontologo->telefono = $request->telefono;
        $odontologo->email = $request->email;
        $odontologo->especialidad = $request->especialidad;
        $odontologo->ruc = $request->ruc;
        $odontologo->save();
    }
}
