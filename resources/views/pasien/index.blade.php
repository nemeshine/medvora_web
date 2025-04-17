<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
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

<div class="container mt-5">
    <div class="card p-4">
        <h4 class="mb-4">Data Pasien</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('pasien.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="nama" class="form-control" placeholder="Cari nama..." value="{{ request('nama') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('pasien.create') }}" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Pengguna</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor HP</th>
                    <th>HP Keluarga</th>
                    <th>Riwayat Penyakit</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pasiens as $index => $pasien)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pasien->nama_pasien }}</td>
                        <td>{{ $pasien->usia }}</td>
                        <td>{{ $pasien->jenis_kelamin }}</td>
                        <td>{{ $pasien->nomor_hp }}</td>
                        <td>{{ $pasien->nomor_hp_keluarga }}</td>
                        <td>{{ $pasien->riwayat_penyakit }}</td>
                        <td>{{ $pasien->password }}</td>
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
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $pasiens->withQueryString()->links() }}
        </div>
    </div>
</div>

</body>
</html>
