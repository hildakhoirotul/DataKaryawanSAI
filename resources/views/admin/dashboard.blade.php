@extends('admin.layout.main')
@section('title', 'Rekapitulasi')

@section('content')
<main class="content p-2 pt-3">
    <div class="row">
        <div class="card p-4">
            <h5 class="mb-0 ms-1">Rekapitulasi Data Karyawan</h5>
            <div class="jumlah-data text-nowrap border px-2">
                Jumlah data : {{ $total }}
            </div>
            <div class="row mt-2 justify-content-between align-items-end">

                <div class="col-md-7 ms-1">
                    <button type="button" class="btn btn-danger mt-2 p-1 px-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bi bi-cloud-upload me-1' style="vertical-align: middle;"></i>
                        <span>Unggah Data</span>
                    </button>
                    <a href="{{ route('export.excel.submit') }}" class="btn unduh btn-info mt-2 ms-1 p-1 px-2">
                        <i class='bi bi-cloud-download me-1'></i>
                        <span>Unduh Data</span>
                    </a>
                    <a href="{{ route('update.rekap') }}" class="btn unduh btn-warning mt-2 ms-1 p-1 px-2">
                        <i class="bi bi-pencil-square"></i>
                        <span>Update Data</span>
                    </a>
                    <a href="{{ url('/unduh/template_rekapitulasi.xlsx') }}" class="btn unduh btn-outline-success mt-2 ms-1 p-1 px-2">
                        <i class='bi bi-cloud-download me-1'></i>
                        <span>Template</span>
                    </a>
                </div>
                <!-- <div class="col-md-2 p-0 m-0">
                    <span>Jumlah data : {{ $total }}</span>
                </div> -->
                <div class="col-md-3 pe-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.2rem; font-size: 10pt;" id="searchp" class="form-control input-text" placeholder="Cari NIK disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.2rem;" id="search-btn" type="button" disabled><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>

            <!-- Modal Impor-->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('import.excel.submit') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header p-2 px-3">
                                <h5 class="modal-title" id="importExcelLabel">Import Data Excel</h5>
                            </div>
                            <div class="modal-body px-3 pt-2 pb-1 mb-0">
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
            <!-- End Modal -->

            <!-- Modal Pesan Error -->
            <!-- End Modal -->

            <div class="row mt-0">
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped text-center table-bordered border-light">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIK</th>
                                    <th>SD</th>
                                    <th>S</th>
                                    <th>I</th>
                                    <th>A</th>
                                    <th>ITD</th>
                                    <th>ICP</th>
                                    <th>TD</th>
                                    <th>OCHI</th>
                                    <th>QCC</th>
                                    <th>OCHI Leader</th>
                                </tr>
                            </thead>
                            <tbody id="absensiTableBody">
                                @php $i=1 @endphp
                                @foreach($rekap as $r)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $r->nik }}</td>
                                    <td>
                                        @if($r->SD == 0 || null)
                                        -
                                        @else
                                        {{ $r->SD }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->S == 0 || null)
                                        -
                                        @else
                                        {{ $r->S }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->I == 0 || null)
                                        -
                                        @else
                                        {{ $r->I }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->A == 0 || null)
                                        -
                                        @else
                                        {{ $r->A }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->ITD == 0 || null)
                                        -
                                        @else
                                        {{ $r->ITD }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->ICP == 0 || null)
                                        -
                                        @else
                                        {{ $r->ICP }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->TD == 0 || null)
                                        -
                                        @else
                                        {{ $r->TD }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->OCHI == 0 || null)
                                        -
                                        @else
                                        {{ $r->OCHI }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->QCC == 0 || null)
                                        -
                                        @else
                                        {{ $r->QCC }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->OCHI_leader == 0 || null)
                                        -
                                        @else
                                        {{ $r->OCHI_leader }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3" id="paging">
                        {{ $rekap->links()}}
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>
<script>
    function myFunction() {
        const selected = document.getElementById('searchp').value;

        fetch(`{{ route('search.rekap') }}?nik=${selected}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('absensiTableBody').innerHTML = data;
            });
        document.getElementById('paging').style.display = "none";
    }

    document.getElementById('searchp').addEventListener('input', function() {
        myFunction();
    });
</script>
@endsection