describe('Admin Dashboard - QCC', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.trixsite.com/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.trixsite.com/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Data Karyawan').click()
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
    cy.contains('Data Karyawan').should('exist');
    cy.contains('Jumlah data :').should('exist');
    cy.get('.btn.btn-danger').should('exist')
    cy.get('.bi-cloud-upload').should('exist')
    cy.contains('Unggah Data').should('exist')
    cy.get('.bi-cloud-download').should('exist')
    cy.contains('Template').should('exist')
    cy.get('.bi-trash').should('exist')
    cy.contains('Hapus').should('exist')
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
    cy.get('nav').invoke('css', 'display', 'none');
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_karyawan_server_F(1).xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 4, NIK tidak boleh kosong.').should('exist')
    cy.contains('2. Kesalahan pada baris 5, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 6, Nama tidak boleh kosong.').should('exist')
    cy.contains('4. Kesalahan pada baris 7, Password tidak boleh kosong.').should('exist')
    cy.contains('OK').click()
    cy.contains('Jumlah data : 500').should('exist')
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_karyawan_server(1).xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()

    cy.get('nav').invoke('css', 'display', 'none');

    // cy.get('button[type=button]').eq(0).should('exist')
    // cy.get('button[type=button]').eq(0).click({ force: true })
    cy.contains('Unggah Data').click({force: true})

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_karyawan_server(2).xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()

    cy.get('nav').invoke('css', 'display', 'none');

    // cy.get('button[type=button]').eq(0).should('exist')
    // cy.get('button[type=button]').eq(0).click({ force: true })
    cy.contains('Unggah Data').click({force: true})

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_karyawan_server(3).xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()

    cy.get('nav').invoke('css', 'display', 'none');

    // cy.get('button[type=button]').eq(0).should('exist')
    // cy.get('button[type=button]').eq(0).click({ force: true })
    cy.contains('Unggah Data').click({force: true})

    cy.get('.modal.fade').should('exist')
    cy.contains('Import Data Excel').should('exist')
    cy.get('input[type=file]').should('exist')
    cy.get('input[type=file]').should('have.attr', 'accept', '.xlsx, .xls, .csv');
    cy.get('button[type=button]').should('exist')
    cy.contains('Close').should('exist')
    cy.get('button[type=submit]').should('exist')
    cy.contains('Import').should('exist')
    // can import
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_karyawan_server(4).xlsx')
    cy.get('button[type="submit"]').eq(0).click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    cy.contains('Jumlah data : 1930').should('exist')
  })

  it('search karyawan, click password-toggle', () => {
    // search nik
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('55', { force: true })
    cy.contains('000255').should('exist')
    cy.contains('000355').should('exist')
    cy.contains('000558').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('000000').should('exist')
    // click password-toggle
    cy.get('#karyawanTableBody .password-text')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('000000010199')
      .should('not.exist');
    cy.get('.toggle-password-icon').eq(0).click()
    // cy.get('000000010199').should('exist')
    // cy.get('.password-text').should('have.attr', 'type', 'text')
  })

  it('can delete selection data', () => {
    const selectedOption = '1000';
    cy.get('#paginate').select(selectedOption, { force: true });
    cy.get('#paginate').should('have.value', selectedOption);

    cy.get('#selectAllCheckbox').should('exist')
    cy.get('#selectAllCheckbox').check()

    cy.get('#karyawanTableBody input.checkbox').each(($el, index, $list) => {
      if (index >= 0 && index <= 5) {
        cy.wrap($el).uncheck()
      }
    })

    cy.get('nav').invoke('css', 'display', 'none');
    cy.get('#removeDataButton').click()
    // cy.contains('Anda yakin ingin menghapus data yang dipilih?').should('exist')
    // cy.contains('OK').click()
    cy.contains('Jumlah data : 936').should('exist')

    const selectedOption1 = '1000';
    cy.get('#paginate').select(selectedOption1, { force: true });
    cy.get('#paginate').should('have.value', selectedOption1);

    cy.get('#selectAllCheckbox').should('exist')
    cy.get('#selectAllCheckbox').check()

    cy.get('#karyawanTableBody input.checkbox').each(($el, index, $list) => {
      if (index >= 0 && index <= 5) {
        cy.wrap($el).uncheck()
      }
    })

    cy.get('nav').invoke('css', 'display', 'none');
    cy.get('#removeDataButton').click()
    // cy.contains('Anda yakin ingin menghapus data yang dipilih?').should('exist')
    // cy.contains('OK').click()
    cy.contains('Jumlah data : 6').should('exist')
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