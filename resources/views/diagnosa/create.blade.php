<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Diagnosa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f5f6fa;font-family:'Segoe UI',sans-serif;}
    .card-form{max-width:700px;margin:50px auto;padding:30px;background:#fff;border-radius:15px;
               box-shadow:0 2px 10px rgba(0,0,0,0.05);}
    .form-title{text-align:center;font-size:1.5rem;margin-bottom:20px;font-weight:500;}
    .btn-primary{background:#6C5CE7;border:none;}
    .btn-primary:hover{background:#5a4dd1;}
  </style>
</head>
<body>
  @include('sidebar.sidebar')

  <div class="container-fluid">
    <div class="card-form">
      <div class="form-title">Tambah Diagnosa Penyakit</div>
      <form method="POST" action="{{ route('diagnosa.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Nama Pasien</label>
          <select name="id_pasien" class="form-select @error('id_pasien') is-invalid @enderror">
            <option value="">-- Pilih Pasien --</option>
            @foreach($pasiens as $pasien)
              <option value="{{ $pasien->id_pasien }}"
                {{ old('id_pasien')==$pasien->id_pasien?'selected':'' }}>
                {{ $pasien->nama_pasien }}
              </option>
            @endforeach
          </select>
          @error('id_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Tanggal Keluhan</label>
            <input type="date" name="tanggal_keluhan"
                   class="form-control @error('tanggal_keluhan') is-invalid @enderror"
                   value="{{ old('tanggal_keluhan') }}">
            @error('tanggal_keluhan')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Tanggal Diagnosa</label>
            <input type="date" name="tanggal_diagnosa"
                   class="form-control @error('tanggal_diagnosa') is-invalid @enderror"
                   value="{{ old('tanggal_diagnosa') }}">
            @error('tanggal_diagnosa')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="mb-3 mt-3">
          <label class="form-label">Keluhan</label>
          <textarea name="keluhan" rows="3"
                    class="form-control @error('keluhan') is-invalid @enderror">{{ old('keluhan') }}</textarea>
          @error('keluhan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Diagnosa</label>
          <input type="text" name="diagnosa"
                 class="form-control @error('diagnosa') is-invalid @enderror"
                 value="{{ old('diagnosa') }}">
          @error('diagnosa')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Resep Obat</label>
          <textarea name="resep_obat" rows="2" class="form-control">{{ old('resep_obat') }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Catatan Tambahan</label>
          <textarea name="catatan_tambahan" rows="2" class="form-control">{{ old('catatan_tambahan') }}</textarea>
        </div>

        <div class="d-flex justify-content-end mt-4">
          <a href="{{ route('diagnosa.index') }}" class="btn btn-secondary me-2">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
