@extends('admin.layout.main')
@section('title', 'Petunjuk')

@section('content')
<main class="content">
    <div class="row">
        <section id="faq" class="faq section-bg">
            <div class="container-fluid">
                <div class="section-title" data-aos="fade-up">
                    <h2 class="mb-0 ms-1">Setting</h2>
                    <p>Petunjuk Penggunaan</p>
                </div>
                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Sidebar<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/dashboard.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p><span style="font-weight: 600;">Rekapitulasi : </span>berisi data ringkasan dari jumlah SD, S, I, A, ITD, TD, ICP, OCHI, QCC dan Ochi Leader.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/data.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p><span style="font-weight: 600;">Absensi : </span>berisi data jenis absensi (SD, S, I, A, ITD, TD, ICP) beserta tanggal, jam masuk dan jam pulangnya.</p>
                                                <p><span style="font-weight: 600;">OCHI : </span>berisi data Tema OCHI, Kontes, OCHI Leader dan Juara yang pernah diraih.</p>
                                                <p><span style="font-weight: 600;">QCC : </span>berisi data Tema QCC, Kontes, Nama Circle, Juara SAI dan Juara PASI.</p>
                                                <p><span style="font-weight: 600;">Data Karyawan : </span>berisi data dari seluruh akun karyawan (NIK, Nama, Password). Data ini yang akan digunakan karyawan untuk melakukan login.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/setting.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p><span style="font-weight: 600;">Pengaturan : </span>halaman untuk fitur disable tema pada OCHI, QCC dan OCHI Leader serta mengatur informasi yang ditampilkan di halaman karyawan.</p>
                                                <p><span style="font-weight: 600;">Instruksi : </span>berisi petunjuk penggunaan aplikasi.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/expand.png') }}" alt="" style="width: 10rem;"><br><br>
                                                <img src="{{ asset('assets/img/petunjuk/collapse.png') }}" alt="" style="width: 10rem;">
                                            </td>
                                            <td>
                                                <p>Klik expand untuk selalu membuka sidebar.</p>
                                                <p>Klik collapse untuk menutup sidebar. Sidebar terbuka setiap kursor mendekati sidebar.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Tombol Unggah, Unduh, Update, Template, Hapus, dan Reset<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/unggah.png') }}" alt="" class="button">
                                            </td>
                                            <td>
                                                <p>Upload data excel ke dalam sistem.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/unduh.png') }}" alt="" class="button">
                                            </td>
                                            <td>
                                                <p>Download data dengan format file excel.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/update.png') }}" alt="" class="button">
                                            </td>
                                            <td>
                                                <p>Klik untuk memperbarui rekapitulasi. Hasil rekapitulasi didapatkan dari data Absensi, OCHI, QCC, dan Data Karyawan.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/template.png') }}" alt="" class="button">
                                            </td>
                                            <td>
                                                <p>Download template data yang akan diupload dengan format excel.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/remove.png') }}" alt="" style="width: 6rem;">
                                            </td>
                                            <td>
                                                <p>Menghapus data yang dicentang pada tabel.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/reset.png') }}" alt="" style="width: 4rem;">
                                            </td>
                                            <td>
                                                <p>Menghapus seluruh data yang ada pada tabel.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/import_modal.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p>Akan muncul pop up untuk memilih file yang akan diupload, klik import untuk memproses unggah data.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Pencarian dan Filter<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/search.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p>Ketik keyword disini untuk melakukan pencarian.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/filter_jenis.png') }}" alt="" style="width: 4rem;">
                                            </td>
                                            <td>
                                                <p>Klik untuk memfilter data berdasarkan jenis.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/filter_juara.png') }}" alt="" style="width: 4rem;">
                                            </td>
                                            <td>
                                                <p>Klik untuk memfilter data berdasarkan juara.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/baris.png') }}" alt="" style="width: 4rem;">
                                            </td>
                                            <td>
                                                <p>Pilih jumlah baris data yang ingin ditampilkan.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/filter_tanggal.png') }}" alt="" style="width: 8rem;">
                                            </td>
                                            <td>
                                                <p>Pilih tanggal, bulan dan tahun untuk memfilter data berdasarkan tanggal.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Toggler dan Delete<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/toggler.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p>Klik ikon berbentuk mata untuk melihat password.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/delete.png') }}" alt="" style="width: 4rem;">
                                            </td>
                                            <td>
                                                <p>Tombol untuk menghapus data.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Pengaturan Disable Tema dan Informasi di Halaman Karyawan<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/disable1.png') }}" alt="" style="width: 11rem;">
                                                <img src="{{ asset('assets/img/petunjuk/disable2.png') }}" alt="" style="width: 6rem;">
                                            </td>
                                            <td>
                                                <p>Off = untuk menampilkan kolom tema di OCHI, QCC, dan OCHI Leader di halaman karyawan.</p>
                                                <img src="{{ asset('assets/img/petunjuk/tema_off.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/disable1.png') }}" alt="" style="width: 11rem;">
                                                <img src="{{ asset('assets/img/petunjuk/disable3.png') }}" alt="" style="width: 5rem;">
                                            </td>
                                            <td>
                                                <p>On = untuk menghilangkan kolom tema di OCHI, QCC, dan OCHI Leader di halaman karyawan</p>
                                                <img src="{{ asset('assets/img/petunjuk/tema_on.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/add_info.png') }}" alt="" style="width:16rem;">
                                            </td>
                                            <td>
                                                <p>Ketik disini untuk menambahkan informasi di halaman karyawan.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/save_info.png') }}" alt="" style="width:16rem;">
                                            </td>
                                            <td>
                                                <p>Klik save untuk menyimpan informasi. Informasi akan tersimpan di halaman admin dan karyawan.</p>
                                                <p style="font-style: italic;font-size: 12px;font-weight: 500;">Halaman Admin :</p>
                                                <img src="{{ asset('assets/img/petunjuk/info.png') }}" alt="" style="width:20rem;">
                                                <p style="font-style: italic;font-size: 12px;font-weight: 500;">Halaman Karyawan :</p>
                                                <img src="{{ asset('assets/img/petunjuk/info_home.png') }}" alt="" style="width:20rem;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/plus.png') }}" alt="" style="width:3rem;">
                                            </td>
                                            <td>
                                                <p>Klik tombol (+) jika informasi yang ditambahkan lebih dari 1.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/x.png') }}" alt="" style="width:3rem;">
                                            </td>
                                            <td>
                                                <p>Tombol (x) untuk menghapus box.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/edit1.png') }}" alt="" style="width:20rem;"><br><br>
                                                <img src="{{ asset('assets/img/petunjuk/edit2.png') }}" alt="" style="width:20rem;">
                                            </td>
                                            <td>
                                                <p>Klik informasi jika ingin melakukan edit data.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/simpan.png') }}" alt="" style="width:5rem;"><br>
                                            </td>
                                            <td>
                                                <p>Klik Simpan untuk menyimpan informasi yang telah diedit.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/hapus.png') }}" alt="" style="width:5rem;"><br>
                                            </td>
                                            <td>
                                                <p>Hapus untuk menghapus informasi yang ada.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">Darkmode dan Dropdown<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/account.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                            <td>
                                                <p>Arahkan kursor ke NIK di pojok kanan atas untuk menampilkan dropdown ke halaman ganti sandi dan keluar dari akun.</p>
                                                <img src="{{ asset('assets/img/petunjuk/dropdown.png') }}" alt="" style="width: 15rem;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/darkmode.png') }}" alt="" style="width: 4rem;">
                                            </td>
                                            <td>
                                                <p>Klik untuk merubah ke mode gelap. Klik kembali bila ingin merubah ke mode terang.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="600">
                            <i class="bi bi-question-circle icon-help" style="font-size: 1rem;"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">Urutan Memasukkan Data<i class="bi bi-caret-down-fill icon-show"></i><i class="bi bi-caret-up-fill icon-close"></i></a>
                            <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/upload1.png') }}" alt="" style="width: 30rem;">
                                            </td>
                                            <td>
                                                <p>Silahkan Upload terlebih dahulu data karyawan yang berisikan NIK 6 digit, Nama dan Password.</p>
                                                <p>1. Klik tombol Unggah Data untuk mulai memasukkan data. Silahkan unduh template terlebih dahulu pada tombol "Template".</p>
                                                <p>2. Silahkan tunggu hingga proses selesai.</p>
                                                <p>3. Pastikan tidak ada duplikasi pada data.</p>
                                                <p>4. Apabila terjadi kegagalan upload, coba kurangi jumlah data yang diupload.</p>
                                                <p>5. Pesan berhasil akan muncul setelah data terupload dengan benar.</p>
                                                <img src="{{ asset('assets/img/petunjuk/success.png') }}" alt="" style="width: 18rem;">
                                                <p>6. Pesan error akan muncul dengan keterangan data yang tidak valid. Data yang tidak valid, tidak akan terupload. Silahkan perbaiki data kemudian upload ulang.</p>
                                                <img src="{{ asset('assets/img/petunjuk/error1.png') }}" alt="" style="width: 18rem;">
                                                <p>7. Pada data karyawan ini, setiap melakukan upload data, data yang sudah ada tidak akan terhapus. Apabila terdapat NIK yang sama, maka data akan terupdate sementara NIK yang sebelumnya tidak ada akan ditambahkan.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/upload2.png') }}" alt="" style="width: 30rem;">
                                                <img src="{{ asset('assets/img/petunjuk/upload3.png') }}" alt="" style="width: 30rem;">
                                                <img src="{{ asset('assets/img/petunjuk/upload4.png') }}" alt="" style="width: 30rem;">
                                            </td>
                                            <td>
                                                <p>Setelah upload data karyawan, data selanjutnya ialah data Absensi, OCHI dan QCC</p>
                                                <p>1. Klik tombol Unggah Data untuk mulai memasukkan data. Silahkan unduh template terlebih dahulu pada tombol "Template".</p>
                                                <p>2. Silahkan tunggu hingga proses selesai.</p>
                                                <p>3. Pastikan tidak ada duplikasi pada data.</p>
                                                <p>4. Apabila terjadi kegagalan upload, coba kurangi jumlah data yang diupload.</p>
                                                <p>5. Pesan berhasil akan muncul setelah data terupload dengan benar.</p>
                                                <img src="{{ asset('assets/img/petunjuk/success.png') }}" alt="" style="width: 15rem;">
                                                <p>6. Pesan error akan muncul dengan keterangan data yang tidak valid. Data yang tidak valid, tidak akan terupload. Silahkan perbaiki data kemudian upload ulang.</p>
                                                <img src="{{ asset('assets/img/petunjuk/error2.png') }}" alt="" style="width: 18rem;">
                                                <img src="{{ asset('assets/img/petunjuk/error3.png') }}" alt="" style="width: 18rem;">
                                                <img src="{{ asset('assets/img/petunjuk/error4.png') }}" alt="" style="width: 18rem;">
                                                <p>7. Pada data Absensi, OCHI dan QCC, setiap melakukan upload data, data yang sudah ada akan terhapus dan digantikan dengan data yang baru.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/petunjuk/upload5.png') }}" alt="" style="width: 30rem;">
                                            </td>
                                            <td>
                                                <p>Setelah semua data sudah terunggah, Silahkan Update data pada Rekapitulasi untuk mendapatkan jumlah total dari setiap data.</p>
                                                <p>1. Klik tombol Update Data untuk memulai update. Anda juga dapat melakukan unggah data dengan mengunduh template terlebih dahulu pada tombol "Template".</p>
                                                <p>2. Silahkan tunggu hingga proses selesai.</p>
                                                <p>3. Begitu selesai, data akan otomatis terupdate.</p>
                                                <p>4. Apabila terdapat perubahan data pada data karyawan, absensi, OCHI maupun QCC, silahkan lakukan update data kembali pada rekapitulasi.</p>
                                                <p>5. Pada data Rekapitulasi ini, apabila anda melakukan unggah data maka data yang sudah ada akan terhapus dan digantikan dengan data yang baru.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </section>
        <!-- </div> -->
    </div>
</main>
@endsection