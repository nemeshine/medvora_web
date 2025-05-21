<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Diagnosa Penyakit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body{background:#f5f6fa;font-family:'Segoe UI',sans-serif;margin-left:50px;}
    .card{border:none;border-radius:15px;box-shadow:0 2px 10px rgba(0,0,0,0.05);max-width:95%;margin:auto;}
    .btn-add{background:#5F4DFF;color:#fff;border-radius:20px;}
    .btn-add:hover{background:#4e3fd1;}
    th{background:#f1f1f1;}
    td.aksi-column,th.aksi-column{width:140px;white-space:nowrap;}
    td.aksi-column .btn{margin:2px 4px;display:inline-block;}
  </style>
</head>
<body>
  @include('sidebar.sidebar')

  <div class="container-fluid mt-5">
    <div class="card p-4">
      <h4 class="mb-4">Manajemen Diagnosa Penyakit</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="row mb-3">
        <div class="col-md-6 d-flex align-items-center">
          <label class="me-2">Show</label>
          <select class="form-select form-select-sm" style="width:auto"
                  onchange="location=this.value">
            @foreach([10,25,50,100] as $n)
              <option value="?entries={{$n}}&search={{request('search')}}"
                {{request('entries',10)==$n?'selected':''}}>
                {{$n}}
              </option>
            @endforeach
          </select>
          <span class="ms-2">entries</span>
        </div>
        <div class="col-md-6 text-end">
          <form method="GET" action="{{ route('diagnosa.index') }}" class="mb-2">
            <div class="input-group" style="max-width: 300px; float: right;">
              <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
              <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
          <a href="{{ route('diagnosa.create') }}" class="btn btn-add mt-2">
            <i class="fas fa-plus"></i> Tambah Diagnosa
          </a>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Pasien</th>
              <th>Staff</th>
              <th>Tgl Keluhan</th>
              <th>Keluhan</th>
              <th>Tgl Diagnosa</th>
              <th>Diagnosa</th>
              <th>Resep Obat</th>
              <th>Catatan</th>
              <th class="aksi-column">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $d)
            <tr>
              <td>{{ $loop->iteration + ($list->currentPage()-1)*$list->perPage() }}</td>
              <td>{{ $d->pasien->nama_pasien }}</td>
              <td>{{ $d->staff->nama_staff }}</td>
              <td>{{ \Carbon\Carbon::parse($d->tanggal_keluhan)->format('d/m/Y') }}</td>
              <td>{{ $d->keluhan }}</td>
              <td>{{ \Carbon\Carbon::parse($d->tanggal_diagnosa)->format('d/m/Y') }}</td>
              <td>{{ $d->diagnosa }}</td>
              <td>{{ $d->resep_obat }}</td>
              <td>{{ $d->catatan_tambahan }}</td>
              <td class="aksi-column">
                <a href="{{ route('diagnosa.edit',$d) }}" class="btn btn-warning btn-sm">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('diagnosa.destroy',$d) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="10">Tidak ada data diagnosa</td></tr>
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
