<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Riwayat Alarm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('sidebar.sidebar')

<div class="container mt-5">
  <h4 class="mb-4">Detail Riwayat Alarm</h4>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead class="table-light">
        <tr>
          <th>Tanggal</th>
          <th>Waktu Alarm</th>
          <th>Nama Obat</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @for($i=1; $i<=10; $i++)
        <tr>
          <td>{{ now()->format('d M Y') }}</td>
          <td>{{ rand(0, 23) }}:{{ rand(10,59) }}</td>
          <td>Obat {{ $i }}</td>
          <td>
            @if($i%2==0)
              <span class="badge bg-success">Selesai</span>
            @else
              <span class="badge bg-danger">Terlewat</span>
            @endif
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
