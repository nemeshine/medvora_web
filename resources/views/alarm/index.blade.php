<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Alarm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f6fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      width: 1190px;
      margin: auto;
    }
    .btn-detail {
      background-color: #5F4DFF;
      color: white;
      border-radius: 10px;
      padding: 5px 15px;
    }
    .btn-detail:hover {
      background-color: #4e3fd1;
      color: white;
    }
    .table th {
      background-color: #f1f1f1;
    }
    .pagination .page-link {
      color: #5F4DFF;
    }
    .pagination .active .page-link {
      background-color: #5F4DFF;
      border-color: #5F4DFF;
      color: white;
    }
  </style>
</head>
<body>
  @include('sidebar.sidebar')

  <div class="container mt-5">
    <div class="card p-4">
      <h4 class="mb-4">Manajemen Alarm</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="row mb-3">
        <div class="col-md-6 d-flex align-items-center">
          <label class="me-2">Show</label>
          <form id="formEntries" action="{{ route('alarm.index') }}" method="GET">
            <select name="entries" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
              @foreach([10,25,50,100] as $opt)
                <option value="{{ $opt }}" {{ request('entries', 10) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
              @endforeach
            </select>
            <label class="ms-2">entries</label>
            <input type="hidden" name="search" value="{{ request('search') }}">
          </form>
        </div>

        <div class="col-md-6 text-end">
          <div class="d-flex flex-column align-items-end">
            <form class="mb-2" method="GET" action="{{ route('alarm.index') }}">
              <div class="input-group" style="width: 250px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
              </div>
              <input type="hidden" name="entries" value="{{ request('entries', 10) }}">
            </form>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
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
            @forelse($list as $i => $p)
            <tr>
              <td>{{ $i+1 + ($list->currentPage() - 1) * $list->perPage() }}</td>
              <td>{{ $p->nik }}</td>
              <td>{{ $p->nama_pasien }}</td>
              <td>{{ $p->total_alarm }}</td>
              <td>{{ $p->total_obat }}</td>
              <td>{{ $p->alarm_aktif }}</td>
              <td>{{ $p->alarm_selesai }}</td>
              <td>
                <a href="{{ route('alarm.detail', $p->id_pasien) }}" class="btn btn-detail">Lihat Detail</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8">Tidak ada data alarm</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-end mt-3">
        {{ $list->appends(['search' => request('search'), 'entries' => request('entries')])->links() }}
      </div>
    </div>
  </div>
</body>
</html>
