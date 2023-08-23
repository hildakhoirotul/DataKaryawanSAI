@extends('karyawan.layout.master')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero">

    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                <div data-aos="zoom-out">
                    <h1>Selamat Datang<span><br>Mohon Diperhatikan</span></h1>
                    <h6>
                        <p>Konfirmasi Absensi ke EB.</p>
                        <p>Konfirmasi OCHI & QCC ke Training.</p>
                        <p>Perubahan data dapat dilihat kembali setelah 1 bulan.</p>
                        <p>Sandi dapat diganti di halaman Ganti Sandi.</p>
                    </h6>
                    <div class="text-center text-md-start text-lg-start">
                        <a href="#main" class="btn-get-started scrollto">Lihat Data<i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
    </svg>

</section><!-- End Hero -->
<main id="main" class="mt-0">
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <!-- <div class="container">
                        <i class="bi bi-emoji-smile"></i>
                    </div> -->
                    <div class="count-box">
                        <div class="count-header">
                            <i class="bi bi-emoji-smile"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $rekap->first()->A }}" data-purecounter-duration="1" class="purecounter"></span>
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
                                        <td><i class='bx bxs-calendar-alt text-end'></i></td>
                                        <td class="text-end">{{ \Carbon\Carbon::parse($alpha->tanggal)->format('d F Y') }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <!-- <div class="container">
                        <i class="bi bi-journal-richtext"></i>
                    </div> -->
                    <div class="count-box">
                        <div class="count-header">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $rekap->first()->TD }}" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Lihat tanggal</p>
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

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <!-- <div class="container">
                        <i class="bi bi-headset"></i>
                    </div> -->
                    <div class="count-box">
                        <div class="count-header">
                            <i class="bi bi-headset"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Hours Of Support</p>
                        </div>
                        <div class="count-content">

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <!-- <div class="container">
                        <i class="bi bi-people"></i>
                    </div> -->
                    <div class="count-box">
                        <div class="count-header">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Hard Workers</p>
                        </div>
                        <div class="count-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Counts Section -->
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<div id="preloader"></div>

<script src="js/jquery.js"></script>

<!-- <script>
    $(".count-header").click(function() {
        var content = $(this).siblings(".count-content");
        content.slideToggle();
        $(this).toggleClass("active");
    });
</script> -->
<script>
    $(".count-header").click(function() {
        var box = $(this).closest(".count-box");
        var content = box.find(".count-content");
        content.slideToggle();

        box.toggleClass("expanded");
    });
</script>
<script>
    const columns = document.querySelectorAll('.col-lg-3, .col-md-6');
    const scrollButtonLeft = document.querySelector('.scroll-button:first-child');
    const scrollButtonRight = document.querySelector('.scroll-button:last-child');
    let currentIndex = 0;

    function scrollColumns(direction) {
        const container = document.querySelector('.row');
        const containerWidth = container.offsetWidth;
        const numColumns = columns.length;
        const numVisibleColumns = Math.floor(containerWidth / columns[0].offsetWidth);

        if (direction === 'left') {
            currentIndex = Math.max(currentIndex - numVisibleColumns, 0);
        } else {
            currentIndex = Math.min(currentIndex + numVisibleColumns, numColumns - numVisibleColumns);
        }

        container.scrollLeft = columns[currentIndex].offsetLeft;
    }

    // Inisialisasi keadaan awal
    scrollColumns('right');
</script>
@endsection