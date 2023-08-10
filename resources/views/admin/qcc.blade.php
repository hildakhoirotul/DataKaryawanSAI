@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-5">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h4 class="ms-3 mb-0">Data QCC Karyawan</h4>
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
                    <form id="exportForm" action="{{ route('export.qcc.submit') }}" method="GET" style="display: none;">
                        @csrf
                        <input type="hidden" id="juaraExport" name="juara">
                    </form>
                    <button onclick="exportData()" type="button" class="btn btn-info mt-2 ms-1">
                        <i class='bx bx-download me-2'></i>
                        <span>Unduh Data</span>
                    </button>
                </div>
                <div class="col-md-4 text-end pe-3 me-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.5rem; margin-top: 1.8rem;" id="searchp" class="form-control input-text" placeholder="Cari disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.5rem; margin-top: 1.8rem;" id="search-btn" type="button" disabled><i class="fa fa-search fa-sm"></i></button>

                        <div class="dropdown mt-2 ms-2">
                            <label for="juara">Juara: </label>
                            <select id="juara" name="juara" class="form-control col-md-3 filter-juara">
                                <option value="">-- Juara --</option>
                                <option value="Juara 1">Juara 1</option>
                                <option value="Juara 2">Juara 2</option>
                                <option value="Juara 3">Juara 3</option>
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
                    <table id="myTable" class="table table-striped table-bordered border-light">
                        <thead class="text-center">
                            <tr>
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
                                <td class="text-center">{{ $r->id }}</td>
                                <td class="text-center">{{ $r->nik }}</td>
                                <td class="text-start">{{ $r->tema }}</td>
                                <td class="text-center">{{ $r->kontes }}</td>
                                <td class="text-center">{{ $r->nama_qcc }}</td>
                                <td class="text-center">
                                    @if($r->juara_sai == 0 || null)
                                    -
                                    @else
                                    {{ $r->juara_sai }}
                                    @endif
                                </td>
                                <td class="text-center">
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
                    <div class="d-flex justify-content-center">
                        {{ $qcc->links()}}
                    </div>
                </div>

                <!-- </div> -->
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

        fetch(`{{ secure_url(route('filter.qcc')) }}?juara=${selectedJuara}&search=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('qccTableBody').innerHTML = data;
            });
    }

    document.getElementById('juara').addEventListener('change', function() {
        filterData();
    });
    document.getElementById('searchp').addEventListener('input', function() {
        filterData();
    });
</script>
@endsection