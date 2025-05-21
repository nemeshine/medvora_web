<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Riwayat Alarm</title>
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
    .badge-selesai {
      background-color: #b37dfc;
    }
    .badge-terlewat {
      background-color: #ff8fa3;
    }
    .badge {
      padding: 6px 12px;
      font-size: 13px;
      color: white;
      border-radius: 8px;
    }
    .search-box {
      width: 250px;
      border-radius: 20px;
      padding-left: 15px;
    }
    .form-select-sm {
      border-radius: 20px;
      padding-left: 10px;
    }
  </style>
</head>
<body>

@include('sidebar.sidebar')

<div class="container mt-5">
  <div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Detail Riwayat Alarm</h4>
      <form method="GET">
        <div class="input-group" style="width: 250px;">
          <input type="text" name="search" class="form-control search-box" placeholder="Cari obat..." value="{{ request('search') }}">
          <button class="btn btn-outline-secondary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
    </div>

    <div class="row mb-3">
      <div class="col-md-6 d-flex align-items-center">
        <label class="me-2">Tampilkan</label>
        <form id="formEntries" method="GET">
          <select name="entries" class="form-select form-select-sm d-inline" style="width: auto;" onchange="this.form.submit()">
            @foreach([10, 25, 50, 100] as $opt)
              <option value="{{ $opt }}" {{ request('entries', 10) == $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
          </select>
        </form>
        <label class="ms-2">entri</label>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center bg-white">
        <thead class="table-light">
          <tr>
            <th>Tanggal</th>
            <th>Waktu Alarm</th>
            <th>Nama Obat</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($riwayat as $r)
            <tr>
              <td>{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d F Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($r->waktu_aksi)->format('H:i') }}</td>
              <td>{{ $r->alarm->obat->nama_obat ?? '-' }}</td>
              <td>
                @if($r->status === 'selesai')
                  <span class="badge badge-selesai">Selesai</span>
                @else
                  <span class="badge badge-terlewat">Terlewat</span>
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="text-center">Tidak ada riwayat alarm</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</body>
</html>
