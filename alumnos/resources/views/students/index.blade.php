<x-layout>
  <h3>Estudiantes</h3>

  <form method="get">
    <div class="grid">
      <label>Buscar (carné, nombre, DPI)
        <input name="buscar" value="{{ request('buscar') }}">
      </label>
      <label>Tipo
        <select name="tipo">
          <option value="">Todos</option>
          @foreach(['nuevo','traslado','equivalencia','reingreso'] as $t)
            <option value="{{ $t }}" @selected(request('tipo')===$t)>{{ ucfirst($t) }}</option>
          @endforeach
        </select>
      </label>
      <label>Facultad
        <select name="facultad_id">
          <option value="">Todas</option>
          @foreach($facultades as $f)
            <option value="{{ $f->id }}" @selected(request('facultad_id')==$f->id)>{{ $f->nombre }}</option>
          @endforeach
        </select>
      </label>
    </div>
    <button>Filtrar</button>
    <a class="secondary" href="{{ route('students.export.xlsx', request()->query()) }}">Exportar Excel</a>
    <a class="secondary" href="{{ route('students.export.pdf',  request()->query()) }}">Reporte PDF</a>
  </form>

  <table>
    <thead>
      <tr>
        <th>Carné</th><th>Nombre</th><th>Tipo</th><th>Facultad</th><th>Email</th><th>DPI</th>
      </tr>
    </thead>
    <tbody>
      @foreach($q as $s)
        <tr>
          <td>{{ $s->carne }}</td>
          <td>{{ $s->apellidos }}, {{ $s->nombres }}</td>
          <td>{{ ucfirst($s->tipo) }}</td>
          <td>{{ $s->facultad?->nombre }}</td>
          <td>{{ $s->email1 }}</td>
          <td>
            @if($s->dpi_path)
              <a href="{{ asset('storage/'.$s->dpi_path) }}" target="_blank">Ver</a>
            @else —
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $q->links() }}
</x-layout>