<html>
<head>
    <title>Tambah Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-3">Tambah Pasien</h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
    <form method="POST" action="{{ route('pasien.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror" value="{{ old('nama_pasien') }}">
            @error('nama_pasien') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Usia</label>
            <input name="usia" class="form-control @error('usia') is-invalid @enderror" value="{{ old('usia') }}">
            @error('usia') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                <option value="">Pilih</option>
                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Nomor HP</label>
            <input name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('nomor_hp') }}">
            @error('nomor_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Nomor HP Keluarga</label>
            <input name="nomor_hp_keluarga" class="form-control @error('nomor_hp_keluarga') is-invalid @enderror" value="{{ old('nomor_hp_keluarga') }}">
            @error('nomor_hp_keluarga') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Riwayat Penyakit</label>
            <input name="riwayat_penyakit" class="form-control" value="{{ old('riwayat_penyakit') }}">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
