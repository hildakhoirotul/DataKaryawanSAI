@extends('admin.layout.main')
@section('title', 'Absensi')
@section('content')
<main class="content p-2 pt-3">
    <div class="row">
        <div class="card p-4">
            <h5 class="ms-1 mb-0">Data Absensi Karyawan</h5>
            <form method="GET" action="{{ route('absensi') }}" class="baris me-4">
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

            <div class="row mt-2 justify-content-between align-items-end">
                <div class="col-md-5">
                    <button type="button" class="btn btn-danger mt-2 p-1 px-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bi bi-cloud-upload me-1' style="vertical-align: middle;"></i>
                        <span>Unggah</span>
                    </button>
                    <form id="exportForm" action="{{ route('export.absensi.submit') }}" method="GET" style="display: none;">
                        @csrf
                        <input type="hidden" id="jenisExport" name="jenis">
                        <input type="hidden" id="tanggalMulaiExport" name="tanggalMulai">
                        <input type="hidden" id="tanggalAkhirExport" name="tanggalAkhir">
                    </form>
                    <button onclick="exportData()" type="button" class="btn btn-info mt-2 p-1 px-2">
                        <i class='bi bi-cloud-download me-1' style="vertical-align: middle;"></i>
                        <span>Unduh</span>
                    </button>
                    <a href="{{ url('/unduh/template_absensi.xlsx') }}" class="btn unduh btn-outline-success mt-2 p-1 px-2">
                        <span>Template</span>
                    </a>
                    <button class="btn btn-outline-warning mt-2 p-1 px-2" id="removeDataButton">
                        <span>Hapus</span>
                    </button>
                    <button type="button" onclick="showDeleteConfirmation(event, this)" class="btn unduh btn-outline-danger mt-2 p-1 px-2">
                        <span>Reset</span>
                    </button>
                </div>
                <div class="col-md-7">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.1rem; margin-top: 2rem; font-size: 10pt;" id="searchp" class="form-control input-text" placeholder="Cari NIK disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.1rem; margin-top: 2rem; border-radius: 0px 5px 5px 0px;" id="search-btn" type="button" disabled><i class="bi bi-search"></i></button>
                        <!-- <i class="fa-solid fa-magnifying-glass" id="searchIcon"></i> -->
                        <!-- </div> -->

                        <div class="dropdown mt-2 ms-2">
                            <label for="jenis">Jenis: </label>
                            <select id="jenis" name="jenis" class="form-control col-md-3 filter-jenis">
                                <option value="">-Jenis-</option>
                                <option value="S">S</option>
                                <option value="SD">SD</option>
                                <option value="I">I</option>
                                <option value="A">A</option>
                                <option value="TD">TD</option>
                                <option value="CP">CP</option>
                                <option value="ITD">ITD</option>
                                <option value="ICP">ICP</option>
                            </select>
                        </div>
                        <div class="dropdown ms-2 mt-2">
                            <label for="tanggalMulai">Tanggal Mulai:</label>
                            <input type="date" id="tanggalMulai" name="tanggalMulai" class="form-control col-md-3 tanggalMulai">
                        </div>
                        <div class="dropdown ms-2 mt-2">
                            <label for="tanggalAkhir">Tanggal Akhir: </label>
                            <input type="date" id="tanggalAkhir" name="tanggalAkhir" class="form-control col-md-3 tanggalAkhir">
                        </div>
                    </div>
                </div>
            </div>

            <!-- </a> -->

            <!-- Modal -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('import.absensi.submit') }}" method="post" enctype="multipart/form-data">
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
                        <table id="myTable" class="table table-striped text-center table-bordered border-light" id="search_list">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                                    <th>NO</th>
                                    <th onclick="sortTable(1)">NIK <i class="bi bi-arrow-down-up"></i></th>
                                    <th onclick="sortTable(2)">Jenis <i class="bi bi-arrow-down-up"></i></th>
                                    <th onclick="sortTable(3)">Tanggal <i class="bi bi-arrow-down-up"></i></th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                </tr>
                            </thead>
                            <tbody id="absensiTableBody">
                                @php $i=1 @endphp
                                @foreach($absensi as $r)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" data-id="{{$r->id}}" data-checked="{{ $r->isChecked ? 'true' : 'false' }}"></td>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $r->nik }}</td>
                                    <td>{{ $r->jenis }}</td>
                                    <td>{{ $r->tanggal }}</td>
                                    <td>
                                        @if($r->jam_masuk == '00:00:00')
                                        @if(in_array($r->jenis, ['ICP', 'ITD', 'TD', 'CP']))
                                        Tidak Checklog
                                        @else
                                        -
                                        @endif
                                        @else
                                        {{ $r->jam_masuk }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->jam_pulang == '00:00:00')
                                        @if(in_array($r->jenis, ['ICP', 'ITD', 'TD', 'CP']))
                                        Tidak Checklog
                                        @else
                                        -
                                        @endif
                                        @else
                                        {{ $r->jam_pulang }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3" id="paging">
                        {{ $absensi->appends(['paginate' => $page])->links()}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];

                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
<script>
    function exportData() {
        const selectedJenis = document.getElementById('jenis').value;
        const tanggalMulai = document.getElementById('tanggalMulai').value;
        const tanggalAKhir = document.getElementById('tanggalAkhir').value;

        document.getElementById('jenisExport').value = selectedJenis;
        document.getElementById('tanggalMulaiExport').value = tanggalMulai;
        document.getElementById('tanggalAkhirExport').value = tanggalAKhir;

        document.getElementById('exportForm').submit();
    }

    function filterData() {
        const selectedJenis = document.getElementById('jenis').value;
        const tanggalMulai = document.getElementById('tanggalMulai').value;
        const tanggalAkhir = document.getElementById('tanggalAkhir').value;
        const selectedNik = document.getElementById('searchp').value;

        fetch(`{{ route('filter.absensi') }}?jenis=${selectedJenis}&tanggalMulai=${tanggalMulai}&tanggalAkhir=${tanggalAkhir}&nik=${selectedNik}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('absensiTableBody').innerHTML = data;
                handleCheckboxChanges();
            });
    }

    document.getElementById('tanggalMulai').addEventListener('change', function() {
        filterData();
    });

    document.getElementById('tanggalAkhir').addEventListener('change', function() {
        filterData();
    });

    document.getElementById('jenis').addEventListener('change', function() {
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
                    url: "{{ url('delete-absensi')}}",
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
                    $.get("{{ url('reset-absensi') }}", function(data) {
                        location.reload();
                    });
                }
            });
    }
</script>
@endsection