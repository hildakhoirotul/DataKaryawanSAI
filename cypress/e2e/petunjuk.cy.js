describe('Admin Dashboard - Pengaturan', () => {
  beforeEach(() => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'http://127.0.0.1:8000/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Petunjuk').click()
  });

  it('displays informations on the page', () => {
    // navbar
    cy.get('.bi-brightness-high').should('exist')
    cy.contains('000000').should('exist');
    cy.get('.img').should('have.attr', 'src', 'assets/img/account.png');
    cy.get('.nav-link').trigger('mouseover');
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')
    // sidebar
    cy.get('.sidebar').should('exist')
    cy.get('.sidebar').trigger('mouseover')
    cy.get('.menu_dahsboard').should('exist')
    cy.get('.bi-table').should('exist')
    cy.contains('Rekapitulasi').should('exist')
    cy.get('.menu_editor').should('exist')
    cy.get('.bi-person-check').should('exist')
    cy.contains('Absensi').should('exist')
    cy.get('.bi-journal-text').should('exist')
    cy.contains('OCHI').should('exist')
    cy.get('.bi-journals').should('exist')
    cy.contains('QCC').should('exist')
    cy.get('.bi-person-vcard').should('exist')
    cy.contains('Data Karyawan').should('exist')
    cy.get('.menu_setting').should('exist')
    cy.get('.bi-gear').should('exist')
    cy.contains('Pengaturan').should('exist')
    cy.get('.bi-chat-dots').should('exist')
    cy.contains('Petunjuk').should('exist')
    cy.contains('Expand').should('exist')
    cy.contains('Expand').click({ force: true })
    cy.contains('Collapse').should('exist')
    // content
    cy.contains('Setting').should('exist');
    cy.contains('Petunjuk Penggunaan').should('exist');
    // sidebar
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Sidebar').should('exist')
    // cy.contains('Sidebar').click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/dashboard.png');
    cy.contains('Rekapitulasi :').should('exist')
    cy.contains('berisi data ringkasan dari jumlah SD, S, I, A, ITD, TD, ICP, OCHI, QCC dan Ochi Leader.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/data.png');
    cy.contains('Absensi : ').should('exist')
    cy.contains('berisi data jenis absensi (SD, S, I, A, ITD, TD, ICP) beserta tanggal, jam masuk dan jam pulangnya.').should('exist')
    cy.contains('OCHI : ').should('exist')
    cy.contains('berisi data Tema OCHI, Kontes, OCHI Leader dan Juara yang pernah diraih.').should('exist')
    cy.contains('QCC : ').should('exist')
    cy.contains('berisi data Tema qcc, Kontes, Nama Circle, Juara SAI dan Juara PASI.').should('exist')
    cy.contains('Data Karyawan :').should('exist')
    cy.contains('berisi data dari seluruh akun karyawan (NIK, Nama, Password). Data ini yang akan digunakan karyawan untuk melakukan login.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/setting.png');
    cy.contains('Pengaturan :').should('exist')
    cy.contains('halaman untuk fitur disable tema pada OCHI, QCC dan OCHI Leader serta mengatur informasi yang ditampilkan di halaman karyawan.').should('exist')
    cy.contains('Instruksi :').should('exist')
    cy.contains('berisi petunjuk penggunaan aplikasi.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/expand.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/collapse.png');
    cy.contains('Klik expand untuk selalu membuka sidebar.').should('exist')
    cy.contains('Klik collapse untuk menutup sidebar. Sidebar terbuka setiap kursor mendekati sidebar.').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');
    
    // Unggah, Unduh, Update, Template, Hapus
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Tombol Unggah, Unduh, Update, Template, dan Hapus').should('exist')
    cy.get('.bi.bi-caret-down-fill').eq(1).click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/unggah.png');
    cy.contains('Upload data excel ke dalam sistem.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/unduh.png');
    cy.contains('Download data dengan format file excel.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/update.png');
    cy.contains('Klik untuk memperbarui rekapitulasi. Hasil rekapitulasi didapatkan dari data Absensi, OCHI, QCC, dan Data Karyawan.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/template.png');
    cy.contains('Download template excel.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/remove.png');
    cy.contains('Menghapus data yang dicentang pada tabel.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/import_modal.png');
    cy.contains('Akan muncul pop up untuk memilih file yang akan diupload, klik import untuk memproses unggah data.').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');
    
    // Pencarian dan filter
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Pencarian dan Filter').should('exist')
    cy.get('.bi.bi-caret-down-fill').eq(2).click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/search.png');
    cy.contains('Ketik keyword disini untuk melakukan pencarian.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/filter_jenis.png');
    cy.contains('Klik untuk memfilter data berdasarkan jenis.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/filter_juara.png');
    cy.contains('Klik untuk memfilter data berdasarkan juara.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/baris.png');
    cy.contains('Pilih jumlah baris data yang ingin ditampilkan.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/filter_tanggal.png');
    cy.contains('Pilih tanggal, bulan dan tahun untuk memfilter data berdasarkan tanggal.').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');
    
    // Toggler dan Delete
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Toggler dan Delete').should('exist')
    cy.get('.bi.bi-caret-down-fill').eq(3).click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/toggler.png');
    cy.contains('Klik ikon berbentuk mata untuk melihat password.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/delete.png');
    cy.contains('Tombol untuk menghapus data.').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');

    // Pengaturan Disable Tema dan Informasi di Halaman Karyawan
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Pengaturan Disable Tema dan Informasi di Halaman Karyawan').should('exist')
    cy.get('.bi.bi-caret-down-fill').eq(3).click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/disable1.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/disable2.png');
    cy.contains('Off = untuk menampilkan kolom tema di OCHI, QCC, dan OCHI Leader di halaman karyawan.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/tema_off.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/disable3.png');
    cy.contains('On = untuk menghilangkan kolom tema di OCHI, QCC, dan OCHI Leader di halaman karyawan').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/tema_on.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/add_info.png');
    cy.contains('Ketik disini untuk menambahkan informasi di halaman karyawan.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/save_info.png');
    cy.contains('Klik save untuk menyimpan informasi. Informasi akan tersimpan di halaman admin dan karyawan.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/info.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/info_home.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/plus.png');
    cy.contains('Klik tombol + jika informasi yang ditambahkan lebih dari 1.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/x.png');
    cy.contains('Tombol x untuk menghapus box.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/edit1.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/edit2.png');
    cy.contains('Klik informasi jika ingin melakukan edit data.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/simpan.png');
    cy.contains('Klik Simpan untuk menyimpan informasi yang telah diedit.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/hapus.png');
    cy.contains('Hapus untuk menghapus informasi yang ada.').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');

    // Darkmode dan Dropdown
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Darkmode dan Dropdown').should('exist')
    cy.get('.bi.bi-caret-down-fill').eq(4).click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/account.png');
    cy.contains('Arahkan kursor ke NIK di pojok kanan atas untuk menampilkan dropdown ke halaman ganti sandi dan keluar dari akun.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/dropdown.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/darkmode.png');
    cy.contains('Klik untuk merubah ke mode gelap. Klik kembali bila ingin merubah ke mode terang.').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');

    // Urutan Memasukkan Data
    cy.get('.bi.bi-question-circle').should('exist')
    cy.contains('Urutan Memasukkan Data').should('exist')
    cy.get('.bi.bi-caret-down-fill').eq(5).click()
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/upload1.png');
    cy.contains('Silahkan Upload terlebih dahulu data karyawan yang berisikan NIK 6 digit, Nama dan Password.').should('exist')
    cy.contains('1. Klik tombol Unggah Data untuk mulai memasukkan data. Silahkan unduh template terlebih dahulu pada tombol "Template".').should('exist')
    cy.contains('2. Silahkan tunggu hingga proses selesai.').should('exist')
    cy.contains('3. Pastikan tidak ada duplikasi pada data.').should('exist')
    cy.contains('4. Apabila terjadi kegagalan upload, coba kurangi jumlah data yang diupload.').should('exist')
    cy.contains('5. Pesan berhasil akan muncul setelah data terupload dengan benar.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/success.png');
    cy.contains('6. Pesan error akan muncul dengan keterangan data yang tidak valid. Data yang tidak valid, tidak akan terupload. Silahkan perbaiki data kemudian upload ulang.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/error1.png');
    cy.contains('7. NIK tidak valid artinya NIK tersebut belum ada di data karyawan. Silahkan tambahkan data NIK, Nama dan Password pada data karyawan agar NIK tersebut menjadi valid.').should('exist')
    cy.contains('8. Pada data karyawan ini, setiap melakukan upload data, data yang sudah ada tidak akan terhapus. Apabila terdapat data yang sama, maka akan terupdate sementara data yang tidak ada akan ditambahkan.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/upload2.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/upload3.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/upload4.png');
    cy.contains('Setelah upload data karyawan, data selanjutnya ialah data Absensi, OCHI dan QCC').should('exist')
    cy.contains('1. Klik tombol Unggah Data untuk mulai memasukkan data. Silahkan unduh template terlebih dahulu pada tombol "Template".').should('exist')
    cy.contains('2. Silahkan tunggu hingga proses selesai.').should('exist')
    cy.contains('3. Pastikan tidak ada duplikasi pada data.').should('exist')
    cy.contains('4. Apabila terjadi kegagalan upload, coba kurangi jumlah data yang diupload.').should('exist')
    cy.contains('5. Pesan berhasil akan muncul setelah data terupload dengan benar.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/success.png');
    cy.contains('6. Pesan error akan muncul dengan keterangan data yang tidak valid. Data yang tidak valid, tidak akan terupload. Silahkan perbaiki data kemudian upload ulang.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/error2.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/error3.png');
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/error4.png');
    cy.contains('7. NIK tidak valid artinya NIK tersebut belum ada di data karyawan. Silahkan tambahkan data NIK, Nama dan Password pada data karyawan agar NIK tersebut menjadi valid.').should('exist')
    cy.contains('8. Pada data Absensi, OCHI dan QCC, setiap melakukan upload data, data yang sudah ada akan terhapus dan digantikan dengan data yang baru.').should('exist')
    cy.get('.img').should('have.attr', 'src', 'assets/img/petunjuk/upload5.png');
    cy.contains('Setelah semua data sudah terunggah, Silahkan Update data pada Rekapitulasi untuk mendapatkan jumlah total dari setiap data.').should('exist')
    cy.contains('1. Klik tombol Update Data untuk memulai update. Anda juga dapat melakukan unggah data dengan mengunduh template terlebih dahulu pada tombol "Template".').should('exist')
    cy.contains('2. Silahkan tunggu hingga proses selesai.').should('exist')
    cy.contains('3. Begitu selesai, data akan otomatis terupdate.').should('exist')
    cy.contains('4. Apabila terdapat perubahan data pada data karyawan, absensi, OCHI maupun QCC, silahkan lakukan update data kembali pada rekapitulasi.').should('exist')
    cy.contains('5. Pada data Rekapitulasi ini, Apabila anda melakukan unggah data maka data yang sudah ada akan terhapus dan digantikan dengan data yang baru.').should('exist')
  });
})