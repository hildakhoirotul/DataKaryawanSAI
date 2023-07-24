@extends('admin.layout.main')

@section('content')

<div class="row">
    <!-- <div class="col-md-12"> -->
    <div class="card p-4">
        <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
        <h4 class="ms-3">Data Absensi Karyawan</h4>
        <!-- <a href="#"> -->
        <div class="col-md-4 ms-3">
            <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#importExcel">
                <i class='bx bx-upload me-2'></i>
                <span>Unggah Data</span>
            </button>
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
                <table class="table table-striped text-center table-bordered border-light">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIK</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1 @endphp
                        @foreach($absensi as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->nik }}</td>
                            <td>{{ $r->jenis }}</td>
                            <td>{{ $r->tanggal }}</td>
                            <td>{{ $r->jam_masuk }}</td>
                            <td>{{ $r->jam_pulang }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $absensi->links()}}
            </div>

            <!-- </div> -->
        </div>
    </div>

</div>
@endsection