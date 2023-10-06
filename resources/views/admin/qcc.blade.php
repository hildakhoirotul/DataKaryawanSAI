@extends('admin.layout.main')
@section('title', 'QCC')

@section('content')
<main class="content p-2 pt-3">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h5 class="ms-1 mb-0">Data QCC Karyawan</h5>
            <form method="GET" action="{{ route('data-qcc') }}" class="baris me-4">
                <span style="font-size: 12px;">Jumlah Baris : </span>
                <div class="dropdown text-end ms-2">
                    <!-- <label for="paginate" style="font-size: 12px;">Jumlah baris:</label> -->
                    <select id="paginate" name="paginate" class="form-control px-2" style="width: 4rem; height: 1.8rem; font-size: 12px;" onchange="this.form.submit()">
                        <option value="50">-select-</option>
                        <option value="50" {{ $page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $page == 100 ? 'selected' : '' }}>100</option>
                        <option value="250" {{ $page == 250 ? 'selected' : '' }}>250</option>
                        <option value="500" {{ $page == 500 ? 'selected' : '' }}>500</option>
                        <option value="1000" {{ $page == 1000 ? 'selected' : '' }}>1000</option>
                    </select>
                </div>
            </form>
            <div class="jumlah-data px-2 ms-2 text-nowrap border">
                Jumlah data : {{ $total }}
            </div>
            <!-- <a href="#"> -->
            <div class="row justify-content-between align-items-end">
                <div class="col-md-7 ms-1">
                    <button type="button" class="btn btn-danger mt-2 p-1 px-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bi bi-cloud-upload me-1' style="vertical-align: middle;"></i>
                        <span>Unggah Data</span>
                    </button>
                    <form id="exportForm" action="{{ route('export.qcc.submit') }}" method="GET" style="display: none;">
                        @csrf
                        <input type="hidden" id="juaraExport" name="juara">
                    </form>
                    <button onclick="exportData()" type="button" class="btn btn-info mt-2 p-1 px-2">
                        <i class='bi bi-cloud-download me-1' style="vertical-align: middle;"></i>
                        <span>Unduh Data</span>
                    </button>
                    <a href="{{ url('/unduh/template_qcc.xlsx') }}" class="btn unduh btn-outline-success mt-2 ms-1 p-1 px-2">
                        <i class='bi bi-cloud-download me-1'></i>
                        <span>Template</span>
                    </a>
                    <button class="btn btn-outline-warning mt-2 p-1 px-2" id="removeDataButton">
                        <i class="bi bi-trash"></i>
                        <span>Hapus</span>
                    </button>
                    <button type="button" onclick="showDeleteConfirmation(event, this)" class="btn unduh btn-outline-danger mt-2 p-1 px-2">
                        <span>Reset</span>
                    </button>
                </div>
                <div class="col-md-4 text-end pe-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.1rem; margin-top: 2rem; font-size: 10pt;" id="searchp" class="form-control input-text" placeholder="Cari disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.1rem; margin-top: 2rem; border-radius: 0px 5px 5px 0px;" id="search-btn" type="button" disabled><i class="bi bi-search"></i></button>

                        <div class="dropdown mt-2 ms-2">
                            <label for="juara">Juara: </label>
                            <select id="juara" name="juara" class="form-control col-md-3 filter-juara">
                                <option value="">-- Juara --</option>
                                <option value="1">Juara 1</option>
                                <option value="2">Juara 2</option>
                                <option value="3">Juara 3</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- </a> -->

            <!-- Modal -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('import.qcc.submit') }}" method="post" enctype="multipart/form-data">
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
            <div class="row">
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered border-light">
                            <thead class="align-middle text-center">
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th>NO</th>
                                    <th>NIK</th>
                                    <th>TEMA</th>
                                    <th>Kontes</th>
                                    <th>Nama QCC</th>
                                    <th>Juara SAI</th>
                                    <th>Juara PASI</th>
                                </tr>
                            </thead>
                            <tbody id="qccTableBody">
                                @php $i=1 @endphp
                                @foreach($qcc as $r)
                                <tr>
                                    <td style="width: 40px;" class="text-center"><input type="checkbox" class="checkbox" data-id="{{$r->id}}" data-checked="{{ $r->isChecked ? 'true' : 'false' }}"></td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $r->nik }}</td>
                                    <td>{{ $r->tema }}</td>
                                    <td style="width: 80px;" class="text-center">{{ $r->kontes }}</td>
                                    <td>{{ $r->nama_qcc }}</td>
                                    <td style="width: 80px;" class="text-center">
                                        @if($r->juara_sai == 0 || null)
                                        -
                                        @else
                                        {{ $r->juara_sai }}
                                        @endif
                                    </td>
                                    <td style="width: 80px;" class="text-center">
                                        @if($r->juara_pasi == 0 || null)
                                        -
                                        @else
                                        {{ $r->juara_pasi }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3" id="paging">
                        {{ $qcc->appends(['paginate' => $page])->links()}}
                    </div>

                    <!-- </div> -->
                </div>
            </div>
        </div>

    </div>
</main>
<script>
    function exportData() {
        const selectedJuara = document.getElementById('juara').value;

        document.getElementById('juaraExport').value = selectedJuara;

        document.getElementById('exportForm').submit();
    }

    function filterData() {
        const selected = document.getElementById('searchp').value;
        const selectedJuara = document.getElementById('juara').value;

        fetch(`{{ route('filter.qcc') }}?juara=${selectedJuara}&search=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('qccTableBody').innerHTML = data;
                handleCheckboxChanges();
            });
    }

    document.getElementById('juara').addEventListener('change', function() {
        filterData();
    });
    document.getElementById('searchp').addEventListener('input', function() {
        filterData();
    });
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

            localStorage.setItem("selectAllChecked", isChecked ? "true" : "false");

            $(".checkbox").prop("checked", isChecked);

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
        handleCheckboxChanges();

        $(".checkbox").change(function() {
            handleCheckboxChanges();
        });
    });

    function deleteSelectedData() {
        var selectedIds = getSelectedIdsFromLocalStorage();

        if (selectedIds.length > 0) {
            if (confirm("Anda yakin ingin menghapus data yang dipilih?")) {
                $.ajax({
                    url: "{{ url('delete-qcc')}}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: selectedIds
                    },
                    success: function(response) {
                        localStorage.removeItem("selectedIds");
                        localStorage.removeItem("selectAllChecked");
                        $(".checkbox").prop("checked", false);
                        $("#selectAllCheckbox").prop("checked", false);
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
        deleteSelectedData();
    });
</script>
<script type="text/javascript">
    function showDeleteConfirmation(event, button) {
        event.preventDefault();
        var form = $(button).closest("form");
        swal.fire({
                title: `Apakah anda yakin menghapus semua data ini?`,
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
                    $.get("{{ url('reset-qcc') }}", function(data) {
                        location.reload();
                    });
                }
            });
    }
</script>
@endsection