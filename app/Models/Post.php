<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /* especifica que la tabla que yo quiero en la base de datos sin seguir ewl esquema de nombres del framework*/
    protected $table='alumnos';
}
