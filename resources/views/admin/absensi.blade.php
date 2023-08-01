@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-5">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h4 class="ms-3 mb-0" style="display: inline;">Data Absensi Karyawan</h4>
            <div class="jumlah-absensi text-nowrap border">
                Jumlah data : {{ $total }}
            </div>
            <!-- <a href="#"> -->
            <div class="row mt-2 justify-content-between align-items-end">
                <div class="col-md-4 ms-3">
                    <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bx bx-upload me-2'></i>
                        <span>Unggah Data</span>
                    </button>
                    <!-- <form action="{{ route('export.absensi.submit') }}" method="POST"> -->
                    <!-- @csrf -->
                    <!-- <button type="submit">
                            <i class='bx bx-download me-2'></i>
                            <span>Unduh Data</span>
                        </button> -->
                    <!-- </form> -->
                    <form id="exportForm" action="{{ route('export.absensi.submit') }}" method="GET" style="display: none;">
                        @csrf
                        <input type="hidden" id="jenisExport" name="jenis">
                        <input type="hidden" id="tanggalMulaiExport" name="tanggalMulai">
                        <input type="hidden" id="tanggalAkhirExport" name="tanggalAkhir">
                    </form>
                    <button onclick="exportData()" type="button" class="btn btn-info mt-2 ms-1">
                        <i class='bx bx-download me-2'></i>
                        <span>Unduh Data</span>
                    </button>
                    <!-- <a href="/export-absensi" onclick="exportData()" type="button" class="btn btn-info mt-2 ms-1">
                        <i class='bx bx-download me-2'></i>
                        <span>Unduh Data</span>
                    </a> -->

                </div>
                <!-- <div class="col-md-3">
                    
                </div> -->
                <div class="col-md-7 text-end pe-3 me-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.5rem; margin-top: 1.8rem;" id="searchp" onkeyup="myFunction()" class="form-control input-text" placeholder="Cari NIK disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.5rem; margin-top: 1.8rem;" id="search-btn" type="button" disabled><i class="fa fa-search fa-sm"></i></button>
                        <!-- <i class="fa-solid fa-magnifying-glass" id="searchIcon"></i> -->
                        <!-- </div> -->

                        <div class="dropdown mt-2 ms-2">
                            <label for="jenis">Jenis: </label>
                            <select id="jenis" name="jenis" class="form-control col-md-3 filter-jenis">
                                <option value="">-- Jenis --</option>
                                <option value="S">S</option>
                                <option value="SD">SD</option>
                                <option value="I">I</option>
                                <option value="A">A</option>
                                <option value="TD">TD</option>
                                <option value="CP">CP</option>
                                <option value="ITD">ITD</option>
                                <option value="ICP">ICP</option>
                            </select>
                            <!-- <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>S</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>SD</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>I</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>A</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>ITD</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>ICP</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>TP</span></a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-key"></i><span>CP</span></a></li>
                            </ul> -->
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
                    <table id="myTable" class="table table-striped text-center table-bordered border-light" id="search_list">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th onclick="sortTable(1)">NIK <i class='bx bx-sort'></i></th>
                                <th onclick="sortTable(2)">Jenis <i class='bx bx-sort'></i></th>
                                <th onclick="sortTable(3)">Tanggal <i class='bx bx-sort'></i></th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                            </tr>
                        </thead>
                        <tbody id="absensiTableBody">
                            @php $i=1 @endphp
                            @foreach($absensi as $r)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $r->nik }}</td>
                                <td>{{ $r->jenis }}</td>
                                <td>{{ $r->tanggal }}</td>
                                <td>
                                    @if($r->jam_masuk == '00:00:00')
                                    -
                                    @else
                                    {{ $r->jam_masuk }}
                                    @endif
                                </td>
                                <td>
                                    @if($r->jam_pulang == '00:00:00')
                                    -
                                    @else
                                    {{ $r->jam_pulang }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- </div> -->
            </div>
        </div>

    </div>
</main>
<script>
    // $('#searchp').keyup(function() {
    //     var seterm = $('#searchp').val();
    //     for (var i = 0; i < $('.contact').length; i++) {
    //         $('.contact:eq(' + i + ')').css('display', 'table-cell');
    //         if ($('.contact:eq(' + i + ')').text().toLowerCase().indexOf(seterm) < 0) {
    //             $('.contact:eq(' + i + ')').css('display', 'none');
    //         }
    //     }
    // });
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue, paging;
        input = document.getElementById("searchp");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        paging = document.getElementById("paging");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
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

    // document.querySelector('.filter-jenis').addEventListener('change', function() {
    //     const selectedJenis = this.value;
    //     fetch(`{{ route('filter.absensi') }}?jenis=${selectedJenis}`)
    //     .then(response => response.text())
    //     .then(data=> {
    //         document.getElementById('absensiTableBody').innerHTML = data;
    //     });
    // });

    function filterData() {
        const selectedJenis = document.getElementById('jenis').value;
        const tanggalMulai = document.getElementById('tanggalMulai').value;
        const tanggalAkhir = document.getElementById('tanggalAkhir').value;

        fetch(`{{ route('filter.absensi') }}?jenis=${selectedJenis}&tanggalMulai=${tanggalMulai}&tanggalAkhir=${tanggalAkhir}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('absensiTableBody').innerHTML = data;
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
</script>
@endsection