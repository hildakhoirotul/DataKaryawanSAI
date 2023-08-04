@extends('admin.layout.main')

@section('content')
<main class="content p-2 pt-5">
    <div class="row">
        <!-- <div class="col-md-12"> -->
        <div class="card p-4">
            <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->
            <h4 class="mb-0">Rekapitulasi Data Karyawan</h4>
            <div class="jumlah-data text-nowrap border px-2">
                Jumlah data : {{ $total }}
            </div>
            <!-- <a href="#"> -->
            <div class="row mt-2 justify-content-between align-items-end">

                <div class="col-md-5">
                    <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#importExcel">
                        <i class='bx bx-upload me-2'></i>
                        <span>Unggah Data</span>
                    </button>
                    <a href="/export-excel" class="btn btn-info mt-2 ms-1">
                        <i class='bx bx-download me-2'></i>
                        <span>Unduh Data</span>
                    </a>
                </div>
                <!-- <div class="col-md-2 p-0 m-0">
                    <span>Jumlah data : {{ $total }}</span>
                </div> -->
                <div class="col-md-3 pe-3">
                    <div class="input-group">
                        <!-- <div class="search-container"> -->
                        <input type="text" name="search" style="height: 2.5rem;" id="searchp" onkeyup="myFunction()" class="form-control input-text" placeholder="Cari NIK disini ...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-secondary btn-lg" style="height: 2.5rem;" id="search-btn" type="button" disabled><i class="fa fa-search fa-sm"></i></button>
                    </div>
                </div>
            </div>

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
                                        @if($r->CP == 0 || null)
                                        -
                                        @else
                                        {{ $r->CP }}
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
                                    <td>
                                        @if($r->Juara_OCHI == 0 || null)
                                        -
                                        @else
                                        {{ $r->Juara_OCHI }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->Juara_QCC == 0 || null)
                                        -
                                        @else
                                        {{ $r->Juara_QCC }}
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

    </div>
</main>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchp");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

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
@endsection