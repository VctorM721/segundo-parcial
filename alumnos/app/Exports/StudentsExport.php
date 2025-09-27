<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class StudentsExport implements FromCollection, WithHeadings
{
    public function __construct(private array $filters = []){}

    public function collection(){
        $r = new Request($this->filters);
        return Student::with('facultad')
            ->when($r->filled('tipo'), fn($x)=>$x->where('tipo',$r->tipo))
            ->when($r->filled('facultad_id'), fn($x)=>$x->where('facultad_id',$r->facultad_id))
            ->get()
            ->map(function($s){
                return [
                    'Carne'     => $s->carne,
                    'Nombres'   => $s->nombres,
                    'Apellidos' => $s->apellidos,
                    'Tipo'      => $s->tipo,
                    'Facultad'  => $s->facultad?->nombre,
                    'Email'     => $s->email1,
                    'Teléfono'  => $s->tel1,
                ];
            });
    }

    public function headings(): array {
        return ['Carné','Nombres','Apellidos','Tipo','Facultad','Email','Teléfono'];
    }
}