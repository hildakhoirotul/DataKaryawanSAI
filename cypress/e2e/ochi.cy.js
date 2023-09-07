describe('Admin Dashboard - OCHI', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.trixsite.com/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.trixsite.com/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('OCHI').click()
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
    cy.contains('Data OCHI').should('exist');
    cy.contains('Jumlah data :').should('exist');
    cy.get('.btn.btn-danger').should('exist')
    cy.get('.bx-upload').should('exist')
    cy.contains('Unggah Data').should('exist')
    cy.get('.btn.btn-info').should('exist')
    cy.get('.bx-download').should('exist')
    cy.contains('Unduh Data').should('exist')
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')
    // filter
    cy.get('.dropdown').eq(1).click({ force: true });
    cy.get('#juara option').should('have.length', 4);
    cy.get('#juara option').should('contain', 'Juara 1');
    cy.get('#juara option').should('contain', 'Juara 2');
    cy.get('#juara option').should('contain', 'Juara 3');

    cy.get('table[id=myTable]').should('exist')
    cy.contains('NO').should('exist')
    cy.contains('NIK').should('exist')
    cy.contains('TEMA').should('exist')
    cy.contains('Kontes').should('exist')
    cy.contains('OCHI Leader').should('exist')
    cy.contains('Juara').should('exist')
    cy.get('#ochiTableBody').should('exist')
    cy.get('#paging').should('exist')
  });

  it('filter juara dan search', () => {
    // search nik
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('55', { force: true })
    cy.contains('105559').should('exist')
    cy.contains('355253').should('exist')
    cy.contains('Kontes 3').should('exist')
    cy.contains('kontes 6').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('111111').should('exist')
    // search tema
    cy.get('input[type=text]').type('viverra', { force: true })
    cy.contains('et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse').should('exist')
    cy.contains('elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit').should('exist')
    cy.contains('Kontes 3').should('exist')
    cy.contains('Kontes 1').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('111111').should('exist')
    // search kontes
    cy.get('input[type=text]').type('tes 3', { force: true })
    cy.wait(2000)
    cy.contains('497227').should('exist')
    cy.contains('at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a').should('exist')
    cy.contains('Kontes 3').should('exist')
    // cy.contains('kontes 6').should('not.exist')
    cy.get('input[type=text]').clear()
    cy.contains('111111').should('exist')
    // search nik ochi leader
    cy.get('input[type=text]').type('56', { force: true })
    cy.contains('463756').should('exist')
    cy.contains('592956').should('exist')
    cy.contains('Kontes 3').should('exist')
    cy.contains('Kontes 4').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('111111').should('exist')
    //filter juara + search
    const selectedOption = 'Juara 1';
    cy.get('#juara').select(selectedOption, { force: true });
    cy.get('#juara').should('have.value', selectedOption);

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('Juara 2')
      .should('not.exist');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('Juara 3')
      .should('not.exist');

    const selectedOption2 = '';
    cy.get('#juara').select(selectedOption2, { force: true });

    const selectedOption3 = 'Juara 2';
    cy.get('#juara').select(selectedOption3, { force: true });
    cy.get('#juara').should('have.value', selectedOption3);

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('Juara 1')
      .should('not.exist');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('Juara 3')
      .should('not.exist');
    cy.get('#juara').select(selectedOption2, { force: true });

    const selectedOption4 = 'Juara 3';
    cy.get('#juara').select(selectedOption4, { force: true });
    cy.get('#juara').should('have.value', selectedOption4);

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('Juara 2')
      .should('not.exist');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('Juara 1')
      .should('not.exist');

    cy.get('#juara').select(selectedOption2, { force: true });
  })

  it('can upload invalidate ochi data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/dummy_ochi1_F.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 5, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('2. Kesalahan pada baris 14, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 19, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('4. Kesalahan pada baris 5, Tema tidak boleh kosong.').should('exist')
    cy.contains('5. Kesalahan pada baris 14, Tema tidak boleh kosong.').should('exist')
    cy.contains('6. Kesalahan pada baris 4, NIK OCHI leader harus terdiri dari 6 digit.').should('exist')
    cy.contains('7. Kesalahan pada baris 9, NIK OCHI leader harus terdiri dari 6 digit.').should('exist')
    cy.contains('OK').click()
  })

  it('can upload right ochi data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/dummy_ochi2_T.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    cy.contains('111111').should('exist')
  })
})