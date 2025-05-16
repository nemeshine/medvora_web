<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Alarm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('sidebar.sidebar')

<div class="container mt-5">
  <h4 class="mb-4">Tambah Alarm</h4>

  <form action="{{ route('alarm.store') }}" method="POST">
    @csrf

    <div class="mb-3">
  <label>Pasien</label>
  <input type="text" class="form-control" value="{{ $pasien->nama_pasien }}" disabled>
  <input type="hidden" name="id_pasien" value="{{ $pasien->id_pasien }}">
</div>


    <div class="mb-3">
      <label>Obat</label>
      <select name="id_obat" class="form-select" required>
        <option value="">-- Pilih Obat --</option>
        @foreach($obat as $o)
        <option value="{{ $o->id_obat }}">{{ $o->nama_obat }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Takaran</label>
      <input type="text" name="takaran" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Waktu Minum</label>
      <input type="time" name="waktu_minum" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Tanggal Mulai</label>
      <input type="date" name="tanggal_mulai" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Tanggal Selesai</label>
      <input type="date" name="tanggal_selesai" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Instruksi</label>
      <select name="instruksi" class="form-select" required>
        <option value="sebelum">Sebelum Makan</option>
        <option value="sesudah">Sesudah Makan</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Total Obat</label>
      <input type="number" name="total_obat" class="form-control" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
</body>
</html>
