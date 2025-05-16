<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Alarm Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { margin-left: 80px; background-color: #f0f2f5; }
    .card-alarm {
      border: none; border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      cursor: pointer;
    }
    .badge-status { background: #3dd2fc; color: #fff; }
    .btn-action { border-radius: 5px; }
  </style>
</head>
<body>
@include('sidebar.sidebar')

<div class="container-fluid mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Detail Alarm Pengguna</h4>
    <a href="{{ route('alarm.create', ['id_pasien' => $pasien->id_pasien]) }}" class="btn btn-primary">Tambah Alarm</a>
  </div>

  <div class="row g-4">
    @foreach($alarms as $alarm)
    <div class="col-md-4">
      <div class="card-alarm p-4 bg-white" data-bs-toggle="modal" data-bs-target="#editAlarmModal{{ $alarm->id_alarm }}">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">{{ $alarm->obat->nama_obat }}</h5>
          <span class="badge px-3 py-2 
            {{ $alarm->status === 'aktif' ? 'bg-info' : ($alarm->status === 'terlewat' ? 'bg-danger' : 'bg-success') }}">
            {{ ucfirst($alarm->status) }}
          </span>
        </div>
        <div class="mb-3">
          <button class="btn btn-outline-secondary btn-action me-2">{{ ucfirst($alarm->instruksi) }} Makan</button>
          <button class="btn btn-outline-secondary btn-action">{{ $alarm->takaran }}</button>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <div class="text-muted">
            <i class="fas fa-calendar-alt me-2"></i>
            {{ \Carbon\Carbon::parse($alarm->tanggal_mulai)->format('d-m-Y') }}
          </div>
          <h5 class="mb-0">{{ \Carbon\Carbon::parse($alarm->waktu_minum)->format('H:i') }}</h5>
        </div>
      </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editAlarmModal{{ $alarm->id_alarm }}" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('alarm.update', $alarm->id_alarm) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title">Edit Alarm</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label>Takaran</label>
                <input type="text" name="takaran" class="form-control" value="{{ $alarm->takaran }}">
              </div>
              <div class="mb-3">
                <label>Waktu Minum</label>
                <input type="time" name="waktu_minum" class="form-control" value="{{ $alarm->waktu_minum }}">
              </div>
              <div class="mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ $alarm->tanggal_mulai }}">
              </div>
              <div class="mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ $alarm->tanggal_selesai }}">
              </div>
              <div class="mb-3">
                <label>Instruksi</label>
                <select name="instruksi" class="form-select">
                  <option value="sebelum" {{ $alarm->instruksi == 'sebelum' ? 'selected' : '' }}>Sebelum Makan</option>
                  <option value="sesudah" {{ $alarm->instruksi == 'sesudah' ? 'selected' : '' }}>Sesudah Makan</option>
                </select>
              </div>
              <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                  <option value="aktif" {{ $alarm->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                  <option value="terlewat" {{ $alarm->status == 'terlewat' ? 'selected' : '' }}>Terlewat</option>
                  <option value="selesai" {{ $alarm->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
