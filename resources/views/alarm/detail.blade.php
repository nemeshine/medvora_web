<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Alarm Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif; margin-left: 80px; }
    .card-alarm { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 100%; }
    .badge-status { background: #3dd2fc; color: #fff; }
    .btn-action { border-radius: 5px; }
  </style>
</head>
<body>
  {{-- sidebar --}}
  @include('sidebar.sidebar')

  <div class="container-fluid mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4>Detail Alarm Pengguna</h4>
      <div>
        <select class="form-select d-inline-block" style="width:200px;">
          <option>All</option>
          <option>Aktif</option>
          <option>Selesai</option>
        </select>
        <a href="/alarm/create" class="btn btn-primary ms-3">Tambah Alarm+</a>
      </div>
    </div>

    <div class="row g-4">
      @for($i = 0; $i < 5; $i++)
      <div class="col-md-4">
        <div class="card-alarm p-4 bg-white">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Paracetamol</h5>
            <span class="badge badge-status px-3 py-2">Aktif</span>
          </div>
          <div class="mb-3">
            <button class="btn btn-outline-secondary btn-action me-2">Sesudah Makan</button>
            <button class="btn btn-outline-secondary btn-action">3 Kapsul</button>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
              <i class="fas fa-calendar-alt me-2"></i>
              08-02-2025
            </div>
            <h5 class="mb-0">19.00</h5>
          </div>
        </div>
      </div>
      @endfor
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
