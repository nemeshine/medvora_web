<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Staff</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('sidebar.sidebar')

<div class="container mt-5">
  <h4 class="mb-4">Edit Staff</h4>

  <form action="{{ route('staff.update', $staff->id_staff) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label>Nama Staff</label>
      <input type="text" name="nama_staff" class="form-control" value="{{ $staff->nama_staff }}" required>
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
    </div>

    <div class="mb-3">
      <label>Password <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
      <input type="password" name="password" class="form-control">
    </div>

    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('staff.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
