<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Alarm Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f6fa;
      font-family: 'Segoe UI', sans-serif;
      margin-left: 80px;
    }
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      width: 100%;
      margin: auto;
    }
    .btn-detail {
      background-color: #5F4DFF;
      color: white;
      border-radius: 20px;
      padding: 6px 16px;
      font-size: 14px;
    }
    .btn-detail:hover {
      background-color: #4e3fd1;
      color: white;
    }
    .search-box {
      width: 300px;
      border-radius: 20px;
      padding-left: 15px;
    }
    .pagination {
      margin-top: 20px;
    }
    .pagination .page-link {
      border-radius: 10px;
      margin: 0 3px;
      color: #5F4DFF;
    }
    .pagination .page-item.active .page-link {
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
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Riwayat Alarm Pengguna</h4>
      <form action="{{ route('riwayat.index') }}" method="GET">
        <input type="text" name="search" class="form-control search-box" placeholder="Cari nama pengguna..." value="{{ request('search') }}">
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Pengguna</th>
            <th>Total Alarm</th>
            <th>Aktif</th>
            <th>Terlewat</th>
            <th>Selesai</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($riwayat as $i => $row)
            <tr>
              <td>{{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $i + 1 }}</td>
              <td>{{ $row->nik }}</td>
              <td>{{ $row->nama_pasien }}</td>
              <td>{{ $row->total_alarm }}</td>
              <td>{{ $row->aktif }}</td>
              <td>{{ $row->terlewat }}</td>
              <td>{{ $row->selesai }}</td>
              <td>
                <a href="{{ route('riwayat.detail', $row->id_pasien) }}" class="btn btn-detail">
                  Lihat Riwayat
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8">Tidak ada data ditemukan</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center">
      {{ $riwayat->withQueryString()->links() }}
    </div>

  </div>
</div>

</body>
</html>
