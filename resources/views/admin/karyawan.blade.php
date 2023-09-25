@extends('admin.layout.main')
@section('title', 'Karyawan')

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
                                    <option value="50">--select--</option>
                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                    <option value="250" {{ $perPage == 250 ? 'selected' : '' }}>250</option>
                                    <option value="500" {{ $perPage == 500 ? 'selected' : '' }}>500</option>
                                    <option value="1000" {{ $perPage == 1000 ? 'selected' : '' }}>1000</option>
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
                                    <td><input type="checkbox" class="checkbox" data-id="{{$r->id}}" data-checked="{{ $r->isChecked ? 'true' : 'false' }}"></td>
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
                    <div class="pagination d-flex justify-content-center mt-3" id="paging">
                        {{ $user->appends(['paginate' => $perPage])->links()}}
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
                handleCheckboxChanges();
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
    function handleCheckboxChanges() {
        function getCheckboxStatusFromLocalStorage() {
            var isChecked = localStorage.getItem("selectAllChecked");
            if (isChecked === "true") {
                $("#selectAllCheckbox").prop("checked", true);
                $(".checkbox").prop("checked", true);
            } else {
                $("#selectAllCheckbox").prop("checked", false);
                $(".checkbox").prop("checked", false);
            }
        }

        function updateSelectedIdsInLocalStorage(selectedIds) {
            localStorage.setItem("selectedIds", JSON.stringify(selectedIds));
        }

        $("#selectAllCheckbox").change(function() {
            var isChecked = $(this).prop("checked");

            // Mengatur status selectAllChecked di local storage
            localStorage.setItem("selectAllChecked", isChecked ? "true" : "false");

            // Mengatur status checkbox individual
            $(".checkbox").prop("checked", isChecked);

            // Memperbarui selectedIds di local storage sesuai dengan status terbaru
            if (isChecked) {
                var dataIds = $(".checkbox").map(function() {
                    return $(this).data("id");
                }).get();
                updateSelectedIdsInLocalStorage(dataIds);
            } else {
                updateSelectedIdsInLocalStorage([]);
            }
        });

        var selectedIds = getSelectedIdsFromLocalStorage();
        $(".checkbox").each(function() {
            var dataId = $(this).data("id");
            if (selectedIds.includes(dataId)) {
                $(this).prop("checked", true);
            }
        });

        $(".checkbox").change(function() {
            var isChecked = $(this).prop("checked");
            var dataId = $(this).data("id");
            var selectedIds = getSelectedIdsFromLocalStorage();

            if (isChecked) {
                selectedIds.push(dataId);
            } else {
                selectedIds = selectedIds.filter(function(id) {
                    return id !== dataId;
                });
            }

            localStorage.setItem("selectedIds", JSON.stringify(selectedIds));
        });

    }

    function getSelectedIdsFromLocalStorage() {
        var selectedIds = JSON.parse(localStorage.getItem("selectedIds")) || [];
        return selectedIds;
    }

    $(document).ready(function() {
        handleCheckboxChanges(); // Panggil fungsi ketika dokumen siap

        // Event listener untuk checkbox yang akan memanggil fungsi saat dicentang
        $(".checkbox").change(function() {
            handleCheckboxChanges();
        });
    });

    function deleteSelectedData() {
        var selectedIds = getSelectedIdsFromLocalStorage();

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
    };
    $("#removeDataButton").click(function() {
        deleteSelectedData(); // Panggil fungsi untuk menghapus data
    });
</script>
@endsection