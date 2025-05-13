<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Alarm Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f0f2f5; margin-left: 80px; }
    .btn-detail { background-color: #6c63ff; color: white; border-radius: 10px; padding: 5px 15px; }
    .btn-detail:hover { background-color: #574fe3; }
  </style>
</head>
<body>
  @include('sidebar.sidebar')

  <div class="container mt-5">
    <h4 class="mb-4">Riwayat Alarm Pengguna</h4>

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
          @foreach($riwayat as $i => $row)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $row->nik }}</td>
              <td>{{ $row->nama_pasien }}</td>
              <td>{{ $row->total_alarm }}</td>
              <td>{{ $row->aktif }}</td>
              <td>{{ $row->terlewat }}</td>
              <td>{{ $row->selesai }}</td>
              <td>
                <a href="{{ route('riwayat.detail', $row->id_pasien) }}" class="btn btn-detail">Lihat Riwayat</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
