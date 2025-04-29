<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Alarm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif; margin-left: 80px; }
    .card { border: none; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .btn-detail { background: #5F4DFF; color: #fff; }
    .btn-detail:hover { background: #4e3fd1; }
    table th { background: #f1f1f1; }
  </style>
</head>
<body>
  {{-- sidebar --}}
  @include('sidebar.sidebar')

  <div class="container-fluid mt-5">
    <div class="card p-4">
      <h4 class="mb-4">Manajemen Alarm</h4>

      <div class="row mb-3">
        <div class="col-md-6 d-flex align-items-center">
          <label class="me-2">Show</label>
          <select class="form-select form-select-sm" style="width:auto;">
            <option>10</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
          </select>
          <span class="ms-2">entries</span>
        </div>
        <div class="col-md-6 text-end">
          <div class="input-group" style="width:250px; display:inline-block;">
            <input type="text" class="form-control" placeholder="Cari...">
            <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle text-center mb-0">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama Pengguna</th>
              <th>Total Alarm</th>
              <th>Total Obat</th>
              <th>Alarm Aktif</th>
              <th>Alarm Selesai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            {{-- loop data di controller --}}
            <tr>
              <td>1</td>
              <td>123465314266829037</td>
              <td>Sabililah Zayn</td>
              <td>20</td>
              <td>10</td>
              <td>2</td>
              <td>8</td>
              <td>
              <a href="{{ route('alarm.detail', 1) }}" class="btn btn-detail btn-sm">Lihat Detail</a>
              </td>
            </tr>
            {{-- ulangi baris di atas untuk setiap pengguna --}}
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-end mt-3">
        {{-- pagination --}}
        <nav>
          <ul class="pagination mb-0">
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
