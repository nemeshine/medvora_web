<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background-color: #eee; }
        hr { margin: 20px 0; }
    </style>
</head>
<body>

    <h2>Data Pasien: {{ $pasien->nama_pasien }}</h2>
    <p><strong>NIK:</strong> {{ $pasien->nik }}</p>
    <p><strong>Usia:</strong> {{ $pasien->usia }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</p>
    <p><strong>Riwayat Penyakit:</strong> {{ $pasien->riwayat_penyakit }}</p>

    <h3>Data Alarm</h3>
    <table>
        <thead>
            <tr>
                <th>Obat</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Staff</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pasien->alarm as $alarm)
                <tr>
                    <td>{{ $alarm->obat->nama_obat ?? '-' }}</td>
                    <td>{{ $alarm->tanggal_mulai ?? '-' }}</td>
                    <td>{{ $alarm->tanggal_selesai ?? '-' }}</td>
                    <td>{{ $alarm->staff->nama_staff ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data alarm</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Diagnosa Penyakit</h3>
    @forelse($pasien->diagnosa as $diagnosa)
        <p><strong>Tanggal Keluhan:</strong> {{ $diagnosa->tanggal_keluhan }}</p>
        <p><strong>Keluhan:</strong> {{ $diagnosa->keluhan }}</p>
        <p><strong>Tanggal Diagnosa:</strong> {{ $diagnosa->tanggal_diagnosa }}</p>
        <p><strong>Diagnosa:</strong> {{ $diagnosa->diagnosa }}</p>
        <p><strong>Resep Obat:</strong> {{ $diagnosa->resep_obat }}</p>
        <p><strong>Catatan Tambahan:</strong> {{ $diagnosa->catatan_tambahan }}</p>
        <p><strong>Staff:</strong> {{ $diagnosa->staff->nama_staff ?? '-' }}</p>
        <hr>
    @empty
        <p>Tidak ada data diagnosa.</p>
    @endforelse

</body>
</html>
