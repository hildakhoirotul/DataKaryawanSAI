describe('Admin Dashboard', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.sdn108gresik.sch.id/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/dashboard')
    cy.contains('OK').click()
  });

  it('displays informations on the page', () => {
    // navbar
    cy.get('.bx-sun').should('exist')
    cy.contains('000000').should('exist');
    cy.get('.img').should('have.attr', 'src', 'assets/img/account.png');
    cy.get('.nav-link').trigger('mouseover');
    cy.contains('Ganti Sandi').should('exist')
    cy.contains('Keluar').should('exist')
    // sidebar
    cy.get('.sidebar').should('exist')
    cy.get('.sidebar').trigger('mouseover')
    cy.get('.menu_dahsboard').should('exist')
    cy.contains('Rekapitulasi').should('exist')
    cy.get('.menu_editor').should('exist')
    cy.contains('Absensi').should('exist')
    cy.contains('OCHI').should('exist')
    cy.contains('QCC').should('exist')
    cy.contains('Data Karyawan').should('exist')
    cy.get('.menu_setting').should('exist')
    cy.contains('Pengaturan').should('exist')
    cy.contains('Expand').should('exist')
    cy.contains('Expand').click({ force: true })
    cy.contains('Collapse').should('exist')
    // content
    cy.contains('Rekapitulasi Data Karyawan').should('exist');
    cy.contains('Jumlah data :').should('exist');
    cy.get('button[type=button]').should('exist')
    cy.get('.bx-upload').should('exist')
    cy.contains('Unggah Data').should('exist')
    cy.get('.btn.unduh').should('exist')
    cy.get('.bx-download').should('exist')
    cy.contains('Unduh Data').should('exist')
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('table[id=myTable]').should('exist')
    cy.contains('NO').should('exist')
    cy.contains('NIK').should('exist')
    cy.contains('SD').should('exist')
    cy.contains('S').should('exist')
    cy.contains('I').should('exist')
    cy.contains('A').should('exist')
    cy.contains('ITD').should('exist')
    cy.contains('ICP').should('exist')
    cy.contains('TD').should('exist')
    cy.contains('CP').should('exist')
    cy.contains('OCHI').should('exist')
    cy.contains('QCC').should('exist')
    cy.contains('OCHI Leader').should('exist')
    cy.contains('Juara OCHI').should('exist')
    cy.contains('Juara QCC').should('exist')
    cy.get('#absensiTableBody').should('exist')
    cy.get('#paging').should('exist')
  });

  it('can upload invalidate rekapitulasi data', () => {
    cy.get('button[type=button]').eq(0).should('exist')
    cy.get('button[type=button]').eq(0).click()

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/rekap_dummy1_F.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 6, NIK harus terdiri dari minimal 6 digit.').should('exist')
    cy.contains('2. Kesalahan pada baris 11, NIK harus terdiri dari minimal 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 14, NIK harus terdiri dari minimal 6 digit.').should('exist')
    cy.contains('4. Kesalahan pada baris 21, NIK tidak boleh kosong.').should('exist')
    cy.contains('OK').click()
  })

  it('can cancel upload right rekapitulasi data', () => {
    cy.get('button[type=button]').eq(0).should('exist')
    cy.get('button[type=button]').eq(0).click()

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/rekap_dummy_T.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    cy.contains('111111').should('exist')
  })

  it('search nik in table', () => {
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('99')
    cy.contains('268499').should('exist')
    cy.contains('535599').should('exist')
    cy.contains('990052').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('111111').should('exist')
  })
  
  // it('can download file', () => {
  //   cy.get('.btn.unduh').should('exist')
  //   cy.get('.btn.unduh').click()    
  // })

  it('dark mode', () => {
    cy.get('.bx.bx-sun').should('exist')
    cy.get('.bx.bx-sun').click()

    cy.get('.bx.bx-moon').should('exist')
    cy.get('body.dark').should('exist')

    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Rekapitulasi').click()
    cy.get('body.dark').should('exist')
    cy.contains('Absensi').click()
    cy.get('body.dark').should('exist')
    cy.contains('OCHI').click()
    cy.get('body.dark').should('exist')
    cy.contains('QCC').click()
    cy.get('body.dark').should('exist')
    cy.contains('Data Karyawan').click()
    cy.get('body.dark').should('exist')
    cy.contains('Pengaturan').click()
    cy.get('body.dark').should('exist')
    
    cy.get('.bx.bx-moon').click()
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

    cy.get('input[name=current_password]').type('000000')
    cy.get('input[name=new_password]').type('111111')
    cy.get('input[name=password_confirmation]').type('111111')
    cy.get('button[type=submit]').click()

    cy.contains('Password berhasil diubah').should('exist')
    cy.contains('Silahkan Login kembali').should('exist')
    cy.contains('OK').click()

    cy.url().should('include', '/login');

    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('111111')
    cy.get('button[type=submit]').eq(0).click()

    cy.url().should('include', 'https://datakaryawan.sdn108gresik.sch.id/dashboard')
    cy.contains('OK').click()

    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Ganti Sandi').click({ force: true });
    cy.url().should('include', '/change-password');

    cy.get('input[name=current_password]').type('111111')
    cy.get('input[name=new_password]').type('000000')
    cy.get('input[name=password_confirmation]').type('000000')
    cy.get('button[type=submit]').click()

    cy.contains('Password berhasil diubah').should('exist')
    cy.contains('Silahkan Login kembali').should('exist')
    cy.contains('OK').click()
  });
})