describe('Admin Dashboard - QCC', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'http://localhost:8000/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Data Karyawan').click()
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
    cy.contains('Data Karyawan').should('exist');
    cy.contains('Jumlah data :').should('exist');
    cy.get('.btn.btn-danger').should('exist')
    cy.get('.bx-upload').should('exist')
    cy.contains('Unggah Data').should('exist')
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('table[id=myTable]').should('exist')
    cy.contains('NO').should('exist')
    cy.contains('NIK').should('exist')
    cy.contains('Password').should('exist')
    cy.contains('Terakhir Ganti').should('exist')
    cy.contains('Action').should('exist')
    cy.get('input[type=password]').should('exist')
    cy.get('input[type=password]').should('have.attr', 'readonly')
    cy.get('.toggle-password-icon').should('exist')
    cy.get('.btn.show_confirm').should('exist')
    cy.contains('Delete').should('exist')
    cy.get('#karyawanTableBody').should('exist')
    cy.get('#paging').should('exist')
  });

  it('can upload invalidate karyawan data', () => {
    cy.get('button[type=button]').eq(0).should('exist')
    cy.get('button[type=button]').eq(0).click({ force: true })

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/dummy_karyawan_F.xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 4, NIK tidak boleh kosong.').should('exist')
    cy.contains('2. Kesalahan pada baris 19, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 14, Password tidak boleh kosong.').should('exist')
    cy.contains('OK').click()
  })

  it('can upload right karyawan data', () => {
    cy.get('button[type=button]').eq(0).should('exist')
    cy.get('button[type=button]').eq(0).click({ force: true })

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/dummy_karyawan_T.xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    cy.contains('363465').should('exist')
  })

  it('search karyawan, click password-toggle', () => {
    // search nik
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('55', { force: true })
    cy.contains('557796').should('exist')
    cy.contains('620755').should('exist')
    cy.contains('535599').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('111111').should('exist')
    // click password-toggle
    cy.get('#karyawanTableBody .password-text')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('000000')
      .should('not.exist');
    cy.get('.toggle-password-icon').eq(0).click()
    cy.get('.password-text').should('have.attr', 'type', 'text')
  })

  it('can delete record', () => {
    cy.get('.btn.show_confirm').should('exist')
    cy.get('.btn.show_confirm').eq(5).click()

    cy.contains('Apakah anda yakin menghapus data ini?').should('exist')
    cy.contains('Data yang dihapus tidak dapat dikembalikan.').should('exist')
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Cancel').should('exist')
    // Cancel
    cy.contains('Cancel').click()
    cy.contains('Apakah anda yakin menghapus data ini?').should('not.exist')
    // delete
    cy.get('.btn.show_confirm').eq(5).click()
    cy.contains('Yes, delete it!').should('exist')
    cy.contains('Yes, delete it!').click()
  })
})