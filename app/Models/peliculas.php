<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peliculas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_pelicula','id_categoria','id_autor','nombre','fecha_lanzamiento','productora'];
}
