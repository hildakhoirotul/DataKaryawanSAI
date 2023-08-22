describe('Homepage', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').type('111111')
    cy.get('input[name=password]').type('111111')
    cy.get('button[type=submit]').click()
    cy.visit('http://localhost:8000/home');
  });

  it('displays informations on the page', () => {
    cy.contains('Data Absensi dan Prestasi Karyawan');
    cy.contains('Konfirmasi Absensi ke EB.');
    cy.contains('Konfirmasi OCHI & QCC ke Training.');
    cy.contains('Perubahan data dapat dilihat kembali setelah 1 bulan.');
    cy.contains('Silahkan mengganti password ketika pertama kali masuk sistem.');
    cy.contains('NIK: 111111');
  });

  it('can navigate to change password page', () => {
    cy.get('#navbarDropdown').trigger('mouseover');
    cy.wait(1000);
    cy.get('.dropdown-item', {force: true}).should('be.visible');
    cy.contains('Ganti Sandi').click();
    cy.url().should('include', '/change-password');
  });

  it('can logout', () => {
    cy.get('.nav-link').trigger('mouseover');
    // cy.get('.dropdown-menu').should('be.visible');
    cy.get('.dropdown-menu', { force: true }).should('be.visible'); // Memeriksa apakah elemen dropdown-menu terlihat
    cy.contains('Keluar').click();
    cy.url().should('include', '/');
  });

  it('opens and displays modal on card click', () => {
    // cy.get('.card-link').first().click(); // Ganti dengan selektor card yang sesuai
    // Memeriksa apakah modal muncul dan menampilkan data yang diharapkan
    // cy.get('.modal').should('be.visible');
    // Lanjutkan untuk memeriksa data lainnya sesuai tampilan di modal
    // });
    cy.get('.option').each((card, index) => {
      cy.get('.modal .close').click({ multiple: true, force: true });

      cy.wrap(card).find('.card-link').click({ multiple: true });

      cy.get('.modal').should('be.visible');

      cy.get('.modal .close').click({ multiple: true, force: true });
    });
  });

  it('can toggle dark mode', () => {
    cy.get('#darkLight').click();
    cy.get('body').should('have.class', 'dark');
    cy.get('#darkLight').click();
    cy.get('body').should('not.have.class', 'dark');
  });
});
