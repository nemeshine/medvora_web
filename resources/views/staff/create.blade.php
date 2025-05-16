<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Staff</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('sidebar.sidebar')

<div class="container mt-5">
  <h4 class="mb-4">Tambah Staff</h4>

  <form action="{{ route('staff.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label>Nama Staff</label>
      <input type="text" name="nama_staff" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('staff.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
