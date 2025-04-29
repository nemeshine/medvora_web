<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Alarm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('sidebar.sidebar')

<div class="container mt-5">
  <h4 class="mb-4">Riwayat Alarm Pengguna</h4>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
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
        @for($i=1; $i<=8; $i++)
        <tr>
          <td>{{ $i }}</td>
          <td>1234567890123456</td>
          <td>Nama User {{ $i }}</td>
          <td>{{ rand(10, 100) }}</td>
          <td>{{ rand(1, 30) }}</td>
          <td>{{ rand(1, 20) }}</td>
          <td>{{ rand(1, 50) }}</td>
          <td>
            <a href="/riwayat/{{ $i }}" class="btn btn-primary btn-sm">Lihat Riwayat</a>
          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-end mt-3">
    <nav>
      <ul class="pagination">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </div>
</div>
</body>
</html>
