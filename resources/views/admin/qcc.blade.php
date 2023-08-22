@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-3">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h5 class="ms-1 mb-0">Data QCC Karyawan</h5>
            <div class="jumlah-data px-2 text-nowrap border">
                Jumlah data : {{ $total }}
            </div>
            <!-- <a href="#"> -->
            <div class="row justify-content-between align-items-end">
                <div class="col-md-4 ms-1">
                    <button type="button" class="btn btn-danger mt-2 p-1 px-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bx bx-upload me-1' style="vertical-align: middle;"></i>
                        <span>Unggah Data</span>
                    </button>
                    <form id="exportForm" action="{{ route('export.qcc.submit') }}" method="GET" style="display: none;">
                        @csrf
                        <input type="hidden" id="juaraExport" name="juara">
                    </form>
                    <button onclick="exportData()" type="button" class="btn btn-info mt-2 p-1 px-2">
                        <i class='bx bx-download me-1' style="vertical-align: middle;"></i>
                        <span>Unduh Data</span>
                    </button>
                </div>
                <div class="col-md-4 text-end pe-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.1rem; margin-top: 2rem; font-size: 10pt;" id="searchp" class="form-control input-text" placeholder="Cari disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.1rem; margin-top: 2rem; border-radius: 0px 5px 5px 0px;" id="search-btn" type="button" disabled><i class="fa fa-search fa-sm"></i></button>

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
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->nik }}</td>
                                    <td>{{ $r->tema }}</td>
                                    <td style="width: 80px;">{{ $r->kontes }}</td>
                                    <td>{{ $r->nama_qcc }}</td>
                                    <td style="width: 80px;">
                                        @if($r->juara_sai == 0 || null)
                                        -
                                        @else
                                        {{ $r->juara_sai }}
                                        @endif
                                    </td>
                                    <td style="width: 80px;">
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