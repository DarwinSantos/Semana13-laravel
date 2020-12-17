<?php
//Darwin Santos
namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable=['nombres','apellidos','correo','telefono','Foto', 'Nombre_foto'];
}
