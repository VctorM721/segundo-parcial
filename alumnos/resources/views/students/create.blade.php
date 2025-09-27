<x-layout>
  <h3>Registrar estudiante</h3>
  <form method="post" enctype="multipart/form-data" action="{{ route('students.store') }}">
    @csrf
    <div class="grid">
      <label>Carné
        <input name="carne" required value="{{ old('carne') }}">
      </label>
      <label>Tipo
        <select name="tipo" required>
          @foreach(['nuevo','traslado','equivalencia','reingreso'] as $t)
            <option value="{{ $t }}" @selected(old('tipo')===$t)>{{ ucfirst($t) }}</option>
          @endforeach
        </select>
      </label>
    </div>

    <div class="grid">
      <label>Nombres <input name="nombres" required value="{{ old('nombres') }}"></label>
      <label>Apellidos <input name="apellidos" required value="{{ old('apellidos') }}"></label>
    </div>

    <div class="grid">
      <label>DPI <input name="dpi" value="{{ old('dpi') }}"></label>
      <label>NIT <input name="nit" value="{{ old('nit') }}"></label>
    </div>

    <div class="grid">
      <label>Email personal <input type="email" name="email1" required value="{{ old('email1') }}"></label>
      <label>Otro email <input type="email" name="email2" value="{{ old('email2') }}"></label>
    </div>

    <div class="grid">
      <label>Teléfono móvil <input name="tel1" value="{{ old('tel1') }}"></label>
      <label>Otro teléfono <input name="tel2" value="{{ old('tel2') }}"></label>
    </div>

    <div class="grid">
      <label>Facultad
        <select name="facultad_id" required>
          <option value="">Seleccione…</option>
          @foreach($facultades as $f)
            <option value="{{ $f->id }}" @selected(old('facultad_id')==$f->id)>{{ $f->nombre }}</option>
          @endforeach
        </select>
      </label>
      <label>Adjuntar DPI (PDF/JPG, máx. 2 MB)
        <input type="file" name="dpi_file" accept=".pdf,.jpg,.jpeg,.png">
      </label>
    </div>

    @if ($errors->any())
      <article class="contrast">
        <ul style="margin:0">
          @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </article>
    @endif

    <button type="submit">Enviar solicitud</button>
  </form>
</x-layout>