describe('Homepage', () => {
  beforeEach(() => {
    cy.visit('http://localhost:8000/login')
    cy.get('input[name=nik]').eq(0).type('111111')
    cy.get('input[name=password]').eq(0).type('222222')
    cy.get('button[type=submit]').eq(0).click()
    cy.visit('http://localhost:8000/home');
  });

  it('displays informations on the page', () => {
    cy.contains('Konfirmasi Absensi ke EB.');
    cy.contains('Konfirmasi OCHI & QCC ke Training.');
    cy.contains('Maksimal Konfirmasi 3 hari.');
    cy.contains('Perubahan data dapat dilihat kembali setelah 1 bulan.');
    cy.contains('Sandi dapat diganti di halaman Ganti Sandi.');
  });

  it('can navigate to change password page', () => {
    cy.get('#navbar').trigger('mouseover');
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
