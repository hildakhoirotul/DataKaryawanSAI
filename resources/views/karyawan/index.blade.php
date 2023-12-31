@extends('karyawan.layout.main')

@section('content')
<main class="content px-4">
    <div class="card p-4">
        <div class="container-fluid">
            <h3 class="title text-center">Data Absensi dan Prestasi Karyawan</h3>
            <p class="sub-title">NIK: {{ Auth::user()->nik }}</p>
            <div class="row justify-content-between">
                <!-- ALPHA -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-jenis="A" data-toggle="modal" data-target="#myModal--effect-pulse">
                        <div class="card bg-c-red order-card">
                            <div class="card-block">
                                <h1>A</h1>
                                <h2 class="text-end">{{ $rekap->first()->A }}</h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Alpha Modal -->
                <div class="modal fade" id="myModal--effect-pulse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #DF033F;">
                                <h4 class="modal-title" id="myModalLabel">Tanggal Alpha</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        @if($a->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @else
                                        @php $i=1 @endphp
                                        @foreach($a as $alpha)
                                        <tr>
                                            <td></td>
                                            <td><i class='bx bxs-calendar-alt text-end'></i></td>
                                            <td class="text-end">{{ \Carbon\Carbon::parse($alpha->tanggal)->format('d F Y') }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SAKIT -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse2">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h1>S</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->S }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Sakit Modal -->
                <div class="modal fade" id="myModal--effect-pulse2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #C40E57;">
                                <h4 class="modal-title" id="myModalLabel">Tanggal Sakit</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        @if($s->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @else
                                        @php $i=1 @endphp
                                        @foreach($s as $sakit)
                                        <tr>
                                            <td></td>
                                            <td><i class='bx bxs-calendar-alt text-end'></i></td>
                                            <td class="text-end">{{ \Carbon\Carbon::parse($sakit->tanggal)->format('d F Y') }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sakit Surat Dokter -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse3">
                        <div class="card bg-c-purple200 order-card">
                            <div class="card-block">
                                <h1>SD</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->SD }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- SD Modal -->
                <div class="modal fade" id="myModal--effect-pulse3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #A9196E;">
                                <h4 class="modal-title me-3" id="myModalLabel" style="font-size: 20px;">Sakit dengan Surat Dokter</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        @if($sd->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @else
                                        @php $i=1 @endphp
                                        @foreach($sd as $sakit)
                                        <tr>
                                            <td></td>
                                            <td><i class='bx bxs-calendar-alt text-end'></i></td>
                                            <td class="text-end">{{ \Carbon\Carbon::parse($sakit->tanggal)->format('d F Y') }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- IZIN -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse4">
                        <div class="card bg-c-purple500 order-card">
                            <div class="card-block">
                                <h1>I</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->I }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Izin Modal -->
                <div class="modal fade" id="myModal--effect-pulse4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #8E2386;">
                                <h4 class="modal-title" id="myModalLabel">Tanggal Izin</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped">
                                    <tbody>
                                        @if($iz->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @else
                                        @php $i=1 @endphp
                                        @foreach($iz as $izin)
                                        <tr>
                                            <td></td>
                                            <td><i class='bx bxs-calendar-alt text-end'></i></td>
                                            <td class="text-end">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Izin Terlambat Datang -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse5">
                        <div class="card bg-c-purple order-card">
                            <div class="card-block">
                                <h1>ITD</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->ITD }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- ITD Modal -->
                <div class="modal fade" id="myModal--effect-pulse5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #742E9E;">
                                <h4 class="modal-title" id="myModalLabel" style="font-size: 20px;">Tanggal ITD</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped text-center">
                                    @if($itd->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead>
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($itd as $izin)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                            <td>{{ $izin->jam_masuk }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Terlambat Datang -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse6">
                        <div class="card bg-c-purple700 order-card">
                            <div class="card-block">
                                <h1>TD</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->TD }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- TD Modal -->
                <div class="modal fade" id="myModal--effect-pulse6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #5939B5;">
                                <h4 class="modal-title" id="myModalLabel">Tanggal TD</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped text-center">
                                    @if($td->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead>
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($td as $izin)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                            <td>{{ $izin->jam_masuk }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Izin Cepat Pulang -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse7">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h1>ICP</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->ICP }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- ICP Modal -->
                <div class="modal fade" id="myModal--effect-pulse7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #3E44CD;">
                                <h4 class="modal-title me-3" id="myModalLabel" style="font-size: 20px;">Tanggal Izin Cepat Pulang</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped text-center">
                                    @if($icp->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead>
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Tanggal</th>
                                            <th>Jam Pulang</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($icp as $izin)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                            <td>{{ $izin->jam_pulang }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cepat Pulang -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse8">
                        <div class="card bg-c-purple700 order-card">
                            <div class="card-block">
                                <h1>CP</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->CP }}</span></h2>
                                <span class="arrow">Lihat tanggal<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- CP Modal -->
                <div class="modal fade" id="myModal--effect-pulse8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #5939B5;">
                                <h4 class="modal-title" id="myModalLabel">Tanggal Cepat Pulang</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-borderless table-striped text-center">
                                    @if($cp->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead>
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Tanggal</th>
                                            <th>Jam Pulang</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($cp as $izin)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                            <td>{{ $izin->jam_pulang }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- OCHI -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse9" data-jenis="OCHI">
                        <div class="card bg-c-purple order-card">
                            <div class="card-block">
                                <h1>OCHI</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->OCHI }}</span></h2>
                                <span class="arrow">Lihat detail<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- OCHI Modal -->
                <div class="modal fade" id="myModal--effect-pulse9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #742E9E;">
                                <h4 class="modal-title" id="myModalLabel">Tema OCHI</h4>
                            </div>
                            @if($status)
                            <div class="modal-body pt-0">
                                <table class="table table-borderless text-center table-striped mt-0">
                                    @if($ochi->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead style="font-size: 20px;">
                                        <tr>
                                            <!-- <th></th> -->
                                            <!-- <th>Tema</th> -->
                                            <th>Kontes</th>
                                            <th>Juara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($ochi as $o)
                                        <tr>
                                            <!-- <td></td> -->
                                            <!-- <td style="font-size: 12pt;">{{ $o->tema }}</td> -->
                                            <td style="font-size: 12pt;">{{ $o->kontes }}</td>
                                            <td style="font-size: 12pt;">{{ $o->juara }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="modal-body pt-0">
                                <table class="table table-borderless table-striped mt-0">
                                    @if($ochi->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead style="font-size: 20px;">
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Tema</th>
                                            <th>Kontes</th>
                                            <th>Juara</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($ochi as $o)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td style="font-size: 12pt;">{{ $o->tema }}</td>
                                            <td style="font-size: 12pt;">{{ $o->kontes }}</td>
                                            <td style="font-size: 12pt;">{{ $o->juara }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- QCC -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse10">
                        <div class="card bg-c-purple500 order-card">
                            <div class="card-block">
                                <h1>QCC</h1>
                                <h2 class="text-end"><span>{{ $rekap->first()->QCC }}</span></h2>
                                <span class="arrow">Lihat detail<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- QCC Modal -->
                <div class="modal fade" id="myModal--effect-pulse10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #8E2386;">
                                <h4 class="modal-title" id="myModalLabel">QCC</h4>
                            </div>
                            <div class="modal-body pt-0">
                                @if($status)
                                <table class="table table-borderless text-start table-striped mt-0">
                                    @if($qcc->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead class="align-middle">
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Nama Circle</th>
                                            <!-- <th>Tema</th> -->
                                            <th>Kontes</th>
                                            <th>Juara SAI</th>
                                            <th>Juara PASI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tabel-qcc">
                                        @php $i=1 @endphp
                                        @foreach($qcc as $o)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td>{{ $o->nama_qcc }}</td>
                                            <!-- <td>{{ $o->tema }}</td> -->
                                            <td>{{ $o->kontes }}</td>
                                            <td>
                                                @if($o->juara_sai == 0 || null)
                                                -
                                                @else
                                                {{ $o->juara_sai }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($o->juara_pasi == 0 || null)
                                                -
                                                @else
                                                {{ $o->juara_pasi }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @else
                                <table class="table table-borderless text-start table-striped mt-0">
                                    @if($qcc->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead class="align-middle">
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>Nama Circle</th>
                                            <th>Tema</th>
                                            <th>Kontes</th>
                                            <th>Juara SAI</th>
                                            <th>Juara PASI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tabel-qcc">
                                        @php $i=1 @endphp
                                        @foreach($qcc as $o)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td>{{ $o->nama_qcc }}</td>
                                            <td>{{ $o->tema }}</td>
                                            <td>{{ $o->kontes }}</td>
                                            <td>
                                                @if($o->juara_sai == 0 || null)
                                                -
                                                @else
                                                {{ $o->juara_sai }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($o->juara_pasi == 0 || null)
                                                -
                                                @else
                                                {{ $o->juara_pasi }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- OCHI leader -->
                <div class="col-md-2 p-1 option">
                    <a href="" class="card-link" data-toggle="modal" data-target="#myModal--effect-pulse11">
                        <div class="card bg-c-purple200 order-card">
                            <div class="card-block">
                                <h3>Ochi leader</h3>
                                <h4 class="text-end"><span>{{ $rekap->first()->OCHI_leader }}</span></h4>
                                <span class="arrow">Lihat detail<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- OCHI leader Modal -->
                <div class="modal fade" id="myModal--effect-pulse11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #A9196E;">
                                <h4 class="modal-title" id="myModalLabel">OCHI Leader</h4>
                            </div>
                            <div class="modal-body pt-0">
                                @if($status)
                                <table class="table table-borderless table-striped mt-0">
                                    @if($oleader->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead class="align-middle">
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <th class="text-end">NIK OCHI</th>
                                            <th></th>
                                            <!-- <th class="text-start">Tema</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($oleader as $o)
                                        <tr>
                                            <td></td>
                                            <td><i class='bx bx-user-pin text-end'></i></td>
                                            <td class="text-end">{{ $o->nik }}</td>
                                            <td></td>
                                            <!-- <td style="font-size: 12pt;" class="text-start">{{ $o->tema }}</td> -->
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @else
                                <table class="table table-borderless text-center table-striped mt-0">
                                    @if($oleader->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead class="align-middle">
                                        <tr>
                                            <!-- <th></th> -->
                                            <th>NIK OCHI</th>
                                            <th class="text-start">Tema</th>
                                            <!-- <th></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($oleader as $o)
                                        <tr>
                                            <!-- <td></td> -->
                                            <td style="font-size: 12pt;">{{ $o->nik }}</td>
                                            <td style="font-size: 12pt;" class="text-start">{{ $o->tema }}</td>
                                            <!-- <td></td> -->
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Juara OCHI -->
                <!-- @if($status) -->
                <!-- <div class="col-md-2 p-1 option">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h3>Juara OCHI</h3>
                            <h4 class="text-end" style="font-size: 50pt;"><span>{{ $rekap->first()->Juara_OCHI }}</span></h4>
                        </div>
                    </div>
                </div> -->
                <!-- @else -->
                <!-- <div class="col-md-2 p-1 option">
                    <a href="" data-toggle="modal" data-target="#myModal--effect-pulse12">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h3>Juara OCHI</h3>
                                <h4 class="text-end"><span>{{ $rekap->first()->Juara_OCHI }}</span></h4>
                                <span class="arrow">Lihat detail<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div> -->
                <!-- Juara OCHI Modal -->
                <!-- <div class="modal fade" id="myModal--effect-pulse12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #C40E57;">
                                <h4 class="modal-title" id="myModalLabel">Juara OCHI</h4>
                            </div>
                            <div class="modal-body pt-0">
                                <table class="table table-borderless text-center table-striped mt-0">
                                    @if($jochi->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead class="align-middle" style="font-size: 20px;">
                                        <tr>
                                            <th>Juara</th>
                                            <th>Tema</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1 @endphp
                                        @foreach($jochi as $o)
                                        <tr>
                                            <td style="font-size: 12pt;">{{ $o->juara }}</td>
                                            <td style="font-size: 12pt;">{{ $o->tema }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- @endif -->
            </div>
            <div class="row">
                <!-- Juara QCC -->
                <!-- @if($status) -->
                <!-- <div class="col-md-2 p-1 option">
                    <div class="card bg-c-red order-card">
                        <div class="card-block">
                            <h3>Juara QCC</h3>
                            <h4 class="text-end" style="font-size: 50pt;"><span>{{ $rekap->first()->Juara_QCC }}</span></h4>
                        </div>
                    </div>
                    </div>
                    @else -->
                <!-- <div class="col-md-2 p-1 option">
                    <a href="" data-toggle="modal" data-target="#myModal--effect-pulse13">
                        <div class="card bg-c-red order-card">
                            <div class="card-block">
                                <h3>Juara QCC</h3>
                                <h4 class="text-end"><span>{{ $rekap->first()->Juara_QCC }}</span></h4>
                                <span class="arrow">Lihat detail<i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </a>
                </div> -->
                <!-- Juara QCC Modal -->
                <!-- <div class="modal fade" id="myModal--effect-pulse13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <i class='bx bx-x close mt-3 me-3 align-self-end' type="button" data-dismiss="modal" aria-label="Close"></i>
                            <div class="modal-header justify-content-center" style="background-color: #DF033F;">
                                <h4 class="modal-title" style="font-size: 20px;" id="myModalLabel">Juara QCC</h4>
                            </div>
                            <div class="modal-body pt-0">
                                <table class="table table-borderless text-center table-striped mt-0">
                                    @if($jqcc->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    <thead class="align-middle" style="font-size: 16px;">
                                        <tr>
                                            <th>Juara SAI</th>
                                            <th>Juara PASI</th>
                                            <th>Nama Circle</th>
                                            <th>Tema</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tabel-qcc">
                                        @php $i=1 @endphp
                                        @foreach($jqcc as $o)
                                        <tr>
                                            <td>{{ $o->juara_sai }}</td>
                                            <td>
                                                @if($o->juara_pasi == 0 || null)
                                                -
                                                @else
                                                {{ $o->juara_pasi }}
                                                @endif
                                            </td>
                                            <td>{{ $o->nama_qcc }}</td>
                                            <td>{{ $o->tema }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- @endif -->
            </div>
        </div>
    </div>

    <div class="card mt-2 p-4 mb-3">
        <h4 class="sub-title">
            Mohon Diperhatikan
        </h4>
        <div class="petunjuk ms-3">
            <p>Konfirmasi Absensi ke EB.</p>
            <p>Konfirmasi OCHI & QCC ke Training.</p>
            <p>Perubahan data dapat dilihat kembali setelah 1 bulan.</p>
            <p>Silahkan mengganti password ketika pertama kali masuk sistem.</p>
        </div>

    </div>
</main>
@endsection