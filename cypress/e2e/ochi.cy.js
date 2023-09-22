describe('Admin Dashboard - OCHI', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.trixsite.com/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.trixsite.com/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('OCHI').click()
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
    cy.contains('Data OCHI').should('exist');
    cy.contains('Jumlah data :').should('exist');
    cy.get('.btn.btn-danger').should('exist')
    cy.get('.bi-cloud-upload').should('exist')
    cy.contains('Unggah Data').should('exist')
    cy.get('.btn.btn-info').should('exist')
    cy.get('.bi-cloud-download').should('exist')
    cy.contains('Unduh Data').should('exist')
    cy.get('.bi-cloud-download').should('exist')
    cy.contains('Template').should('exist')
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
    cy.get('nav').invoke('css', 'display', 'none');
    // search nik
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('55', { force: true })
    cy.contains('003552').should('exist')
    cy.contains('008461').should('exist')
    cy.contains('kontes 26').should('exist')
    cy.contains('001113').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('022891').should('exist')
    // search tema
    cy.get('input[type=text]').type('sampling', { force: true })
    cy.contains('Optimalisasi ID temporary wh sampling finish good').should('exist')
    cy.contains('kontes 27').should('exist')
    cy.contains('008690').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('022891').should('exist')
    // search kontes
    cy.get('input[type=text]').type('kontes 27', { force: true })
    cy.wait(5000)
    cy.contains('004075').should('exist')
    cy.contains('Menurunkan defect wrong cot DU.19 (Taping 6)').should('exist')
    cy.contains('kontes 27').should('exist')
    // cy.contains('kontes 6').should('not.exist')
    cy.get('input[type=text]').clear()
    cy.contains('022891').should('exist')
    // search nik ochi leader
    cy.get('input[type=text]').type('56', { force: true })
    cy.contains('015681').should('exist')
    cy.contains('017456').should('exist')
    cy.contains('005209').should('exist')
    cy.contains('000388').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('022891').should('exist')
    //filter juara + search
    const selectedOption = 'Juara 1';
    cy.get('#juara').select(selectedOption, { force: true });
    cy.get('#juara').should('have.value', '1');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('003999')
      .should('exist');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('014785')
      .should('exist');

    const selectedOption2 = '';
    cy.get('#juara').select(selectedOption2, { force: true });

    const selectedOption3 = 'Juara 2';
    cy.get('#juara').select(selectedOption3, { force: true });
    cy.get('#juara').should('have.value', '2');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('001949')
      .should('exist');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('001699')
      .should('exist');
    cy.get('#juara').select(selectedOption2, { force: true });

    const selectedOption4 = 'Juara 3';
    cy.get('#juara').select(selectedOption4, { force: true });
    cy.get('#juara').should('have.value', '3');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('002282')
      .should('exist');

    cy.get('#ochiTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('008461')
      .should('exist');

    cy.get('#juara').select(selectedOption2, { force: true });
  })

  it('can upload invalidate ochi data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_ochi_F.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 3, NIK tidak boleh kosong.').should('exist')
    cy.contains('2. Kesalahan pada baris 5, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 296, NIK tidak valid').should('exist')
    cy.contains('4. Kesalahan pada baris 425, NIK tidak valid').should('exist')
    cy.contains('5. Kesalahan pada baris 4, Tema tidak boleh kosong.').should('exist')
    cy.contains('6. Kesalahan pada baris 6, NIK OCHI leader tidak boleh kosong.').should('exist')
    cy.contains('7. Kesalahan pada baris 7, NIK OCHI leader harus terdiri dari 6 digit.').should('exist')
    cy.contains('OK').click()
    cy.contains('Jumlah data : 417').should('exist')
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_ochi.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    cy.contains('Jumlah data : 422').should('exist')
  })
})