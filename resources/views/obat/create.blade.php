<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Obat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background:#f5f6fa; font-family:'Segoe UI',sans-serif; }
    .card-form { background:#fff; border-radius:15px; padding:30px; box-shadow:0 2px 10px rgba(0,0,0,0.05); max-width:600px; margin:50px auto; }
    .form-title { text-align:center; font-size:1.5rem; margin-bottom:20px; font-weight:bold; }
    .btn-primary { background:#6C5CE7; border-color:#6C5CE7; }
    .btn-primary:hover { background:#5a4dd1; }
  </style>
</head>
<body>
@include('sidebar.sidebar')

  <div class="container-fluid">
    <div class="card-form">
      <div class="form-title">Tambah Obat</div>

      <form method="POST" action="{{ route('obat.store') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Nama Obat</label>
          <input name="nama_obat" type="text" class="form-control @error('nama_obat') is-invalid @enderror"
                 value="{{ old('nama_obat') }}">
          @error('nama_obat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Dosis</label>
          <input name="dosis" type="text" class="form-control @error('dosis') is-invalid @enderror"
                 value="{{ old('dosis') }}">
          @error('dosis') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Efek Samping</label>
          <input name="efek_samping" type="text" class="form-control"
                 value="{{ old('efek_samping') }}">
        </div>
        <div class="mb-3">
          <label class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
        </div>
        <div class="d-flex justify-content-end">
          <a href="{{ route('obat.index') }}" class="btn btn-secondary me-2">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
