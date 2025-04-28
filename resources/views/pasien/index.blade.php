<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pasien</title>
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
        .btn-add {
            background-color: #5F4DFF;
            color: white;
            border-radius: 20px;
        }
        .btn-add:hover {
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
        <h4 class="mb-4">Data Pasien</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
                <label class="me-2">Show</label>
                <form id="formEntries" action="{{ route('pasien.index') }}" method="GET">
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
                <form class="d-inline" method="GET" action="{{ route('pasien.index') }}">
                    <div class="input-group" style="width: 250px; float: right;">
                        <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a href="{{ route('pasien.create') }}" class="btn btn-add ms-3"><i class="fas fa-plus"></i> Tambah Pasien</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor HP</th>
                    <th>HP Keluarga</th>
                    <th>Riwayat Penyakit</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pasiens as $pasien)
                    <tr>
                        <td>{{ $loop->iteration + ($pasiens->currentPage()-1) * $pasiens->perPage() }}</td>
                        <td>{{ $pasien->nik }}</td>
                        <td>{{ $pasien->nama_pasien }}</td>
                        <td>{{ $pasien->email }}</td>
                        <td>{{ optional($pasien->tanggal_lahir)->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $pasien->jenis_kelamin }}</td>
                        <td>{{ $pasien->nomor_hp }}</td>
                        <td>{{ $pasien->nomor_hp_keluarga }}</td>
                        <td>{{ $pasien->riwayat_penyakit }}</td>
                        <td>
                            <a href="{{ route('pasien.edit', $pasien) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('pasien.destroy', $pasien) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data pasien</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $pasiens->links() }}
        </div>
    </div>
</div>

</body>
</html>
