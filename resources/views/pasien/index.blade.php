<html>
<head>
    <title>Data Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-3">Data Pasien</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('pasien.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="nama" class="form-control" placeholder="Cari nama..." value="{{ request('nama') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <a href="{{ route('pasien.create') }}" class="btn btn-success mb-3">+ Tambah Pasien</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
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
        @foreach($pasiens as $pasien)
            <tr>
                <td>{{ $pasien->id_pasien }}</td>
                <td>{{ $pasien->nama_pasien }}</td>
                <td>{{ $pasien->usia }}</td>
                <td>{{ $pasien->jenis_kelamin }}</td>
                <td>{{ $pasien->nomor_hp }}</td>
                <td>{{ $pasien->nomor_hp_keluarga }}</td>
                <td>{{ $pasien->riwayat_penyakit }}</td>
                <td>{{ $pasien->password }}</td>
                <td>
                    <a href="{{ route('pasien.edit', $pasien) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pasien.destroy', $pasien) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $pasiens->withQueryString()->links() }}
</div>
</body>
</html>