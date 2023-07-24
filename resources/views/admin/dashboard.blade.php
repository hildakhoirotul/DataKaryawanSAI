@extends('admin.layout.main')

@section('content')

<div class="row">
    <!-- <div class="col-md-12"> -->
    <div class="card p-4">
        <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
        <h4 class="ms-2">Rekapitulasi Data Karyawan</h4>
        <!-- <a href="#"> -->
        <div class="row">
            <div class="col-md-8 ms-2">
                <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#importExcel">
                    <i class='bx bx-upload me-2'></i>
                    <span>Unggah Data</span>
                </button>
                <a href="/export-excel" class="btn btn-info mt-2 ms-1">
                    <i class='bx bx-download me-2'></i>
                    <span>Unduh Data</span>
                </a>
                <!-- <button type="button" class="btn btn-info mt-2 ms-1" data-toggle="modal" data-target="#exportExcel">
                    <i class='bx bx-download me-2'></i>
                    <span>Unduh Data</span>
                </button> -->
            </div>
        </div>


        <!-- </a> -->

        <!-- Modal Impor-->
        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="importExcelLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('import.excel.submit') }}" method="post" enctype="multipart/form-data">
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
        <!-- End Modal -->

        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center table-bordered border-light">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIK</th>
                                <th>S</th>
                                <th>SD</th>
                                <th>I</th>
                                <th>A</th>
                                <th>ITD</th>
                                <th>ICP</th>
                                <th>TD</th>
                                <th>CP</th>
                                <th>OCHI</th>
                                <th>QCC</th>
                                <th>OCHI Leader</th>
                                <th>Juara OCHI</th>
                                <th>Juara QCC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach($rekap as $r)
                            <tr>
                                <td>{{ $r->id }}</td>
                                <td>{{ $r->nik }}</td>
                                <td>{{ $r->SD }}</td>
                                <td>{{ $r->S }}</td>
                                <td>{{ $r->I }}</td>
                                <td>{{ $r->A }}</td>
                                <td>{{ $r->ITD }}</td>
                                <td>{{ $r->ICP }}</td>
                                <td>{{ $r->TD }}</td>
                                <td>{{ $r->CP }}</td>
                                <td>{{ $r->OCHI }}</td>
                                <td>{{ $r->QCC }}</td>
                                <td>{{ $r->OCHI_leader }}</td>
                                <td>{{ $r->Juara_OCHI }}</td>
                                <td>{{ $r->Juara_QCC }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {{ $rekap->links()}}
                </div>

                <!-- </div> -->
            </div>
        </div>

    </div>

</div>
@endsection