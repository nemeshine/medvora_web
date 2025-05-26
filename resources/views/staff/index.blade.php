<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            width: 800px;
            margin: auto;
        }
        .btn-add {
            background-color: #5F4DFF;
            color: white;
            border-radius: 20px;
        }
        .btn-add:hover {
            background-color: #4e3fd1;
            color: white;
        }
        .table th {
            background-color: #f1f1f1;
        }
    /* Pastikan sidebar tetap bisa diakses */
    .sidebar {
    z-index: 1070 !important; /* lebih tinggi dari backdrop */
    }

    </style>
</head>
<body>
@include('sidebar.sidebar')
<div class="container mt-5">
    <div class="card p-4">
        <h4 class="mb-4">Manajemen Staff</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('staff.create') }}" class="btn btn-add"><i class="fas fa-plus"></i> Tambah Staff</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffs as $i => $staff)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $staff->nama_staff }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>
                            <a href="{{ route('staff.edit', $staff->id_staff) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('staff.destroy', $staff->id_staff) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada data staff</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi Password -->
<div class="modal fade" id="passwordModal" tabindex="0" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <form id="verifyForm" method="POST" action="{{ route('staff.verify-password') }}">
        @csrf
        <div class="modal-header border-0 flex-column text-center">
          <h5 class="modal-title" id="passwordModalLabel">Verifikasi Admin</h5>
          <i class='bx bx-lock mt-2' id="lockIcon" style="font-size: 90px; color:black;"></i>
          <br>
                    <p class="mb-3">Masukkan password untuk melihat data staff:</p>
        </div>
        <div class="modal-body text-center">

          <input type="password" name="password" class="form-control text-center" placeholder="Password" required autofocus>

          @if(session('verify_error'))
              <div class="text-danger mt-2">{{ session('verify_error') }}</div>
          @endif
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="submit" id="verifyBtn" class="btn btn-primary px-4 py-2">
            Verifikasi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>





@if(!session('verified'))
<script>
document.addEventListener("DOMContentLoaded", function() {
    var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {
        backdrop: 'static',
        keyboard: false
    });
    passwordModal.show();

    const verifyForm = document.getElementById("verifyForm");
    const lockIcon = document.getElementById("lockIcon");
    verifyForm.addEventListener("submit", function() {
        lockIcon.classList.remove('bx-lock');
        lockIcon.classList.add('bx-lock-open');
    });
});
</script>
@endif


</body>
</html>
