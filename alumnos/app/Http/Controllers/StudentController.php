<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function index(Request $r)
    {
        $facultades = Facultad::orderBy('nombre')->get();

        $q = Student::with('facultad')
            ->when($r->filled('tipo'), fn($x) => $x->where('tipo', $r->tipo))
            ->when($r->filled('facultad_id'), fn($x) => $x->where('facultad_id', $r->facultad_id))
            ->when($r->filled('buscar'), function ($x) use ($r) {
                $b = '%'.$r->buscar.'%';
                $x->where(function ($w) use ($b) {
                    $w->where('carne','like',$b)
                      ->orWhere('nombres','like',$b)
                      ->orWhere('apellidos','like',$b)
                      ->orWhere('dpi','like',$b);
                });
            })
            ->latest()->paginate(10)->withQueryString();

        return view('students.index', compact('q','facultades'));
    }

    public function create()
    {
        $facultades = Facultad::orderBy('nombre')->get();
        return view('students.create', compact('facultades'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'carne'       => 'required|string|max:20|unique:students,carne',
            'nombres'     => 'required|string|max:120',
            'apellidos'   => 'required|string|max:120',
            'dpi'         => 'nullable|string|max:20',
            'nit'         => 'nullable|string|max:20',
            'email1'      => 'required|email',
            'email2'      => 'nullable|email',
            'tel1'        => 'nullable|string|max:20',
            'tel2'        => 'nullable|string|max:20',
            'tipo'        => 'required|in:nuevo,traslado,equivalencia,reingreso',
            'facultad_id' => 'required|exists:facultades,id',
            'dpi_file'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($r->hasFile('dpi_file')) {
            $data['dpi_path'] = $r->file('dpi_file')->store('dpi', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')->with('ok', 'Registro creado.');
    }

    public function exportExcel(Request $r)
    {
        return Excel::download(new StudentsExport($r->all()), 'estudiantes.xlsx');
    }

    public function exportPdf(Request $r)
    {
        $items = Student::with('facultad')
            ->when($r->filled('tipo'), fn($x) => $x->where('tipo',$r->tipo))
            ->when($r->filled('facultad_id'), fn($x) => $x->where('facultad_id',$r->facultad_id))
            ->orderBy('apellidos')->get();

        $pdf = Pdf::loadView('students.pdf', ['items' => $items]);
        return $pdf->download('estudiantes.pdf');
    }
}