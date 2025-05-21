<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Staff</title>
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
      width: 600px;
      margin: auto;
    }
    .btn-primary {
      background-color: #5F4DFF;
      border-radius: 20px;
      padding: 8px 24px;
      border: none;
    }
    .btn-primary:hover {
      background-color: #4e3fd1;
    }
    .btn-secondary {
      border-radius: 20px;
      padding: 8px 24px;
    }
  </style>
</head>
<body>

@include('sidebar.sidebar')

<div class="container mt-5">
  <div class="card p-4">
    <h4 class="mb-4 text-center">Tambah Staff</h4>

    <form action="{{ route('staff.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="nama_staff" class="form-label">Nama Staff</label>
        <input type="text" name="nama_staff" id="nama_staff" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
