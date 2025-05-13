<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Alarm Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { margin-left: 80px; background-color: #f0f2f5;}
    .card-alarm { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
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
      <div class="card-alarm p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">{{ $alarm->obat->nama_obat }}</h5>
          <span class="badge px-3 py-2 
  {{ $alarm->status === 'aktif' ? 'bg-info' : 
     ($alarm->status === 'terlewat' ? 'bg-danger' : 'bg-success') }}">
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
    @endforeach
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
