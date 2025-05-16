<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Medvora</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; padding-left: 80px; }
    .sidebar { width: 250px; background-color: #5F4DFF; min-height: 100vh; color: #fff; }
    .sidebar a { color: #ccc; text-decoration: none; display: flex; align-items: center; padding: 15px; }
    .sidebar a.active, .sidebar a:hover { background-color: #4e3fd1; color: #fff; }
    .sidebar a .icon { width: 30px; text-align: center; margin-right: 10px; }
    .topbar { height: 60px; background-color: #fff; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
    .stats-card { border-radius: 10px; background-color: #fff; padding: 20px; }
    .stats-card .icon { font-size: 1.5rem; }
    .new-users .card { border-radius: 10px; background-color: #fff; margin-bottom: 15px; }
    .filter-select { width: 200px; }
    .pengguna{background-color: black; color: #fff;align-items: center; border-radius: 10px; width: 50%; text-align: center; padding: 8px; margin-left: auto;margin-right: auto;}
    .alarm_aktif{background-color: blue; color: #fff;align-items: center; border-radius: 10px; width: 50%; text-align: center; padding: 8px; margin-left: auto;margin-right: auto;}
    .alarm_terlewat{background-color:#eb2f64; color: #fff;align-items: center; border-radius: 10px; width: 50%; text-align: center; padding: 8px; margin-left: auto;margin-right: auto;}
    .alarm_selesai{background-color: green; color: #fff;align-items: center; border-radius: 10px; width: 50%; text-align: center; padding: 8px; margin-left: auto;margin-right: auto;}
    .pengguna_search{display: flex;align-items: center;text-align: center;}
  </style>
</head>
<body>
@include('sidebar.sidebar')

<div class="d-flex">
  <div class="flex-grow-1">

    <div class="p-4">
      <h3>Dashboard</h3>
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="stats-card">
          <div class="pengguna">
            <small >Total Pengguna</small>
          </div>
            <div class="d-flex align-items-center mt-2">
              <i class="fas fa-user icon text-secondary"></i>
              <h4 class="mb-0 ms-auto">{{ $totalPengguna }}</h4>

            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stats-card">
          <div class="alarm_aktif">
            <small>Alarm Aktif</small>
          </div>
            <div class="d-flex align-items-center mt-2">
              <i class="fas fa-clock icon text-info"></i>
              <h4 class="mb-0 ms-auto">{{ $alarmAktif }}</h4>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stats-card">
            <div class="alarm_terlewat">
            <small >Alarm Terlewat</small>
            </div>
            <div class="d-flex align-items-center mt-2">
              <i class="fas fa-exclamation-triangle icon text-danger"></i>
              <h4 class="mb-0 ms-auto">{{ $alarmTerlewat }}</h4>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stats-card">
          <div class="alarm_selesai">
            <small >Alarm Selesai</small>
          </div>
            <div class="d-flex align-items-center mt-2">
              <i class="fas fa-check-circle icon text-purple"></i>
              <h4 class="mb-0 ms-auto">{{ $alarmSelesai }}</h4>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-8">
          <div class="card p-3 mb-4">
            <canvas id="dashboardChart" style="width:100%;height:300px;"></canvas>
          </div>
        </div>

        <div class="col-lg-4">
  <div class="new-users p-3">
    <form method="GET" action="{{ route('dashboard') }}">
      <div class="pengguna_search mb-3">
        <input type="search" name="search" class="form-control" placeholder="Cari..." value="{{ $search }}">
      </div>
    </form>

    <h5>Pengguna Baru</h5>

    <div class="list-group">
      @forelse($penggunaBaru as $pasien)
        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
          <i class="fas fa-user-circle fa-2x text-secondary me-3"></i>
          <div>
            <div>{{ $pasien->nama_pasien }}</div>
            <small class="text-muted">{{ $pasien->nik }} - {{ \Carbon\Carbon::parse($pasien->created_at)->format('d/m/Y') }}</small>
          </div>
        </a>
      @empty
        <div class="text-center text-muted">Tidak ada pengguna ditemukan</div>
      @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
      {{ $penggunaBaru->links() }}
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const chartLabels = @json($chartData['labels']);
  const dataAktif = @json($chartData['aktif']);
  const dataTerlewat = @json($chartData['terlewat']);
  const dataSelesai = @json($chartData['selesai']);

  const ctx = document.getElementById('dashboardChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: chartLabels,
      datasets: [
        { label: 'Alarm Aktif', type: 'line', data: dataAktif, borderColor: '#3498db', tension: 0.4, fill: false },
        { label: 'Alarm Terlewat', data: dataTerlewat, backgroundColor: '#eb2f64' },
        { label: 'Alarm Selesai', data: dataSelesai, backgroundColor: 'green' }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' }
      }
    }
  });
</script>

</body>
</html>
