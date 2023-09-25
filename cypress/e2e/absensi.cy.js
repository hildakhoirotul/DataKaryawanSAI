describe('Admin Dashboard - Absensi', () => {
  beforeEach(() => {
    cy.visit('https://datakaryawan.trixsite.com/')
    cy.get('input[name=nik]').eq(0).type('000000')
    cy.get('input[name=password]').eq(0).type('000000010199')
    cy.get('button[type=submit]').eq(0).click()
    cy.url().should('include', 'https://datakaryawan.trixsite.com/dashboard')
    cy.contains('OK').click()
    cy.get('.sidebar').trigger('mouseover')
    cy.contains('Absensi').click()
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
    cy.contains('Data Absensi Karyawan').should('exist');
    cy.contains('Jumlah data :').should('exist');
    cy.get('.btn.btn-danger').should('exist')
    cy.get('.bi-cloud-upload').should('exist')
    cy.contains('Unggah').should('exist')
    cy.get('.btn.btn-info').should('exist')
    cy.get('.bi-cloud-download').should('exist')
    cy.contains('Unduh').should('exist')
    cy.get('.bi-cloud-download').should('exist')
    cy.contains('Template').should('exist')
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')
    // filter
    cy.get('.dropdown').eq(1).click({ force: true });
    cy.get('#jenis option').should('have.length', 9); // Pastikan jumlah opsi sesuai
    cy.get('#jenis option').should('contain', 'S'); // Memeriksa apakah opsi 'S' ada
    cy.get('#jenis option').should('contain', 'SD');
    cy.get('#jenis option').should('contain', 'I');
    cy.get('#jenis option').should('contain', 'A');
    cy.get('#jenis option').should('contain', 'TD');
    cy.get('#jenis option').should('contain', 'CP');
    cy.get('#jenis option').should('contain', 'ITD');
    // cy.get('#jenis option').should('contain', 'ICP');
    // cy.get('.dropdown').eq(1).should('exist')
    // cy.get('label[for=jenis]').should('exist')
    // cy.contains('Jenis:').should('exist')
    // cy.get('.dropdown').eq(1).click({ force: true })
    // cy.contains('S').should('exist')
    // cy.contains('SD').should('exist')
    // cy.contains('I').should('exist')
    // cy.contains('A').should('exist')
    // cy.contains('TD').should('exist')
    // cy.contains('CP').should('exist')
    // cy.contains('ITD').should('exist')
    // cy.contains('ICP').should('exist')

    cy.get('.dropdown').eq(2).should('exist')
    cy.get('label[for=tanggalMulai]').should('exist')
    cy.contains('Tanggal Mulai:').should('exist')
    cy.get('input[id=tanggalMulai]').should('exist')

    cy.get('.dropdown').eq(3).should('exist')
    cy.get('label[for=tanggalAkhir]').should('exist')
    cy.contains('Tanggal Akhir:').should('exist')
    cy.get('input[id=tanggalAkhir]').should('exist')

    cy.get('table[id=myTable]').should('exist')
    cy.contains('NO').should('exist')
    cy.contains('NIK').should('exist')
    cy.contains('Jenis').should('exist')
    cy.contains('Tanggal').should('exist')
    cy.contains('Jam Masuk').should('exist')
    cy.contains('Jam Pulang').should('exist')
    cy.get('#absensiTableBody').should('exist')
    cy.get('#paging').should('exist')
  });

  it('filter jenis, tanggal mulai, tanggal akhir dan search', () => {
    // search aja
    cy.get('input[type=text]').should('exist')
    cy.get('input[type=text]').should('have.attr', 'placeholder', 'Cari NIK disini ....');
    cy.get('.btn.btn-outline-secondary').should('exist')

    cy.get('input[type=text]').type('34', { force: true })
    cy.contains('013034').should('exist')
    cy.contains('013415').should('exist')
    cy.contains('2022-12-28').should('exist')
    cy.contains('SD').should('exist')
    cy.get('input[type=text]').clear()
    cy.contains('008764').should('exist')
    cy.get('nav').invoke('css', 'display', 'none');
    //filter jenis, tanggal mulai, tanggal akhir + search
    const selectedOption = 'SD'; 
    cy.get('#jenis').select(selectedOption, { force: true });
    cy.get('#jenis').should('have.value', selectedOption);

    const inputDate1 = '2022-07-01';
    cy.get('#tanggalMulai').type(inputDate1);
    cy.get('#tanggalMulai').should('have.value', inputDate1);

    const inputDate2 = '2022-07-31';
    cy.get('#tanggalAkhir').type(inputDate2);
    cy.get('#tanggalAkhir').should('have.value', inputDate2);

    cy.contains('019336').should('exist')
    cy.contains('001466').should('exist')
    cy.contains('001411').should('exist')
    cy.contains('SD').should('exist')
    cy.contains('2022-07-31').should('exist')
    cy.contains('2022-07-31').should('exist')

    cy.get('input[type=text]').type('5', { force: true })
    cy.contains('001548').should('exist')

    cy.get('input[type=text]').clear()
    const selectedOption2 = '';
    cy.get('#jenis').select(selectedOption2, { force: true });
    cy.get('#tanggalMulai').clear()
    cy.get('#tanggalAkhir').clear()
    cy.contains('008764').should('exist')
    // filter jenis + search
    const selectedOption3 = 'A'; 
    cy.get('#jenis').select(selectedOption3, { force: true });
    cy.get('#jenis').should('have.value', selectedOption3);
    cy.contains('000333').should('exist')
    cy.contains('2022-12-29').should('exist')
    cy.contains('A').should('exist')

    const selectedOption4 = 'S'; 
    cy.get('#jenis').select(selectedOption4, { force: true });
    cy.get('#jenis').should('have.value', selectedOption4);
    cy.contains('013384').should('exist')
    cy.contains('2022-12-30').should('exist')
    cy.contains('S').should('exist')

    cy.get('input[type=text]').type('11', { force: true })
    cy.contains('011012').should('exist')
    cy.contains('2022-12-28').should('exist')

    cy.get('#jenis').select(selectedOption2, { force: true });
    cy.get('#tanggalMulai').clear()
    cy.get('#tanggalAkhir').clear()
    cy.get('input[type=text]').clear({ force: true })
    cy.contains('008764').should('exist')
    // filter tanggal + search
    cy.get('#tanggalMulai').type(inputDate1, { force: true });
    cy.get('#tanggalMulai').should('have.value', inputDate1);
    cy.get('#tanggalAkhir').type(inputDate2, { force: true });
    cy.get('#tanggalAkhir').should('have.value', inputDate2);
    cy.contains('019336').should('exist')
    cy.contains('SD').should('exist')
    cy.contains('2022-07-31').should('exist')

    cy.get('input[type=text]').type('54', { force: true })
    cy.contains('001548').should('exist')
    cy.contains('SD').should('exist')
    cy.contains('2022-07-30').should('exist')
  })

  it('can upload invalidate absensi data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_absensi_F.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Gagal').should('exist')
    cy.contains('Error pada:').should('exist')
    cy.contains('1. Kesalahan pada baris 3, NIK tidak boleh kosong.').should('exist')
    cy.contains('2. Kesalahan pada baris 4, NIK harus terdiri dari 6 digit.').should('exist')
    cy.contains('3. Kesalahan pada baris 5, Jenis tidak boleh kosong.').should('exist')
    cy.contains('4. Kesalahan pada baris 6, Jenis melebihi 3 karakter').should('exist')
    cy.contains('5. Kesalahan pada baris 7, Tanggal tidak boleh kosong.').should('exist')
    // cy.contains('6. Kesalahan pada baris 3124, NIK tidak valid').should('exist')
    cy.contains('6. Kesalahan pada baris 3124, tanggal harus dengan format date.').should('exist')
    cy.contains('OK').click()

    // cy.contains('Jumlah data : 3117').should('exist')
  })

  it('can upload right absensi data', () => {
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
    cy.get('input[type="file"]').selectFile('cypress/fixtures/template_absensi.xlsx')
    cy.get('button[type="submit"]').click();

    cy.contains('Impor Berhasil').should('exist')
    cy.contains('Berhasil diimpor').should('exist')
    cy.contains('OK').click()
    // cy.contains('111111').should('exist')

    // cy.contains('Jumlah data : 3122').should('exist')
  })
})