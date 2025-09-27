<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
    'carne','nombres','apellidos','dpi','nit','email1','email2',
    'tel1','tel2','tipo','facultad_id','dpi_path'
  ];
  public function facultad(){ return $this->belongsTo(Facultad::class); }
}
