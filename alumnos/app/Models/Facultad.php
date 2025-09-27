<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';
    protected $fillable = ['nombre'];
  public function students(){ return $this->hasMany(Student::class); }
}
