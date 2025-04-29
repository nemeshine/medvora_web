<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-form {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            max-width: 900px;
            margin: 0 auto;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #6C5CE7;
            border-color: #6C5CE7;
        }
        .btn-secondary {
            background-color: #dfe6e9;
            color: #2d3436;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5a4dd1;
        }
        .form-title {
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
@include('sidebar.sidebar')
<body style="background-color: #f5f6fa;">
<div class="container mt-5">
    <div class="card-form">
        <div class="form-title">Tambah Data Pasien</div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('pasien.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input name="nama_pasien" type="text" class="form-control @error('nama_pasien') is-invalid @enderror" value="{{ old('nama_pasien') }}">
                    @error('nama_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih</option>
                        <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected':'' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected':'' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor HP</label>
                    <input name="nomor_hp" type="text" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('nomor_hp') }}">
                    @error('nomor_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor HP Keluarga</label>
                    <input name="nomor_hp_keluarga" type="text" class="form-control @error('nomor_hp_keluarga') is-invalid @enderror" value="{{ old('nomor_hp_keluarga') }}">
                    @error('nomor_hp_keluarga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Riwayat Penyakit</label>
                    <input name="riwayat_penyakit" type="text" class="form-control" value="{{ old('riwayat_penyakit') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('pasien.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
