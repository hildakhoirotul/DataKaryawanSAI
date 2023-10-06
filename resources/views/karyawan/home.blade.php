@extends('karyawan.layout.master')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero">

    <div class="container">
        @include('sweetalert::alert')
        <div class="row justify-content-between">
            <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                <div data-aos="zoom-out">
                    <h1>Selamat Datang
                        <p style="margin-top: 15px; font-size: 40px;">{{ Auth::user()->nama }}</p>
                        <span>Mohon Diperhatikan</span>
                    </h1>
                    <h6>
                        @foreach($info as $i)
                        <p>{{ $i->information }}</p>
                        @endforeach
                    </h6>
                    <div class="text-center text-md-start text-lg-start">
                        <a href="#main" class="btn-get-started scrollto">Lihat Data<i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 px-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                <img src="{{ asset('assets/img/4.png') }}" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" class="wave1" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" class="wave2" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" class="wave3" x="50" y="9" fill="#fff">
        </g>
    </svg>

</section><!-- End Hero -->
<main id="main" class="mt-0">
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container mobile">
            <div class="row">
                <!-- SD -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Sakit dengan Surat Dokter</h3>
                            <i class="bi bi-envelope-check"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->SD == '-' || $rekap->first()->SD == '' || $rekap->first()->SD == 0) ? 0 : $rekap->first()->SD }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">
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
                                        <td class="text-start"><i class="bi bi-calendar-week"></i></td>
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
                <!-- S -->
                <div class="col-lg-3 col-md-6 mt-5">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Sakit</h3>
                            <i class="bi bi-thermometer-half"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->S == '-' || $rekap->first()->S == '' || $rekap->first()->S == 0) ? 0 : $rekap->first()->S }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat tanggal</p>
                        </div>
                        <div class="count-content">
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
                                        <td class="text-start"><i class="bi bi-calendar-week"></i></td>
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
                <!-- I -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Izin</h3>
                            <i class="bi bi-person-check"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->I == '-' || $rekap->first()->I == '' || $rekap->first()->I == 0) ? 0 : $rekap->first()->I }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">
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
                                        <td class="text-start"><i class="bi bi-calendar-week"></i></td>
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
                <!-- A -->
                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <div class="count-header">
                            <i class="bi bi-calendar2-x"></i>
                            <h3>Jumlah Alpha</h3>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->A == '-' || $rekap->first()->A == '' || $rekap->first()->A == 0) ? 0 : $rekap->first()->A }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">
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
                                        <td class="text-start"><i class="bi bi-calendar-week"></i></td>
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
                <!-- ITD -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Izin Terlambat Datang</h3>
                            <i class="bi bi-clipboard2-check"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->ITD == '-' || $rekap->first()->ITD == '' || $rekap->first()->ITD == 0) ? 0 : $rekap->first()->ITD }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">
                            <table class="table table-borderless table-striped text-center">
                                @if($itd->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($itd as $izin)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                        <td>
                                            @if($izin->jam_masuk === '00:00:00')
                                            Tidak Checklog
                                            @else
                                            {{ $izin->jam_masuk }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- TD -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Terlambat Datang</h3>
                            <i class="bi bi-alarm"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->TD == '-' || $rekap->first()->TD == '' || $rekap->first()->TD == 0) ? 0 : $rekap->first()->TD }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">
                            <table class="table table-borderless table-striped text-center">
                                @if($td->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($td as $izin)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                        <td>
                                            @if($izin->jam_masuk === '00:00:00')
                                            Tidak Checklog
                                            @else
                                            {{ $izin->jam_masuk }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ICP -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Izin Cepat Pulang</h3>
                            <i class="bi bi-journal-check"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->ICP == '-' || $rekap->first()->ICP == '' || $rekap->first()->ICP == 0) ? 0 : $rekap->first()->ICP }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">
                            <table class="table table-borderless table-striped text-center">
                                @if($icp->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Pulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($icp as $izin)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                        <td>
                                            @if($izin->jam_pulang === '00:00:00')
                                            Tidak Checklog
                                            @else
                                            {{ $izin->jam_pulang }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- CP -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah Cepat Pulang</h3>
                            <i class="bi bi-exclamation-square"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->CP == '-' || $rekap->first()->CP == '' || $rekap->first()->CP == 0) ? 0 : $rekap->first()->CP }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Tanggal</p>
                        </div>
                        <div class="count-content">

                            <table class="table table-borderless table-striped text-center">
                                @if($cp->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jam Pulang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($cp as $izin)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                        <td>
                                            @if($izin->jam_pulang === '00:00:00')
                                            Tidak Checklog
                                            @else
                                            {{ $izin->jam_pulang }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- OCHI -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah OCHI</h3>
                            <i class="bi bi-file-earmark-text"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->OCHI == '-' || $rekap->first()->OCHI == '' || $rekap->first()->OCHI == 0) ? 0 : $rekap->first()->OCHI }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Detail</p>
                        </div>
                        <div class="count-content">
                            @if($status)
                            <table class="table table-borderless text-center table-striped mt-0">
                                @if($ochi->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead style="font-size: 20px;">
                                    <tr>
                                        <th>Kontes</th>
                                        <th>Juara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($ochi as $o)
                                    <tr>
                                        <td style="font-size: 12pt;">{{ $o->kontes }}</td>
                                        <td style="font-size: 12pt;">{{ $o->juara }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @else
                            <table class="table table-borderless table-striped mt-0">
                                @if($ochi->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead style="font-size: 20px;">
                                    <tr>
                                        <th class="text-start">Tema</th>
                                        <th>Kontes</th>
                                        <th>Juara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($ochi as $o)
                                    <tr>
                                        <td style="font-size: 12pt;" class="text-start">{{ $o->tema }}</td>
                                        <td style="font-size: 12pt;">{{ $o->kontes }}</td>
                                        <td style="font-size: 12pt;">{{ $o->juara }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- QCC -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>Jumlah QCC</h3>
                            <i class="bi bi-file-earmark-zip"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->QCC == '-' || $rekap->first()->QCC == '' || $rekap->first()->QCC == 0) ? 0 : $rekap->first()->QCC }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Detail</p>
                        </div>
                        <div class="count-content">
                            @if($status)
                            <table class="table table-borderless text-start table-striped mt-0">
                                @if($qcc->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                <thead class="align-middle">
                                    <tr>
                                        <th>Nama Circle</th>
                                        <th>Kontes</th>
                                        <th>Juara SAI</th>
                                        <th>Juara PASI</th>
                                    </tr>
                                </thead>
                                <tbody class="tabel-qcc">
                                    @php $i=1 @endphp
                                    @foreach($qcc as $o)
                                    <tr>
                                        <td>{{ $o->nama_qcc }}</td>
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
                <!-- OCHI Leader -->
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <div class="count-header">
                            <h3>OCHI Leader</h3>
                            <i class="bi bi-person-badge"></i>
                            @if($rekap->isNotEmpty())
                            <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->OCHI_leader == '-' || $rekap->first()->OCHI_leader == '' || $rekap->first()->OCHI_leader == 0) ? 0 : $rekap->first()->OCHI_leader }}" data-purecounter-duration="1" class="purecounter"></span>
                            @else
                            <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                            @endif
                            <p>Lihat Detail</p>
                        </div>
                        <div class="count-content">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($oleader as $o)
                                    <tr>
                                        <td></td>
                                        <td><i class='bi bi-person-vcard text-end'></i></td>
                                        <td class="text-end">{{ $o->nik }}</td>
                                        <td></td>
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
                                        <th>NIK OCHI</th>
                                        <th class="text-start">Tema</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($oleader as $o)
                                    <tr>
                                        <td style="font-size: 12pt;">{{ $o->nik }}</td>
                                        <td style="font-size: 12pt;" class="text-start">{{ $o->tema }}</td>
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
        </div>
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <!-- SD -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>SD</h3>
                                        <i class="bi bi-envelope-check"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->SD == '-' || $rekap->first()->SD == '' || $rekap->first()->SD == 0) ? 0 : $rekap->first()->SD }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">
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
                                                    <td class="text-start"><i class="bi bi-calendar-week"></i></td>
                                                    <td></td>
                                                    <td class="text-end">{{ \Carbon\Carbon::parse($sakit->tanggal)->format('d F Y') }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- S -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>S</h3>
                                        <i class="bi bi-thermometer-half"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->S == '-' || $rekap->first()->S == '' || $rekap->first()->S == 0) ? 0 : $rekap->first()->S }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat tanggal</p>
                                    </div>
                                    <div class="count-content">
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
                                                    <td class="text-start"><i class="bi bi-calendar-week"></i></td>
                                                    <td></td>
                                                    <td class="text-end">{{ \Carbon\Carbon::parse($sakit->tanggal)->format('d F Y') }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- I -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>I</h3>
                                        <i class="bi bi-person-check"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->I == '-' || $rekap->first()->I == '' || $rekap->first()->I == 0) ? 0 : $rekap->first()->I }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">
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
                                                    <td class="text-start"><i class="bi bi-calendar-week"></i></td>
                                                    <td></td>
                                                    <td class="text-end">{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- A -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <i class="bi bi-calendar2-x"></i>
                                        <h3>A</h3>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->A == '-' || $rekap->first()->A == '' || $rekap->first()->A == 0) ? 0 : $rekap->first()->A }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">
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
                                                    <td class="text-start"><i class="bi bi-calendar-week"></i></td>
                                                    <td></td>
                                                    <td class="text-end">{{ \Carbon\Carbon::parse($alpha->tanggal)->format('d F Y') }}</td>
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
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <!-- ITD -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>ITD</h3>
                                        <i class="bi bi-clipboard2-check"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->ITD == '-' || $rekap->first()->ITD == '' || $rekap->first()->ITD == 0) ? 0 : $rekap->first()->ITD }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">
                                        <table class="table table-borderless table-striped text-center">
                                            @if($itd->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jam Masuk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($itd as $izin)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                                    <td>
                                                        @if($izin->jam_masuk === '00:00:00')
                                                        Tidak Checklog
                                                        @else
                                                        {{ $izin->jam_masuk }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- TD -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>TD</h3>
                                        <i class="bi bi-alarm"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->TD == '-' || $rekap->first()->TD == '' || $rekap->first()->TD == 0) ? 0 : $rekap->first()->TD }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">
                                        <table class="table table-borderless table-striped text-center">
                                            @if($td->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jam Masuk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($td as $izin)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                                    <td>
                                                        @if($izin->jam_masuk === '00:00:00')
                                                        Tidak Checklog
                                                        @else
                                                        {{ $izin->jam_masuk }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ICP -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>ICP</h3>
                                        <i class="bi bi-journal-check"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->ICP == '-' || $rekap->first()->ICP == '' || $rekap->first()->ICP == 0) ? 0 : $rekap->first()->ICP }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">
                                        <table class="table table-borderless table-striped text-center">
                                            @if($icp->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jam Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($icp as $izin)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                                    <td>
                                                        @if($izin->jam_pulang === '00:00:00')
                                                        Tidak Checklog
                                                        @else
                                                        {{ $izin->jam_pulang }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- CP -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>CP</h3>
                                        <i class="bi bi-exclamation-square"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->CP == '-' || $rekap->first()->CP == '' || $rekap->first()->CP == 0) ? 0 : $rekap->first()->CP }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Tanggal</p>
                                    </div>
                                    <div class="count-content">

                                        <table class="table table-borderless table-striped text-center">
                                            @if($cp->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Jam Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($cp as $izin)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d F Y') }}</td>
                                                    <td>
                                                        @if($izin->jam_pulang === '00:00:00')
                                                        Tidak Checklog
                                                        @else
                                                        {{ $izin->jam_pulang }}
                                                        @endif
                                                    </td>
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
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <!-- OCHI -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>OCHI</h3>
                                        <i class="bi bi-file-earmark-text"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->OCHI == '-' || $rekap->first()->OCHI == '' || $rekap->first()->OCHI == 0) ? 0 : $rekap->first()->OCHI }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Detail</p>
                                    </div>
                                    <div class="count-content">
                                        @if($status)
                                        <table class="table table-borderless text-center table-striped mt-0">
                                            @if($ochi->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead style="font-size: 20px;">
                                                <tr>
                                                    <th>Kontes</th>
                                                    <th>Juara</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($ochi as $o)
                                                <tr>
                                                    <td style="font-size: 12pt;">{{ $o->kontes }}</td>
                                                    <td style="font-size: 12pt;">{{ $o->juara }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        @else
                                        <table class="table table-borderless table-striped mt-0">
                                            @if($ochi->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead style="font-size: 20px;">
                                                <tr>
                                                    <th class="text-start">Tema</th>
                                                    <th>Kontes</th>
                                                    <th>Juara</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($ochi as $o)
                                                <tr>
                                                    <td class="text-start">{{ $o->tema }}</td>
                                                    <td>{{ $o->kontes }}</td>
                                                    <td>{{ $o->juara }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- QCC -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>QCC</h3>
                                        <i class="bi bi-file-earmark-zip"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->QCC == '-' || $rekap->first()->QCC == '' || $rekap->first()->QCC == 0) ? 0 : $rekap->first()->QCC }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Detail</p>
                                    </div>
                                    <div class="count-content">
                                        @if($status)
                                        <table class="table table-borderless text-start table-striped mt-0">
                                            @if($qcc->isEmpty())
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @else
                                            <thead class="align-middle">
                                                <tr>
                                                    <th>Nama Circle</th>
                                                    <th style="min-width: 90px;">Kontes</th>
                                                    <th style="min-width: 80px;">Juara SAI</th>
                                                    <th style="min-width: 80px;">Juara PASI</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tabel-qcc">
                                                @php $i=1 @endphp
                                                @foreach($qcc as $o)
                                                <tr>
                                                    <td>{{ $o->nama_qcc }}</td>
                                                    <td style="min-width: 90px;">{{ $o->kontes }}</td>
                                                    <td style="min-width: 80px;">
                                                        @if($o->juara_sai == 0 || null)
                                                        -
                                                        @else
                                                        {{ $o->juara_sai }}
                                                        @endif
                                                    </td>
                                                    <td style="min-width: 80px;">
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
                                                    <th>Nama Circle</th>
                                                    <th style="min-width: 150px;">Tema</th>
                                                    <th style="min-width: 90px;">Kontes</th>
                                                    <th style="min-width: 80px;">Juara SAI</th>
                                                    <th style="min-width: 80px;">Juara PASI</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tabel-qcc">
                                                @php $i=1 @endphp
                                                @foreach($qcc as $o)
                                                <tr>
                                                    <td>{{ $o->nama_qcc }}</td>
                                                    <td style="min-width: 150px;">{{ $o->tema }}</td>
                                                    <td style="min-width: 90px;">{{ $o->kontes }}</td>
                                                    <td style="min-width: 80px;">
                                                        @if($o->juara_sai == 0 || null)
                                                        -
                                                        @else
                                                        {{ $o->juara_sai }}
                                                        @endif
                                                    </td>
                                                    <td style="min-width: 80px;">
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
                            <!-- OCHI Leader -->
                            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                                <div class="count-box">
                                    <div class="count-header">
                                        <h3>OCHI Leader</h3>
                                        <i class="bi bi-person-badge"></i>
                                        @if($rekap->isNotEmpty())
                                        <span data-purecounter-start="0" data-purecounter-end="{{ ($rekap->first()->OCHI_leader == '-' || $rekap->first()->OCHI_leader == '' || $rekap->first()->OCHI_leader == 0) ? 0 : $rekap->first()->OCHI_leader }}" data-purecounter-duration="1" class="purecounter"></span>
                                        @else
                                        <span data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        @endif
                                        <p>Lihat Detail</p>
                                    </div>
                                    <div class="count-content">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($oleader as $o)
                                                <tr>
                                                    <td></td>
                                                    <td><i class='bi bi-person-vcard text-end'></i></td>
                                                    <td class="text-end">{{ $o->nik }}</td>
                                                    <td></td>
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
                                                    <th>NIK OCHI</th>
                                                    <th class="text-start">Tema</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1 @endphp
                                                @foreach($oleader as $o)
                                                <tr>
                                                    <td>{{ $o->nik }}</td>
                                                    <td class="text-start">{{ $o->tema }}</td>
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
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                <span class="swipe">Geser</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="swipe">Geser</span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </section><!-- End Counts Section -->
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<script src="{{ asset('js/jquery.js') }}"></script>

<script>
    $(".mobile .count-box").click(function() {
        var box = $(this).closest(".count-box");
        var content = box.find(".count-content");
        content.slideToggle();

        box.toggleClass("expanded");
    });
</script>
<script>
    $(document).ready(function() {
        $(".carousel .count-box").click(function() {
            var box = $(this).closest(".count-box");
            var content = box.find(".count-content");

            $(".count-box.expanded").not(box).removeClass("expanded");
            $(".count-content").not(content).slideUp();

            content.slideToggle();
            box.toggleClass("expanded");
        });
    });
</script>
@endsection