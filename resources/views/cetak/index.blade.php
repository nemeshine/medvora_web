<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pasien</title>
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
        .table th {
            background-color: #f1f1f1;
        }
        .btn-cetak {
            background-color: #198754;
            color: white;
            border-radius: 8px;
        }
        .btn-cetak:hover {
            background-color: #157347;
        }
    </style>
</head>
<body>
@include('sidebar.sidebar')
<div class="container mt-5">
    <div class="card p-4">
        <h4 class="mb-4">Daftar Pasien</h4>


        <div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="{{ route('cetak.index') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>



        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Riwayat Penyakit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                        <tr>
                            <td>{{ $pasien->nik }}</td>
                            <td>{{ $pasien->nama_pasien }}</td>
                            <td>{{ $pasien->usia }}</td>
                            <td>{{ $pasien->riwayat_penyakit }}</td>
                            <td>
                                <a href="{{ url('/cetak_data/'.$pasien->id_pasien.'/pdf') }}" 
                                   class="btn btn-cetak btn-sm" target="_blank">
                                    <i class="fas fa-print"></i> Cetak PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
    {{ $pasiens->appends(['search' => $search])->links() }}
</div>



    </div>
</div>

</body>
</html>
