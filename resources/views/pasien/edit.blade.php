<html>
<head>
    <title>Edit Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-3">Edit Pasien</h2>
    <form method="POST" action="{{ route('pasien.update', $pasien) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input name="nama_pasien" class="form-control" value="{{ old('nama_pasien', $pasien->nama_pasien) }}">
        </div>
        <div class="mb-3">
            <label>Usia</label>
            <input name="usia" class="form-control" value="{{ old('usia', $pasien->usia) }}">
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Nomor HP</label>
            <input name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $pasien->nomor_hp) }}">
        </div>
        <div class="mb-3">
            <label>Nomor HP Keluarga</label>
            <input name="nomor_hp_keluarga" class="form-control" value="{{ old('nomor_hp_keluarga', $pasien->nomor_hp_keluarga) }}">
        </div>
        <div class="mb-3">
            <label>Riwayat Penyakit</label>
            <input name="riwayat_penyakit" class="form-control" value="{{ old('riwayat_penyakit', $pasien->riwayat_penyakit) }}">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control" value="{{ old('password', $pasien->password) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
