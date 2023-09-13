@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-3">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h5 class="ms-1 mb-0">Data Karyawan</h5>
            <div class="jumlah-data px-2 text-nowrap border">
                Jumlah data : {{ $total }}
            </div>
            <!-- <a href="#"> -->
            <div class="row mt-2 justify-content-between align-items-end">


                <div class="col-md-6 ms-1">
                    <button type="button" class="btn btn-danger mt-2 p-1 px-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bi bi-cloud-upload me-1' style="vertical-align: middle;"></i>
                        <span>Unggah Data</span>
                    </button>
                    <a href="{{ route('unduh', ['nama_file' => 'template_karyawan_server.xlsx']) }}" class="btn unduh btn-outline-success mt-2 ms-1 p-1 px-2">
                        <i class='bi bi-cloud-download me-1'></i>
                        <span>Template</span>
                    </a>
                    <button class="btn btn-outline-warning mt-2 p-1 px-2" id="removeDataButton">
                        <i class="bi bi-trash"></i>
                        <span>Hapus</span>
                    </button>
                </div>
                <div class="col-md-5 pe-3">
                    <div class="input-group">
                        <form method="GET" action="{{ route('karyawan') }}">
                            <div class="dropdown text-end ms-2 me-2">
                                <label for="paginate" style="font-size: 12px;">Jumlah baris:</label>
                                <select id="paginate" name="paginate" class="form-control col-md-3" onchange="this.form.submit()">
                                    <option value="">--select--</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                            </div>
                        </form>
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.2rem; font-size: 10pt; margin-top: 1.40rem;" id="searchp" class="form-control input-text" placeholder="Cari NIK disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.2rem; margin-top: 1.40rem;" id="search-btn" type="button" disabled><i class="bi bi-search"></i></i></button>
                    </div>
                </div>
            </div>

            <!-- </a> -->

            <!-- Modal -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('import.karyawan.submit') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header p-2 px-3">
                                <h5 class="modal-title" id="importExcelLabel">Import Data Excel</h5>
                            </div>
                            <div class="modal-body px-3 pt-2 pb-1 mb-0">
                                <!-- Tempatkan form import di sini -->
                                @csrf
                                <div class="form-group p-0">
                                    <input type="file" name="file" accept=".xlsx, .xls, .csv">
                                </div>
                            </div>
                            <div class="modal-footer p-1">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- </div> -->
            <div class="row mt-0">
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped text-center table-bordered border-light">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th>NO</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Password</th>
                                    <th>Terakhir Ganti</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="karyawanTableBody">
                                @php $i=1 @endphp
                                @foreach($user as $r)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$r->id}}"></td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $r->nik }}</td>
                                    <td>{{ $r->nama }}</td>
                                    <td>
                                        <div class="password-container">
                                            <input type="password" class="password-text" value="{{ $r->chain }}" readonly>
                                            <i class="toggle-password-icon bi bi-eye-slash-fill" onclick="togglePasswordVisibility(this)"></i>
                                        </div>
                                    </td>
                                    <td>{{ $r->updated_at ? $r->updated_at : '-' }}</td>
                                    <td>
                                        <form action="{{ route('karyawan.destroy', ['id' => $r->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger px-2 show_confirm" style="font-size: 12px;" onclick="showDeleteConfirmation(event, this)">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!$state)
                    <div class="d-flex justify-content-center mt-3" id="paging">
                        {{ $user->links()}}
                    </div>
                    @endif
                    <!-- </div> -->
                </div>
            </div>
        </div>

    </div>
</main>
<script>
    function togglePasswordVisibility(icon) {
        var passwordInput = icon.previousElementSibling;
        var type = passwordInput.getAttribute('type');

        if (type === 'password') {
            passwordInput.setAttribute('type', 'text');
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        } else {
            passwordInput.setAttribute('type', 'password');
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        }
    }
</script>
<script>
    function myFunction() {
        const selected = document.getElementById('searchp').value;

        fetch(`{{ route('search.karyawan') }}?nik=${selected}`)
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
<script type="text/javascript">
    function showDeleteConfirmation(event, button) {
        event.preventDefault();
        var form = $(button).closest("form");
        swal.fire({
                title: `Apakah anda yakin menghapus data ini?`,
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    form.submit();
                }
            });
    }
</script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#selectAllCheckbox").change(function() {
            var isChecked = $(this).prop("checked");

            $(".checkbox").prop("checked", isChecked);
        });
        $("#removeDataButton").click(function() {
            var selectedIds = [];

            $(".checkbox:checked").each(function() {
                selectedIds.push($(this).data("id"));
            });

            if (selectedIds.length > 0) {
                if (confirm("Anda yakin ingin menghapus data yang dipilih?")) {
                    $.ajax({
                        url: "{{ url('delete-all')}}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: selectedIds
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(error) {
                            console.error("Terjadi kesalahan: " + error);
                        }
                    });
                }
            } else {
                alert("Pilih setidaknya satu data untuk dihapus.");
            }
        });
    });
</script>
@endsection