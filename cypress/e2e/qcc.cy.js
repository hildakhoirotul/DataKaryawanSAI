describe('Admin Dashboard - QCC', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.trixsite.com/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.trixsite.com/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('QCC').click()
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
    cy.contains('Data QCC').should('exist');
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
    cy.contains('Nama QCC').should('exist')
    cy.contains('Juara SAI').should('exist')
    cy.contains('Juara PASI').should('exist')
    cy.get('#qccTableBody').should('exist')
    cy.get('#paging').should('exist')
  });

  it('filter juara dan search', () => {
    cy.get('nav').invoke('css', 'display', 'none');
    // search nik
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('55', { force: true })
    cy.contains('011855').should('exist')
    cy.contains('OPTIMALISASI PROSES SUBLINE DI LINE 12A').should('exist')
    cy.contains('28').should('exist')
    cy.contains('IMPETE').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('027002').should('exist')
    // search tema
    cy.get('input[type=text]').type('assy', { force: true })
    cy.contains('027002').should('exist')
    cy.contains('000163').should('exist')
    cy.contains('REDUCE DEFECT WRONG TERMINAL PRE ASSY 602W').should('exist')
    cy.contains('REDUCE DEFECT DEFORM TERMINAL PRE ASSY J72A').should('exist')
    cy.contains('LEONIDAS').should('exist')
    cy.contains('PRE SHINE').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('027002').should('exist')
    // search kontes
    // cy.get('input[type=text]').type('kontes 3', { force: true })
    // cy.contains('602446').should('exist')
    // cy.contains('at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a').should('exist')
    // cy.contains('Kontes 3').should('exist')
    // cy.contains('kontes 6').should('not.exist')
    // cy.get('input[type=text]').clear()
    // cy.contains('111111').should('exist')
    // search nama QCC
    cy.get('input[type=text]').type('kembang', { force: true })
    cy.contains('001564').should('exist')
    cy.contains('REDUCE SCRAB SA AB KEPENDEKAN LINE 9A').should('exist')
    cy.contains('KEMBANG 27').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('027002').should('exist')
    //filter juara + search
    const selectedOption = 'Juara 1';
    cy.get('#juara').select(selectedOption, { force: true });
    cy.get('#juara').should('have.value', '1');

    cy.get('#qccTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('027002')
      .should('exist');

    cy.get('#qccTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('001677')
      .should('exist');

    const selectedOption2 = '';
    cy.get('#juara').select(selectedOption2, { force: true });

    const selectedOption3 = 'Juara 2';
    cy.get('#juara').select(selectedOption3, { force: true });
    cy.get('#juara').should('have.value', '2');

    cy.get('#qccTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('000585')
      .should('exist');

    cy.get('#qccTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('000035')
      .should('exist');
    cy.get('#juara').select(selectedOption2, { force: true });

    const selectedOption4 = 'Juara 3';
    cy.get('#juara').select(selectedOption4, { force: true });
    cy.get('#juara').should('have.value', '3');

    cy.get('#qccTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('008995')
      .should('exist');

    cy.get('#qccTableBody')  // Ganti dengan ID yang sesuai untuk <tbody> tabel
      .contains('001677')
      .should('exist');

    cy.get('#juara').select(selectedOption2, { force: true });
  })

  it('can upload invalidate qcc data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_qcc_F.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 3, NIK tidak boleh kosong.').should('exist')
    cy.contains('2. Kesalahan pada baris 4, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 740, NIK tidak valid').should('exist')
    cy.contains('4. Kesalahan pada baris 5, Tema tidak boleh kosong.').should('exist')
    cy.contains('5. Kesalahan pada baris 6, Nama QCC tidak boleh kosong.').should('exist')
    cy.contains('OK').click()
    cy.contains('Jumlah data : 734').should('exist')
  })

  it('can upload right qcc data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_qcc.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    cy.contains('Jumlah data : 738').should('exist')
  })
})