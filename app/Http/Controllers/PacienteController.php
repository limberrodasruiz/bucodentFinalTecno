<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar=='') {
            $paciente = Paciente::orderBy('id', 'desc')->paginate(5);
        }
        else{
            $paciente = Paciente::where($criterio, 'like','%'.$buscar .'%')->orderBy('id','desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $paciente->total(),
                'current_page' => $paciente->currentPage(),
                'per_page'     => $paciente->perPage(),
                'last_page'    => $paciente->lastPage(),
                'from'         => $paciente->firstItem(),
                'to'           => $paciente->lastItem(),
            ],
            'paciente' => $paciente
        ];
    }

 

    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $paciente = new Paciente();
        $paciente->nombre = $request->nombre;
        $paciente->apellido = $request->apellido;
        $paciente->ci = $request->ci;
        $paciente->fechanacimiento = $request->fechanacimiento;
        $paciente->direccion = $request->direccion;
        $paciente->telefono = $request->telefono;
        $paciente->email = $request->email;
        $paciente->save();
        
    }

 
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $paciente = Paciente::findOrFail($request->id);
        $paciente->nombre = $request->nombre;
        $paciente->apellido = $request->apellido;
        $paciente->ci = $request->ci;
        $paciente->fechanacimiento = $request->fechanacimiento;
        $paciente->direccion = $request->direccion;
        $paciente->telefono = $request->telefono;
        $paciente->email = $request->email;
        $paciente->save();
    }

    
}
