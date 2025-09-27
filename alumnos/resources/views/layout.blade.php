<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Estudiantes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" rel="stylesheet">
</head>
<body>
<main class="container">
  <nav>
    <ul><li><strong>Registro</strong></li></ul>
    <ul>
      <li><a href="{{ route('students.index') }}">Listado</a></li>
      <li><a href="{{ route('students.create') }}">Nuevo</a></li>
    </ul>
  </nav>
  @if(session('ok')) <article class="contrast">{{ session('ok') }}</article> @endif
  {{ $slot }}
</main>
</body>
</html>