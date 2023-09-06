describe('Homepage', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.sdn108gresik.sch.id/')
    cy.get('input[name=nik]').eq(0).type('111111')
    cy.get('input[name=password]').eq(0).type('111111')
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/home')
    cy.contains('OK').click()
  });

  it('displays informations on the page', () => {
    cy.contains('Home').should('exist')
    cy.contains('111111').should('exist')
    cy.get('.bi-person-circle').should('exist')

    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')

    cy.contains('Selamat Datang').should('exist');
    cy.contains('Mohon Diperhatikan').should('exist');
    cy.contains('Konfirmasi Absensi ke EB.').should('exist');
    cy.contains('Konfirmasi OCHI & QCC ke Training.').should('exist');
    cy.contains('Maksimal Konfirmasi pada tanggal 20 Oktober 2023 jam 12.00 WIB.').should('exist');
    cy.contains('Perubahan data dapat dilihat kembali setelah 1 bulan.').should('exist');
    cy.contains('Sandi dapat diganti di halaman Ganti Sandi.').should('exist');
    cy.get('.btn-get-started').should('exist')
    cy.contains('Lihat Data').should('exist')
    cy.get('.bi-arrow-right').should('exist')

    cy.get('.img-fluid').should('have.attr', 'src', 'https://datakaryawan.sdn108gresik.sch.id/assets/img/8.png');
    cy.get('.hero-waves').should('exist');
    cy.get('.wave1').should('exist');
    cy.get('.wave2').should('exist');
    cy.get('.wave3').should('exist');
  });


  it('display web on mobile phone', () => {
    cy.viewport('iphone-xr');
    cy.get('.dropdown').click();
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')
    cy.get('.dropdown').click()

    // cy.get('.carousel').should('not.exist')
    cy.get('.btn-get-started').should('exist');
    // cy.url().should('include', '#main');
    // cy.get('.btn-get-started').click();

    cy.get('.container.mobile').should('exist')
    cy.contains('Jumlah Alpha').should('exist')
    cy.contains('Jumlah Sakit').should('exist')
    cy.contains('Jumlah Sakit dengan Surat Dokter').should('exist')
    cy.contains('Jumlah Izin').should('exist')
    cy.contains('Jumlah Izin Terlambat Datang').should('exist')
    cy.contains('Jumlah Terlambat Datang').should('exist')
    cy.contains('Jumlah Izin Cepat Pulang').should('exist')
    cy.contains('Jumlah Cepat Pulang').should('exist')
    cy.contains('Jumlah OCHI').should('exist')
    cy.contains('Jumlah QCC').should('exist')
    cy.contains('OCHI Leader').should('exist')
    cy.contains('Lihat Tanggal').should('exist')
    cy.contains('Lihat Detail').should('exist')

    // A
    cy.get('.count-box').eq(0).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('25 May 2023').should('exist');
    // S
    cy.get('.count-box').eq(1).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('01 April 2023').should('exist');
    // SD
    cy.get('.count-box').eq(2).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('13 April 2023').should('exist');
    // I
    cy.get('.count-box').eq(3).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('03 April 2023').should('exist');
    // ITD
    cy.get('.count-box').eq(4).click();
    cy.contains('Tidak ada data').should('exist');
    // TD
    cy.get('.count-box').eq(5).click();
    cy.contains('Tanggal').should('exist');
    cy.contains('Jam Masuk').should('exist');
    cy.contains('08 February 2023').should('exist');
    cy.contains('07:45:00').should('exist');
    // ICP
    cy.get('.count-box').eq(6).click();
    cy.contains('Tidak ada data').should('exist');
    // CP
    cy.get('.count-box').eq(7).click();
    cy.contains('Tanggal').should('exist');
    cy.contains('Jam Pulang').should('exist');
    cy.contains('09 April 2023').should('exist');
    cy.contains('10:40:55').should('exist');
    // OCHI
    cy.get('.count-box').eq(8).click();
    cy.contains('Tema').should('exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara').should('exist');
    cy.contains('blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus').should('exist');
    cy.contains('Kontes 4').should('exist');
    cy.contains('Juara 3').should('exist');
    // QCC
    cy.get('.count-box').eq(9).click();
    cy.contains('Nama Circle').should('exist');
    cy.contains('Tema').should('exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara SAI').should('exist');
    cy.contains('Juara PASI').should('exist');
    cy.contains('Legal').should('exist');
    cy.contains('blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus').should('exist');
    cy.contains('Kontes 4').should('exist');
    cy.contains('Juara 1').should('exist');
    cy.contains('-').should('exist');
    // OCHI Leader
    cy.get('.count-box').eq(10).click();
    cy.contains('NIK OCHI').should('exist');
    cy.contains('Tema').should('exist');
    cy.contains('766512').should('exist');
    cy.contains('cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam').should('exist');

    cy.get('.back-to-top').should('exist');
    cy.get('.back-to-top').click();
    cy.contains('Selamat Datang').should('exist')

    cy.get('.dropdown').click();
    cy.contains('Ganti Sandi').click({ force: true });
    cy.url().should('include', '/change-password');

    cy.contains('Ingin Ganti Password?').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit, password lama dan password baru.').should('exist')
    
    cy.contains('Ganti Password').should('exist')
    cy.get('input[name=current_password]').should('exist')
    cy.get('input[name=new_password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist')
    cy.get('button[type=submit]').should('exist')
  })

  it('display web on ipad mini', () => {
    cy.viewport('ipad-mini');
    cy.get('.dropdown').click();
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')
    cy.get('.dropdown').click()

    cy.get('.btn-get-started').should('exist');
    // cy.url().should('include', '#main');
    // cy.get('.btn-get-started').click();

    // cy.get('.carousel').should('not.exist')
    cy.get('.container.mobile').should('exist')
    cy.contains('Jumlah Alpha').should('exist')
    cy.contains('Jumlah Sakit').should('exist')
    cy.contains('Jumlah Sakit dengan Surat Dokter').should('exist')
    cy.contains('Jumlah Izin').should('exist')
    cy.contains('Jumlah Izin Terlambat Datang').should('exist')
    cy.contains('Jumlah Terlambat Datang').should('exist')
    cy.contains('Jumlah Izin Cepat Pulang').should('exist')
    cy.contains('Jumlah Cepat Pulang').should('exist')
    cy.contains('Jumlah OCHI').should('exist')
    cy.contains('Jumlah QCC').should('exist')
    cy.contains('OCHI Leader').should('exist')
    cy.contains('Lihat Tanggal').should('exist')
    cy.contains('Lihat Detail').should('exist')

    // A
    cy.get('.count-box').eq(0).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('25 May 2023').should('exist');
    // S
    cy.get('.count-box').eq(1).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('01 April 2023').should('exist');
    // SD
    cy.get('.count-box').eq(2).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('13 April 2023').should('exist');
    // I
    cy.get('.count-box').eq(3).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('03 April 2023').should('exist');
    // ITD
    cy.get('.count-box').eq(4).click();
    cy.contains('Tidak ada data').should('exist');
    // TD
    cy.get('.count-box').eq(5).click();
    cy.contains('Tanggal').should('exist');
    cy.contains('Jam Masuk').should('exist');
    cy.contains('08 February 2023').should('exist');
    cy.contains('07:45:00').should('exist');
    // ICP
    cy.get('.count-box').eq(6).click();
    cy.contains('Tidak ada data').should('exist');
    // CP
    cy.get('.count-box').eq(7).click();
    cy.contains('Tanggal').should('exist');
    cy.contains('Jam Pulang').should('exist');
    cy.contains('09 April 2023').should('exist');
    cy.contains('10:40:55').should('exist');
    // OCHI
    cy.get('.count-box').eq(8).click();
    cy.contains('Tema').should('exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara').should('exist');
    cy.contains('blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus').should('exist');
    cy.contains('Kontes 4').should('exist');
    cy.contains('Juara 3').should('exist');
    // QCC
    cy.get('.count-box').eq(9).click();
    cy.contains('Nama Circle').should('exist');
    cy.contains('Tema').should('exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara SAI').should('exist');
    cy.contains('Juara PASI').should('exist');
    cy.contains('Legal').should('exist');
    cy.contains('blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus').should('exist');
    cy.contains('Kontes 4').should('exist');
    cy.contains('Juara 1').should('exist');
    cy.contains('-').should('exist');
    // OCHI Leader
    cy.get('.count-box').eq(10).click();
    cy.contains('NIK OCHI').should('exist');
    cy.contains('Tema').should('exist');
    cy.contains('766512').should('exist');
    cy.contains('cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam').should('exist');

    cy.get('.back-to-top').should('exist');
    cy.get('.back-to-top').click();
    cy.contains('Selamat Datang').should('exist')

    cy.get('.dropdown').click();
    cy.contains('Ganti Sandi').click({ force: true });
    cy.url().should('include', '/change-password');

    cy.contains('Ingin Ganti Password?').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit, password lama dan password baru.').should('exist')
    
    cy.contains('Ganti Password').should('exist')
    cy.get('input[name=current_password]').should('exist')
    cy.get('input[name=new_password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist')
    cy.get('button[type=submit]').should('exist')
  })

  it('display web on pc/laptop', () => {
    cy.get('.btn-get-started').should('exist');
    // cy.url().should('include', '#main');
    // cy.get('.btn-get-started').click();

    // cy.get('.container.mobile').should('not.exist')
    cy.get('.carousel').should('exist')
    cy.contains('Jumlah Alpha').should('exist')
    cy.contains('Jumlah Sakit').should('exist')
    cy.contains('Jumlah Sakit dengan Surat Dokter').should('exist')
    cy.contains('Jumlah Izin').should('exist')
    cy.contains('Jumlah Izin Terlambat Datang').should('exist')
    cy.contains('Jumlah Terlambat Datang').should('exist')
    cy.contains('Jumlah Izin Cepat Pulang').should('exist')
    cy.contains('Jumlah Cepat Pulang').should('exist')
    cy.contains('Jumlah OCHI').should('exist')
    cy.contains('Jumlah QCC').should('exist')
    cy.contains('OCHI Leader').should('exist')
    cy.contains('Lihat Tanggal').should('exist')
    cy.contains('Lihat Detail').should('exist')

    cy.get('.carousel-item').should('exist')
    // A
    cy.get('.count-box').eq(11).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('25 May 2023').should('exist');
    // S
    cy.get('.count-box').eq(12).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('01 April 2023').should('exist');
    // SD
    cy.get('.count-box').eq(13).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('13 April 2023').should('exist');
    // I
    cy.get('.count-box').eq(14).click();
    cy.get('.bx-calendar').should('exist');
    cy.contains('03 April 2023').should('exist');

    cy.get('.carousel-control-next').should('exist')
    cy.get('.carousel-control-next').click()

    // ITD
    cy.get('.count-box').eq(15).click();
    cy.contains('Tidak ada data').should('exist');
    // TD
    cy.get('.count-box').eq(16).click();
    cy.contains('Tanggal').should('exist');
    cy.contains('Jam Masuk').should('exist');
    cy.contains('08 February 2023').should('exist');
    cy.contains('07:45:00').should('exist');
    // ICP
    cy.get('.count-box').eq(17).click();
    cy.contains('Tidak ada data').should('exist');
    // CP
    cy.get('.count-box').eq(18).click();
    cy.contains('Tanggal').should('exist');
    cy.contains('Jam Pulang').should('exist');
    cy.contains('09 April 2023').should('exist');
    cy.contains('10:40:55').should('exist');

    cy.get('.carousel-control-next').should('exist')
    cy.get('.carousel-control-next').click()

    // OCHI
    cy.get('.count-box').eq(19).click();
    cy.contains('Tema').should('exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara').should('exist');
    cy.contains('blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus').should('exist');
    cy.contains('Kontes 4').should('exist');
    cy.contains('Juara 3').should('exist');
    // QCC
    cy.get('.count-box').eq(20).click();
    cy.contains('Nama Circle').should('exist');
    cy.contains('Tema').should('exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara SAI').should('exist');
    cy.contains('Juara PASI').should('exist');
    cy.contains('Legal').should('exist');
    cy.contains('blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus').should('exist');
    cy.contains('Kontes 4').should('exist');
    cy.contains('Juara 1').should('exist');
    cy.contains('-').should('exist');
    // OCHI Leader
    cy.get('.count-box').eq(21).click();
    cy.contains('NIK OCHI').should('exist');
    cy.contains('Tema').should('exist');
    cy.contains('766512').should('exist');
    cy.contains('cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam').should('exist');

    cy.get('.back-to-top').should('exist');
    cy.get('.back-to-top').click();
    cy.contains('Selamat Datang').should('exist')
  })

  it('try to change password', () => {
    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Ganti Sandi').click({ force: true });
    cy.url().should('include', '/change-password');

    cy.contains('Ingin Ganti Password?').should('exist')
    cy.contains('Silahkan masukkan NIK 6 digit, password lama dan password baru.').should('exist')
    
    cy.contains('Ganti Password').should('exist')
    cy.get('input[name=current_password]').should('exist')
    cy.get('input[name=new_password]').should('exist')
    cy.get('input[name=password_confirmation]').should('exist')
    cy.get('button[type=submit]').should('exist')

    cy.get('input[name=current_password]').type('111111')
    cy.get('input[name=new_password]').type('222222')
    cy.get('input[name=password_confirmation]').type('222222')
    cy.get('button[type=submit]').click()

    cy.contains('Password berhasil diubah').should('exist')
    cy.contains('Silahkan Login kembali').should('exist')
    cy.contains('OK').click()

    cy.url().should('include', '/login');

    cy.get('input[name=nik]').eq(0).type('111111')
    cy.get('input[name=password]').eq(0).type('222222')
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/home')
    cy.contains('OK').click()

    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Ganti Sandi').click({ force: true });
    cy.url().should('include', '/change-password');

    cy.get('input[name=current_password]').type('222222')
    cy.get('input[name=new_password]').type('111111')
    cy.get('input[name=password_confirmation]').type('111111')
    cy.get('button[type=submit]').click()

    cy.contains('Password berhasil diubah').should('exist')
    cy.contains('Silahkan Login kembali').should('exist')
    cy.contains('OK').click()
  });

  it('can logout', () => {
    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Keluar').click({ force: true });
    cy.url().should('include', '/');
  });

});
