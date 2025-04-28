<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Obat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body { background: #f5f6fa; font-family: 'Segoe UI', sans-serif;margin-left: 70px; }
    .card { border:none; border-radius:15px; box-shadow:0 2px 10px rgba(0,0,0,0.05); max-width:95%; margin:auto; }
    .btn-add { background:#5F4DFF; color:#fff; border-radius:20px; }
    .btn-add:hover { background:#4e3fd1; }
    .table th { background:#f1f1f1; }
    td.aksi-column, th.aksi-column { width:140px; white-space: nowrap; }
    td.aksi-column .btn { margin:2px 4px; display:inline-block; }
  </style>
</head>
<body>
@include('sidebar.sidebar')

  <div class="container-fluid mt-5">
    <div class="card p-4">
      <h4 class="mb-4">Data Obat</h4>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="row mb-3">
        <div class="col-md-6 d-flex align-items-center">
          <label class="me-2">Show</label>
          <select class="form-select form-select-sm" style="width:auto"
                  onchange="location=this.value">
            @foreach([10,25,50,100] as $n)
              <option value="{{ route('obat.index',['entries'=>$n,'search'=>request('search')]) }}"
                {{ request('entries',10)==$n?'selected':'' }}>
                {{ $n }}
              </option>
            @endforeach
          </select>
          <label class="ms-2">entries</label>
        </div>
        <div class="col-md-6 text-end">
          <a href="{{ route('obat.create') }}" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Obat</a>
          <form class="d-inline ms-2" method="GET" action="{{ route('obat.index') }}">
            <div class="input-group" style="width:250px; display:inline-block;">
              <input type="text" name="search" class="form-control" placeholder="Cari..."
                     value="{{ request('search') }}">
              <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Obat</th>
              <th>Dosis</th>
              <th>Efek Samping</th>
              <th>Keterangan</th>
              <th class="aksi-column">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($obats as $o)
            <tr>
              <td>{{ $loop->iteration + ($obats->currentPage()-1)*$obats->perPage() }}</td>
              <td>{{ $o->nama_obat }}</td>
              <td>{{ $o->dosis }}</td>
              <td>{{ $o->efek_samping }}</td>
              <td>{{ $o->keterangan }}</td>
              <td class="aksi-column">
                <a href="{{ route('obat.edit',$o) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <form action="{{ route('obat.destroy',$o) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="6">Belum ada data obat</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-end mt-3">
        {{ $obats->links() }}
      </div>
    </div>
  </div>
</body>
</html>
