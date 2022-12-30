<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillabe = ['nombre,apellido,ci,fechanacimiento,direccion,telefono,email'];
  
}
