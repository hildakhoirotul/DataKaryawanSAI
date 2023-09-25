describe('Admin Dashboard - Pengaturan', () => {
  beforeEach(() => {
    cy.visit('http://127.0.0.1:8000/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'http://127.0.0.1:8000/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Pengaturan').click()
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
    // cy.contains('SETTING').should('exist');
    cy.contains('Pengaturan').should('exist');
    cy.contains('Disable Tema OCHI & QCC').should('exist');
    cy.get('.bi.bi-gear').should('exist')
    cy.get('input[type=checkbox]').should('exist')
    cy.get('input[type=checkbox]').should('have.attr', 'role', 'switch');

    cy.contains('Informasi Saat Ini:').should('exist')
    cy.contains('Klik teks untuk edit.').should('exist')
    cy.get('.table.table-hover').should('exist')
    cy.contains('Konfirmasi Absensi ke EB.').should('exist')
    cy.contains('Konfirmasi OCHI & QCC ke Training.').should('exist')
    cy.contains('Maksimal Konfirmasi pada tanggal 20 September 2023 jam 10.00 WIB.').should('exist')
    cy.contains('Perubahan data dapat dilihat kembali setelah 1 bulan.').should('exist')
    cy.contains('Sandi dapat diganti di halaman Ganti Sandi.').should('exist')
    cy.get('.btn.btn-danger').should('exist')
    cy.contains('Hapus').should('exist')
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Type Information')
    cy.get('.bi.bi-plus').should('exist')
    cy.contains('Save').should('exist')
  });

  it('can disable tema ochi and qcc', () => {
    cy.get('#flexSwitchCheckDefault').should('exist')
    cy.get('#flexSwitchCheckDefault').should('not.be.checked')
    cy.get('#flexSwitchCheckDefault').click()
    cy.get('#flexSwitchCheckDefault').should('be.checked')
    cy.contains('Perubahan disimpan').should('exist')
    cy.contains('Beberapa fitur telah dinonaktifkan').should('exist')
    cy.contains('OK').click()
    cy.contains('On').should('exist')
    cy.contains('Off').should('not.exist')
    // cek tema
    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Keluar').click({ force: true });
    cy.url().should('include', '/');

    cy.get('input[name=nik]').eq(0).type('015761')
    cy.get('input[name=password]').eq(0).type('015761')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'http://127.0.0.1:8000/home')
    cy.contains('OK').click()

    cy.get('.carousel-control-prev').should('exist')
    cy.get('.carousel-control-prev').click()
    // OCHI
    cy.get('.count-box').eq(17).click();
    cy.contains('Tema').should('not.exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara').should('exist');
    cy.contains('Reduce waktu proses pembuatan tanda terima invoice expedisi').should('not.exist');
    cy.contains('kontes 27').should('exist');
    // QCC
    cy.get('.count-box').eq(18).click();
    cy.contains('Nama Circle').should('exist');
    cy.contains('Tema').should('not.exist');
    cy.contains('Kontes').should('exist');
    cy.contains('Juara SAI').should('exist');
    cy.contains('Juara PASI').should('exist');
    cy.contains('LUCKY REBORN').should('exist');
    cy.contains('REDUCE PROBLEM DELAY PEMENUHAN QUOTATION DI LOCAL PURCHASE').should('not.exist');
    cy.contains('28').should('exist');
    cy.contains('-').should('exist');
    // OCHI Leader
    // cy.get('.count-box').eq(21).click();
    // cy.contains('NIK OCHI').should('exist');
    // cy.contains('Tema').should('not.exist');
    // cy.contains('766512').should('exist');
    // cy.contains('cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam').should('not.exist');

    cy.get('.dropdown').trigger('mouseover');
    cy.contains('Keluar').click({ force: true });
    cy.url().should('include', '/');

    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'http://127.0.0.1:8000/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Pengaturan').click()

    cy.get('#flexSwitchCheckDefault').should('exist')
    cy.get('#flexSwitchCheckDefault').should('be.checked')
    cy.get('#flexSwitchCheckDefault').click()
    cy.get('#flexSwitchCheckDefault').should('not.be.checked')
    cy.contains('Perubahan disimpan').should('exist')
    cy.contains('Beberapa fitur telah diaktifkan kembali').should('exist')
    cy.contains('OK').click()
    cy.contains('On').should('not.exist')
    cy.contains('Off').should('exist')
  })

  it('crud record', () => {
    // add 1 data
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').type('Silahkan hubungi HR untuk informasi lebih lanjut')
    cy.contains('Save').click()
    cy.contains('Berhasil! Informasi telah ditambahkan.').should('exist')
    cy.get('.table.table-hover')
      .contains('Silahkan hubungi HR untuk informasi lebih lanjut')
      .should('exist');
    // add >1 data
    cy.get('.bi.bi-plus').click()
    cy.get('.bi.bi-plus').click()
    cy.get('.bi.bi-x').eq(1).click()

    cy.get('input[type=text]').eq(0).type('hotline: 123')
    cy.get('input[type=text]').eq(1).type('hotline: 456')
    cy.contains('Save').click()
    cy.contains('Berhasil! Informasi telah ditambahkan.').should('exist')
    cy.get('.table.table-hover')
      .contains('hotline: 123')
      .should('exist')
    cy.get('.table.table-hover')
      .contains('hotline: 456')
      .should('exist')
    // edit record
    cy.get('.table.table-hover')
      .contains('hotline: 123')
      .click()
    cy.get('input[id=info]').should('exist')
    cy.get('input[id=info]').clear()
    cy.get('input[id=info]').type('hotline: 12345678')
    cy.contains('Simpan').click()
    cy.get('.table.table-hover')
      .contains('hotline: 12345678')
      .should('exist')
    // delete record
    cy.get('.table.table-hover tbody tr:nth-child(6) button.btn-danger').click();
    cy.get('.table.table-hover')
      .contains('Silahkan hubungi HR untuk informasi lebih lanjut')
      .should('not.exist')
      cy.get('.table.table-hover tbody tr:nth-child(6) button.btn-danger').click();
    cy.get('.table.table-hover')
      .contains('hotline: 12345678')
      .should('not.exist')
    cy.get('.table.table-hover tbody tr:nth-child(6) button.btn-danger').click();
    cy.get('.table.table-hover')
      .contains('hotline: 456')
      .should('not.exist')
  })
})