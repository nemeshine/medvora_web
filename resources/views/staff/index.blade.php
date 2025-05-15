
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('sidebar.sidebar')
<div class="container mt-5">
    <h4 class="mb-3">Manajemen Staff</h4>
    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Tambah Staff</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $i => $staff)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $staff->nama_staff }}</td>
                <td>{{ $staff->email }}</td>
                <td>
                    <a href="{{ route('staff.edit', $staff->id_staff) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('staff.destroy', $staff->id_staff) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>