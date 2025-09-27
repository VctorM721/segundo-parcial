<!doctype html><html lang="es"><head><meta charset="utf-8">
<style>
  body{ font-family: DejaVu Sans, sans-serif; font-size:12px }
  table{ width:100%; border-collapse: collapse }
  th,td{ border:1px solid #333; padding:6px }
  th{ background:#eee }
</style></head><body>
<h3>Reporte de Estudiantes</h3>
<table>
  <thead><tr>
    <th>Carné</th><th>Apellidos</th><th>Nombres</th><th>Tipo</th><th>Facultad</th><th>Email</th>
  </tr></thead>
  <tbody>
  @foreach($items as $s)
    <tr>
      <td>{{ $s->carne }}</td>
      <td>{{ $s->apellidos }}</td>
      <td>{{ $s->nombres }}</td>
      <td>{{ ucfirst($s->tipo) }}</td>
      <td>{{ $s->facultad?->nombre }}</td>
      <td>{{ $s->email1 }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</body></html>