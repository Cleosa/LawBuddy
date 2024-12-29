<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - LawBuddy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e5f6f1;
        }

        .container {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-success" href="#">LAW<span class="text-primary">BUDDY</span> Admin</a>
        </div>
    </nav>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-5 pt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-success">Daftar Lawyer</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Lawyer Baru
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor HP</th>
                                <th>Pengalaman (Tahun)</th>
                                <th>Biaya Konsultasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="lawyerTableBody">
                            @forelse($lawyers as $lawyer)
                            <tr>
                                <td>{{ $lawyer->name }}</td>
                                <td>{{ $lawyer->phone_number }}</td>
                                <td>{{ $lawyer->years_of_experience }}</td>
                                <td>Rp{{ number_format($lawyer->consultation_fee, 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-secondary btn-edit"
                                        data-lawyer='@json($lawyer)'
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">Edit</button>
                                    <button class="btn btn-danger ms-3 btn-delete"
                                        data-lawyer-id="{{ $lawyer->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data lawyer.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Lawyer Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="addName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="addName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPhone" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="addPhone" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="addExperience" class="form-label">Pengalaman (Tahun)</label>
                            <input type="number" class="form-control" id="addExperience" name="years_of_experience" required>
                        </div>
                        <div class="mb-3">
                            <label for="addFee" class="form-label">Biaya Konsultasi</label>
                            <input type="number" class="form-control" id="addFee" name="consultation_fee" required>
                        </div>
                        <button type="submit" class="btn btn-success">Tambah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Lawyer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="editPhone" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="editExperience" class="form-label">Pengalaman (Tahun)</label>
                            <input type="number" class="form-control" id="editExperience" name="years_of_experience" required>
                        </div>
                        <div class="mb-3">
                            <label for="editFee" class="form-label">Biaya Konsultasi</label>
                            <input type="number" class="form-control" id="editFee" name="consultation_fee" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data lawyer ini?</p>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup CSRF token for all AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Add functionality
            document.getElementById('addForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('/admin/lawyers', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            throw new Error('Something went wrong');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambah data.');
                    });
            });

            // Edit functionality
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const lawyer = JSON.parse(this.dataset.lawyer);
                    document.getElementById('editId').value = lawyer.id;
                    document.getElementById('editName').value = lawyer.name;
                    document.getElementById('editPhone').value = lawyer.phone_number;
                    document.getElementById('editExperience').value = lawyer.years_of_experience;
                    document.getElementById('editFee').value = lawyer.consultation_fee;
                    document.getElementById('editForm').action = `/admin/lawyers/${lawyer.id}`;
                });
            });

            // Handle edit form submission
            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            throw new Error('Something went wrong');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memperbarui data.');
                    });
            });

            // Delete functionality
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const lawyerId = this.dataset.lawyerId;
                    document.getElementById('deleteForm').action = `/admin/lawyers/${lawyerId}`;
                });
            });

            // Handle delete confirmation
            document.getElementById('confirmDelete').addEventListener('click', function() {
                const deleteForm = document.getElementById('deleteForm');

                fetch(deleteForm.action, {
                        method: 'POST',
                        body: new FormData(deleteForm),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            throw new Error('Something went wrong');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus data.');
                    });
            });

            // Reset add form when modal is closed
            document.getElementById('addModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('addForm').reset();
            });

            // Reset edit form when modal is closed
            document.getElementById('editModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('editForm').reset();
            });
        });
    </script>
</body>

</html>