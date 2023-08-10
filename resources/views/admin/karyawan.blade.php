@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-5">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h4 class="ms-3 mb-0">Data Karyawan</h4>
            <div class="jumlah-absensi px-2 text-nowrap border">
                Jumlah data : {{ $total }}
            </div>
            <!-- <a href="#"> -->
            <div class="row justify-content-between align-items-end">


                <div class="col-md-4 ms-3">
                    <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bx bx-upload me-2'></i>
                        <span>Unggah Data</span>
                    </button>
                </div>

                <div class="col-md-3 pe-3 me-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.5rem; margin-top: 1.8rem;" id="searchp" class="form-control input-text" placeholder="Cari NIK disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.5rem; margin-top: 1.8rem;" id="search-btn" type="button" disabled><i class="fa fa-search fa-sm"></i></button>
                    </div>
                </div>
            </div>

            <!-- </a> -->

            <!-- Modal -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('import.karyawan.submit') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importExcelLabel">Import Data Excel</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Tempatkan form import di sini -->
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="file" accept=".xlsx, .xls, .csv">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- </div> -->

            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped text-center table-bordered border-light">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIK</th>
                                <th>Password</th>
                                <th>Terakhir Ganti</th>
                            </tr>
                        </thead>
                        <tbody id="karyawanTableBody">
                            @php $i=1 @endphp
                            @foreach($user as $r)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $r->nik }}</td>
                                <td>
                                    <div class="password-container">
                                        <input type="password" class="password-text" value="{{ $r->chain }}" readonly>
                                        <i class="toggle-password-icon fa fa-eye-slash" onclick="togglePasswordVisibility(this)"></i>
                                    </div>
                                </td>
                                <!-- <td>{{ $r->password }}</td> -->
                                <td>{{ $r->updated_at ? $r->updated_at : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $user->links()}}
                    </div>
                </div>

                <!-- </div> -->
            </div>
        </div>

    </div>
</main>
<script>
    function togglePasswordVisibility(icon) {
        var passwordInput = icon.previousElementSibling; // Mendapatkan elemen sebelumnya (input password)
        var type = passwordInput.getAttribute('type'); // Mendapatkan atribut type dari input

        if (type === 'password') {
            passwordInput.setAttribute('type', 'text'); // Ganti atribut type menjadi 'text' untuk menampilkan teks
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.setAttribute('type', 'password'); // Ganti atribut type menjadi 'password' untuk menyembunyikan teks
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>
<script>
    function myFunction() {
        const selected = document.getElementById('searchp').value;

        fetch(`{{ secure_url(route('search.karyawan')) }}?nik=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('karyawanTableBody').innerHTML = data;
            });
            document.getElementById('paging').style.display = "none";
    }

    document.getElementById('searchp').addEventListener('input', function() {
        myFunction();
    });
</script>
@endsection